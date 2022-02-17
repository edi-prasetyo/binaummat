<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
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
    $this->load->model('berita_model');
    $this->load->model('category_model');
    $this->load->model('meta_model');
    $this->load->model('donasi_model');
    $this->load->library('pagination');
  }
  public function index()
  {
    $meta                           = $this->meta_model->get_meta();
    $category                       = $this->category_model->get_category();
    $donasi_popular                  = $this->donasi_model->donasi_populer();
    $this->load->library('pagination');
    $config['base_url']             = base_url('berita/index/');
    $config['total_rows']           = count($this->berita_model->total());
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
    $berita = $this->berita_model->berita($limit, $start);

    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data = array(
        'title'                       => 'Berita - ' . $meta->title,
        'deskripsi'                   => 'Berita - ' . $meta->description,
        'keywords'                    => 'Berita - ' . $meta->keywords,
        'paginasi'                    => $this->pagination->create_links(),
        'berita'                      => $berita,
        'category'                    => $category,
        'donasi_popular'               => $donasi_popular,
        'content'                     => 'front/berita/index_berita'
      );
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data = array(
        'title'                       => 'Berita - ' . $meta->title,
        'deskripsi'                   => 'Berita - ' . $meta->description,
        'keywords'                    => 'Berita - ' . $meta->keywords,
        'paginasi'                    => $this->pagination->create_links(),
        'berita'                      => $berita,
        'category'                    => $category,
        'donasi_popular'               => $donasi_popular,
        'content'                     => 'mobile/berita/index'
      );
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
  public function detail($berita_slug = NULL)
  {
    if (!empty($berita_slug)) {
      $berita_slug;
    } else {
      redirect(base_url('berita'));
    }
    $category                       = $this->category_model->get_category();
    $donasi_popular                  = $this->donasi_model->donasi_populer();

    $berita                         = $this->berita_model->read($berita_slug);

    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data                           = array(
        'title'                       => $berita->berita_title,
        'deskripsi'                   => $berita->berita_title,
        'keywords'                    => $berita->berita_keywords,
        'berita'                      => $berita,
        'category'                    => $category,
        'donasi_popular'               => $donasi_popular,
        'content'                     => 'front/berita/detail_berita'
      );
      $this->add_count($berita_slug);
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data                           = array(
        'title'                       => $berita->berita_title,
        'deskripsi'                   => $berita->berita_title,
        'keywords'                    => $berita->berita_keywords,
        'berita'                      => $berita,
        'category'                    => $category,
        'donasi_popular'               => $donasi_popular,
        'content'                     => 'mobile/berita/detail'
      );
      $this->add_count($berita_slug);
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
  function add_count($berita_slug)
  {
    // load cookie helper
    $this->load->helper('cookie');
    // this line will return the cookie which has slug name
    $check_visitor = $this->input->cookie(urldecode($berita_slug), FALSE);
    // this line will return the visitor ip address
    $ip = $this->input->ip_address();
    // if the visitor visit this article for first time then //
    //set new cookie and update article_views column  ..
    //you might be notice we used slug for cookie name and ip
    //address for value to distinguish between articles  views
    if ($check_visitor == false) {
      $cookie = array(
        "name"                      => urldecode($berita_slug),
        "value"                     => "$ip",
        "expire"                    =>  time() + 7200,
        "secure"                    => false
      );
      $this->input->set_cookie($cookie);
      $this->berita_model->update_counter(urldecode($berita_slug));
    }
  }
}
