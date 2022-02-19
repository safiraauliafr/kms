<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_model extends CI_Model
{

    public function view_log()
    {
        return $this->db->get('tb_aktivitas')->result_array();
    }

    public function get_log()
    {
        $this->db->select("*");
        $this->db->from("tb_aktivitas");
        $this->db->order_by("id_aktivitas");
        $hasil = $this->db->get();
        return $hasil;
    }

    public function insert_log($data)
    {
        $hasil = $this->db->insert('tb_aktivitas', $data);
        return $hasil;
    }
}