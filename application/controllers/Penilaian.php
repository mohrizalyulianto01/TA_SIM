<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

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
		$peserta_nilai = $this->db->select('id_peserta')->get('detail_nilai')->result_array();
		$data['peserta'] = $this->crud->cekAbsen();
		$data['peserta'] = $this->crud->cekabsen();
		$data['magang'] = $this->crud->cekabsen();
		$data['aspek'] = $this->crud->get('aspek_penilaian');

		foreach ($peserta_nilai as $nilai) {
			foreach ($data['magang'] as $key => $peserta) {
				if ($nilai['id_peserta'] == $peserta['id_peserta']) {
					unset($data['magang'][$key]);
				}
			}
		}
		$data['judul'] = "Nilai Peserta Magang";
		$this->load->view('templates/header',$data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/detailpenilaian',$data);
		$this->load->view('templates/footer');
	}

	public function penilaian($id_peserta)
	{
		$data['peserta'] = $this->crud->cekabsen();
		$data['magang'] = $this->crud->cekabsen();
		$data['total_nilai'] = $this->crud->totalnilai($id_peserta);
		$data['nilai'] = $this->crud->ceknilai($id_peserta);
		$data['penilaian'] = $this->crud->ceknilai($id_peserta);
		$data['judul'] = "Nilai Peserta Magang";
		$this->load->view('templates/header',$data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/detailnilai',$data);
		$this->load->view('templates/footer');
	}

	public function nilai()
	{
		$data['peserta'] = $this->crud->cekabsen();
		$data['magang'] = $this->crud->cekabsen();
		$data['aspek'] = $this->crud->get('aspek_penilaian');
		$aspek = $this->crud->get('aspek_penilaian');
		$jumlahaspek = count($aspek);
		$id_peserta = $this->input->post('id_peserta');
		$id_mentor = $this->session->userdata('id_mentor');
		$id_aspek = count($this->input->post('id_aspek'));
		$nilai = $this->input->post('nilai');
		$tgl = date("Y-m-d");
		for ($i=0; $i < $id_aspek ; $i++) 
		{ 
			$datas[$i] = array(
				'id_aspek'   => $this->input->post('id_aspek['.$i.']'),
				'id_peserta'       => $id_peserta,
				'id_mentor'       => $id_mentor,
				'nilai'         => $this->input->post('nilai['.$i.']')
			);
			$this->crud->insert($datas[$i],'detail_nilai');
			$total_nilai += $nilai[$i];
		}
		$data = array(
			'id_peserta' => $id_peserta,
			'id_mentor'  => $id_mentor,
			'total_nilai' => $total_nilai,
			'tgl_buat' => $tgl
		);
		$this->crud->insert($data,'nilai_magang');
		$this->session->set_flashdata('pesan', 'ditambahkan');
		redirect('penilaian');
	}

	public function update()
	{
		$id = $this->input->post('id_detail_nilai');
		$id_aspek = $this->input->post('id_aspek');
		$nilai = $this->input->post('nilai');
		$where = array('id_detail_nilai' => $id);
		$data = array(
			'id_aspek' => $id_aspek,
			'nilai'    => $nilai,
		);

    // Update nilai di tabel detail_nilai
		$this->crud->update($where, $data, 'detail_nilai');

    // Menghitung kembali total nilai
		$detail_nilai = $this->crud->get('detail_nilai', array('id_detail_nilai' => $id));
		if (!empty($detail_nilai)) {
			$id_peserta = $detail_nilai[0]['id_peserta'];
			$total_nilai = $this->crud->hitungTotalNilai($id_peserta);

        // Update total nilai di tabel nilai_magang
			$where_total = array('id_peserta' => $id_peserta);
			$data_total = array('total_nilai' => $total_nilai);
			$this->crud->update($where_total, $data_total, 'nilai_magang');
		}

		$this->session->set_flashdata('pesan', 'Data berhasil diupdate');
		redirect('penilaian');
	}

	public function delete($id)
	{
		$where = array('id_peserta' => $id );
		$this->crud->delete($where, 'detail_nilai');
		$this->crud->delete($where, 'nilai_magang');
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('penilaian');
	}

	public function lihatNilai()
	{
		$data['judul'] = "Nilai Magang";
		$data['peserta'] = $this->crud->cekAbsen();
		$data['magang'] = $this->crud->cekabsen();
		$this->load->view('templates/header',$data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/lihatnilai',$data);
		$this->load->view('templates/footer');
	}

	public function nilaiMagang($id_peserta)
	{
		$data['judul'] = "Nilai Magang";
		$data['peserta'] = $this->crud->cekAbsen();
		$data['magang'] = $this->crud->cekabsen();
		$data['nilai'] = $this->crud->lihatnilai($id_peserta);
		$data['sertifikat'] = $this->crud->lihatnilai($id_peserta);
		$this->load->view('templates/header',$data);
		$this->load->view('mentor/sidebar');
		$this->load->view('templates/navbar');
		$this->load->view('mentor/nilaimagang',$data);
		$this->load->view('templates/footer');
	}

	public function unilaimagang()
	{
		$id = $this->input->post('id_nilai');
		$where = array('id_nilai' => $id);
		if ($sertifikat_file = ''){}else{
			$config['upload_path']          = './file';
			$config['allowed_types']        = 'pdf';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('sertifikat_file'))
			{
				echo "Gagal Mengupload";
			}
			else
			{
				$g =  $this->crud->getSertifikat($id)->row_array();
				if ($g != null) {
                //hapus gambar yg ada diserver
					unlink('./file/'.$g['sertifikat_file']);
				}
				$sertifikat_file = $this->upload->data('file_name');
			}
		}
		$data = array(
			'sertifikat_file'	=> $sertifikat_file,
		);

		$this->crud->update($where, $data, 'nilai_magang');
		$this->session->set_flashdata('pesan', 'diupdate');
		redirect('penilaian/lihatNilai');
	}

	
}
?>