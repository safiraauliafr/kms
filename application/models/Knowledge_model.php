<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Knowledge_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function id_knowledge($id)
    {

        $this->db->select('Right(tb_knowledge.id_knowledge,3) as kode ', false);
        $this->db->order_by('id_knowledge', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tb_knowledge');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi  = "M-" . $kodemax;
        return $kodejadi;
    }

    public function get()
    {
        $query = $this->db->select("*")
            ->from('tb_knowledge')
            ->order_by('id_knowledge', 'ASC')
            ->get();
        return $query->result_array();
    }

    public function get_knowledge_id($id)
    {
        $this->db->where('id_knowledge', $id);
        return $this->db->get('tb_knowledge')->result_array();
    }

    public function insert($data)
    {
        $query = $this->db->insert('tb_knowledge', $data);
        return $query;
    }

    public function update($data, $id)
    {
        $query = $this->db->update("tb_knowledge", $data, $id);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        return $this->db->where('id_knowledge', $id)
            ->delete('tb_knowledge');
    }
}