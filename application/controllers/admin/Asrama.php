<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asrama extends CI_Controller
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
        $this->load->model('asrama_model');
        $this->load->library('pagination');
        $this->load->library('upload');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }

    public function index()
    {
        $config['base_url']         = base_url('admin/asrama/index/');
        $config['total_rows']       = count($this->asrama_model->total_row());
        $config['per_page']         = 5;
        $config['uri_segment']      = 4;

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

        $limit                      = $config['per_page'];
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

        $this->pagination->initialize($config);
        $asrama = $this->asrama_model->get_asrama($limit, $start);
        $data = [
            'title'                 => 'Data Asrama',
            'asrama'                  => $asrama,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/asrama/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function create()
    {
        $this->form_validation->set_rules(
            'asrama_name',
            'Nama Asrama',
            'required',
            [
                'required'      => 'Nama Bank harus di isi',
            ]
        );


        if ($this->form_validation->run()) {
            $config['upload_path']          = './assets/img/asrama/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
            $config['max_size']             = 5000000;
            $config['max_width']            = 5000000;
            $config['max_height']           = 5000000;
            $config['remove_spaces']        = TRUE;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('photo')) {
                $data = [
                    'title'                 => 'Tambah Aasrama',
                    'error_upload'          => $this->upload->display_errors(),
                    'content'               => 'admin/asrama/create'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);
            } else {
                $upload_data                = array('uploads'  => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/asrama/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data  = [
                    'asrama_name'             => $this->input->post('asrama_name'),
                    'asrama_address'           => $this->input->post('asrama_address'),
                    'photo'             => $upload_data['uploads']['file_name'],
                    'created_at'          => date('Y-m-d H:i:s')
                ];
                $this->asrama_model->create($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data Bank telah ditambahkan</div>');
                redirect(base_url('admin/asrama'), 'refresh');
            }
        }
        $data = [
            'title'             => 'Tambah Asrama',
            'error_upload'      => $this->upload->display_errors(),
            'content'           => 'admin/asrama/create'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function Update($id)
    {
        $asrama = $this->asrama_model->asrama_detail($id);
        $valid = $this->form_validation;
        $valid->set_rules(
            'asrama_name',
            'Nama Bank',
            'required',
            ['required'      => '%s harus diisi']
        );

        if ($valid->run()) {
            if (!empty($_FILES['asrama_logo']['name'])) {

                $config['upload_path']          = './assets/img/asrama/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
                $config['max_size']             = 5000000;
                $config['max_width']            = 5000000;
                $config['max_height']           = 5000000;
                $config['remove_spaces']        = TRUE;
                $config['encrypt_name']         = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('asrama_logo')) {
                    $data = [
                        'title'                 => 'Edit Bank',
                        'asrama'                  => $asrama,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'admin/asrama/update'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);
                } else {
                    $upload_data                = array('uploads'  => $this->upload->data());
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/asrama/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    if ($asrama->asrama_logo != "") {
                        unlink('./assets/img/asrama/' . $asrama->asrama_logo);
                    }

                    $data  = [
                        'id'                    => $id,
                        'asrama_name'             => $this->input->post('asrama_name'),
                        'asrama_number'           => $this->input->post('asrama_number'),
                        'asrama_account'          => $this->input->post('asrama_account'),
                        'asrama_branch'           => $this->input->post('asrama_branch'),
                        'asrama_logo'             => $upload_data['uploads']['file_name'],
                        'date_updated'          => time()
                    ];
                    $this->asrama_model->update($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
                    redirect(base_url('admin/asrama'), 'refresh');
                }
            } else {
                if ($asrama->asrama_logo != "")
                    $data  = [
                        'id'                    => $id,
                        'asrama_name'             => $this->input->post('asrama_name'),
                        'asrama_number'           => $this->input->post('asrama_number'),
                        'asrama_account'          => $this->input->post('asrama_account'),
                        'asrama_branch'           => $this->input->post('asrama_branch'),
                        'date_updated'          => time()
                    ];
                $this->asrama_model->update($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
                redirect(base_url('admin/asrama'), 'refresh');
            }
        }

        $data = [
            'title'             => 'Update Bank',
            'asrama'              => $asrama,
            'content'           => 'admin/asrama/update'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function delete($id)
    {
        is_login();
        $asrama = $this->asrama_model->asrama_detail($id);

        if ($asrama->asrama_logo != "") {
            unlink('./assets/img/asrama/' . $asrama->asrama_logo);
        }

        $data = ['id'   => $asrama->id];
        $this->asrama_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
