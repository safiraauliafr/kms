<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Knowledge extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "admin") {
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
        $home = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('nama_user', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "knowledge" => $this->knowledge_model->get()
        );

        $this->load->view("admin/knowledge", $home);
    }

    public function read_knowledge($id)
    {
        $home = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('nama_user', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "data" => $this->knowledge_model->get_knowledge_id($id),
            "id_knowledge" => $this->knowledge_model->id_knowledge($id)
        );

        $this->load->view("admin/read_knowledge", $home);
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

        $this->load->view("admin/add_knowledge", $add_km);
    }

    public function add()
    {
        $this->form_validation->set_rules('id_knowledge', 'ID KNowledge', 'required');
        $this->form_validation->set_rules('user_nama', 'Nama User', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|max_length[100]');
        $this->form_validation->set_rules('nama_knowledge', 'Nama Knowledge', 'required');
        $this->form_validation->set_rules('deskripsi', 'Isi Deskripsi', 'required');



        $data = array(
            "id_knowledge" => $this->input->post("id_knowledge"),
            "nama_user" => $this->input->post("user_nama"),
            "jenis" => $this->input->post("jenis"),
            "nama_knowledge" => $this->input->post("nama_knowledge"),
            "deskripsi" => $this->input->post("deskripsi"),
            "gambar" => $this->input->post("gambar")
        );

        $keterangan = "Menambah data knowledge";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->knowledge_model->insert($data) && $this->create_log($email, $keterangan)) {
            redirect('admin/knowledge');
        }
    }

    public function edit_knowledge($id)
    {
        $data['knowledge'] = $this->knowledge_model->get_knowledge_id($id);

        $this->load->view("admin/edit_knowledge", $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('id_knowledge', 'ID KNowledge', 'required');
        $this->form_validation->set_rules('user_nama', 'Nama User', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|max_length[100]');
        $this->form_validation->set_rules('nama_knowledge', 'Nama Knowledge', 'required');
        $this->form_validation->set_rules('deskripsi', 'Isi Deskripsi', 'required');

        $id['id_knowledge'] = $this->input->post("id_knowledge");

        $data = array(
            "id_knowledge" => $this->input->post("id_knowledge"),
            "nama_user" => $this->input->post("user_nama"),
            "jenis" => $this->input->post("jenis"),
            "nama_knowledge" => $this->input->post("nama_knowledge"),
            "deskripsi" => $this->input->post("deskripsi"),
            "gambar" => $this->input->post("gambar")
        );

        $keterangan = "Mengubah data knowledge";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->knowledge_model->update($data, $id) && $this->create_log($email, $keterangan)) {
            redirect('admin/knowledge');
        }
    }

    public function delete($id)
    {
        $keterangan = "Menghapus data knowledge";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->knowledge_model->delete($id) && $this->create_log($email, $keterangan)) {
            redirect('admin/knowledge');
        }
    }
}