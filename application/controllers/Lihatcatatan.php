<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lihatcatatan extends CI_Controller {

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
		$this->load->model('Model_crud','crud');
	}

	public function index()
	{
		$data['judul'] = "Laporan Harian Peserta Magang";
		$data['peserta'] = $this->crud->cekAbsen();
		$data['magang'] = $this->crud->cekAbsen();
		$this->load->view('templates/header',$data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/detailharian',$data);
		$this->load->view('templates/footer');
	}

	public function laporan($id_peserta)
	{
		$id_mentor = $this->session->userdata('id_mentor');
		$data['harian'] = $this->crud->lihatHarian($id_peserta);
		$data['hari'] = $this->crud->lihatHarian($id_peserta);
		$data['mentoring'] = $this->crud->cekmentoring($id_peserta);
		$data['peserta'] = $this->crud->cekabsen();
		$data['judul'] = "Laporan Harian Peserta Magang";
		$this->load->view('templates/header', $data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/laporanharian', $data);
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
		$data['hari'] = $this->crud->filterharian($id_peserta,$start_date, $end_date);
		$data['peserta'] = $this->crud->cekabsen();
		$data['judul'] = "Data Gaji";
		$this->load->view('templates/header', $data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/filterharian', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$id_peserta = $this->input->post('id_peserta');
		$catatan = $this->input->post('catatan_mentor');
		$tgl = date('Y-m-d');
		$detail_mentoring = $this->db->get_where('detail_mentoring', array('id_peserta' => $id_peserta))->row();
		if ($detail_mentoring) {
			$id_detail_mentoring = $detail_mentoring->id_detail_mentoring;
		} else {
		}
		$data = array(
			'catatan_mentor' => $catatan,
			'tgl_catatan' => $tgl,
			'id_detail_mentoring' => $id_detail_mentoring
		);

		$this->crud->insert($data, 'catatan_harian');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('lihatcatatan');
	}

	public function tambahbanyak()
	{
		$id_mentor = $this->session->userdata('id_mentor');
		$catatan = $this->input->post('catatan_mentor');
		$tgl = date('Y-m-d');
		$detail_mentoring = $this->db->get_where('detail_mentoring', array('id_mentor' => $id_mentor))->row();
		if ($detail_mentoring) {
			$id_detail_mentoring = $detail_mentoring->id_detail_mentoring;
		} else {
		}
		$data = array(
			'catatan_mentor' => $catatan,
			'tgl_catatan' => $tgl,
			'id_detail_mentoring' => $id_detail_mentoring
		);

		$this->crud->insert($data, 'catatan_harian');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('lihatcatatan');
	}

	public function update()
	{
		$id = $this->input->post('id_catatan_harian');
		$catatan = $this->input->post('catatan_mentor');
		$where = array('id_catatan_harian' => $id);
		$data = array(
			'catatan_mentor'	=> $catatan,
		);

		$this->crud->update($where, $data, 'catatan_harian');
		$this->session->set_flashdata('pesan', 'diupdate');
		redirect('lihatcatatan');
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