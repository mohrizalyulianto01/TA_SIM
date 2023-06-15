<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginmentor extends CI_Controller {

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
		if ($this->session->userdata('status') == "mentor") {
			redirect('mentor');
		} else {
        // Pengguna belum memiliki sesi login, lanjutkan dengan validasi form
			if ($this->form_validation->run() == false) {
				$this->load->view('mentor/login');
			} else {
				$login = $this->login->mentor();
				if ($login == false) {
					$this->session->set_flashdata('gagal', 'Username atau password salah!');
					redirect('Loginmentor');
				} else {
					$this->session->set_userdata(array(
						'status' => "mentor",
						'id_mentor' => $login->id_mentor,
						'username' => $login->username,
						'nama_mentor' => $login->nama_mentor,
						'id_detail_mentoring' => $login->id_detail_mentoring
					));
					redirect('mentor');
				}
			}
		}
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('Loginmentor');
    }

}
