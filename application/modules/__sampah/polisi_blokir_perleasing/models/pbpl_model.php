<?php
class pbpl_model extends CI_Model {
	function pbpl_model(){
		parent::__construct();
	}



function get_data($id_polda,$bulan,$tahun){

	$sql="select l.leasing_id,l.leasing_nama, 
	count(p.daft_id) as semua , 
	count(if(p.jenis_permohonan='B',1,null)) as baru, 
	count(if(p.jenis_permohonan='L',1,null)) as lama 

	from m_leasing l 
	left join t_pendaftaran  p on p.leasing_id = l.leasing_id
	where p.id_polda='$id_polda'  
	and year(daft_date) = '$tahun' 
	and month(daft_date) = '$bulan'
	and approved = '1'
	group by l.leasing_id"; 

	$res = $this->db->query($sql);

	return $res;

}
 
	
}
?>