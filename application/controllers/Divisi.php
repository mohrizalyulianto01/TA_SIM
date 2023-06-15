<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi extends CI_Controller {

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
		$data['judul'] = "Data Divisi";
		$data['divisi'] = $this->crud->get('divisi');
		$data['div'] = $this->crud->get('divisi');
		$this->load->view('templates/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/divisi');
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$nama_divisi = $this->input->post('nama_divisi');
		$data = array(
			'nama_divisi' => $nama_divisi,
		);
		$this->crud->insert($data, 'divisi');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('divisi');
	}

	public function update()
	{
			$id = $this->input->post('id_divisi');
			$nama_divisi = $this->input->post('nama_divisi');
		
			$where = array('id_divisi' => $id );
				$data = array(
					'nama_divisi' => $nama_divisi,
				);

			$this->crud->update($where, $data, 'divisi');
			$this->session->set_flashdata('pesan', 'diupdate');
			redirect('divisi');
		
	}

	public function delete($id)
	{
		$where = array('id_divisi' => $id );
		$this->crud->delete($where, 'divisi');
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('divisi');
	}

}
