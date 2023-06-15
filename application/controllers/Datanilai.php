<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datanilai extends CI_Controller {

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
		$this->load->model('Model_crud','crud');
	}

	public function index()
	{
		$data['judul'] = "Nilai Magang";
		$data['nilai'] = $this->crud->nilaimagang();
		$data['detail'] = $this->crud->detailnilai();
		$this->load->view('templates/header',$data);
		$this->load->view('magang/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('magang/nilai',$data);
		$this->load->view('templates/footer');
	}

	public function downloadFile($id)
	{
		$file = $this->crud->cekSertif($id);
		if ($file) {
			$filePath = './file/' . $file->sertifikat_file;
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
				header('Content-Disposition: attachment; filename="' .$file->sertifikat_file. '"');

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
