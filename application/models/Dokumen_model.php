<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function id_dokumen($id)
    {

        $this->db->select('Right(tb_dokumen.id_dokumen,3) as kode ', false);
        $this->db->order_by('id_dokumen', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tb_dokumen');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi  = "D-" . $kodemax;
        return $kodejadi;
    }

    public function get()
    {
        $query = $this->db->select("*")
            ->from('tb_dokumen')
            ->order_by('kategori', 'ASC')
            ->get();
        return $query->result_array();
    }

    public function getDoc($id)
    {
        $query = "SELECT * FROM tb_dokumen WHERE id_dokumen = " . $id;
        // print_r($query);
        // die;
        return $this->db->query($query)->result_array();
    }

    public function insert($data)
    {
        $query = $this->db->insert('tb_dokumen', $data);
        return $query;
    }

    public function get_doc_id($id)
    {
        $this->db->where('id_dokumen', $id);
        return $this->db->get('tb_dokumen')->result_array();
    }

    public function update($data, $id)
    {
        $query = $this->db->update("tb_dokumen", $data, $id);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        return $this->db->where('id_dokumen', $id)
            ->delete('tb_dokumen');
    }

    public function upload($data, $id)
    {
        $this->db->where('id_dokumen', $id);
        $query = $this->db->update('tb_dokumen', $data);
        return $query;
    }
}