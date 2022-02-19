<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('forum_model');
        $this->load->model('log_model');
        $this->load->model('nilai_model');
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
        $home = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('nama_user', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "data" => $this->forum_model->get(),
            // "data_forum" => $this->forum_model->view_forum()
        );

        $this->load->view("admin/forum", $home);
    }

    public function validasi()
    {
        $this->form_validation->set_rules('id_forum', 'ID Forum', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('user_nama', 'Nama User', 'required');
        $this->form_validation->set_rules('tgl_forum', 'Tanggal Forum', 'required|max_length[100]');
        $this->form_validation->set_rules('judul_forum', 'Judul Forum', 'required');
        $this->form_validation->set_rules('isi_forum', 'Isi Forum', 'required');
    }

    public function validasi_komen()
    {
        $this->form_validation->set_rules('id_komentar', 'ID Komentar', 'required');
        $this->form_validation->set_rules('id_forum', 'ID Forum', 'required');
        $this->form_validation->set_rules('tgl_forum', 'Tanggal Forum', 'required|max_length[100]');
        $this->form_validation->set_rules('judul_forum', 'Judul Forum', 'required');
        $this->form_validation->set_rules('isi_forum', 'Isi Forum', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
    }

    public function add_forum()
    {
        $user_nama = $this->session->userdata('user_nama');

        $add_forum = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('user_nama', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "id_forum" => $this->forum_model->id_forum($user_nama)
        );

        $this->load->view("admin/add_forum", $add_forum);
    }

    public function add()
    {
        $this->form_validation->set_rules('id_forum', 'ID Forum', 'required');
        // $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('tgl_forum', 'Tanggal Forum', 'required|max_length[100]');
        $this->form_validation->set_rules('judul_forum', 'Judul Forum', 'required');
        $this->form_validation->set_rules('isi_forum', 'Isi Forum', 'required');

        if ($this->form_validation->run() != false) {
            $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
            // $tanggal = $this->input->post("tgl_forum");
            // $tgl = date('Y-m-d', strtotime($tanggal));

            $data = array(
                "id_forum" => $this->input->post("id_forum"),
                // "nip" => $this->input->post("nip"),
                "nama_user" => $this->input->post("user_nama"),
                "tgl_forum" => $waktu,
                "judul_forum" => $this->input->post("judul_forum"),
                "isi_forum" => $this->input->post("isi_forum")
            );

            $keterangan = "Menambah forum";
            //  $nip = $this->session->userdata('nip');
            $email = $this->session->userdata('email');

            if ($this->forum_model->insert($data) && $this->create_log($email, $keterangan)) {
                redirect('admin/forum');
            }
        }
    }

    public function edit_forum($id)
    {
        $data['forum'] = $this->forum_model->get_forum_id($id);

        $this->load->view("admin/edit_forum", $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('id_forum', 'ID Forum', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('tgl_forum', 'Tanggal Forum', 'required|max_length[100]');
        $this->form_validation->set_rules('judul_forum', 'Judul Forum', 'required');
        $this->form_validation->set_rules('isi_forum', 'Isi Forum', 'required');

        $id['id_forum'] = $this->input->post("id_forum");
        $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

        $data = array(
            'id_forum' => $this->input->post('id_forum'),
            // 'nip' => $this->input->post('nip'),
            'nama_user' => $this->input->post('nama_user'),
            'tgl_forum' => $waktu,
            'judul_forum' => $this->input->post('judul_forum'),
            'isi_forum' => $this->input->post('isi_forum')
        );

        $keterangan = "Mengubah forum";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->forum_model->update($data, $id) && $this->create_log($email, $keterangan)) {
            redirect('admin/forum');
        }
    }

    public function delete_forum($id)
    {
        $keterangan = "Menghapus forum";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->forum_model->delete($id) && $this->create_log($email, $keterangan)) {
            redirect('admin/forum');
        }
    }

    public function read_forum($id)
    {
        $home = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('nama_user', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "data" => $this->forum_model->get_forum_id($id),
            "id_forum" => $this->forum_model->id_forum($id),
            "id_komentar" => $this->forum_model->id_komentar($id),
            "komentar" => $this->forum_model->get_komentar($id),
            "data_komen" => $this->forum_model->data_komentar($id),
            "judul_forum" => $this->forum_model->judul_forum($id)
        );

        $this->load->view("admin/read_forum", $home);
    }

    public function reply_forum($id)
    {
        // $judul_forum = $this->forum_model->judul_forum($id);
        // $user_nama = $this->session->userdata('user_nama');
        // $data['forum'] = $this->forum_model->get_forum_id($id);

        $data = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('user_nama', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "id_komentar" => $this->forum_model->id_komentar($id),
            "id_forum" => $this->forum_model->get_forum_id($id),
            // "forum" => $this->forum_model->get_forum_id($id),
            "judul_forum" => $this->forum_model->judul_forum($id)
        );

        $this->load->view("admin/reply_forum", $data);
    }

    public function reply()
    {
        $this->form_validation->set_rules('id_komentar', 'ID Komentar', 'required');
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required');
        $this->form_validation->set_rules('judul_forum', 'Judul Forum', 'required');
        $this->form_validation->set_rules('isi_komentar', 'Isi Komentar', 'required');
        $this->form_validation->set_rules('tgl_komentar', 'Tanggal Komentar', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id_forum');
            $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
            // $tanggal = $this->input->post("tgl_forum");
            // $tgl = date('Y-m-d', strtotime($tanggal));

            $data = array(
                "id_komentar" => $this->input->post("id_komentar"),
                'id_forum' => $this->input->post('id_forum'),
                "user_komentar" => $this->input->post("nama_user"),
                "judul_forum" => $this->input->post("judul_forum"),
                "isi_komentar" => $this->input->post("isi_komentar"),
                "tgl_komentar" => $waktu
            );

            $keterangan = "Menambah komentar";
            //  $nip = $this->session->userdata('nip');
            $email = $this->session->userdata('email');
            $email_ = $this->session->userdata('email');
            $ket = "Menambah komentar";
            $nilai = "5";

            if ($this->forum_model->insert_komentar($data) && $this->create_nilai($email_, $ket, $nilai) && $this->create_log($email, $keterangan)) {
                redirect('admin/forum/read_forum/' . $id);
            }
        }
    }

    public function delete_komentar($id)
    {
        $idkomen = $this->uri->segment(4);
        $keterangan = "Menghapus komentar";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->forum_model->delete_komentar($id) && $this->create_log($email, $keterangan)) {
            redirect('admin/forum');
        }
    }
}