<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datapresensi extends CI_Controller {

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
		$data['judul'] = "Presensi Peserta Magang";
		$data['peserta'] = $this->crud->get('peserta_magang');
		$this->load->view('templates/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/detail',$data);
		$this->load->view('templates/footer');
	}

	public function absen($id_peserta)
	{
		$data['absensi'] = $this->crud->lihatAbsensi($id_peserta);
		$data['peserta'] = $this->crud->get('peserta_magang');
		$data['judul'] = "Data Absensi";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/presensi', $data);
		$this->load->view('templates/footer');
	}

	public function filterAbsen()
	{
		$id_peserta = $this->input->post('id_peserta');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));
		$data['absens'] = $this->crud->filterAbsen($id_peserta,$start_date, $end_date);
		$data['absensi'] = $this->crud->filterAbsen($id_peserta,$start_date, $end_date);
		$data['peserta'] = $this->crud->get('peserta_magang');
		$data['judul'] = "Data Gaji";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/filter', $data);
		$this->load->view('templates/footer');
	}

	public function delete($id)
	{
		$where = array('id_absen' => $id );
		$this->crud->delete($where, 'absensi');
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('datapresensi');
	}
}
?>