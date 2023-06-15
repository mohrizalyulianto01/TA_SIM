<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Model_login','login');
		if($this->session->userdata('status')!='mentor'){
			if ($this->session->userdata('status') =='admin') {
				redirect('admin');
			}elseif($this->session->userdata('status') =='peserta')
			{
				redirect('peserta');
			}else{
				redirect('loginmentor');
			}
		}
	}

	public function index()
	{
		$data['judul'] = "Dashboard Mentor";
		$this->load->view('templates/header',$data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/index');
		$this->load->view('templates/footer');
	}

}
