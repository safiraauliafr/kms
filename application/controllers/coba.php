<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("role") == "admin") {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('dokumen_model');
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
            "dokumen" => $this->dokumen_model->get()
        );

        $this->load->view("admin/dokumen", $home);
    }

    public function add_dokumen()
    {
        $user_nama = $this->session->userdata('user_nama');

        $add_doc = array(
            "nip" => $this->session->userdata('nip', array(), true),
            "user_id" => $this->session->userdata('user_id', array(), true),
            "username" => $this->session->userdata('user_name', array(), true),
            "email" => $this->session->userdata('email', array(), true),
            "user_nama" => $this->session->userdata('user_nama', array(), true),
            "jabatan" => $this->session->userdata('jabatan', array(), true),
            "id_dokumen" => $this->dokumen_model->id_dokumen($user_nama)
        );

        $this->load->view("admin/add_dokumen", $add_doc);
    }

    public function add()
    {
        $this->form_validation->set_rules('id_dokumen', 'ID Dokumen', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required|max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Dokumen', 'required');
        $this->form_validation->set_rules('tgl_dokumen', 'Tanggal Dokumen', 'required');
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required');
        $this->form_validation->set_rules('status_dokumen', 'Status Dokumen', 'required');

        if ($this->form_validation->run() != false) {
            $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

            $status = $this->input->post("status_dokumen");
            if ($status == "Done") {
                $status_doc = "1";
            } else {
                $status_doc = "0";
            }

            $data = array(
                "id_dokumen" => $this->input->post("id_dokumen"),
                "nip" => $this->input->post("nip"),
                "nama_dokumen" => $this->input->post("nama_dokumen"),
                "file_dokumen" => "",
                "deskripsi" => $this->input->post("deskripsi"),
                "tgl_dokumen" => $waktu,
                "nama_user" => $this->input->post("nama_user"),
                "status_dokumen" => $status_doc

            );

            $keterangan = "Request Dokumen";
            //  $nip = $this->session->userdata('nip');
            $email = $this->session->userdata('email');

            if ($this->dokumen_model->insert($data) && $this->create_log($email, $keterangan)) {
                redirect('admin/dokumen');
            }
        }
    }

    public function edit($id)
    {
        $data['dokumen'] = $this->dokumen_model->get_doc_id($id);

        $this->load->view('admin/edit_dokumen', $data);
    }

    public function updated()
    {
        $this->form_validation->set_rules('id_dokumen', 'ID Dokumen', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required|max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Dokumen', 'required');
        $this->form_validation->set_rules('tgl_dokumen', 'Tanggal Dokumen', 'required');
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required');
        $this->form_validation->set_rules('status_dokumen', 'Status Dokumen', 'required');

        $id['id_dokumen'] = $this->input->post("id_dokumen");
        $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

        $status = $this->input->post("status_doc");
        if ($status == "Done") {
            $status_doc = "1";
        } else {
            $status_doc = "0";
        }

        $data = array(
            "id_dokumen" => $this->input->post("id_dokumen"),
            "nip" => $this->input->post("nip"),
            "nama_dokumen" => $this->input->post("nama_dokumen"),
            "file_dokumen" => "",
            "deskripsi" => $this->input->post("deskripsi"),
            "tgl_dokumen" => $waktu,
            "nama_user" => $this->input->post("nama_user"),
            "status_dokumen" => $status_doc
        );

        $keterangan = "Mengubah data dokumen";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->dokumen_model->update($data, $id) && $this->create_log($email, $keterangan)) {
            redirect('admin/dokumen');
        }
    }

    public function delete($id)
    {
        $keterangan = "Menghapus data dokumen";
        //  $nip = $this->session->userdata('nip');
        $email = $this->session->userdata('email');

        if ($this->dokumen_model->delete($id) && $this->create_log($email, $keterangan)) {
            redirect('admin/dokumen');
        }
    }

    public function upload_doc($id)
    {
        $data['dokumen'] = $this->dokumen_model->get_doc_id($id);

        $this->load->view('admin/upload_dokumen', $data);
    }

    public function upload()
    {
        $this->form_validation->set_rules('id_dokumen', 'ID Dokumen', 'required');
        $this->form_validation->set_rules('nip', 'ID User', 'required');
        $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required|max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Dokumen', 'required');
        $this->form_validation->set_rules('tgl_dokumen', 'Tanggal Dokumen', 'required');
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required');
        $this->form_validation->set_rules('status_doc', 'Status Dokumen', 'required');

        if ($this->form_validation->run() != false) {
            $waktu = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
            $id = $this->input->post("id_dokumen");
            $status = $this->input->post("status_doc");

            // ini untuk apa?
            // if ($status == "Done") {
            //     $status_doc = "1";
            // } else {
            //     $status_doc = "0";
            // }

            $nama = $this->session->userdata('user_nama');
            $nama_doc = $this->input->post("nama_dokumen");
            $nama_file = $nama_doc . "_" . $waktu;

            $config['upload_path'] = '././assets/file/';
            // $config['upload_path'] = '././././assets/file/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $config['overwrite'] = FALSE;
            $config['file_name'] = $nama_file;

            // sudah sampai disini
            // errornya karena masih masuk kedalam if yang ini
            $this->load->library('upload', $config);
            //dibawha ini, karena alur uploadnya kesitu
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                // cek pesan error
                var_dump($error);
                die;
                $this->upload_doc($this->input->post("id_dokumen"));
            } else {
                //jika udah ga ada error masuk kesini
                $data = array(
                    "id_dokumen" => $this->input->post("id_dokumen"),
                    "nip" => $this->input->post("nip"),
                    "nama_dokumen" => $nama_doc,
                    "file_dokumen" => $file['file_name'],
                    "deskripsi" => $this->input->post("deskripsi"),
                    "tgl_dokumen" => $waktu,
                    "nama_user" => $this->input->post("nama_user"),
                    "status_dokumen" => "1"
                );
                // dibawha ini ngecek semua data masuk atau masi ada yang kosong
                var_dump($data);
                die;
                //kalo udah ga ada yang kosong apus aja vardum dan dienya, baru deh main query
                $query = $this->upload->data();
                $keterangan = "Upload dokumen";
                $email = $this->session->userdata('email');

                if ($this->dokumen_model->upload($data, $id) && $this->create_log($email, $keterangan)) {
                    redirect('admin/dokumen');
                }
            }
        } else {
            $this->upload_doc($this->input->post("id_dokumen"));
        }
    }

    public function download()
    {
        $this->load->helper('download');
        $filedoc = $this->uri->segment(4);

        $keterangan = "Download dokumen";
        $email = $this->session->userdata('email');

        $this->create_log($email, $keterangan);
        force_download('./assets/file/' . $filedoc, NULL);
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