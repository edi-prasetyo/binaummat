<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qurban_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allqurban($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('qurban');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_qurban()
    {
        $this->db->select('*');
        $this->db->from('qurban');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_qurban_home()
    {
        $this->db->select('*');
        $this->db->from('qurban');
        $this->db->limit(5);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_qurban_sidebar()
    {
        $this->db->select('*');
        $this->db->from('qurban');
        $this->db->where('qurban_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_qurban($id)
    {
        $this->db->select('*');
        $this->db->from('qurban');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($qurban_slug)
    {
        $this->db->select('*');
        $this->db->from('qurban');
        // Join

        //End Join
        $this->db->where(array(
            'qurban.qurban_slug'      =>  $qurban_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('qurban', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('qurban', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('qurban', $data);
    }

    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('qurban');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
