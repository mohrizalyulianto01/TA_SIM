<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginpeserta extends CI_Controller {

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
		if ($this->session->userdata('status') == "peserta") {
			redirect('peserta');
		} else {
        // Pengguna belum memiliki sesi login, lanjutkan dengan validasi form
			if ($this->form_validation->run() == false) {
				$this->load->view('magang/login');
			} else {
				$login = $this->login->peserta();
				if ($login == false) {
					$this->session->set_flashdata('gagal', 'Username atau password salah!');
					redirect('Loginpeserta');
				} else {
					$this->session->set_userdata(array(
						'status' => "peserta",
						'id_peserta' => $login->id_peserta,
						'username' => $login->username,
						'nama_peserta' => $login->nama_peserta,
						'id_detail_mentoring' => $login->id_detail_mentoring
					));
					redirect('peserta');
				}
			}
		}
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('Loginpeserta');
    }

}
