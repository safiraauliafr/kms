<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function id_forum($id)
    {

        $this->db->select('Right(tb_forum.id_forum,3) as kode ', false);
        $this->db->order_by('id_forum', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tb_forum');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi  = "F-" . $kodemax;
        return $kodejadi;
    }

    public function get()
    {
        $query = $this->db->select("*")
            ->from('tb_forum')
            ->order_by('id_forum')
            ->get();
        return $query->result();
    }

    public function getForums($id)
    {
        $query = "SELECT * FROM tb_forum WHERE id_forum = " . $id;
        // print_r($query);
        // die;
        return $this->db->query($query)->result_array();
    }

    public function get_forum_id($id)
    {
        $this->db->where('id_forum', $id);
        return $this->db->get('tb_forum')->result_array();
    }

    public function view_forum($idforum)
    {
        $this->db->where('id_forum', $idforum);
        return $this->db->get('tb_forum')->result_array();
    }

    public function judul_forum($id)
    {
        $this->db->select('*');
        $this->db->where('id_forum', $id);
        return $this->db->get('tb_forum')->result();
    }

    public function insert($data)
    {
        $query = $this->db->insert('tb_forum', $data);
        return $query;
    }

    public function update($data, $id)
    {
        $query = $this->db->update("tb_forum", $data, $id);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function updated($data, $id)
    {
        $this->db->where('id_forum', $id);
        $query = $this->db->update('tb_forum', $data);
        return $query;
    }

    public function delete($id)
    {
        return $this->db->where('id_forum', $id)
            ->delete('tb_forum');
    }

    public function judul($id)
    {
        $this->db->select('*');
        $this->db->where('id_komentar', $id);
        return $this->db->get('tb_komentar')->row();
    }

    // Komentar

    public function id_komentar()
    {

        $this->db->select('Right(tb_komentar.id_komentar,3) as kode ', false);
        $this->db->order_by('id_komentar', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tb_komentar');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi  = "K-" . $kodemax;
        return $kodejadi;
    }

    public function get_komentar($id)
    {
        $this->db->select("*");
        $this->db->from("tb_komentar");
        $this->db->where('id_forum', $id);
        $this->db->order_by("id_komentar desc");
        $query = $this->db->get();
        return $query;
    }

    public function get_komen_id($id)
    {
        $this->db->where('id_komentar', $id);
        return $this->db->get('tb_komentar')->result_array();
    }

    public function data_komentar($id)
    {
        $this->db->where("id_forum", $id);
        $this->db->order_by("id_komentar desc");
        $query = $this->db->get('tb_komentar');
        return $query->result_array();
    }

    public function insert_komentar($data)
    {
        $query = $this->db->insert('tb_komentar', $data);
        return $query;
    }

    public function delete_komentar($id)
    {
        $this->db->where('id_komentar', $id);
        $query = $this->db->delete("tb_komentar");
        return $query;
    }
}