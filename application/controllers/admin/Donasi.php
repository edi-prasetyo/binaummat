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
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('donasi_model');
    $this->load->model('category_model');
    $this->load->library('pagination');
  }

  public function index()
  {
    $config['base_url']         = base_url('admin/donasi/index/');
    $config['total_rows']       = count($this->donasi_model->total_row());
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
    $donasi = $this->donasi_model->get_donasi($limit, $start);
    $data = [
      'title'                   => 'Data Artikel',
      'donasi'                  => $donasi,
      'pagination'              => $this->pagination->create_links(),
      'content'                 => 'admin/donasi/index'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function create()
  {
    $category = $this->category_model->get_category();
    $this->form_validation->set_rules(
      'donasi_title',
      'Judul Donasi',
      'required',
      [
        'required'              => 'Judul Donasi harus di isi',
      ]
    );
    $this->form_validation->set_rules(
      'donasi_desc',
      'Deskripsi Donasi',
      'required',
      [
        'required'              => 'Deskripsi Donasi harus di isi',
      ]
    );
    if ($this->form_validation->run()) {

      $config['upload_path']      = './assets/img/donasi/';
      $config['allowed_types']    = 'gif|jpg|png|jpeg';
      $config['max_size']         = 5000000;
      $config['max_width']        = 5000000;
      $config['max_height']       = 5000000;
      $config['remove_spaces']    = TRUE;
      $config['encrypt_name']     = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('donasi_image')) {

        $data = [
          'title'                 => 'Tambah Donasi',
          'category'              => $category,
          'errors_upload'          => $this->upload->display_errors(),
          'content'               => 'admin/donasi/create'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
      } else {
        $upload_data                = array('uploads'  => $this->upload->data());
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/donasi/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 500;
        $config['height']           = 500;
        $config['thumb_marker']     = '';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $slugcode = random_string('numeric', 5);
        $donasi_slug  = url_title($this->input->post('donasi_title'), 'dash', TRUE);
        $data  = [
          'created_by'              => $this->session->userdata('id'),
          'category_id'             => $this->input->post('category_id'),
          'donasi_slug'             => $slugcode . '-' . $donasi_slug,
          'donasi_title'            => $this->input->post('donasi_title'),
          'donasi_desc'             => $this->input->post('donasi_desc'),
          'donasi_target'           => $this->input->post('donasi_target'),
          'donasi_image'            => $upload_data['uploads']['file_name'],
          'donasi_status'           => $this->input->post('donasi_status'),
          'donasi_keywords'         => $this->input->post('donasi_keywords'),
          'created_at'              => date('Y-m-d H:i:s'),
          'updated_at'              => date('Y-m-d H:i:s')
        ];
        $this->donasi_model->create($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Donasi telah ditambahkan</div>');
        redirect(base_url('admin/donasi'), 'refresh');
      }
    }

    $data = [
      'title'                       => 'Tambah Donasi',
      'category'                    => $category,
      'content'                     => 'admin/donasi/create'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function update($id)
  {
    $donasi = $this->donasi_model->detail($id);
    $category = $this->category_model->get_category();

    $valid = $this->form_validation;
    $valid->set_rules(
      'donasi_title',
      'Judul Donasi',
      'required',
      ['required'                   => '%s harus diisi']
    );
    $valid->set_rules(
      'donasi_desc',
      'Isi Donasi',
      'required',
      ['required'                   => '%s harus diisi']
    );
    if ($valid->run()) {

      if (!empty($_FILES['donasi_image']['name'])) {

        $config['upload_path']        = './assets/img/donasi/';
        $config['allowed_types']      = 'gif|jpg|png|jpeg';
        $config['max_size']           = 5000000;
        $config['max_width']          = 5000000;
        $config['max_height']         = 5000000;
        $config['remove_spaces']      = TRUE;
        $config['encrypt_name']       = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('donasi_image')) {

          $data = [
            'title'                   => 'Edit Donasi',
            'category'                => $category,
            'donasi'                  => $donasi,
            'error_upload'            => $this->upload->display_errors(),
            'content'                 => 'admin/donasi/update'
          ];
          $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

          $upload_data                = array('uploads'  => $this->upload->data());
          $config['image_library']    = 'gd2';
          $config['source_image']     = './assets/img/donasi/' . $upload_data['uploads']['file_name'];
          $config['create_thumb']     = TRUE;
          $config['maintain_ratio']   = TRUE;
          $config['width']            = 500;
          $config['height']           = 500;
          $config['thumb_marker']     = '';
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();

          if ($donasi->donasi_image != "") {
            unlink('./assets/img/donasi/' . $donasi->donasi_image);
          }

          $data  = [
            'id'                        => $id,
            'created_by'                => $this->session->userdata('id'),
            'category_id'               => $this->input->post('category_id'),
            'donasi_title'             => $this->input->post('donasi_title'),
            'donasi_desc'              => $this->input->post('donasi_desc'),
            'donasi_target'            => $this->input->post('donasi_target'),
            'donasi_image'             => $upload_data['uploads']['file_name'],
            'donasi_status'            => $this->input->post('donasi_status'),
            'donasi_keywords'          => $this->input->post('donasi_keywords'),
            'updated_at'                => date('Y-m-d H:i:s')
          ];
          $this->donasi_model->update($data);
          $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
          redirect(base_url('admin/donasi'), 'refresh');
        }
      } else {

        if ($donasi->donasi_image != "")
          $data  = [
            'id'                        => $id,
            'created_by'                => $this->session->userdata('id'),
            'category_id'               => $this->input->post('category_id'),
            'donasi_title'             => $this->input->post('donasi_title'),
            'donasi_desc'              => $this->input->post('donasi_desc'),
            'donasi_target'            => $this->input->post('donasi_target'),
            'donasi_status'            => $this->input->post('donasi_status'),
            'donasi_keywords'          => $this->input->post('donasi_keywords'),
            'updated_at'                => date('Y-m-d H:i:s')
          ];
        $this->donasi_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
        redirect(base_url('admin/donasi'), 'refresh');
      }
    }

    $data = [
      'title'                         => 'Update Donasi',
      'category'                      => $category,
      'donasi'                        => $donasi,
      'content'                       => 'admin/donasi/update'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function delete($id)
  {
    is_login();
    $donasi = $this->donasi_model->donasi_detail($id);

    if ($donasi->donasi_image != "") {
      unlink('./assets/img/artikel/' . $donasi->donasi_image);
    }

    $data = ['id'                   => $donasi->id];
    $this->donasi_model->delete($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
