<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_crud extends CI_Model {

	public function get_where($where, $table)
	{
		return $this->db->get_where($table, $where)->result_array();
	}

	public function get($table)
	{
		return $this->db->get($table)->result_array();
	}

	public function delete($where, $table)
	{
		$this->db->delete($table, $where);
	}

	public function insert($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function update($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function getAbsensi() {
		$id_peserta = $this->session->userdata('id_peserta');
		$query = $this->db->query("
			SELECT *
			FROM absensi a
			INNER JOIN peserta_magang b ON a.id_peserta = b.id_peserta
			WHERE a.id_peserta = $id_peserta
			ORDER BY a.tgl_absen DESC 
			");
		return $query->result_array();
	}

	public function filterAbsensi($id_peserta,$start_date, $end_date)
	{
		$id_peserta = $this->session->userdata('id_peserta');
		$query = $this->db->query("
			SELECT a.tgl_absen,a.jam_masuk,a.jam_keluar
			FROM absensi a
			INNER JOIN peserta_magang b ON a.id_peserta = b.id_peserta
			WHERE a.id_peserta = $id_peserta 
			AND a.tgl_absen >= '$start_date' AND a.tgl_absen <= '$end_date'
			");
		return $query->result_array();
	}

	public function lihatAbsensi($id_peserta) {
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN absensi b ON a.id_peserta = b.id_peserta
			WHERE a.id_peserta = '$id_peserta'
			ORDER by b.tgl_absen DESC
			");
		return $query->result_array();
	}

	public function lihatnilai($id_peserta) {
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN nilai_magang b ON a.id_peserta = b.id_peserta
			WHERE a.id_peserta = '$id_peserta'
			");
		return $query->result_array();
	}

	public function filterAbsen($id_peserta,$start_date, $end_date)
	{
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN absensi b ON a.id_peserta = b.id_peserta
			WHERE a.id_peserta = '$id_peserta'
			AND b.tgl_absen >= '$start_date' AND b.tgl_absen <= '$end_date'
			");
		return $query->result_array();
	}

	public function lihatHarian($id_peserta) {
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN detail_mentoring c ON a.id_peserta = c.id_peserta
			INNER JOIN catatan_harian b ON b.id_detail_mentoring = c.id_detail_mentoring
			INNER JOIN mentor d ON c.id_mentor = d.id_mentor
			WHERE a.id_peserta = '$id_peserta'
			ORDER by b.tgl_catatan DESC
			");
		return $query->result_array();
	}

	public function filterharian($id_peserta,$start_date, $end_date)
	{
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN detail_mentoring c ON a.id_peserta = c.id_peserta
			INNER JOIN catatan_harian b ON b.id_detail_mentoring = c.id_detail_mentoring
			INNER JOIN mentor d ON c.id_mentor = d.id_mentor
			WHERE a.id_peserta = '$id_peserta'
			AND b.tgl_catatan >= '$start_date' AND b.tgl_catatan <= '$end_date'
			");
		return $query->result_array();
	}

	public function lihatLaporan($id_peserta) {
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN detail_mentoring c ON a.id_peserta = c.id_peserta
			INNER JOIN laporan_hasil_magang b ON b.id_detail_mentoring = c.id_detail_mentoring
			INNER JOIN mentor d ON c.id_mentor = d.id_mentor
			WHERE a.id_peserta = '$id_peserta'
			ORDER by b.tgl_buat DESC
			");
		return $query->result_array();
	}

	public function filterlaporan($id_peserta,$start_date, $end_date)
	{
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN detail_mentoring c ON a.id_peserta = c.id_peserta
			INNER JOIN laporan_hasil_magang b ON b.id_detail_mentoring = c.id_detail_mentoring
			INNER JOIN mentor d ON c.id_mentor = d.id_mentor
			WHERE a.id_peserta = '$id_peserta'
			AND b.tgl_buat >= '$start_date' AND b.tgl_buat <= '$end_date'
			");
		return $query->result_array();
	}

	public function mentoring()
	{
		$query = $this->db->query("
			SELECT *
			FROM detail_mentoring a
			INNER JOIN mentor b ON a.id_mentor = b.id_mentor
			INNER JOIN peserta_magang c ON a.id_peserta = c.id_peserta
			");
		return $query->result_array();
	}

	public function catatan()
	{
		$id_peserta = $this->session->userdata('id_peserta');
		$id_detail_mentoring = $this->session->userdata('id_detail_mentoring');
		$query = $this->db->query("
			SELECT *
			FROM detail_mentoring a
			INNER JOIN peserta_magang b ON a.id_peserta = b.id_peserta
			INNER JOIN mentor c ON a.id_mentor = c.id_mentor
			INNER JOIN catatan_harian d ON a.id_detail_mentoring = d.id_detail_mentoring
			WHERE a.id_peserta = $id_peserta and a.id_detail_mentoring = $id_detail_mentoring
			ORDER BY id_catatan_harian DESC
			");
		return $query->result_array();
	}

	public function cekCatatan($id)
	{
    // Ambil data aduan berdasarkan ID
		$query = $this->db->get_where('catatan_harian', array('id_catatan_harian' => $id));
		return $query->row();
	}

	public function cekSertif($id)
	{
    // Ambil data aduan berdasarkan ID
		$query = $this->db->get_where('nilai_magang', array('id_nilai' => $id));
		return $query->row();
	}

	public function cekLaporan($id)
	{
    // Ambil data aduan berdasarkan ID
		$query = $this->db->get_where('laporan_hasil_magang', array('id_laporan_hasil' => $id));
		return $query->row();
	}

	function getFile($id)
	{
		$this->db->select('file');
		$this->db->from('laporan_hasil_magang');
		$this->db->where('id_laporan_hasil', $id);
		return $this->db->get();
	}

	function getSertifikat($id)
	{
		$this->db->select('sertifikat_file');
		$this->db->from('nilai_magang');
		$this->db->where('id_nilai', $id);
		return $this->db->get();
	}

	function getFoto($id)
	{
		$this->db->select('foto_kegiatan');
		$this->db->from('catatan_harian');
		$this->db->where('id_catatan_harian', $id);
		return $this->db->get();
	}

	public function hasil()
	{
		$id_peserta = $this->session->userdata('id_peserta');
		$id_detail_mentoring = $this->session->userdata('id_detail_mentoring');
		$query = $this->db->query("
			SELECT *
			FROM detail_mentoring a
			INNER JOIN peserta_magang b ON a.id_peserta = b.id_peserta
			INNER JOIN mentor c ON a.id_mentor = c.id_mentor
			INNER JOIN laporan_hasil_magang d ON a.id_detail_mentoring = d.id_detail_mentoring
			WHERE a.id_peserta = $id_peserta and a.id_detail_mentoring = $id_detail_mentoring
			ORDER BY id_laporan_hasil DESC
			");
		return $query->result_array();
	}


	public function cekabsen()
	{
		$id_mentor = $this->session->userdata('id_mentor');
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN detail_mentoring b ON a.id_peserta = b.id_peserta
			INNER JOIN mentor c ON b.id_mentor = c.id_mentor
			WHERE b.id_mentor = $id_mentor
			");
		return $query->result_array();
	}

	public function nilai()
	{
		$id_mentor = $this->session->userdata('id_mentor');
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN detail_mentoring b ON a.id_peserta = b.id_peserta
			INNER JOIN mentor c ON b.id_mentor = c.id_mentor
			WHERE b.id_mentor = $id_mentor
			");
		return $query->result_array();
	}

	public function ceknilai($id_peserta) {
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN detail_nilai b ON a.id_peserta = b.id_peserta
			INNER JOIN aspek_penilaian c ON b.id_aspek = c.id_aspek
			WHERE a.id_peserta = '$id_peserta'
			");
		return $query->result_array();
	}

	public function totalnilai($id_peserta) {
		$query = $this->db->query("
			SELECT SUM(b.nilai) AS total_nilai
			FROM  detail_nilai b
			INNER JOIN peserta_magang a ON a.id_peserta = b.id_peserta
			INNER JOIN aspek_penilaian c ON b.id_aspek = c.id_aspek
			INNER JOIN nilai_magang d ON a.id_peserta = d.id_peserta 
			INNER JOIN mentor e ON e.id_mentor = d.id_mentor 
			WHERE a.id_peserta = '$id_peserta'
			");
		return $query->row()->total_nilai;
	}

	public function hitungTotalNilai($id_peserta)
	{
		$this->db->select_sum('nilai');
		$this->db->where('id_peserta', $id_peserta);
		$query = $this->db->get('detail_nilai');

		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result->nilai;
		} else {
			return 0;
		}
	}

	public function cekmentoring($id_peserta)
	{
		$id_mentor = $this->session->userdata('id_mentor');
		$query = $this->db->query("
			SELECT a.id_detail_mentoring
			FROM detail_mentoring a
			INNER JOIN peserta_magang b ON a.id_peserta = b.id_peserta
			INNER JOIN mentor c ON a.id_mentor = c.id_mentor
			WHERE b.id_peserta = '$id_peserta'
			");

		if ($query->num_rows() > 0) {
			return $query->row()->id_detail_mentoring;
		} else {
			return null;
		}
	}

	public function nilaimagang()
	{
		$id_peserta = $this->session->userdata('id_peserta');
		$query = $this->db->query("
			SELECT *
			FROM nilai_magang a
			INNER JOIN peserta_magang b ON a.id_peserta = b.id_peserta
			INNER JOIN mentor c ON a.id_mentor = c.id_mentor
			WHERE b.id_peserta = $id_peserta
			");
		return $query->result_array();
	}

	public function detailnilai() {
		$id_peserta = $this->session->userdata('id_peserta');
		$query = $this->db->query("
			SELECT *
			FROM peserta_magang a
			INNER JOIN detail_nilai b ON a.id_peserta = b.id_peserta
			INNER JOIN aspek_penilaian c ON b.id_aspek = c.id_aspek
			WHERE a.id_peserta = $id_peserta
			");
		return $query->result_array();
	}

}