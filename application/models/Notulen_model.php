<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notulen_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function id_notulensi($id)
    {

        $this->db->select('Right(tb_notulensi.id_notulensi,3) as kode ', false);
        $this->db->order_by('id_notulensi', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tb_notulensi');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi  = "N-" . $kodemax;
        return $kodejadi;
    }

    public function get()
    {
        $query = $this->db->select("*")
            ->from('tb_notulensi')
            ->order_by('id_notulensi', 'ASC')
            ->get();
        return $query->result_array();
    }

    public function get_notulensi_id($id)
    {
        $this->db->where('id_notulensi', $id);
        return $this->db->get('tb_notulensi')->result_array();
    }

    public function insert($data)
    {
        $query = $this->db->insert('tb_notulensi', $data);
        return $query;
    }

    public function update($data, $id)
    {
        $query = $this->db->update("tb_notulensi", $data, $id);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function updated($data, $id)
    {
        $this->db->where('id_notulensi', $id);
        $query = $this->db->update('tb_notulensi', $data);
        return $query;
    }

    public function delete($id)
    {
        return $this->db->where('id_notulensi', $id)
            ->delete('tb_notulensi');
    }

    public function validasi($status_not, $id)
    {
        $this->db->set("status_notulensi", $status_not);
        $this->db->from("tb_notulensi");
        $this->db->where('id_notulensi', $id);
        $query = $this->db->update();
        return $query;
    }
}