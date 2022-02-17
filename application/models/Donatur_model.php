<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donatur_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alldonatur()
    {
        $this->db->select('*');
        $this->db->from('donatur');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function new_donatur()
    {
        $this->db->select('*');
        $this->db->from('donatur');
        // $this->db->join('user', 'user.id = donatur.user_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }
    public function list_donatur($donasi_id)
    {
        $this->db->select('*');
        $this->db->from('donatur');
        $this->db->where('donasi_id', $donasi_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function pagination_donatur($donasi_id, $limit, $start)
    {
        $this->db->select('*');
        $this->db->from('donatur');
        $this->db->where('donasi_id', $donasi_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    // Total Pembelian
    public function total_nominal_donasi($donasi_id)
    {
        $this->db->select_sum('donasi_nominal');
        $this->db->where('donasi_id', $donasi_id);
        $query = $this->db->get('donatur'); 
        return $query->row()->donasi_nominal;
    }

    public function get_donatur($limit, $start)
    {
        $this->db->select('donatur.*, category.category_name');
        $this->db->from('donatur');
        // Join
        $this->db->join('category', 'category.id = donatur.category_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Berita Main Page
    public function total_row()
    {
        $this->db->select('donatur.*, user.user_name');
        $this->db->from('donatur');
        // Join
        $this->db->join('user', 'user.id = donatur.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total($donasi_id)
    {
        $this->db->select('*');
        $this->db->from('donatur');
        $this->db->where('donasi_id', $donasi_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail($id)
    {
        $this->db->select('donatur.*, category.category_name, bank.bank_name');
        $this->db->from('donatur');
        // Join
        $this->db->join('category', 'category.id = donatur.category_id', 'LEFT');
        $this->db->join('bank', 'bank.id = donatur.bank_id', 'LEFT');
        //End Join
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Berita ke database
    public function create($data)
    {
        $this->db->insert('donatur', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('donatur', $data);
    }

    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('donatur', $data);
    }
    // Data Berita yang di tampilkan di Front End

}
