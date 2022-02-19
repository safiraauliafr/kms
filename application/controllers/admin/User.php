<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "admin") {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('user_model');
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
        $data = array(

            'user'    => $this->user_model->get_all(),

        );

        $this->load->view('admin/user', $data);
    }

    public function tambah_user()
    {
        $this->form_validation->set_rules('nama_user', 'Nama User', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'trim|max_length[32]');
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[64]');
        $this->form_validation->set_rules('tgllahir', 'Field of Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|max_length[32]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|max_length[64]');
        $this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'trim|max_length[64]');
        $this->form_validation->set_rules('npwp', 'Nomor NPWP', 'trim|max_length[64]');

        $this->load->view('admin/input_user');

        // if ($this->form_validation->run() == FALSE) {
        //     $data['user'] = $this->user_model->get_user_id($this->session->userdata('user_id'));

        //     $this->load->view('admin/input_user', $data);
        // }
    }

    public function simpan()
    {
        $tanggal = $this->input->post("tgllahir");
        $tgl = date('Y-m-d', strtotime($tanggal));

        $data = array(

            'nip' => $this->input->post("nip"),
            'nama_user' => $this->input->post("nama_user"),
            'username' => $this->input->post("username"),
            'password' => $this->input->post("password"),
            'jenis_kelamin' => $this->input->post("jenis_kelamin"),
            'tempat_lahir' => $this->input->post("tempat_lahir"),
            'tgl_lahir' => $tgl,
            'no_ktp' => $this->input->post("no_ktp"),
            'npwp' => $this->input->post("npwp"),
            'role' => $this->input->post("role"),
            'no_hp' => $this->input->post("no_hp"),
            'email' => $this->input->post("email"),
            'jabatan' => $this->input->post("jabatan"),
            'alamat' => $this->input->post("alamat")

        );
        $keterangan = "Menambah data user";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->user_model->simpan($data) && $this->create_log($email, $keterangan)) {
            redirect('admin/user/');
        }
    }

    public function edit($id)
    {

        $data['user'] = $this->user_model->get_user_id($id);

        $this->load->view('admin/edit_user', $data);
    }

    public function updated()
    {
        $this->form_validation->set_rules('nama_user', 'Nama User', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'trim|max_length[32]');
        $this->form_validation->set_rules('tgllahir', 'Field of Tanggal Lahir', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[64]');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|max_length[32]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|max_length[64]');
        $this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'trim|max_length[64]');
        $this->form_validation->set_rules('npwp', 'Nomor NPWP', 'trim|max_length[64]');

        $id['id'] = $this->input->post("id");
        // $waktu = date("Y-m-d");

        $tanggal = $this->input->post("tgllahir");
        $tgl = date('Y-m-d', strtotime($tanggal));

        $data = array(

            'id' => $this->input->post('id'),
            'nip' => $this->input->post('nip'),
            'username' => $this->input->post('username'),
            'nama_user' => $this->input->post('nama_user'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tgl_lahir' => $tgl,
            'no_ktp' => $this->input->post("no_ktp"),
            'npwp' => $this->input->post("npwp"),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'jabatan' => $this->input->post('jabatan'),
            'alamat' => $this->input->post('alamat')

        );

        $keterangan = "Mengubah data user";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->user_model->update($data, $id) && $this->create_log($email, $keterangan)) {
            redirect('admin/user');
        }
    }

    public function delete($id)
    {
        $keterangan = "Menghapus data user";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->user_model->delete($id) && $this->create_log($email, $keterangan)) {
            redirect('admin/user');
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