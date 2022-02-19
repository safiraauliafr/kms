<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_model extends CI_Model
{

    public function view_nilai()
    {
        return $this->db->get('tb_nilai')->result_array();
    }

    public function get()
    {
        $sql = 'SELECT * 
        FROM `tb_nilai`
        GROUP BY `waktu`
        ORDER BY `waktu` DESC';

        return $this->db->query($sql)->result_array();
    }

    public function nilai($email)
    {
        $sql = 'SELECT id_nilai, email, waktu, keterangan,nilai 
        FROM `tb_nilai` WHERE `email` = "' . $email . '"';

        return $this->db->query($sql)->result_array();
    }

    public function get_nilai()
    {
        $query = $this->db->select("*")
            ->from('tb_nilai')
            ->order_by('email', 'ASC')
            ->get();
        return $query->result_array();
    }

    public function insert_nilai($data)
    {
        $hasil = $this->db->insert('tb_nilai', $data);
        return $hasil;
    }
}