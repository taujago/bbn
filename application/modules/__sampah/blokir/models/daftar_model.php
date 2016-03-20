<?php
class daftar_model extends CI_Model {
	function daftar_model() {
		parent::__construct();
	}
	

	function get_data($vleasing_id) {
		$this->db->where("LEASING_ID",$vleasing_id);
		$res = $this->db->get("T_PENDAFTARAN");
		return $res;
	}

	


	function inq_get_bpkb($v_is_cari, $v_cari, $v_leasing_id, $v_inq_by ) {

		if($v_is_cari == "1") {
			$this->db->where("NO_RANGKA",$v_cari);
			$res = $this->db->get("T_PENDAFTARAN");
			if($res->num_rows() > 0) {

				$arr_inq = array("LEASING_ID"=>$v_leasing_id,
								 "NO_BPKB" =>$v_cari,
								 "INQ_DATE" => ora_date(date("d-m-Y")),
								 "INQ_BY" => $v_inq_by,
								 "INQ_PROSES" => 'PENDAFTARAN');
				$res_inq = $this->db->insert("T_INQ_BPKB",$arr_inq);

				$sql = " SELECT 'TIDAK TERSEDIA' AS STATUS,
		                   L.LEASING_NAMA AS DAFTAR_OLEH,
		                   L.LEASING_NAMA AS BLOKIR_OLEH
			              FROM T_PENDAFTARAN P
			                   LEFT JOIN T_BLOKIR B ON B.DAFT_ID = P.DAFT_ID
			                   INNER JOIN M_LEASING L ON L.LEASING_ID = P.LEASING_ID
			             WHERE P.NO_RANGKA = '$v_cari'";
			    $data = $this->db->query($sql)->row_array();
			    return $data;

			}
			else {
				$arr_inq = array("LEASING_ID"=>$v_leasing_id,
								 "NO_BPKB" =>$v_cari,
								 "INQ_DATE" => ora_date(date("d-m-Y")),
								 "INQ_BY" => $v_inq_by,
								 "INQ_PROSES" => 'PENDAFTARAN');
			    $res_inq = $this->db->insert("T_INQ_BPKB",$arr_inq);

			    $sql="SELECT 'TERSEDIA' AS STATUS, '' AS DAFTAR_OLEH, '' AS BLOKIR_OLEH
              			FROM DUAL";
              	$data = $this->db->query($sql)->row_array();
			    return $data;
			}
		}  // end of v_is_cari=1

		else {
			$this->db->where("NO_BPKB",$v_cari);
			$res = $this->db->get("T_PENDAFTARAN");
			if($res->num_rows() > 0) {
				$arr_inq = array("LEASING_ID"=>$v_leasing_id,
								 "NO_BPKB" =>$v_cari,
								 "INQ_DATE" => ora_date(date("d-m-Y")),
								 "INQ_BY" => $v_inq_by,
								 "INQ_PROSES" => 'PENDAFTARAN');
			    $res_inq = $this->db->insert("T_INQ_BPKB",$arr_inq);
			    $sql = " SELECT 'TIDAK TERSEDIA' AS STATUS,
		                   L.LEASING_NAMA AS DAFTAR_OLEH,
		                   L.LEASING_NAMA AS BLOKIR_OLEH
			              FROM T_PENDAFTARAN P
			                   LEFT JOIN T_BLOKIR B ON B.DAFT_ID = P.DAFT_ID
			                   INNER JOIN M_LEASING L ON L.LEASING_ID = P.LEASING_ID
			             WHERE P.NO_BPKB = '$v_cari'";
			    $data = $this->db->query($sql)->row_array();
			    return $data;
			}  // end of > 0
			else {
				$arr_inq = array("LEASING_ID"=>$v_leasing_id,
								 "NO_BPKB" =>$v_cari,
								 "INQ_DATE" => ora_date(date("d-m-Y")),
								 "INQ_BY" => $v_inq_by,
								 "INQ_PROSES" => 'PENDAFTARAN');
			    $res_inq = $this->db->insert("T_INQ_BPKB",$arr_inq);

			    $sql="SELECT 'TERSEDIA' AS STATUS, '' AS DAFTAR_OLEH, '' AS BLOKIR_OLEH
              			FROM DUAL";
              	$data = $this->db->query($sql)->row_array();
			    return $data;
			} // end of else > 0
		}

	}


	function daftar_simpan($data){
		// ini variab
		$ret = array();
		unset($data['DAFT_ID']);
		
		//show_array($data); exit;

		

		// $data_daftar['DAFT_DATE'] = ora_date($data_daftar['DAFT_DATE']);
		// $data_daftar['TGL_BPKB'] = ora_date($data_daftar['TGL_BPKB']);

		if(empty($data['TGL_BPKB'])){
			unset($data['TGL_BPKB']);
		}
		else {
			$data['TGL_BPKB'] = ora_date($data['TGL_BPKB']);
		}

		if(empty($data['DAFT_DATE'])){
			unset($data['DAFT_DATE']);
		}
		else {
			$data['DAFT_DATE'] = ora_date($data['DAFT_DATE']);
		}

		$data_daftar = $data;
		unset($data_daftar['mode']);
		unset($data_daftar['v_is_cari']);

		($data['v_is_cari']=="1")?$this->db->where("NO_BPKB",$data['NO_BPKB']):$this->db->where("NO_RANGKA",$data['NO_RANGKA']);

		$jml = $this->db->get("T_PENDAFTARAN")->num_rows();

		if($jml > 0){

				$sql = "SELECT STATUS,
	                L.LEASING_NAMA,
	                L.LEASING_KOTA,
	                L.LEASING_ALAMAT		           
		           FROM T_PENDAFTARAN PP
		                LEFT JOIN (  SELECT NO_BPKB, MAX (DAFT_ID) AS MAXID
		                               FROM T_PENDAFTARAN
		                           GROUP BY NO_BPKB) P
		                   ON P.NO_BPKB = PP.NO_BPKB
		                INNER JOIN M_LEASING L ON L.LEASING_ID = PP.LEASING_ID
		          WHERE PP.DAFT_ID = P.MAXID "; 
		         $sql .= ($data['v_is_cari']=="1")?" AND PP.NO_BPKB = '".$data['NO_BPKB']."'":" AND PP.NO_RANGKA = '".$data['NO_RANGKA']."'";

		         $data_status = $this->db->query($sql)->row_array();
		         // show_array($data_status); exit;

		         if($data_status['STATUS'] == 0 ) {
		         	 $message = ($data['v_is_cari']=="1")?"GAGAL, NO BPKB ".$data['NO_BPKB']." SUDAH DIDAFTARKAN OLEH ".$data_status['LEASING_NAMA']:
		         	 "GAGAL, NO RANGKA ".$data['NO_RANGKA']." SUDAH DIDAFTARKAN OLEH ".$data_status['LEASING_NAMA'];
		         	 $ret = array("error"=>true,"message"=>$message);
		         	 return $ret;
		         }
		         else {
		         	($data['v_is_cari']=="1")?$this->db->where("NO_BPKB",$data['NO_BPKB']):$this->db->where("NO_RANGKA",$data['NO_RANGKA']);
		         	$jml_bpkb = $this->db->get("DBSIFIK.T_BPKB_MASTER")->num_rows();

		         	if($jml_bpkb > 0) {
 		         		$res_daftar = $this->db->insert("T_PENDAFTARAN",$data_daftar);
 		         		// input ke t_blokir_langsung 


 		         		$this->db->where("SEQUENCE_NAME","T_PENDAFTARAN_ASC");
 		         		$ds = $this->db->get("USER_SEQUENCES")->row_array();
 		         		$data_daftar['DAFT_ID'] = $ds['LAST_NUMBER'] - 1;
 		         		unset($data_daftar['NAMA_PENGAJUAN_LEASING']);
				    	unset($data_daftar['ALAMAT_PENGAJUAN_LEASING']);
				    	unset($data_daftar['USER_ID']);
				    	unset($data_daftar['DAFT_DATE']);
				    	$this->db->insert("V_T_BLOKIR_LANGSUNG",$data_daftar);

				    	//echo $this->db->last_query();





		         		if($res_daftar){
		         			 $message = ($data['v_is_cari']=="1")?"SUKSES, NO BPKB ".$data['NO_BPKB']." BERHASIL DIDAFTAR ":
		         	 		"SUKSES, NO RANGKA ".$data['NO_RANGKA']." BERHASIL DIDAFTARKAN  ";
		         	 		$ret = array("error"=>false,"message"=>$message);
		         	 		return $ret;
		         		}
		         	}
		         	else {
		         		 	$message = ($data['v_is_cari']=="1")?"GAGAL, NO BPKB ".$data['NO_BPKB']." TIDAK TERDAFTAR DI POLDA":
		         	 		"GAGAL, NO RANGKA ".$data['NO_RANGKA']." TIDAK TERDAFTAR DI POLDA ";
		         	 		$ret = array("error"=>true,"message"=>$message);
		         	 		return $ret;
		         	}
		         }

		         
		} // end of $jml > 0
		else { // kalo tidak ada 
			($data['v_is_cari']=="1")?$this->db->where("NO_BPKB",$data['NO_BPKB']):$this->db->where("NO_RANGKA",$data['NO_RANGKA']);
		    $jml_bpkb2 = $this->db->get("DBSIFIK.T_BPKB_MASTER")->num_rows();     
		    if($jml_bpkb2>0){
		    	$res_daftar = $this->db->insert("T_PENDAFTARAN",$data_daftar);


    			$this->db->where("SEQUENCE_NAME","T_PENDAFTARAN_ASC");
         		$ds = $this->db->get("USER_SEQUENCES")->row_array();
         		$data_daftar['DAFT_ID'] = $ds['LAST_NUMBER'] - 1;
         		unset($data_daftar['NAMA_PENGAJUAN_LEASING']);
		    	unset($data_daftar['ALAMAT_PENGAJUAN_LEASING']);
		    	unset($data_daftar['USER_ID']);
		    	unset($data_daftar['DAFT_DATE']);
		    	$this->db->insert("V_T_BLOKIR_LANGSUNG",$data_daftar);


		    	if($res_daftar){
		    		 $message = ($data['v_is_cari']=="1")?"SUKSES, NO BPKB ".$data['NO_BPKB']." BERHASIL DIDAFTAR ":
		         	 		"SUKSES, NO RANGKA ".$data['NO_RANGKA']." BERHASIL DIDAFTARKAN  ";
		         	 $ret = array("error"=>false,"message"=>$message);
		         	 return $ret;
		    	}
		    	else {
		    		$message = ($data['v_is_cari']=="1")?"GAGAL, NO BPKB ".$data['NO_BPKB']." TIDAK TERDAFTAR DI POLDA":
		         	 		"GAGAL, NO RANGKA ".$data['NO_RANGKA']." TIDAK TERDAFTAR DI POLDA ";
		         	 $ret = array("error"=>true,"message"=>$message);
		         	 return $ret;
		    	}
		    }	
		}

		//echo $this->db->last_query();


	}

	function inq_lepas_daft($data) {



		($data['IS_CARI']=="1")?$this->db->where("NO_RANGKA",$data['NO_BPKB']):$this->db->where("NO_BPKB",$data['NO_BPKB']);
		$jumlah = $this->db->get("T_PENDAFTARAN")->num_rows();
		if($jumlah > 0) {  // ada datanya di pendaftaran 
			// insert ke inq bpkb 
			$data_inq=array("LEASING_ID"=>$data['LEASING_ID'],
							"NO_BPKB"	=>$data['NO_BPKB'],
							"INQ_DATE"	=> ora_date(date("d-m-Y")),
							"INQ_BY"	=> $data['INQ_BY'],
							"INQ_PROSES"=>	'LEPAS PENDAFTARAN'
							);
			$res_inq = $this->db->insert("T_INQ_BPKB",$data_inq);

			$this->db->select("DAFT_ID,
                   LEASING_ID,
                   NO_BPKB,
                   NREG_BPKB,
                   NO_RANGKA,
                   NO_MESIN,
                   NO_POLISI,
                   TO_CHAR(TGL_BPKB,'DD-MM-YYYY') AS TGL_BPKB,
                   NAMA_PEMILIK,
                   ALAMAT_PEMILIK,
                   MERK_ID,
                   TYPE_KENDARAAN,
                   WARNA_ID,
                   TAHUN_KENDARAAN,
                   USER_ID,
                   CASE
                      WHEN STATUS = 0 THEN 'TERDAFTAR'
                      WHEN STATUS > 0 THEN 'TIDAK TERDAFTAR'
                   END
                      AS STATUS,
                   TO_CHAR(DAFT_DATE,'DD-MM-YYYY') AS DAFT_DATE,
                   DAFT_BY,
                   TO_CHAR(VERIFIKASI_DATE,'DD-MM-YYYY') AS VERIFIKASI_DATE,
                   VERIFIKASI_BY,
                   TO_CHAR(DAFT_LEVEL2_DATE,'DD-MM-YYYY') AS DAFT_LEVEL2_DATE,
                   DAFT_LEVEL2_BY,
                   TO_CHAR(DAFT_LEVEL3_DATE,'DD-MM-YYYY') AS DAFT_LEVEL3_DATE,
                   DAFT_LEVEL3_BY,
                   NAMA_PENGAJUAN_LEASING,
                   ALAMAT_PENGAJUAN_LEASING",false)
			->from("T_PENDAFTARAN");

			($data['IS_CARI']=="1")?$this->db->where("NO_RANGKA",$data['NO_BPKB']):$this->db->where("NO_BPKB",$data['NO_BPKB']);
			$this->db->where("LEASING_ID",$data['LEASING_ID']);
			$ret = $this->db->get()->row_array();
			//echo $this->db->last_query(); exit;
			$ret = array("error"=>false,"message"=>$ret);

		}
		else {  // tidak ada datanya.
			$data_inq=array("LEASING_ID"=>$data['LEASING_ID'],
							"NO_BPKB"	=>$data['NO_BPKB'],
							"INQ_DATE"	=> ora_date(date("d-m-Y")),
							"INQ_BY"	=> $data['INQ_BY'],
							"INQ_PROSES"=>	'LEPAS PENDAFTARAN'
							);
			$res_inq = $this->db->insert("T_INQ_BPKB",$data_inq);
			$ret = array("error"=>true,"message"=>"DATA TIDAK ADA");
		}
		return $ret;
	}

	function lepas_daftar($data){
		$this->db->where("STATUS","0");
		$this->db->where("LEASING_ID",$data['LEASING_ID']);
		($data['v_is_cari']=="1")?
		$this->db->where("NO_RANGKA",$data['NO_RANGKA']):
		$this->db->where("NO_BPKB",$data['NO_BPKB']);

		$jml = $this->db->get("T_PENDAFTARAN")->num_rows();
		if($jml > 0){
			$sql="SELECT MAX (STATUS) as STATUS
		             FROM T_PENDAFTARAN PP
		            WHERE LEASING_ID = '".$data['LEASING_ID']."' ";
		    $sql .= ($data['v_is_cari']=="2")?" AND NO_BPKB='".$data['NO_BPKB']."'":" AND NO_RANGKA='".$data['NO_RANGKA']."'";
		    $sql.=" GROUP BY STATUS";

		    $dstatus = $this->db->query($sql)->row_array();
		    //echo $this->db->last_query(); exit;
		    $status = $dstatus['STATUS']+1;

		    $arr_daftar=array(
		    		"STATUS" => $status,
		    		"LEPAS_DAFT_BY" => $data['USER_ID'],
		    		"LEPAS_DAFT_DATE" => ora_date(date("d-m-Y"))
		    	);

		   	$this->db->where("STATUS",0);
		   	$this->db->where("LEASING_ID",$data['LEASING_ID']);
		   	($data['v_is_cari']=="1")?
			$this->db->where("NO_BPKB",$data['NO_BPKB']):
			$this->db->where("NO_RANGKA",$data['NO_RANGKA']);

			$res = $this->db->update("T_PENDAFTARAN",$arr_daftar);
			//echo $this->db->last_query();
			if($res){
				$message = ($data['v_is_cari']=="2")?"SUKSES, LEPAS PENDAFTARAN ATAS NO BPKB ".$data['NO_BPKB']:
				"SUKSES, LEPAS PENDAFTARAN ATAS NO RANGKA ".$data['NO_RANGKA'];
				//echo $message;
				$ret = array("error"=>false,"message"=>$message);
				//show_array($ret); exit;
			}
			else {
				$ret = array("error"=>true,"message"=>$this->db->_error_message());
			}


		}
		else {
			$message = ($data['v_is_cari']=="2")?"GAGAL LEPAS PENDAFTARAN, DATA NO BPKB ".$data['NO_BPKB']." TIDAK ADA ATAU TIDAK SESUAI DENGAN KONDISI ":
				"GAGAL LEPAS PENDAFTARAN, DATA NO BPKB ".$data['NO_BPKB']." TIDAK ADA ATAU TIDAK SESUAI DENGAN KONDISI ";
			$ret = array("error"=>true,"message"=>$message);
		}
		return $ret;

	}

}


?>