<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi extends CI_Controller
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
        $this->load->model('donasi_model');
        $this->load->model('bank_model');
        $this->load->model('category_model');
        $this->load->model('pengaturan_model');
        $this->load->model('transaction_model');
        $this->load->model('donatur_model');
        $this->load->model('meta_model');
        $this->load->library('pagination');
    }
    public function index()
    {
        $meta                           = $this->meta_model->get_meta();
        $category                       = $this->category_model->get_category();
        $this->load->library('pagination');
        $config['base_url']             = base_url('donasi/index/');
        $config['total_rows']           = count($this->donasi_model->total());
        $config['per_page']             = 6;
        $config['uri_segment']          = 3;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $limit                          = $config['per_page'];
        $start                          = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        $this->pagination->initialize($config);
        $donasi = $this->donasi_model->donasi($limit, $start);

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = array(
                'title'                       => 'Donasi - ' . $meta->title,
                'deskripsi'                   => 'Donasi - ' . $meta->description,
                'keywords'                    => 'Donasi - ' . $meta->keywords,
                'pagination'                   => $this->pagination->create_links(),
                'donasi'                      => $donasi,
                'category'                    => $category,
                'content'                     => 'front/donasi/index_donasi'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            // Mobile View
            $data = array(
                'title'                       => 'Donasi - ' . $meta->title,
                'deskripsi'                   => 'Donasi - ' . $meta->description,
                'keywords'                    => 'Donasi - ' . $meta->keywords,
                'pagination'                    => $this->pagination->create_links(),
                'donasi'                      => $donasi,
                'category'                    => $category,
                'content'                     => 'mobile/donasi/index'
            );
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }
    public function detail($donasi_slug = NULL)
    {
        if (!empty($donasi_slug)) {
            $donasi_slug;
        } else {
            redirect(base_url('donasi'));
        }
        $category                       = $this->category_model->get_category();
        $donasi                         = $this->donasi_model->read($donasi_slug);
        $donasi_id                      = $donasi->id;

        $this->load->library('pagination');
        $config['base_url']             = base_url('donasi/detail/' . $donasi_slug . '/index/');
        $config['total_rows']           = count($this->donatur_model->total($donasi_id));
        $config['per_page']             = 2;
        $config['uri_segment']          = 5;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $limit                          = $config['per_page'];
        $start                          = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        $this->pagination->initialize($config);
        $listdonatur                        = $this->donatur_model->pagination_donatur($donasi_id, $limit, $start);
        // var_dump($donatur);
        // die;

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data                             = array(
                'title'                       => $donasi->donasi_title,
                'deskripsi'                   => $donasi->donasi_title,
                'keywords'                    => $donasi->donasi_keywords,
                'donasi'                      => $donasi,
                'category'                    => $category,
                'listdonatur'                     => $listdonatur,
                'pagination'                  => $this->pagination->create_links(),
                'content'                     => 'front/donasi/detail_donasi'
            );
            // $this->add_count($donasi_slug);
            $this->load->view('front/donasi/detail_donasi', $data, FALSE);
        } else {
            // Mobile View
            $data                           = array(
                'title'                       => $donasi->donasi_title,
                'deskripsi'                   => $donasi->donasi_title,
                'keywords'                    => $donasi->donasi_keywords,
                'donasi'                      => $donasi,
                'category'                    => $category,
                'listdonatur'                       => $listdonatur,
                'pagination'                    => $this->pagination->create_links(),
                'content'                     => 'mobile/donasi/detail'
            );
            // $this->add_count($donasi_slug);
            $this->load->view('front/donasi/detail_donasi', $data, FALSE);
        }
    }

    public function checkout($id = NULL)
    {


        $donasi             = $this->donasi_model->donasi_detail($id);
        $bank               = $this->bank_model->get_allbank();
        $send_email_order   = $this->pengaturan_model->sendemail_status_order();

        // var_dump($donasi);
        // die;
        $this->form_validation->set_rules(
            'bank_id',
            'Metode Pembayaran',
            'required',
            [
                'required'     => 'Pilih Metode Pembayaran',
            ]
        );
        $this->form_validation->set_rules(
            'donasi_nominal',
            'donasi_nominal',
            'required',
            [
                'required'     => 'Nominal Donasi Harus Di Isi',
            ]
        );


        if ($this->form_validation->run() == false) {

            if (!$this->agent->is_mobile()) {
                // Desktop View
                $data = array(
                    'title'             => 'Checkout',
                    'deskripsi'         => 'Checkout',
                    'keywords'          => 'Checkout',
                    'bank'              => $bank,
                    'donasi'            => $donasi,
                    'content'           => 'front/donasi/checkout'
                );
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {
                // Mobile View
                $data = array(
                    'title'         => 'Checkout',
                    'deskripsi'     => 'Checkout',
                    'keywords'      => 'Checkout',
                    'bank'          => $bank,
                    'donasi'            => $donasi,
                    'content'           => 'mobile/donasi/checkout'
                );
                $this->load->view('mobile/layout/wrapp', $data, FALSE);
            }
        } else {

            $donasi_nominal = $this->input->post('donasi_nominal');
            $sub = substr($donasi_nominal, -3);
            $total =  random_string('numeric', 3);
            $total_nominal =  $donasi_nominal + $total;
            $kode_unik = substr($total_nominal, -3);

            $donasi_id      = $donasi->id;
            $donasi_title   = $donasi->donasi_title;
            $category_id    = $donasi->category_id;
            // var_dump($category_id);
            // die;

            // $date               = ("Y-m-d H:i:s");
            // $new_date = date("Y-m-d H:is", strtotime("$date +3 days"));

            $data  = array(
                'user_id'               => $this->session->userdata('id'),
                'donasi_id'             => $donasi_id,
                'category_id'           => $category_id,
                'donasi_title'          => $donasi_title,
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
            );


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











    // function add_count($donasi_slug)
    // {
    //     $this->load->helper('cookie');
    //     $check_visitor = $this->input->cookie(urldecode($donasi_slug), FALSE);
    //     $ip = $this->input->ip_address();
    //     if ($check_visitor == false) {
    //         $cookie = array(
    //             "name"                      => urldecode($donasi_slug),
    //             "value"                     => "$ip",
    //             "expire"                    =>  time() + 7200,
    //             "secure"                    => false
    //         );
    //         $this->input->set_cookie($cookie);
    //         $this->donasi_model->update_counter(urldecode($donasi_slug));
    //     }
    // }
}
