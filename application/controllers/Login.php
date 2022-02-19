<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin');
        $this->load->model('log_model');
    }

    public function index()
    {
        $this->load->view('login');
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

    public function masuk()
    {

        if ($this->admin->is_logged_in()) {
            redirect("admin/dashboard");
        } else {


            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            if ($this->form_validation->run() == TRUE) {

                $username = $this->input->post("username", TRUE);
                $password = $this->input->post('password', TRUE);

                $checking = $this->admin->check_login('tbl_users', array('username' => $username), array('password' => $password));

                if ($checking != FALSE) {
                    foreach ($checking as $apps) {

                        $session_data = array(
                            'nip'       => $apps->nip,
                            'user_id'   => $apps->id,
                            'user_name' => $apps->username,
                            'user_pass' => $apps->password,
                            'user_nama' => $apps->nama_user,
                            'email'     => $apps->email,
                            'jabatan'   => $apps->jabatan,
                            'tempat_lahir' => $apps->tempat_lahir,
                            'tgl_lahir' => $apps->tgl_lahir,
                            'foto' => $apps->foto,
                            'role'      => $apps->role
                        );
                        $this->session->set_userdata($session_data);

                        $keterangan = "Berhasil Login";
                        //  $nip = $this->session->userdata('nip');
                        $email = $this->session->userdata('email');

                        if ($this->session->userdata("role") == "admin") {
                            if ($this->create_log($email, $keterangan)) {
                                redirect('admin/dashboard/');
                            }
                            // redirect('admin/dashboard/');
                        } else {
                            if ($this->create_log($email, $keterangan)) {
                                redirect('user/dashboard/');
                            }
                        }
                    }
                } else {

                    $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                        <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
                    $this->load->view('login', $data);
                }
            } else {

                $this->load->view('login');
            }
        }
    }

    public function keluar()
    {
        $this->session->sess_destroy();
        $keterangan = "Keluar dari Sistem";
        $email = $this->session->userdata('email');
        //   $nip = $this->session->userdata('nip');
        $this->create_log($email, $keterangan);
        redirect(site_url());
    }
}