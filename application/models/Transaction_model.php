<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_alltransaction()
  {
    $this->db->select('*');
    $this->db->from('transaction');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function new_transaction()
  {
    $this->db->select('*');
    $this->db->from('transaction');
    // $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }
  public function product_home()
  {
    $this->db->select('transaction.*, user.user_name');
    $this->db->from('transaction');
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $this->db->limit(4);
    $query = $this->db->get();
    return $query->result();
  }
  public function get_transaction($limit, $start)
  {
    $this->db->select('transaction.*, category.category_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('category', 'category.id = transaction.category_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function get_mytransaction($id, $limit, $start)
  {
    $this->db->select('transaction.*, user.user_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    //End Join
    $this->db->where('user_id', $id);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Berita Main Page
  public function total_row()
  {
    $this->db->select('transaction.*, user.user_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function detail($id)
  {
    $this->db->select('transaction.*, category.category_name, bank.bank_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('category', 'category.id = transaction.category_id', 'LEFT');
    $this->db->join('bank', 'bank.id = transaction.bank_id', 'LEFT');
    //End Join
    $this->db->where('transaction.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  //Kirim Data Berita ke database
  public function create($data)
  {
    $this->db->insert('transaction', $data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  public function last_transaction($id)
  {
    $this->db->select('transaction.*, bank.bank_logo, bank.bank_number, bank.bank_account');
    $this->db->from('transaction');
    //join
    $this->db->join('bank', 'bank.id = transaction.bank_id', 'left');
    //End Join
    $this->db->where('md5(transaction.id)', $id);
    $query = $this->db->get();
    return $query->row();
  }
  //Update Data
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('transaction', $data);
  }

  //Hapus Data Dari Database
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('transaction', $data);
  }
  // Data Berita yang di tampilkan di Front End
  //listing Berita Main Page
  public function transaction($limit, $start)
  {
    $this->db->select('transaction.*, user.user_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    //End Join
    $this->db->where(['transaction_status'     =>  'Aktif']);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Berita Main Page
  public function total()
  {
    $this->db->select('transaction.*, user.user_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Total Product Vendor
  public function total_myproduct()
  {
    $this->db->select('transaction.*, user.user_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_transaction_user($id, $limit, $start)
  {
    $this->db->select('transaction.*, user.user_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    //End Join
    $this->db->where('user_id', $id);
    $this->db->order_by('transaction.id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function mytransaction($id)
  {
    $this->db->select('transaction.*, user.user_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    //End Join
    $this->db->where('user_id', $id);
    $this->db->order_by('transaction.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_transaction_user($id)
  {
    $this->db->select('transaction.*,user.user_name');
    $this->db->from('transaction');
    // Join
    $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
    //End Join
    $this->db->where('user_id', $id);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // Detail Transaction User
  public function detail_transaction($id)
  {
    $this->db->select('*');
    $this->db->from('transaction');
    //join
    // $this->db->join('mobil', 'mobil.id_mobil = transaction.id_mobil', 'left');
    //End Join
    $this->db->where('id', $id);
    $this->db->order_by('id');
    $query = $this->db->get();
    return $query->row();
  }
  //Cek transaction
  public function cek_transaction($kode_transaction, $email)
  {
    $this->db->select('transaction.*, mobil.mobil_name');
    $this->db->from('transaction');
    //join
    $this->db->join('mobil', 'mobil.id = transaction.mobil_id', 'left');
    //End Join
    $this->db->like('kode_transaction', $kode_transaction);
    $this->db->like('user_email', $email);
    // $this->db->where('kode_transaction',$kode_transaction);
    $query = $this->db->get();
    return $query->row();
  }
}
