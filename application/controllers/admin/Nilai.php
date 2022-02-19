<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "admin") {
            $this->load->helper('form', 'url');
            $this->load->library('form_validation');
            $this->load->model('nilai_model');
            $this->load->model('user_model');
        }
    }

    public function index()
    {
        $email = $this->user_model->get_all_email();

        for ($a = 0; $a < count($email); $a++) {
            $data['nilai'][$a] = $this->nilai_model->nilai($email[$a]->email);
        }

        $this->load->view("admin/nilai", $data);

        // var_dump($data['nilai_']);
        // die;

    }
}