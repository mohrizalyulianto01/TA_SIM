<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginadmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Model_login','login');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'password', 'required|trim');
		if ($this->session->userdata('status') == "admin") {
			redirect('admin');
		} else {
        // Pengguna belum memiliki sesi login, lanjutkan dengan validasi form
			if ($this->form_validation->run() == false) {
				$this->load->view('admin/login');
				$this->session->set_flashdata('gagal', 'Username atau password salah!');
			} else {
				$login = $this->login->admin();
				if ($login == false) {
					$this->session->set_flashdata('gagal', 'Username atau password salah!');
					redirect('loginadmin');
				} else {
					$this->session->set_userdata(array(
						'status' => "admin",
						'id_admin' => $login->id_admin,
						'username' => $login->username
					));
					redirect('admin');
				}
			}
		}
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('loginadmin');
    }

}
