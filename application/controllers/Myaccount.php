<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myaccount extends CI_Controller
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
    $this->load->library('pagination');
    $this->load->model('meta_model');
    $this->load->model('transaksi_model');
    $this->load->model('bank_model');
  }

  public function index()
  {
    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    $meta = $this->meta_model->get_meta();
    $transaksi = $this->transaksi_model->mytransaksi($id);

    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data = array(
        'title'                           => 'Akun Saya',
        'deskripsi'                       => 'Berita - ' . $meta->description,
        'keywords'                        => 'Berita - ' . $meta->keywords,
        'user'                            => $user,
        'meta'                            => $meta,
        'transaksi'                       => $transaksi,
        'content'                         => 'front/myaccount/index_account'
      );
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data = array(
        'title'                           => 'Akun Saya',
        'deskripsi'                       => 'Berita - ' . $meta->description,
        'keywords'                        => 'Berita - ' . $meta->keywords,
        'user'                            => $user,
        'meta'                            => $meta,
        'transaksi'                       => $transaksi,
        'content'                         => 'mobile/myaccount/index'
      );
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
  public function update()
  {
    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    $meta = $this->meta_model->get_meta();
    $this->form_validation->set_rules(
      'user_name',
      'Nama',
      'required',
      [
        'required'                      => 'Nama harus di isi'
      ]
    );
    if ($this->form_validation->run()) {

      if (!empty($_FILES['user_image']['name'])) {
        $config['upload_path']          = './assets/img/avatars/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 5000000;
        $config['max_width']            = 5000000;
        $config['max_height']           = 5000000;
        $config['remove_spaces']        = TRUE;
        $config['encrypt_name']         = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('user_image')) {

          if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = [
              'title'                     => 'Ubah Profile',
              'deskripsi'                 => 'Profile - ' . $meta->description,
              'keywords'                  => 'Profile - ' . $meta->keywords,
              'meta'                      => $meta,
              'error_upload'              => $this->upload->display_errors(),
              'content'                   => 'front/myaccount/update_account'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
          } else {
            // Mobile View
            $data = [
              'title'                     => 'Ubah Profile',
              'deskripsi'                 => 'Profile - ' . $meta->description,
              'keywords'                  => 'Profile - ' . $meta->keywords,
              'meta'                      => $meta,
              'error_upload'              => $this->upload->display_errors(),
              'content'                   => 'mobile/myaccount/update'
            ];
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
          }
        } else {

          $upload_data                  = array('uploads'  => $this->upload->data());
          $config['image_library']      = 'gd2';
          $config['source_image']       = './assets/img/avatars/' . $upload_data['uploads']['file_name'];
          $config['create_thumb']       = TRUE;
          $config['maintain_ratio']     = TRUE;
          $config['width']              = 500;
          $config['height']             = 500;
          $config['thumb_marker']       = '';
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();

          if ($user->user_image != "") {
            unlink('./assets/img/avatars/' . $user->user_image);
          }
          $data  = [
            'id'                        => $id,
            'user_name'                 => $this->input->post('user_name'),
            'email'                     => $this->input->post('email'),
            'user_image'                => $upload_data['uploads']['file_name'],
            'user_phone'                => $this->input->post('user_phone'),
            'user_address'              => $this->input->post('user_address'),
            'date_updated'              => time()
          ];
          $this->user_model->update($data);
          $this->session->set_flashdata('message', 'Data telah di Update');
          redirect(base_url('myaccount'), 'refresh');
        }
      } else {
        if ($user->user_image != "")
          $data  = [
            'id'                          => $id,
            'user_name'                   => $this->input->post('user_name'),
            'email'                       => $this->input->post('email'),
            'user_phone'                  => $this->input->post('user_phone'),
            'user_address'                => $this->input->post('user_address'),
            'date_updated'                => time()
          ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'Data telah di Update');
        redirect(base_url('myaccount'), 'refresh');
      }
    }
    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data = [
        'title'                           => 'Ubah Profile',
        'deskripsi'                       => 'Berita - ' . $meta->description,
        'keywords'                        => 'Berita - ' . $meta->keywords,
        'meta'                            => $meta,
        'user'                            => $user,
        'content'                         => 'front/myaccount/update_account'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data = [
        'title'                           => 'Ubah Profile',
        'deskripsi'                       => 'Berita - ' . $meta->description,
        'keywords'                        => 'Berita - ' . $meta->keywords,
        'meta'                            => $meta,
        'user'                            => $user,
        'content'                         => 'mobile/myaccount/update'
      ];
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
  public function ubah_password()
  {
    $id                                 = $this->session->userdata('id');
    $user                               = $this->user_model->user_detail($id);
    $meta                               = $this->meta_model->get_meta();

    $this->form_validation->set_rules(
      'password1',
      'Password',
      'required|trim|min_length[3]|matches[password2]',
      [
        'required'                      => 'Password harus Di isi',
        'matches'                       => 'Password tidak sama',
        'min_length'                    => 'Password Min 3 karakter'
      ]
    );
    $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');
    if ($this->form_validation->run() == false) {
      if (!$this->agent->is_mobile()) {
        // Desktop View
        $data = array(
          'title'                         => 'Ubah Profile',
          'deskripsi'                     => 'Profile - ' . $meta->description,
          'keywords'                      => 'Profile - ' . $meta->keywords,
          'user'                          => $user,
          'meta'                          => $meta,
          'content'                       => 'front/myaccount/password_account'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
      } else {
        // Mobile View
        $data = array(
          'title'                         => 'Ubah Password',
          'deskripsi'                     => 'Profile - ' . $meta->description,
          'keywords'                      => 'Profile - ' . $meta->keywords,
          'user'                          => $user,
          'meta'                          => $meta,
          'content'                       => 'mobile/myaccount/password'
        );
        $this->load->view('mobile/layout/wrapp', $data, FALSE);
      }
    } else {
      $data = [
        'id'                            => $id,
        'password'                      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      ];
      $this->user_model->update($data);
      $this->session->set_flashdata('message', 'Data telah di ubah');
      redirect(base_url('myaccount'), 'refresh');
    }
  }

  public function transaksi()
  {
    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    $meta = $this->meta_model->get_meta();

    $config['base_url']                 = base_url('myaccount/transaksi/index/');
    $config['total_rows']               = count($this->transaksi_model->total_transaksi_user($id));
    $config['per_page']                 = 2;
    $config['uri_segment']              = 4;

    $config['first_link']               = 'First';
    $config['last_link']                = 'Last';
    $config['next_link']                = 'Next';
    $config['prev_link']                = 'Prev';
    $config['full_tag_open']            = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']           = '</ul></nav></div>';
    $config['num_tag_open']             = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']            = '</span></li>';
    $config['cur_tag_open']             = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']            = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']          = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']          = '</span>Next</li>';
    $config['first_tag_open']           = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close']         = '</span></li>';
    $config['last_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']          = '</span></li>';

    $limit                              = $config['per_page'];
    $start                              = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

    $this->pagination->initialize($config);

    $transaksi = $this->transaksi_model->get_transaksi_user($id, $limit, $start);
    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data = [
        'title'                           => 'Data Transaksi',
        'deskripsi'                       => 'deskripsi',
        'keywords'                        => 'keywords',
        'transaksi'                       => $transaksi,
        'user'                            => $user,
        'meta'                            => $meta,
        'pagination'                      => $this->pagination->create_links(),
        'content'                         => 'front/myaccount/transaksi'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data = [
        'title'                           => 'Data Transaksi',
        'deskripsi'                       => 'deskripsi',
        'keywords'                        => 'keywords',
        'transaksi'                       => $transaksi,
        'user'                            => $user,
        'meta'                            => $meta,
        'pagination'                      => $this->pagination->create_links(),
        'content'                         => 'mobile/myaccount/transaksi'
      ];
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }

  public function detail_transaksi($id)
  {
    $transaksi = $this->transaksi_model->detail_transaksi($id);
    $bank = $this->bank_model->get_allbank();

    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data = [
        'title'                         => 'Detail Transaksi',
        'deskripsi'                     => 'detail Transaksi',
        'keywords'                      => 'detail Transaksi',
        'transaksi'                          => $transaksi,
        'bank'                          => $bank,
        'content'                       => 'front/myaccount/detail_transaksi'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data = [
        'title'                         => 'Detail Transaksi',
        'deskripsi'                     => 'detail Transaksi',
        'keywords'                      => 'detail Transaksi',
        'transaksi'                          => $transaksi,
        'bank'                          => $bank,
        'content'                       => 'mobile/myaccount/detail'
      ];
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
}
