<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');
        // $this->load->model('forum_model');
        $this->load->model('admin');
        if ($this->admin->is_role() != "admin") {
            redirect("login/");
        }
    }

    public function index()
    {
        $this->load->view("admin/dashboard");
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

    public function logout()
    {
        $this->session->sess_destroy();
        $keterangan = "Keluar dari Sistem";
        $email = $this->session->userdata('email');
        //   $nip = $this->session->userdata('nip');
        $this->create_log($email, $keterangan);
        redirect('login');
    }
}