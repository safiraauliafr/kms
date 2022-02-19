<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "user") {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('user_model');
        }
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') == "CEO") {
            $data = array(
                "sidebar_ceo" => $this->load->view("user/sidebar_ceo", array(), true),
                'user' => $this->user_model->get_all('tbl_users')
            );
            $this->load->view('user/user', $data);
        } else {
            $data = array(
                "sidebar" => $this->load->view("user/sidebar", array(), true),
                'user' => $this->user_model->get_all('tbl_users')
            );
            $this->load->view('user/user', $data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}