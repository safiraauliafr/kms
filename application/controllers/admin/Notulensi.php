<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notulensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "admin") {
            $this->load->helper('form');
            $this->load->library('form_validation');
            // $this->load->library('Pdf');
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
            //   "nip" => $nip,
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
        $data['notulensi'] = $this->notulen_model->get();

        $this->load->view("admin/notulensi", $data);
    }

    public function add_notulensi()
    {
        $id = $this->input->post('id_notulensi');

        $add_not = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('user_nama', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "id_notulensi" => $this->notulen_model->id_notulensi($id)
        );

        $this->load->view("admin/add_notulensi", $add_not);
    }

    public function add()
    {
        $this->form_validation->set_rules('id_notulensi', 'ID Notulensi', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('tgl_notulensi', 'Tanggal Notulensi', 'required|max_length[100]');
        $this->form_validation->set_rules('status_notulensi', 'Status Notulensi', 'required');
        $this->form_validation->set_rules('isi_notulensi', 'Isi Notulensi', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu Notulensi', 'required');
        $this->form_validation->set_rules('tempat', 'Tempat Notulensi', 'required');

        if ($this->form_validation->run() != false) {
            $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
            // $tanggal = $this->input->post("tgl_forum");
            // $tgl = date('Y-m-d', strtotime($tanggal));

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
                "waktu" => $this->input->post("waktu"),
                "tempat" => $this->input->post("tempat"),
                "status_notulensi" => $status_not

            );

            $keterangan = "Menambah notulensi";
            $email = $this->session->userdata('email');
            $email_ = $this->session->userdata('email');
            $ket = "Membuat notulensi";
            $nilai = "5";

            if (
                $this->notulen_model->insert($data) && $this->create_nilai($email_, $ket, $nilai)
                && $this->create_log($email, $keterangan)
            ) {
                redirect('admin/notulensi');
            }
        }
    }

    public function read_notulensi($id)
    {
        $home = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('nama_user', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "data" => $this->notulen_model->get_notulensi_id($id),
            "id_notulensi" => $this->notulen_model->id_notulensi($id)
        );

        $this->load->view("admin/read_notulensi", $home);
    }

    public function edit_notulensi($id)
    {
        $data['notulensi'] = $this->notulen_model->get_notulensi_id($id);

        $this->load->view("admin/edit_notulensi", $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('id_notulensi', 'ID Notulensi', 'required');
        $this->form_validation->set_rules('user_nama', 'Nama User', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('tgl_notulensi', 'Tanggal Notulensi', 'required|max_length[100]');
        $this->form_validation->set_rules('status_notulensi', 'Status Notulensi', 'required');
        $this->form_validation->set_rules('isi_notulensi', 'Isi Notulensi', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu Notulensi', 'required');
        $this->form_validation->set_rules('tempat', 'Tempat Notulensi', 'required');

        $id['id_notulensi'] = $this->input->post("id_notulensi");
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
            "waktu" => $this->input->post("waktu"),
            "tempat" => $this->input->post("tempat"),
            "status_notulensi" => $status_not
        );

        $keterangan = "Mengubah notulensi";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->notulen_model->update($data, $id) && $this->create_log($email, $keterangan)) {
            redirect('admin/notulensi');
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

        //$this->notulen_model->validasi($status_not, $id['id_notulensi']) ini buat memproses validasi ke database
        //alias update database,nah kalo mainan database pasti ada primary key ($id['id_notulensi']) ini primarynya
        // redirect ke halaman awalnya harusnya gausah pake id kayaknya
        // kalo mau pake id redirectnya ke sini read_notulensi/N-003
        if ($this->notulen_model->validasi($status_not, $id['id_notulensi']) && $this->create_log($email, $keterangan)) {
            redirect('admin/notulensi/');
        }
    }

    public function delete_notulensi($id)
    {
        $keterangan = "Menghapus notulensi";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->notulen_model->delete($id) && $this->create_log($email, $keterangan)) {
            redirect('admin/notulensi');
        }
    }
}