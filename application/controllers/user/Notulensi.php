<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notulensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "user") {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('notulen_model');
            $this->load->model('log_model');
            $this->load->model('nilai_model');
        }
    }

    public function create_log($email, $keterangan)
    {
        $this->load->model('log_model');
        $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

        $data = array(
            "email" => $email,
            "keterangan" => $keterangan,
            "waktu" => $waktu
        );

        return $this->log_model->insert_log($data);
    }

    public function create_nilai($email_, $ket, $nilai)
    {
        $this->load->model('nilai_model');
        $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

        $data = array(
            "email" => $email_,
            "keterangan" => $ket,
            "nilai" => $nilai,
            "waktu" => $waktu
        );

        return $this->nilai_model->insert_nilai($data);
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
                "notulensi" => $this->notulen_model->get()
            );

            $this->load->view("user/notulensi", $home);
        } else {
            $home = array(
                "sidebar" => $this->load->view("user/sidebar", array(), true),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('nama_user', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true),
                "notulensi" => $this->notulen_model->get()
            );

            $this->load->view("user/notulensi", $home);
        }
    }

    public function add_notulensi()
    {
        $id = $this->input->post('id_notulensi');

        if ($this->session->userdata('jabatan') == "CEO") {
            $add_not = array(
                "sidebar_ceo" => $this->load->view("user/sidebar_ceo", array(), true),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true),
                "id_notulensi" => $this->notulen_model->id_notulensi($id)
            );

            $this->load->view("user/add_notulensi", $add_not);
        } else {
            $add_not = array(
                "sidebar" => $this->load->view("user/sidebar", array(), true),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('user_nama', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true),
                "id_notulensi" => $this->notulen_model->id_notulensi($id)
            );

            $this->load->view("user/add_notulensi", $add_not);
        }
    }

    public function add()
    {
        $this->form_validation->set_rules('id_notulensi', 'ID Notulensi', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('tgl_notulensi', 'Tanggal Notulensi', 'required|max_length[100]');
        $this->form_validation->set_rules('status_notulensi', 'Status Notulensi', 'required');
        $this->form_validation->set_rules('isi_notulensi', 'Isi Notulensi', 'required');

        if ($this->form_validation->run() != false) {
            $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

            $status = $this->input->post("status_not");
            if ($status == "Tervalidasi") {
                $status_not = "1";
            } else {
                $status_not = "0";
            }

            $data = array(
                "id_notulensi" => $this->input->post("id_notulensi"),
                "nip" => $this->input->post("nip"),
                "nama_user" => $this->input->post("user_nama"),
                "isi_notulensi" => $this->input->post("isi_notulensi"),
                "tgl_notulensi" => $waktu,
                "status_notulensi" => $status_not

            );

            $keterangan = "Menambah notulensi";
            $email = $this->session->userdata('email');
            $email_ = $this->session->userdata('email');
            $ket = "Menambah notulensi";
            $nilai = "5";

            if (
                $this->notulen_model->insert($data) && $this->create_nilai($email_, $ket, $nilai)
                && $this->create_log($email, $keterangan)
            ) {
                redirect('user/notulensi');
            }
        }
    }

    public function read_notulensi($id)
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
                "data" => $this->notulen_model->get_notulensi_id($id),
                "id_notulensi" => $this->notulen_model->id_notulensi($id)
            );

            $this->load->view("user/read_notulensi", $home);
        } else {
            $home = array(
                "sidebar" => $this->load->view("user/sidebar", array(), true),
                "nip" => $this->session->userdata('nip', array(), true),
                "user_id" => $this->session->userdata('user_id', array(), true),
                "username" => $this->session->userdata('user_name', array(), true),
                "email" => $this->session->userdata('email', array(), true),
                "user_nama" => $this->session->userdata('nama_user', array(), true),
                "jabatan" => $this->session->userdata('jabatan', array(), true),
                "data" => $this->notulen_model->get_notulensi_id($id),
                "id_notulensi" => $this->notulen_model->id_notulensi($id)
            );

            $this->load->view("user/read_notulensi", $home);
        }
    }

    public function validasi()
    {
        $status_not = "1";
        $id['id_notulensi'] = $this->uri->segment(4);
        //$id['id_notulensi'] tadi belum ada nilainya, nah cara ngambil nilainya gabisa lewat method post
        //bisanya lewat method get, tapi di codeigniter method get diganti pake sistem uri biar ga kena 
        //sql injection
        // $this->uri->segment(4) 4 itu bagian ke 4 dari /-nya 
        // $id = array(            "id_notulensi" => $this->input->post("id_notulensi"));

        // vardump digunakan untuk cek variabel, nah $this-input-post itu null isinya
        // var_dump($id['id_notulensi']);
        // die;

        $keterangan = "Melakukan validasi notulensi";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');
        $email_ = $this->session->userdata('email');
        $ket = "Validasi notulensi";
        $nilai = "5";

        //$this->notulen_model->validasi($status_not, $id['id_notulensi']) ini buat memproses validasi ke database
        //alias update database,nah kalo mainan database pasti ada primary key ($id['id_notulensi']) ini primarynya
        // redirect ke halaman awalnya harusnya gausah pake id kayaknya
        // kalo mau pake id redirectnya ke sini read_notulensi/N-003
        if (
            $this->notulen_model->validasi($status_not, $id['id_notulensi']) && $this->create_nilai($email_, $ket, $nilai)
            && $this->create_log($email, $keterangan)
        ) {
            redirect('user/notulensi/');
        }
    }
}