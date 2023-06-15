<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataharian extends CI_Controller {

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
		$data['judul'] = "Laporan Harian Peserta Magang";
		$data['peserta'] = $this->crud->get('peserta_magang');
		$this->load->view('templates/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/detailharian',$data);
		$this->load->view('templates/footer');
	}

	public function laporan($id_peserta)
	{
		$data['harian'] = $this->crud->lihatHarian($id_peserta);
		$data['peserta'] = $this->crud->get('peserta_magang');
		$data['judul'] = "Data Absensi";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/laporanharian', $data);
		$this->load->view('templates/footer');
	}

	public function filterlaporan()
	{
		$id_peserta = $this->input->post('id_peserta');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));
		$data['harian'] = $this->crud->filterharian($id_peserta,$start_date, $end_date);
		$data['peserta'] = $this->crud->get('peserta_magang');
		$data['judul'] = "Data Gaji";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/filterharian', $data);
		$this->load->view('templates/footer');
	}

	public function delete($id)
	{
		$where = array('id_catatan_harian' => $id );
		$this->crud->delete($where, 'catatan_harian');
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('dataharian');
	}

	public function downloadFile($id)
	{
		$file = $this->crud->cekCatatan($id);
		if ($file) {
			$filePath = './file/' . $file->file;
			$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        // Periksa apakah file ada di server
			if (file_exists($filePath)) {
            // Set header untuk mengatur tipe file
				switch ($fileExtension) {
					case '.doc':
					header('Content-Type: application/msword');
					break;
					case '.docx':
					header('Content-Type: application/msword');
					break;
					case '.pdf':
					header('Content-Type: application/pdf');
					break;
					case '.jpg':
					header('Content-Type: image/jpeg');
					break;
				}

            // Set header untuk memberi nama file saat diunduh
				header('Content-Disposition: attachment; filename="' .$file->foto_kegiatan. '"');

            // Baca dan keluarkan isi file
				readfile($filePath);

				exit;
			} else {
            // File tidak ditemukan
				echo 'File not found.';
			}
		} else {
        // Data file tidak ditemukan
			echo 'File data not found.';
		}
	}
}
?>