<?php 
class polda_m extends CI_Model {
	function polda_m(){
		parent::__construct();
	}


	function get_arr_polda(){
		
		$userdata = $this->session->userdata("userdata");

		$leasing_id = $userdata['leasing_id']; 

		$sql="select * from m_polda pol join polda_leasing l on pol.id_polda = 
		l.id_polda where l.leasing_id = '$leasing_id' ";

		
		$res = $this->db->query($sql);

		$arr = array();
		foreach($res->result() as $row) : 
			$arr[$row->id_polda] = $row->nama_polda;
		endforeach;
		return $arr;
	}
}

?>