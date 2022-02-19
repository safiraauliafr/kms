<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Knowledge extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "user") {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('knowledge_model');
            $this->load->model('log_model');
        }
    }

    public function create_log($email, $keterangan)
    {
        $this->load->model('log_model');
        $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

        $data = array(
            "email" => $email,
            //   "nip" => $nip,
            "keterangan" => $keterangan,
            "waktu" => $waktu
        );

        return $this->log_model->insert_log($data);
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') == "CEO") {
            $home = array(
                "sidebar_ceo" => $this->load->view("user/sidebar_ceo", array(), true),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('nama_user', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true),
                "knowledge" => $this->knowledge_model->get()
            );

            $this->load->view("user/knowledge", $home);
        } else {
            $home = array(
                "sidebar" => $this->load->view("user/sidebar", array(), true),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('nama_user', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true),
                "knowledge" => $this->knowledge_model->get()
            );

            $this->load->view("user/knowledge", $home);
        }
    }

    public function read_knowledge($id)
    {
        if ($this->session->userdata('jabatan') == "CEO") {
            $home = array(
                "sidebar_ceo" => $this->load->view("user/sidebar_ceo", array(), true),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('nama_user', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true),
                "data" => $this->knowledge_model->get_knowledge_id($id),
                "id_knowledge" => $this->knowledge_model->id_knowledge($id)
            );

            $this->load->view("user/read_knowledge", $home);
        } else {
            $home = array(
                "sidebar" => $this->load->view("user/sidebar", array(), true),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('nama_user', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true),
                "data" => $this->knowledge_model->get_knowledge_id($id),
                "id_knowledge" => $this->knowledge_model->id_knowledge($id)
            );

            $this->load->view("user/read_knowledge", $home);
        }
    }

    public function add_knowledge()
    {
        $id = $this->input->post('id_knowledge');

        $add_km = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('user_nama', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "id_knowledge" => $this->knowledge_model->id_knowledge($id)
        );

        $this->load->view("user/add_knowledge", $add_km);
    }
}