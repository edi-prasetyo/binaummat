<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
    $this->load->model('meta_model');
    $this->load->model('galery_model');
    $this->load->model('berita_model');
    $this->load->model('layanan_model');
    $this->load->model('category_model');
  }
  public function index()
  {
    $meta                     = $this->meta_model->get_meta();
    $slider                   = $this->galery_model->slider();
    $berita                   = $this->berita_model->berita_home();
    $category                 = $this->category_model->get_category_home();
    $layanan                   = $this->layanan_model->get_layanan();
    $galery_featured            = $this->galery_model->featured();
    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data = array(
        'title'                 => $meta->title . ' - ' . $meta->tagline,
        'keywords'              => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
        'deskripsi'             => $meta->description,
        'slider'                =>  $slider,
        'berita'                => $berita,
        'category'              => $category,
        'layanan'               => $layanan,
        'galery_featured'       => $galery_featured,
        'content'               => 'front/home/index_home'
      );
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data = array(
        'title'                 => $meta->title . ' - ' . $meta->tagline,
        'keywords'              => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
        'deskripsi'             => $meta->description,
        'slider'                =>  $slider,
        'berita'                => $berita,
        'category'              => $category,
        'layanan'               => $layanan,
        'galery_featured'       => $galery_featured,
        'content'               => 'mobile/home/index'
      );
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
}
