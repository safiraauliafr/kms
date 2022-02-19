<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');
        $this->load->model('admin');
        if ($this->admin->is_role() != "user") {
            redirect("login/");
        }
    }

    public function index()
    {
        // $this->load->view("user/dashboard");

        if ($this->session->userdata('jabatan') == "CEO") {
            $home = array(
                "nip" => $this->session->userdata('nip', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "nama_lengkap" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/ceo_dashboard",  $home);
        } elseif ($this->session->userdata('jabatan') == "CIBO") {
            $home = array(
                "nip" => $this->session->userdata('nip', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "nama_lengkap" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/dashboard",  $home);
        } elseif ($this->session->userdata('jabatan') == "CFRO") {
            $home = array(
                "nip" => $this->session->userdata('nip', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "nama_lengkap" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/dashboard",  $home);
        } elseif ($this->session->userdata('jabatan') == "CC") {
            $home = array(
                "nip" => $this->session->userdata('nip', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "nama_lengkap" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/dashboard",  $home);
        } elseif ($this->session->userdata('jabatan') == "FAT") {
            $home = array(
                "nip" => $this->session->userdata('nip', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "nama_lengkap" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/dashboard",  $home);
        } elseif ($this->session->userdata('jabatan') == "OM") {
            $home = array(
                "nip" => $this->session->userdata('nip', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "nama_lengkap" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/dashboard",  $home);
        } elseif ($this->session->userdata('jabatan') == "Marketing") {
            $home = array(
                "nip" => $this->session->userdata('nip', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "nama_lengkap" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/dashboard",  $home);
        } else {
            $home = array(
                "nip" => $this->session->userdata('nip', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "nama_lengkap" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/dashboard",  $home);
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