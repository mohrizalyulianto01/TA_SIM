<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Model_login','login');
		if($this->session->userdata('status')!='admin'){
			if ($this->session->userdata('status') =='peserta') {
				redirect('peserta');
			}elseif($this->session->userdata('status') =='mentor')
			{
				redirect('mentor');
			}else{
				redirect('loginadmin');
			}
		}
	}

	public function index()
	{
		$data['judul'] = "Dashboard Admin";
		$this->load->view('templates/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/index');
		$this->load->view('templates/footer');
	}

}
