<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qurban extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
        $this->load->model('transaction_model');
        $this->load->model('bank_model');
        $this->load->model('pengaturan_model');
        $this->load->model('qurban_model');
    }
    public function index()

    {

        $bank = $this->bank_model->get_allbank();
        $qurban = $this->qurban_model->get_qurban();
        $send_email_order   = $this->pengaturan_model->sendemail_status_order();
        // var_dump($qurban);
        // die;
        if (!$this->agent->is_mobile()) {

            $this->form_validation->set_rules(
                'donatur_name',
                'Nama Donatur',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            if ($this->form_validation->run() === FALSE) {
                $data = [
                    'title'                       => 'Qurban',
                    'deskripsi'                   => 'Qurban di Bina Ummat',
                    'keywords'                    => 'qurban, idul adha, hari raya qurban, qurban berkah',
                    'bank'                        => $bank,
                    'qurban'                      => $qurban,
                    'content'                     => 'front/qurban/index'
                ];
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {

                $id =  $this->input->post('qurban_id');
                $transaction_qurban = $this->qurban_model->detail_qurban($id);

                $donasi_title = $transaction_qurban->qurban_name;
                $donasi_nominal = $transaction_qurban->qurban_price;

                $sub = substr($donasi_nominal, -3);
                $total =  random_string('numeric', 3);
                $total_nominal =  $donasi_nominal + $total;
                $kode_unik = substr($total_nominal, -3);


                $data  = [
                    'donasi_title'          => 'Qurban ' . $donasi_title,
                    'donatur_name'          => $this->input->post('donatur_name'),
                    'donatur_email'         => $this->input->post('donatur_email'),
                    'donatur_phone'         => $this->input->post('donatur_phone'),
                    'doa_khusus'            => $this->input->post('doa_khusus'),
                    'bank_id'               => $this->input->post('bank_id'),
                    'payment_method'        => 'Transfer Bank',
                    'payment_status'        => 'Pending',
                    'donasi_nominal'        => $donasi_nominal,
                    'total_nominal'         => $total_nominal,
                    'kode_unik'             => $kode_unik,
                    'status_read'           => 0,
                    'expired_at'            => date('Y-m-d H:i:s', strtotime("+1 day")),
                    'created_at'            => date('Y-m-d H:i:s')

                ];
                $insert_id = $this->transaction_model->create($data);
                $this->create_incoice_number($insert_id);
                if ($send_email_order->status == 1) {
                    $this->_sendEmail($insert_id);
                    $this->session->set_flashdata('sukses', 'Checkout Berhasil');
                    redirect(base_url('donasi/payment/' . md5($insert_id)), 'refresh');
                } else {
                    $this->session->set_flashdata('sukses', 'Checkout Berhasil');
                    redirect(base_url('donasi/payment/' . md5($insert_id)), 'refresh');
                }
            }
        } else {
            // Mobile View
            $data = array(
                'title'                       => 'Qurban',
                'deskripsi'                   => 'Qurban di Bina Ummat',
                'keywords'                    => 'qurban, idul adha, hari raya qurban, qurban berkah',
                'bank'                        => $bank,
                'qurban'                      => $qurban,
                'content'                     => 'mobile/qurban/index'
            );
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }
    public function create_incoice_number($insert_id)
    {
        $invoice_number = str_pad($insert_id, 11, '0', STR_PAD_LEFT);
        $data = [
            'id'                    => $insert_id,
            'donasi_number'         => $invoice_number,
            'invoice_number'        => 'INV-' . $invoice_number,
        ];
        $this->transaction_model->update($data);
    }
    private function _sendEmail($insert_id)
    {
        $email_order = $this->pengaturan_model->email_order();
        $transaction  = $this->transaction_model->detail_transaction($insert_id);
        // $meta = $this->meta_model->get_meta();

        $config = [
            'protocol'      => "$email_order->protocol",
            'smtp_host'     => "$email_order->smtp_host",
            'smtp_port'     => $email_order->smtp_port,
            'smtp_user'     => "$email_order->smtp_user",
            'smtp_pass'     => "$email_order->smtp_pass",
            'mailtype'      => 'html',
            'charset'       => 'utf-8',
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from("$email_order->smtp_user", 'Order');
        $this->email->to($this->input->post('user_email'));

        $this->email->subject('Order ' . $transaction->invoice_number . '');
        $this->email->message('');

        if ($this->email->send()) {
            return true;
        }
    }
    public function payment($insert_id = NULL)
    {

        $bank                               = $this->bank_model->get_allbank();
        $last_transaction                   = $this->transaction_model->last_transaction($insert_id);

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
                'title'                           => 'Payment',
                'deskripsi'                       => 'Payment',
                'keywords'                        => 'Payment',
                'last_transaction'                => $last_transaction,
                'bank'                            => $bank,
                'content'                         => 'front/donasi/payment'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            // Mobile View
            $data = [
                'title'                           => 'Payment',
                'deskripsi'                       => 'Payment',
                'keywords'                        => 'Payment',
                'last_transaction'                  => $last_transaction,
                'bank'                            => $bank,
                'content'                         => 'mobile/donasi/payment'
            ];
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }



    public function confirmation($insert_id = NULL)
    {

        $last_transaction                   = $this->transaction_model->last_transaction($insert_id);
        $bank                           = $this->bank_model->get_allbank();
        $config['upload_path']          = './assets/img/struk/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 5000000;
        $config['max_width']            = 5000000;
        $config['max_height']           = 5000000;
        $config['remove_spaces']        = TRUE;
        $config['encrypt_name']         = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('bukti_transfer')) {
            if (!$this->agent->is_mobile()) {
                // Desktop View
                $data = array(
                    'title'         => 'Konfirmasi',
                    'deskripsi'     => 'Deskripsi',
                    'keywords'      => 'transaction',
                    'last_transaction'     => $last_transaction,
                    'bank'          => $bank,
                    'error_upload'  => $this->upload->display_errors(),
                    'content'           => 'front/donasi/confirmation'
                );
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {
                // Mobile View
                $data = array(
                    'title'         => 'Konfirmasi',
                    'deskripsi'     => 'Deskripsi',
                    'keywords'      => 'transaction',
                    'last_transaction'     => $last_transaction,
                    'bank'          => $bank,
                    'error_upload'  => $this->upload->display_errors(),
                    'content'           => 'mobile/donasi/confirmation'
                );
                $this->load->view('mobile/layout/wrapp', $data, FALSE);
            }
        } else {

            $upload_data    = array('uploads'  => $this->upload->data());
            $config['image_library']    = 'gd2';
            $config['source_image']     = './assets/img/struk/' . $upload_data['uploads']['file_name'];
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']   = TRUE;
            $config['width']            = 200;
            $config['height']           = 200;
            $config['thumb_marker']     = '';

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();



            $data  = array(
                'id'                    => $last_transaction->id,
                'bukti_transfer'           => $upload_data['uploads']['file_name'],
                'payment_status'          => 'Process',
                'updated_at'          => date('Y-m-d H:i:s')
            );
            $this->transaction_model->update($data);
            $this->session->set_flashdata('sukses', 'Terima Kasih Atas konfirmasi anda pesanan anda akan segera kami proses');
            redirect(base_url('donasi/success/' . $insert_id), 'refresh');
        }
    }

    public function success($insert_id = NULL)
    {
        $last_transaction        = $this->transaction_model->last_transaction($insert_id);


        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
                'title'                           => 'Success',
                'deskripsi'                       => 'Payment',
                'keywords'                        => 'Payment',
                'last_transaction'                => $last_transaction,
                'content'                         => 'front/donasi/success'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            // Mobile View
            $data = [
                'title'                           => 'Success',
                'deskripsi'                       => 'Payment',
                'keywords'                        => 'Payment',
                'last_transaction'                  => $last_transaction,
                'content'                         => 'mobile/donasi/success'
            ];
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }
}
