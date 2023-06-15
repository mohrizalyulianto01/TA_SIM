<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lihatlaporan extends CI_Controller {

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
		$data['judul'] = "Laporan Hasil Magang";
		$data['peserta'] = $this->crud->cekAbsen();
		$this->load->view('templates/header',$data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/detaillaporan',$data);
		$this->load->view('templates/footer');
	}

	public function laporan($id_peserta)
	{
		$data['laporan'] = $this->crud->lihatLaporan($id_peserta);
		$data['lapor'] = $this->crud->lihatLaporan($id_peserta);
		$data['peserta'] = $this->crud->cekabsen();
		$data['judul'] = "Laporan Hasil Magang";
		$this->load->view('templates/header', $data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/laporanhasil', $data);
		$this->load->view('templates/footer');
	}

	public function filterlaporan()
	{
		$id_peserta = $this->input->post('id_peserta');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));
		$data['laporan'] = $this->crud->filterlaporan($id_peserta,$start_date, $end_date);
		$data['peserta'] = $this->crud->cekabsen();
		$data['judul'] = "Data Gaji";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('admin/filterhasil', $data);
		$this->load->view('templates/footer');
	}

	public function update()
{
    $id = $this->input->post('id_laporan_hasil');
    $catatan = $this->input->post('catatan_hasil_mentor');
    $status = $this->input->post('status');
    $where = array('id_laporan_hasil' => $id);
		$data = array(
			'catatan_hasil_mentor'	=> $catatan,
			'status'	=> $status,
		);

    $this->crud->update($where, $data, 'laporan_hasil_magang');
    $this->session->set_flashdata('pesan', 'diupdate');
    redirect('lihatlaporan');
}

	public function delete($id)
	{
		$where = array('id_laporan_hasil' => $id );
		$this->crud->delete($where, 'laporan_hasil');
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('datalaporan');
	}

	public function downloadFile($id)
	{
		$file = $this->crud->ceklaporan($id);
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
				header('Content-Disposition: attachment; filename="' .$file->file. '"');

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