<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
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
		$this->load->model('Model_crud','crud');
	}

	public function index()
	{
		$data['judul'] = "Halaman Absen Peserta Magang";
		$this->load->view('templates/header',$data);
		$this->load->view('magang/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('magang/presensi');
		$this->load->view('templates/footer');
	}

	public function absen_act()
	{
		
		$id_peserta = $this->session->userdata('id_peserta');
		$jam_masuk = date('H:i:s');
		$tgl_absen = date('Y-m-d');
		$jam_mulai = '08:00:00';
		$keterangan = $this->input->post('keterangan');
		if(strtotime($jam_mulai) < strtotime($jam_masuk)){
			$status_masuk = "Terlambat";
		}else{
			$status_masuk = "Tepat Waktu";
		}
		$data = array(
			'id_peserta' => $id_peserta, 
			'jam_masuk' => $jam_masuk, 
			'tgl_absen' => $tgl_absen, 
			'status_masuk' => $status_masuk,
			'keterangan' => $keterangan
		);
		$this->crud->insert($data, 'absensi');
		redirect('presensi');
	}

	public function absen_selesai_act()
	{
		$id = $this->session->userdata('id_peserta');
		$jam_keluar = date('H:i:s');
		$jam_selesai = '16:00:00';
		$where = array('id_peserta' => $id );
		$data =  array(
			'jam_keluar' => $jam_keluar,
		);
		$this->crud->update($where, $data, 'absensi');
		if ($jam_keluar < $jam_selesai) {
    // Menonaktifkan tombol "Absen Pulang"
			$disabled = 'disabled';
		} else {
    // Mengaktifkan tombol "Absen Pulang"
			$disabled = '';
		}
		redirect('presensi');
	}

	public function history()
	{
		$data['judul'] = "History Absensi";
		$data['absensi'] = $this->crud->getAbsensi();
		$this->load->view('templates/header',$data);
		$this->load->view('magang/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('magang/history',$data);
		$this->load->view('templates/footer');
	}

	public function filterabsen()
	{
		$id_peserta = $this->session->userdata('id_peserta');
		$data['judul'] = "Detail Absen dan Gaji";
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));
		$data['absensi'] = $this->crud->filterAbsensi($id_peserta,$start_date, $end_date);
		$this->load->view('templates/header',$data);
		$this->load->view('magang/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('magang/filter',$data);
		$this->load->view('templates/footer');
	}

}
