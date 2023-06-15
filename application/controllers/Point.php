<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller {

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
		$this->load->model('Model_crud','crud');
	}

	public function index()
	{
		$data['judul'] = "Data Point Penilaian";
		$data['point'] = $this->crud->get('aspek_penilaian');
		$data['poin'] = $this->crud->get('aspek_penilaian');
		$this->load->view('templates/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/point');
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$aspek_penilaian = $this->input->post('aspek_penilaian');
		$batas_nilai = $this->input->post('batas_nilai');

		$data = array(
			'aspek_penilaian' => $aspek_penilaian,
			'batas_nilai' => $batas_nilai,
		);
		$this->crud->insert($data, 'aspek_penilaian');
		$this->session->set_flashdata('pesan','ditambahkan');
		redirect('point');
	}

	public function update()
	{
		$id = $this->input->post('id_aspek');
		$aspek_penilaian = $this->input->post('aspek_penilaian');
		$batas_nilai = $this->input->post('batas_nilai');
		$where = array('id_aspek' => $id );
		$data = array(
			'aspek_penilaian' => $aspek_penilaian,
			'batas_nilai' => $batas_nilai,
		);

		$this->crud->update($where, $data, 'aspek_penilaian');
		$this->session->set_flashdata('pesan','diupdate');
		redirect('point');
		
	}

	public function delete($id)
	{
		$where = array('id_aspek' => $id );
		$this->crud->delete($where, 'aspek_penilaian');
		$this->session->set_flashdata('pesan','dihapus');
		redirect('point');
	}

}
