<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //List Semua Donasi dengan Limit Pagination
  public function get_donasi($limit, $start)
  {
    $this->db->select('donasi.*,
    category.category_name, user.user_name');
    $this->db->from('donasi');
    // Join
    $this->db->join('category', 'category.id = donasi.category_id', 'LEFT');
    $this->db->join('user', 'user.id = donasi.user_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Donasi Main Page
  public function total_row()
  {
    $this->db->select('donasi.*,category.category_name, user.user_name');
    $this->db->from('donasi');
    // Join
    $this->db->join('category', 'category.id = donasi.category_id', 'LEFT');
    $this->db->join('user', 'user.id = donasi.user_id', 'LEFT');
    //End Join
    $this->db->where(['donasi_status'     =>  'Publish']);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Total Detail donasi
  public function detail($id)
  {
    $this->db->select('*');
    $this->db->from('donasi');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  //Total Detail donasi
  public function donasi_detail($id)
  {
    $this->db->select('*');
    $this->db->from('donasi');
    $this->db->where('md5(id)', $id);
    $query = $this->db->get();
    return $query->row();
  }

  // Insert data donasi ke database
  public function create($data)
  {
    $this->db->insert('donasi', $data);
  }
  //Update Data donasi ke database
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('donasi', $data);
  }
  //Hapus Data Dari Database
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('donasi', $data);
  }
  // Data Donasi yang di tampilkan di Front End
  //listing Donasi Main Page
  public function donasi($limit, $start)
  {
    $this->db->select('*');
    $this->db->from('donasi');
    $this->db->where(['donasi_status'     =>  1]);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function donasi_home()
  {
    $this->db->select('donasi.*,category.category_name, user.user_name');
    $this->db->from('donasi');
    // Join
    $this->db->join('category', 'category.id = donasi.category_id', 'LEFT');
    $this->db->join('user', 'user.id = donasi.user_id', 'LEFT');
    //End Join
    $this->db->where(['donasi_status'     =>  'Publish']);
    $this->db->order_by('donasi.id', 'DESC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }
  public function donasi_populer()
  {
    $this->db->select('*');
    $this->db->from('donasi');
    $this->db->where(['donasi_status'     =>  1]);
    $this->db->order_by('donasi_views', 'ASC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Donasi Main Page
  public function total()
  {
    $this->db->select('*');
    $this->db->from('donasi');
    $this->db->where(['donasi_status'     =>  1]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Read Donasi
  public function read($donasi_slug)
  {
    $this->db->select('donasi.*,category.category_name');
    $this->db->from('donasi');
    // Join
    $this->db->join('category', 'category.id = donasi.category_id', 'LEFT');
    //End Join
    $this->db->where(array(
      'donasi_status'           =>  1,
      'donasi.donasi_slug'      =>  $donasi_slug
    ));
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  // Update Counter Views Donasi
  function update_counter($donasi_slug)
  {
    // return current article views
    $this->db->where('donasi_slug', urldecode($donasi_slug));
    $this->db->select('donasi_views');
    $count = $this->db->get('donasi')->row();
    // then increase by one
    $this->db->where('donasi_slug', urldecode($donasi_slug));
    $this->db->set('donasi_views', ($count->donasi_views + 1));
    $this->db->update('donasi');
  }
  // Update Counter Views Donasi
  function update_donatur($id)
  {
    // return current article views
    $this->db->where('id', $id);
    $this->db->select('donatur');
    $count = $this->db->get('donasi')->row();
    // then increase by one
    $this->db->where('id', $id);
    $this->db->set('donatur', ($count->donatur + 1));
    $this->db->update('donasi');
  }

  // Category
  public function category($category_id, $limit, $start)
  {
    $this->db->select('donasi.*,category.category_name, category.category_slug, user.user_name');
    $this->db->from('donasi');
    // Join
    $this->db->join('category', 'category.id = donasi.category_id', 'LEFT');
    $this->db->join('user', 'user.id = donasi.user_id', 'LEFT');
    //End Join
    $this->db->where(['category_id'     =>  $category_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row_category($category_id)
  {
    $this->db->select('donasi.*,category.category_name, user.user_name');
    $this->db->from('donasi');
    // Join
    $this->db->join('category', 'category.id = donasi.category_id', 'LEFT');
    $this->db->join('user', 'user.id = donasi.user_id', 'LEFT');
    //End Join
    $this->db->where(['category_id'     =>  $category_id]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
}
