<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Model_login','login');
		if($this->session->userdata('status')!='peserta'){
			if ($this->session->userdata('status') =='admin') {
				redirect('admin');
			}elseif($this->session->userdata('status') =='mentor')
			{
				redirect('mentor');
			}else{
				redirect('loginpeserta');
			}
		}
	}

	public function index()
	{
		$data['judul'] = "Dashboard Peserta Magang";
		$this->load->view('templates/header',$data);
		$this->load->view('magang/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('magang/index');
		$this->load->view('templates/footer');
	}

}
