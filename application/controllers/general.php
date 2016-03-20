<?php 


class general extends CI_Controller {

	function general(){
		parent::__construct();
	}


	function  get_polres(){
		$id_polda = $this->input->post('id_polda');
		$this->db->where("id_provinsi",$id_polda);
		$this->db->order_by("kota");
		$res = $this->db->get("tiger_kota");
		$html = "";
		foreach($res->result() as $row): 
			$html .= "<option value=$row->id> $row->kota </option> ";
		endforeach;
		echo $html;
	}


	function get_polres_polda(){
		$id_polda = $this->input->post('id_polda');
		$id_polres = $this->input->post('id_polres');
		$this->db->where("id_provinsi",$id_polda);
		$this->db->order_by("kota");
		$res = $this->db->get("tiger_kota");
		$html = "";
		foreach($res->result() as $row): 
			$sel = ($row->id == $id_polres)?"selected":"";
			$html .= "<option value=$row->id $sel> $row->kota </option> ";
		endforeach;
		echo $html;
	}



}