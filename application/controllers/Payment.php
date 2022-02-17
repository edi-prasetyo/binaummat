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
        $this->load->model('category_model');
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
                'paginasi'                    => $this->pagination->create_links(),
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
                'paginasi'                    => $this->pagination->create_links(),
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
        // var_dump($donasi);
        // die;

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data                             = array(
                'title'                       => $donasi->donasi_title,
                'deskripsi'                   => $donasi->donasi_title,
                'keywords'                    => $donasi->donasi_keywords,
                'donasi'                      => $donasi,
                'category'                    => $category,
                'content'                     => 'front/donasi/detail_donasi'
            );
            $this->add_count($donasi_slug);
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            // Mobile View
            $data                           = array(
                'title'                       => $donasi->donasi_title,
                'deskripsi'                   => $donasi->donasi_title,
                'keywords'                    => $donasi->donasi_keywords,
                'donasi'                      => $donasi,
                'category'                    => $category,
                'content'                     => 'mobile/donasi/detail'
            );
            $this->add_count($donasi_slug);
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }
    
}
