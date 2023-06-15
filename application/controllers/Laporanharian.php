<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanharian extends CI_Controller {

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
		$data['judul'] = "Laporan Harian";
		$data['catat'] = $this->crud->catatan();
		$data['catatan'] = $this->crud->catatan();
		$this->load->view('templates/header',$data);
		$this->load->view('magang/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('magang/harian',$data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$catatan_harian = $this->input->post('catatan_harian');
		$tgl = date('Y-m-d');
		$id_detail_mentoring = $this->session->userdata('id_detail_mentoring');
		$data = array(
			'catatan_harian' => $catatan_harian,
			'tgl_catatan' => $tgl,
			'id_detail_mentoring' => $id_detail_mentoring
		);
		$config['upload_path'] = './file/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('foto_kegiatan')) {
			$file_data = $this->upload->data();
			$data['foto_kegiatan'] = $file_data['file_name'];
		} else {
    // Jika terjadi error saat upload file
			$error = $this->upload->display_errors();
			echo "Gagal";
			return;
			redirect('laporanharian');
		}
		$this->crud->insert($data, 'catatan_harian');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('laporanharian');
	}

	public function update()
{
    $id = $this->input->post('id_catatan_harian');
    $catatan = $this->input->post('catatan_harian');
    $where = array('id_catatan_harian' => $id);

    if ($foto_kegiatan = ''){}else{
			$config['upload_path']          = './file';
			$config['allowed_types']        = 'png|jpeg|jpg';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('foto_kegiatan'))
			{
				echo "Gagal Mengupload";
			}
			else
			{
				$g =  $this->crud->getFoto($id)->row_array();
				if ($g != null) {
                //hapus gambar yg ada diserver
					unlink('./file/'.$g['foto_kegiatan']);
				}
				$foto_kegiatan = $this->upload->data('file_name');
			}
		}
		$data = array(
			'catatan_harian'	=> $catatan,
			'foto_kegiatan'	=> $foto_kegiatan,
		);

    $this->crud->update($where, $data, 'catatan_harian');
    $this->session->set_flashdata('pesan', 'diupdate');
    redirect('laporanharian');
}

	public function delete($id)
	{
		$where = array('id_catatan_harian' => $id );
		$file = $this->db->get_where('catatan_harian', array('id_catatan_harian' => $id))->row();
		if ($file) {
			$filePath = './file/' . $file->foto_kegiatan;

        // Periksa apakah file ada di server
			if (file_exists($filePath)) {
            // Hapus file dari server
				unlink($filePath);
			}

        // Hapus data file dari database
			$this->crud->delete($where, 'catatan_harian');
			$this->session->set_flashdata('pesan', 'dihapus');
			redirect('laporanharian');

			return true;
		} else {
        // Data file tidak ditemukan
			return false;
		}
		
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
