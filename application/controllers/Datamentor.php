<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datamentor extends CI_Controller {

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
		$data['judul'] = "Data Mentor";
		$data['mentor'] = $this->crud->get('mentor');
		$data['tor'] = $this->crud->get('mentor');
		$data['divisi'] = $this->crud->get('divisi');
		$data['div'] = $this->crud->get('divisi');
		$this->load->view('templates/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/mentor',$data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$nama_mentor = $this->input->post('nama_mentor');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5($password);
		$id_divisi = $this->input->post('id_divisi');
		$data = array(
			'nama_mentor' => $nama_mentor,
			'tgl_lahir' => $tgl_lahir,
			'alamat' => $alamat,
			'no_telp' => $no_telp,
			'username' => $username,
			'password' => $password,
			'id_divisi' => $id_divisi,
		);
		$this->crud->insert($data, 'mentor');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('datamentor');
	}

	public function update()
	{
		$id = $this->input->post('id_mentor');
		$nama_mentor = $this->input->post('nama_mentor');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5($password);
		$id_divisi = $this->input->post('id_divisi');
		$where = array('id_mentor' => $id );
		if ($this->input->post('password') == null) {
			$data = array(
				'nama_mentor' => $nama_mentor,
				'tgl_lahir' => $tgl_lahir,
				'alamat' => $alamat,
				'no_telp' => $no_telp,
				'username' => $username,
				'id_divisi' => $id_divisi,
			);
		}else{
			$data = array(
				'nama_mentor' => $nama_mentor,
				'tgl_lahir' => $tgl_lahir,
				'alamat' => $alamat,
				'no_telp' => $no_telp,
				'username' => $username,
				'password' => $password,
				'id_divisi' => $id_divisi,
			);
		}

		$this->crud->update($where, $data, 'mentor');
		$this->session->set_flashdata('pesan', 'diupdate');
		redirect('datamentor');
		
	}

	public function delete($id)
	{
		$where = array('id_mentor' => $id );
		$this->crud->delete($where, 'mentor');
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('datamentor');
	}

	public function mentoring()
	{
		$data['judul'] = "Data Mentoring";
		$data['mentor'] = $this->crud->get('mentor');
		$data['peserta'] = $this->crud->get('peserta_magang');
		$data['pes'] = $this->crud->get('peserta_magang');
		$data['tor'] = $this->crud->get('mentor');
		$data['mentoring'] = $this->crud->mentoring();
		$this->load->view('templates/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/mentoring',$data);
		$this->load->view('templates/footer');
	}

	public function tambahMentoring()
	{
		$id_mentor = $this->input->post('id_mentor');
		$id_peserta = $this->input->post('id_peserta');
		$data = array(
			'id_mentor' => $id_mentor,
			'id_peserta' =>$id_peserta
		);
		$this->crud->insert($data, 'detail_mentoring');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('datamentor/mentoring');
	}

	public function updateMentoring()
	{
		$id = $this->input->post('id_detail_mentoring');
		$nama_mentor = $this->input->post('nama_mentor');
		$nama_peserta = $this->input->post('nama_peserta');
		$where = array('id_detail_mentoring' => $id );
		$data = array(
			'nama_mentor' => $nama_mentor,
			'nama_peserta' =>$nama_peserta
		);

		$this->crud->update($where, $data, 'detail_mentoring');
		$this->session->set_flashdata('pesan', 'diupdate');
		redirect('datamentor/mentoring');
	}

	public function deleteMentoring($id)
	{
		$where = array('id_detail_mentoring' => $id );
		$this->crud->delete($where, 'detail_mentoring');
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('datamentor/mentoring');
	}

}
