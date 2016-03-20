<?php
class pilih_polda extends master_controller {

	function pilih_polda(){
		parent::__construct();
		$this->load->model("polda_m","dm");
	}

	function index(){


		$data['arr_polda'] = $this->dm->get_arr_polda();
		$this->load->view("pilih_polda_view",$data);
	}

	function simpan(){
		$data = $this->input->post();
		$this->db->where("id_polda",$data['id_polda']);
		$polda = $this->db->get("m_polda")->row();
		//print_r($polda); exit;
		$this->session->set_userdata("id_polda",$polda->id_polda);
		$this->session->set_userdata("nama_polda",$polda->nama_polda);
		$this->session->set_userdata("nama_polda_singkatan",$polda->nama_polda_singkatan);
		$this->session->set_userdata("alamat_polda",$polda->alamat_polda);
		$this->session->set_userdata("header_image",$polda->header_image);
		
		$this->session->set_userdata("url",$polda->url);
		redirect("depan_baru");
	}

}
?>