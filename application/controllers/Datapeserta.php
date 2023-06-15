<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datapeserta extends CI_Controller {

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
		$data['judul'] = "Data Peserta";
		$data['peserta'] = $this->crud->get('peserta_magang');
		$data['magang'] = $this->crud->get('peserta_magang');
		$this->load->view('templates/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/peserta');
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$nama_peserta = $this->input->post('nama_peserta');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5($password);
		$data = array(
			'nama_peserta' => $nama_peserta,
			'tgl_lahir' => $tgl_lahir,
			'alamat' => $alamat,
			'no_telp' => $no_telp,
			'username' => $username,
			'password' => $password,
		);
		$this->crud->insert($data, 'peserta_magang');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('datapeserta');
	}

	public function update()
	{
		$id = $this->input->post('id_peserta');
		$nama_peserta = $this->input->post('nama_peserta');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5($password);
		$where = array('id_peserta' => $id );
		if ($this->input->post('password') == null) {
				$data = array(
					'nama_peserta' => $nama_peserta,
					'tgl_lahir' => $tgl_lahir,
					'alamat' => $alamat,
					'no_telp' => $no_telp,
					'username' => $username,
				);
			}else{
				$data = array(
					'nama_peserta' => $nama_peserta,
					'tgl_lahir' => $tgl_lahir,
					'alamat' => $alamat,
					'no_telp' => $no_telp,
					'username' => $username,
					'password' => $password,
				);
			}

		$this->crud->update($where, $data, 'peserta_magang');
		$this->session->set_flashdata('pesan', 'diupdate');
		redirect('datapeserta');
		
	}

	public function delete($id)
	{
		$where = array('id_peserta' => $id );
		$this->crud->delete($where, 'peserta_magang');
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('datapeserta');
	}

}
