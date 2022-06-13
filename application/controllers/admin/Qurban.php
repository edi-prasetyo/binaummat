<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qurban extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('qurban_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //Index Qurban
    public function index()
    {

        $config['base_url']       = base_url('admin/qurban/index/');
        $config['total_rows']     = count($this->qurban_model->total_row());
        $config['per_page']       = 10;
        $config['uri_segment']    = 4;

        //Membuat Style pagination untuk BootStrap v4
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


        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);


        $qurban = $this->qurban_model->get_qurban($limit, $start);

        $data = [
            'title'             => 'Qurban',
            'qurban'          => $qurban,
            'pagination'    => $this->pagination->create_links(),
            'content'           => 'admin/qurban/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    //Create New Qurban
    public function create()
    {
        // Validasi
        $this->form_validation->set_rules(
            'qurban_name',
            'Nama Kategori',
            'required',
            array(
                'required'         => '%s Harus Diisi',
                'is_unque'         => '%s <strong>' . $this->input->post('qurban_name') .
                    '</strong>Nama Kategori Sudah Ada. Buat Nama yang lain!'
            )
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/galery/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
            $config['max_size']             = 500000; //Dalam Kilobyte
            $config['max_width']            = 500000; //Lebar (pixel)
            $config['max_height']           = 500000; //tinggi (pixel)
            $config['remove_spaces']        = TRUE;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('qurban_image')) {

                //End Validasi
                $data = [
                    'title'         => 'Tambah Qurban',
                    'error_upload'  => $this->upload->display_errors(),
                    'content'       => 'admin/qurban/create'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);

                //Masuk Database

            } else {


                $upload_data    = array('uploads'  => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/galery/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data  = [
                    'qurban_name'         => $this->input->post('qurban_name'),
                    'qurban_price'         => $this->input->post('qurban_price'),
                    'qurban_image'        => $upload_data['uploads']['file_name'],
                    'created_at'            => date('Y-m-d H:i:s')
                ];
                $this->qurban_model->create($data);
                $this->session->set_flashdata('message', 'Data Qurban telah ditambahkan');
                redirect(base_url('admin/qurban'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'        => 'Tambah Qurban',
            'content'          => 'admin/qurban/create'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Update
    public function update($id)
    {
        $qurban = $this->qurban_model->detail_qurban($id);
        // var_dump($qurban);
        // die;

        //Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'qurban_name',
            'Nama Qurban',
            'required',
            ['required'      => '%s harus diisi']
        );


        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['qurban_image']['name'])) {

                $config['upload_path']          = './assets/img/galery/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
                $config['max_size']             = 5000000; //Dalam Kilobyte
                $config['max_width']            = 5000000; //Lebar (pixel)
                $config['max_height']           = 5000000; //tinggi (pixel)
                $config['remove_spaces']        = TRUE;
                $config['encrypt_name']         = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('qurban_image')) {

                    //End Validasi
                    $data = [
                        'title'             => 'Edit Qurban',
                        'qurban'            => $qurban,
                        'error_upload'      => $this->upload->display_errors(),
                        'content'           => 'admin/qurban/update'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    $upload_data    = array('uploads'  => $this->upload->data());
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/galery/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();

                    if ($qurban->qurban_image != "") {
                        unlink('./assets/img/galery/' . $qurban->qurban_image);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                    => $id,
                        'qurban_name'           => $this->input->post('qurban_name'),
                        'qurban_price'          => $this->input->post('qurban_price'),
                        'qurban_image'          => $upload_data['uploads']['file_name'],
                        'updated_at'            => date('Y-m-d H:i:s')
                    ];
                    $this->qurban_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/qurban'), 'refresh');
                }
            } else {
                if ($qurban->qurban_image != "")
                    $data  = [
                        'id'                    => $id,
                        'qurban_name'           => $this->input->post('qurban_name'),
                        'qurban_price'          => $this->input->post('qurban_price'),
                        'updated_at'            => date('Y-m-d H:i:s')
                    ];
                $this->qurban_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/qurban'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Update Berita',
            'qurban'            => $qurban,
            'content'           => 'admin/qurban/update'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //delete Qurban
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $qurban = $this->qurban_model->detail_qurban($id);

        if ($qurban->qurban_image != "") {
            unlink('./assets/img/galery/' . $qurban->qurban_image);
        }

        $data = ['id'   => $qurban->id];

        $this->qurban_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/qurban'), 'refresh');
    }
}
