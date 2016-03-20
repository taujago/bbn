<?php
class coremodel extends CI_Model {
	function coremodel() {
		parent::__construct();
	}
	
	function get_arr_leasing(){
		// get data leasing
		$data['method']='get_data_leasing';
		$url = service_url($data);
		
		$xml = file_get_contents($url);
		$arr = xml_to_array($xml);
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}


	function arr_dropdown($vTable, $vINDEX, $vVALUE, $vORDERBY){
		$this->db->order_by($vORDERBY);
		$res  = $this->db->get($vTable);
		$ret = array();
		foreach($res->result_array() as $row) : 
			$ret[$row[$vINDEX]] = $row[$vVALUE];
		endforeach;
		return $ret;

	}

	function arr_level() {
		$arr = array(1=>"Level 1","Level 2","Level 3");
		return $arr;
	}



	function get_detail_kendaraan($v_is_cari,$v_cari) {
		$sql="SELECT  a.BPKB_ID,a.NO_BPKB,a.TEMPAT_KELUAR,a.TGL_BPKB,k.NAMA_PEMILIK,j.ALAMAT_PEMILIK,k.NO_IDENTITAS,k.NO_PONSEL,
        h.NO_POLISI,m.MERK_NAMA,a.TIPE,n.JENIS_NAMA,e.MODEL_NAMA,a.THN_BUAT,a.THN_RAKIT,a.VOL_SILINDER,o.WARNA_NAMA,
        a.NO_RANGKA,a.NO_MESIN,a.JML_RODA,a.JML_SUMBU,p.BB_NAMA,
        a.NO_FAKTUR,a.TGL_FAKTUR,a.NAMA_IMPORTIR,a.PELABUHAN,a.NO_UJI_TIPE as NO_SUT,a.NO_TPT,a.KETR_PABEAN,a.NO_PIB,
        a.TGL_PIB,a.NO_PABEAN,a.TGL_PABEAN,a.NO_UJI_BERKALA,pr.PRT_NAMA,
        wrtnkb.WARNATNKB,mwil.WILAYAH_NAMA,
        (CASE
         WHEN a.BPKB_STATUS = 0 THEN 'TIDAK AKTIF'
         WHEN a.BPKB_STATUS = 1 THEN 'AKTIF'
         WHEN a.BPKB_STATUS = 2 THEN 'BLOKIR'''
         WHEN a.BPKB_STATUS = 3 THEN 'MUTASI LUAR DAERAH'
         END)  AS  BPKB_STATUS,bl.BLOKIR_NO as NO_SURAT_REF_BLOKIR,bl.BLOKIR_DATE as TGL_BLOKIR,
        bl.BLOKIR_BY as PETUGAS_BLOKIR,bl.OPEN_BLOKIR_DATE as TGL_BUKA_BLOKIR,bl.OPEN_BLOKIR_BY as PETUGAS_BUKA_BLOKIR
         FROM DBSIFIK.T_BPKB_MASTER a
         INNER JOIN DBSIFIK.T_HIST_BENTUK d ON d.HIST_ID = a.CURRENT_HISTID
         INNER JOIN DBSIFIK.m_MODEL  e ON e.MODEL_ID = d.MODEL_ID
         INNER JOIN DBSIFIK.t_HIST_NOPOLISI h ON h.HIST_ID = a.CURRENT_HISTID
         INNER JOIN DBSIFIK.t_HIST_ALAMATPEMILIK j ON j.HIST_ID = a.CURRENT_HISTID
         INNER JOIN DBSIFIK.t_HIST_NAMAPEMILIK k ON k.HIST_ID = a.CURRENT_HISTID
         INNER JOIN DBSIFIK.t_HIST_WARNA l ON l.HIST_ID = a.CURRENT_HISTID
         INNER JOIN DBSIFIK.m_MERK m ON m.MERK_ID = a.MERK_ID
         INNER JOIN DBSIFIK.m_JENIS n ON n.JENIS_ID = a.JENIS_ID
         INNER JOIN DBSIFIK.m_WARNA o ON o.WARNA_ID = l.WARNA_ID
         INNER JOIN DBSIFIK.M_BAHANBAKAR p ON p.BB_ID = a.BB_ID
         INNER JOIN DBSIFIK.M_PERUNTUKAN pr ON pr.PRT_ID=A.PRT_ID
         INNER JOIN DBSIFIK.M_WARNATNKB wrtnkb ON WRTNKB.WARNATNKB_ID=H.WARNATNKB_ID
         INNER JOIN DBSIFIK.M_WILAYAH mwil ON MWIL.WILAYAH_ID=J.WILAYAH_ID
         LEFT JOIN T_BLOKIR bl ON BL.NO_BPKB=a.NO_BPKB
         WHERE  ";

         if($v_is_cari=="1"){
         	$sql.=" a.NO_RANGKA = '$v_cari'";
         }
         if($v_is_cari=="2"){
         	$sql.=" a.NO_BPKB = '$v_cari'";
         }
         if($v_is_cari=="3") {
         	$sql.=" h.NO_POLISI = '$v_cari'";
         }


         $res = $this->db->query($sql);
         if($res->num_rows() > 0){
         	$arr = $res->row_array();

         	$ret=array("error"=>false,"message"=>$arr);
         }
         else {
         	$ret = array("error"=>true,"message"=>"Data tidak ditemukan");
         }
         return $ret;
	}


        function get_detail_pendaftaran($id) {
                $this->db->select("p.*, to_char(p.DAFT_DATE,'DD-MM-YYYY') AS DAFT_DATE2,  
                        to_char(p.TGL_BPKB,'DD-MM-YYYY') AS TGL_BPKB2,
                        to_char(p.VERIFIKASI_DATE,'DD-MM-YYYY') AS VERIFIKASI_DATE2,
                        to_char(p.DAFT_LEVEL2_DATE,'DD-MM-YYYY') AS DAFT_LEVEL2_DATE2,
                        to_char(p.DAFT_LEVEL3_DATE,'DD-MM-YYYY') AS DAFT_LEVEL3_DATE3,
                        to_char(p.LEVEL2_TGLSURAT,'DD-MM-YYYY') AS LEVEL2_TGLSURAT2,
                        W.WARNA_NAMA,M.MERK_NAMA, J.JENIS_NAMA,T.TIPE
                        ",false)
                ->from("T_PENDAFTARAN p")
                ->join("V_WARNA W",'W.WARNA_ID=P.WARNA_ID','LEFT')
                ->join("V_MERK M","P.MERK_ID=M.MERK_ID",'LEFT')
                ->join("V_JENIS J","J.JENIS_ID=P.TYPE_KENDARAAN")
                ->join("V_TYPE T",'T.NO_RANGKA = SUBSTR(P.NO_RANGKA,1,10)','LEFT')
                ->where("P.DAFT_ID",$id);
                $res = $this->db->get();
                // echo $this->db->last_query();
                // exit;
                return $res->row_array();
        }

        function get_detail($tbname,$col,$value) {
                $this->db->where($col,$value);
                return $this->db->get($tbname)->row_array();
        }


}
?>