<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "user") {
            $this->load->helper('form', 'url');
            $this->load->library('form_validation');
            $this->load->model('log_model');
        }
    }

    public function index()
    {
        $index_audit = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('username', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('nama_user', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "data" => $this->log_model->get_log(),
            "data_audit" => $this->log_model->view_log()
        );
        $this->load->view("user/log", $index_audit);
    }
}