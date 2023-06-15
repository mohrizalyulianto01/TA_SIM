<?php 
/**
 * 
 */
class Model_login extends CI_Model
{
	
	public function admin()
	{
		$username = set_value('username');
		$password = set_value('password');
		$result = $this->db->query("SELECT * FROM admin WHERE username='$username' AND password=md5('$password')");
		if ($result->num_rows() > 0) {
			return $result->row();
		}else{
			return array();
		}
	}

	public function mentor()
	{
		$username = set_value('username');
		$password = set_value('password');
		$result = $this->db->query("
			SELECT a.*,b.id_detail_mentoring
			FROM mentor a
			INNER JOIN detail_mentoring b 
			WHERE b.id_mentor = a.id_mentor and username='$username' AND password=md5('$password')
			");
		if ($result->num_rows() > 0) {
			return $result->row();
		}else{
			return array();
		}
	}

	public function peserta()
	{
		$username = set_value('username');
		$password = set_value('password');
		$result = $this->db->query("
			SELECT a.*, b.id_detail_mentoring
			FROM peserta_magang a 
			INNER JOIN detail_mentoring b 
			WHERE b.id_peserta = a.id_peserta and username='$username' AND password=md5('$password')");
		if ($result->num_rows() > 0) {
			return $result->row();
		}else{
			return array();
		}
	}
}
 