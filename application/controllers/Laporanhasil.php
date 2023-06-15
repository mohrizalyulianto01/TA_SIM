<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanhasil extends CI_Controller {

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
		$data['judul'] = "Laporan Hasil Magang";
		$data['hasil'] = $this->crud->hasil();
		$data['hasil1'] = $this->crud->hasil();
		$this->load->view('templates/header',$data);
		$this->load->view('magang/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('magang/hasil',$data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$laporan_hasil = $this->input->post('laporan_hasil');
		$tgl = date('Y-m-d');
		$id_detail_mentoring = $this->session->userdata('id_detail_mentoring');
		$data = array(
			'laporan_hasil' => $laporan_hasil,
			'tgl_buat' => $tgl,
			'id_detail_mentoring' => $id_detail_mentoring
		);
		$config['upload_path'] = './file/';
		$config['allowed_types'] = 'pdf';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$file_data = $this->upload->data();
			$data['file'] = $file_data['file_name'];
		} else {
    // Jika terjadi error saat upload file
			$error = $this->upload->display_errors();
			echo "Gagal";
			return;
			redirect('laporanhasil');
		}
		$this->crud->insert($data, 'laporan_hasil_magang');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('laporanhasil');
	}

	public function update()
	{
		$id = $this->input->post('id_laporan_hasil');
		$laporan_hasil = $this->input->post('laporan_hasil');
		$where = array('id_laporan_hasil' => $id);
		if ($file = ''){}else{
			$config['upload_path']          = './file';
			$config['allowed_types']        = 'pdf';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file'))
			{
				echo "Gagal Mengupload";
			}
			else
			{
				$g =  $this->crud->getFile($id)->row_array();
				if ($g != null) {
                //hapus gambar yg ada diserver
					unlink('./file/'.$g['file']);
				}
				$file = $this->upload->data('file_name');
			}
		}
		$data = array(
			'laporan_hasil'	=> $laporan_hasil,
			'file'	=> $file,
		);

		$this->crud->update($where, $data, 'laporan_hasil_magang');
		$this->session->set_flashdata('pesan', 'diupdate');
		redirect('laporanhasil');
	}

	public function delete($id)
	{
		$where = array('id_laporan_hasil' => $id );
		$file = $this->db->get_where('laporan_hasil_magang', array('id_laporan_hasil' => $id))->row();
		if ($file) {
			$filePath = './file/' . $file->file;

        // Periksa apakah file ada di server
			if (file_exists($filePath)) {
            // Hapus file dari server
				unlink($filePath);
			}

        // Hapus data file dari database
			$this->crud->delete($where, 'laporan_hasil_magang');
			$this->session->set_flashdata('pesan', 'dihapus');
			redirect('laporanhasil');

			return true;
		} else {
        // Data file tidak ditemukan
			return false;
		}
		
	}

	public function downloadFile($id)
	{
		$file = $this->crud->cekLaporan($id);
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
