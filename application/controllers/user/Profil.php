<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "user") {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('user_model');
            $this->load->model('log_model');
        }
    }

    public function index()
    {
        if ($this->session->userdata('jabatan') == "CEO") {
            $home = array(
                "sidebar_ceo" => $this->load->view("user/sidebar_ceo", array(), true),
                "user" =>  $this->user_model->get_user_id($this->session->userdata('user_id')),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('nama_user', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/profil", $home);
        } else {
            $home = array(
                "sidebar" => $this->load->view("user/sidebar", array(), true),
                "user" =>  $this->user_model->get_user_id($this->session->userdata('user_id')),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('nama_user', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true)
            );

            $this->load->view("user/profil", $home);
        }
        // $data['user'] = $this->user_model->get_user_id($this->session->userdata('user_id'));
        // print_r($data);
        // die;
        // $this->load->view('user/profil', $data);
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

    public function edit_profil()
    {
        // $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('nama_user', 'Nama User', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'trim|max_length[32]');
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[64]');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|max_length[32]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|max_length[64]');

        $config['upload_path'] = './assets/img/' . set_value('foto'); //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size'] = '0'; //maksimum besar file 2M
        $config['file_name'] = set_value('foto'); //nama yang terupload nantinya
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->akun_model->get($this->session->userdata('user_id'));

            $this->load->view('user/profil', $data);
        } elseif ($this->upload->do_upload('foto')) {

            $file = $this->upload->data();

            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/img/' . $file['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '50%';
            $config['width'] = 200;
            $config['height'] = 200;
            $config['new_image'] = './assets/img/' . $file['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            // $waktu = date("Y-m-d");
            $id = $this->session->userdata('user_id');

            $update = $this->user_model->updated(
                $this->session->userdata('user_id'),
                array(
                    'nip' => $this->input->post('nip'),
                    'username' => $this->input->post('username'),
                    'nama_user' => $this->input->post('nama_user'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    // 'tgl_lahir' => $waktu,
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'no_hp' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                    'jabatan' => $this->input->post('jabatan'),
                    'alamat' => $this->input->post('alamat'),
                    'foto' => $file['file_name']
                )
            );

            $keterangan = "Mengubah profil";
            //  $nip = $this->session->userdata('nip');
            $email = $this->session->userdata('email');

            if ($update && $this->create_log($email, $keterangan)) {
                redirect('user/profil');
            }
        } else {

            $update = $this->user_model->updated(
                $this->session->userdata('user_id'),
                array(
                    'nip' => $this->input->post('nip'),
                    'username' => $this->input->post('username'),
                    'nama_user' => $this->input->post('nama_user'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'no_hp' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                    'jabatan' => $this->input->post('jabatan'),
                    'alamat' => $this->input->post('alamat')
                )
            );

            $keterangan = "Mengubah profil";
            //  $nip = $this->session->userdata('nip');
            $email = $this->session->userdata('email');

            if ($update && $this->create_log($email, $keterangan)) {
                redirect('user/profil');
            }
        }
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