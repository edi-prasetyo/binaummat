<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('bank_model');
    }
    public function index()
    {
        if ($this->session->userdata('id')) {
            redirect(base_url('myaccount/transaksi'), 'refresh');
        } else {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|trim|valid_email',
                [
                    'required'         => 'Email harus di isi',
                    'valid_email'     => 'Format email Tidak sesuai'
                ]
            );
            $this->form_validation->set_rules(
                'kode_transaksi',
                'Kode Transaksi',
                'required',
                [
                    'required'         => 'Kode Transaksi',
                ]
            );
            if ($this->form_validation->run() == false) {
                if (!$this->agent->is_mobile()) {
                    // Desktop View
                    $data = [
                        'title'       => 'Cek Pesanan',
                        'deskripsi'   => 'Cek Pesanan Rental Mobil',
                        'keywords'    => 'Transaksi',
                        'content'         => 'front/transaksi/index_transaksi'
                    ];
                    $this->load->view('front/layout/wrapp', $data, FALSE);
                } else {
                    // Mobile View
                    $data = [
                        'title'       => 'Cek Pesanan',
                        'deskripsi'   => 'Cek Pesanan Rental Mobil',
                        'keywords'    => 'Transaksi',
                        'content'         => 'mobile/transaksi/index'
                    ];
                    $this->load->view('mobile/layout/wrapp', $data, FALSE);
                }
            } else {
                $this->detail();
            }
        }
    }
    public function detail()
    {
        $kode_transaksi             = $this->input->post('kode_transaksi');
        $email                      = $this->input->post('email');
        $detail_transaksi           = $this->transaksi_model->cek_transaksi($kode_transaksi, $email);
        $bank                       = $this->bank_model->get_allbank();

        $transaksi = $this->db->get_where('transaksi', ['kode_transaksi' => $kode_transaksi])->row_array();
        $transakai_email = $this->db->get_where('transaksi', ['user_email' => $email])->row_array();
        if (empty($transaksi)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Kode Transaksi Tidak ada</div> ');
            redirect('transaksi');
        } elseif (empty($transakai_email)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak ada</div> ');
            redirect('transaksi');
        } else {

            if (!$this->agent->is_mobile()) {
                // Desktop View
                $data = array(
                    'title'                     => 'Transaksi',
                    'deskripsi'                 => 'Deskripsi',
                    'keywords'                  => 'Transaksi Angelita Rentcar',
                    'detail_transaksi'          => $detail_transaksi,
                    'bank'                      => $bank,
                    'content'                   => 'front/transaksi/detail_transaksi'
                );
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {
                // Mobile View
                $data = array(
                    'title'                     => 'Transaksi',
                    'deskripsi'                 => 'Deskripsi',
                    'keywords'                  => 'Transaksi Angelita Rentcar',
                    'detail_transaksi'          => $detail_transaksi,
                    'bank'                      => $bank,
                    'content'                   => 'mobile/transaksi/detail'
                );
                $this->load->view('mobile/layout/wrapp', $data, FALSE);
            }
        }
    }

    public function konfirmasi($id)
    {
        $transaksi                      = $this->transaksi_model->detail($id);
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
        if (!$this->upload->do_upload('bukti_bayar')) {
            if (!$this->agent->is_mobile()) {
                // Desktop View
                $data = array(
                    'title'         => 'Konfirmasi',
                    'deskripsi'     => 'Deskripsi',
                    'keywords'      => 'Transaksi',
                    'transaksi'     => $transaksi,
                    'bank'          => $bank,
                    'error_upload'  => $this->upload->display_errors(),
                    'content'           => 'front/transaksi/konfirmasi_transaksi'
                );
                $this->load->view('front/layout/wrapp', $data, FALSE);
            } else {
                // Mobile View
                $data = array(
                    'title'         => 'Konfirmasi',
                    'deskripsi'     => 'Deskripsi',
                    'keywords'      => 'Transaksi',
                    'transaksi'     => $transaksi,
                    'bank'          => $bank,
                    'error_upload'  => $this->upload->display_errors(),
                    'content'           => 'mobile/transaksi/konfirmasi'
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
                'id'                    => $id,
                'bukti_bayar'           => $upload_data['uploads']['file_name'],
                'status_bayar'          => 'Process',
                'date_updated'          => date('Y-m-d H:i:s')
            );
            $this->transaksi_model->update($data);
            $this->session->set_flashdata('sukses', 'Terima Kasih Atas konfirmasi anda pesanan anda akan segera kami proses');
            redirect(base_url('transaksi/sukses'), 'refresh');
        }
    }
    public function sukses()
    {
        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = array(
                'title'                 => 'Konfirmasi transaksi',
                'deskripsi'             => 'Deskripsi',
                'keywords'              => 'Transaksi',
                'content'               => 'front/transaksi/transaksi_sukses'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            // Mobile View
            $data = array(
                'title'                 => 'Konfirmasi transaksi',
                'deskripsi'             => 'Deskripsi',
                'keywords'              => 'Transaksi',
                'content'               => 'mobile/transaksi/sukses'
            );
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }
}
