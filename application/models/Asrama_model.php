<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asrama_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allasrama()
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_asrama($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Bank Main Page
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function asrama_detail($id)
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Bank ke database
    public function create($data)
    {
        $this->db->insert('asrama', $data);
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('asrama', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('asrama', $data);
    }

    // Data Bank yang di tampilkan di Front End

    //listing Bank Main Page
    public function asrama($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Bank Main Page
    public function total()
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
