<?php
class coremodel extends CI_Model {
        function coremodel() {
                parent::__construct();
        }
        
var $arr_bulan = array(1=>"JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI",
  "AGUSTUS","SEPTERMBER","OKTOBER","NOVEMBER","DESEMBER");


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

  var  $arr_status =  array(
            0=>"Pilih Status",
            "Level 2",
            "Menunggu Blokir",
            "Gagal Blokir",
            "Berhasil Blokir");

  var  $arr_status2 =  array(
            0=>"- SEMUA STATUS - ",
            "Level 2",
            "Menunggu Blokir",
            "Gagal Blokir",
            "Berhasil Blokir");

        function arr_dropdown($vTable, $vINDEX, $vVALUE, $vORDERBY){
                $this->db->order_by($vORDERBY);
                $res  = $this->db->get($vTable);
		//echo $this->db->last_query(); exit;

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
                $sql.=" a.NO_RANGKA= '$v_cari'";
         }
         if($v_is_cari=="2"){
                $sql.=" a.NO_BPKB  = '$v_cari'";
         }
         if($v_is_cari=="3") {
                $sql.=" h.NO_POLISI = '$v_cari'";
         }




         $res = $this->db->query($sql);
         //echo $this->db->last_query(); exit;
         if($res->num_rows() > 0){
                $arr = $res->row_array();

                $ret=array("error"=>false,"message"=>$arr);
         }
         else {
                $ret = array("error"=>true,"message"=>"Data tidak ditemukan");
         }
         return $ret;
        }




function get_detail_kendaraan_pendaftaran($v_is_cari, $v_cari){
  $this->db->select("p.*, to_char(p.DAFT_DATE,'DD-MM-YYYY') AS DAFT_DATE2,  
                        to_char(p.TGL_BPKB,'DD-MM-YYYY') AS TGL_BPKB2,
                        to_char(p.VERIFIKASI_DATE,'DD-MM-YYYY') AS VERIFIKASI_DATE2,
                        to_char(p.DAFT_LEVEL2_DATE,'DD-MM-YYYY') AS DAFT_LEVEL2_DATE2,
                        to_char(p.DAFT_LEVEL3_DATE,'DD-MM-YYYY') AS DAFT_LEVEL3_DATE3,
                        to_char(p.LEVEL2_TGLSURAT,'DD-MM-YYYY') AS LEVEL2_TGLSURAT2,
                        W.WARNA_NAMA,M.MERK_NAMA, J.JENIS_NAMA,T.TIPE, L.LEASING_NAMA,
                        L.LEASING_KOTA
                        ",false)
                ->from("T_PENDAFTARAN p")
                ->join("V_WARNA W",'W.WARNA_ID=P.WARNA_ID','LEFT')
                ->join("V_MERK M","P.MERK_ID=M.MERK_ID",'LEFT')
                ->join("V_JENIS J","J.JENIS_ID=P.TYPE_KENDARAAN","left")
                ->join("V_TYPE T",'T.NO_RANGKA = SUBSTR(P.NO_RANGKA,1,10)','LEFT')
                ->join("M_LEASING L","L.LEASING_ID = P.LEASING_ID","L");
                //-//>where("P.DAFT_ID",$id);
  ($v_is_cari=="1")?$this->db->where("P.NO_RANGKA",$v_cari):$this->db->where("P.NO_BPKB",$v_cari);
        $x = $this->db->get();
        
        //echo $this->db->last_query(); exit;

        if($x->num_rows()>0) {
                $res = $x->row_array();
                $arr = array(
                "NAMA_PEMILIK"  => $res['NAMA_PEMILIK'],
                "ALAMAT_PEMILIK" => $res['ALAMAT_PEMILIK'],
                "NREG_BPKB"     =>  $res['NREG_BPKB'],
                "TGL_BPKB"     =>  $res['TGL_BPKB2'],
                "NO_BPKB"       => $res['NO_BPKB'],
                "NO_IDENTITAS"  => null,
                "NO_PONSEL"     => null,
                "NO_POLISI"     => $res['NO_POLISI'],
                "MERK_NAMA"     => $res['MERK_NAMA'],
                "TIPE"          => $res['TIPE'],
                "JENIS_NAMA"    => $res['JENIS_NAMA'],
                "MODEL_NAMA"    => null,
                "THN_BUAT"      => $res['TAHUN_KENDARAAN'],
                "THN_RAKIT"     => null,
                "VOL_SILINDER"  => null,
                "WARNA_NAMA"    => $res['WARNA_NAMA'],
                "NO_RANGKA"     => $res['NO_RANGKA'],
                "NO_MESIN"      => $res['NO_MESIN'],
                "JML_RODA"      => null,
                "JML_SUMBU"     => null,
                "BB_NAMA"       => null,
                "NO_FAKTUR"     => null,
                "TGL_FAKTUR"    => null,
                "NAMA_IMPORTIR" => null,
                "PELABUHAN"     => null,
                "NO_SUT"        => null,
                "NO_TPT"        => null,
                "KETR_PABEAN"   => null,
                "NO_PIB"        => null,
                "TGL_PIB"       => null,
                "NO_PABEAN"     => null,
                "TGL_PABEAN"    => null,
                "NO_UJI_BERKALA"=> null,
                "PRT_NAMA"      => null,
                "WARNATNKB"     => null,
                "WILAYAH_NAMA"  => null,
                "BPKB_STATUS"   => null,
                "NO_SURAT_REF_BLOKIR"   => null,
                "TGL_BLOKIR"            => null,
                "PETUGAS_BLOKIR"        => null,
                "TGL_BUKA_BLOKIR"       => null,
                "PETUGAS_BUKA_BLOKIR"   => null
                );
                $ret=array("error"=>false,"message"=>$arr);
        }
        else {
                $ret = array("error"=>true,"message"=>"Data tidak ditemukanss");
        }


        

        return $ret;


      
}



        // DATE_FORMAT(CURDATE(),'%d-%m-%Y')
        function get_detail_pendaftaran($id) {
          $userdata = $this->session->userdata("userdata");
                $this->db->select("p.`daft_id`, 
                    `no_surat`,`no_urut_surat`,`jenis_permohonan`,p.`leasing_id`,`no_bpkb`,`nreg_bpkb`,`no_rangka`,`no_mesin`,`tgl_bpkb`,`no_polisi`,
                    DATE_FORMAT(`tgl_bpkb`,'%d-%m-%Y') AS tgl_bpkb,
                    `nama_pemilik`,`alamat_pemilik`,p.`merk_id`,
                    IF(jenis_permohonan='B',m.merk_nama,p.`merk_nama`) AS merk_nama,
                    `type_kendaraan`,p.`warna_id`,
                    IF(jenis_permohonan='B',w.`warna_nama`,p.`warna_nama`) AS warna_nama,
                    p.`jenis_id`,
                    IF(jenis_permohonan='B',j.`jenis_nama`,p.`jenis_nama`) AS jenis_nama,
                    `tahun_kendaraan`,`user_id`,`status`,`approved`,`nama_pengajuan_leasing`,`alamat_pengajuan_leasing`,p.`id_polda`,`no_blokir`,
                    DATE_FORMAT(`tgl_blokir`, '%d-%m-%Y')AS tgl_blokir ,
                    DATE_FORMAT(`tgl_blokir2`, '%d-%m-%Y')AS tgl_blokir2 ,

                    DATE_FORMAT(p.daft_date, '%d-%m-%Y') AS daft_date, DATE_FORMAT(p.verifikasi_date, '%d-%m-
                    %Y') AS verifikasi_date, DATE_FORMAT(p.daft_level2_date, '%d-%m-%Y') AS daft_level2_date, DATE_FORMAT
                    (p.daft_level3_date, '%d-%m-%Y') AS daft_level3_date, DATE_FORMAT(p.level2_tglsurat, '%d-%m-%Y') AS level2_tglsurat
                    ,l.leasing_nama, l.leasing_kota,
                    p.cabang_id,

                    `customer_ktp`,`customer_kelurahan`,`customer_kecamatan`,`customer_kab`,`customer_prov`,`pemilik_nama`,`pemilik_ktp`,`pemilik_alamat`,`pemilik_kelurahan`,`pemilik_kecamatan`,`pemilik_kab`,`pemilik_prov`,



                        ",false)
                ->from("t_pendaftaran p")
                ->join("m_warna w",'w.warna_id=p.warna_id','left')
                ->join("m_merk m","p.merk_id=m.merk_id",'LEFT')
                ->join("m_jenis j","j.jenis_id=p.type_kendaraan",'left') 
                // ->join("m_type t",'t.no_rangka = SUBSTR(p.no_rangka,1,10)','LEFT')
                ->join("m_leasing l","l.leasing_id = p.leasing_id","left")
                ->where("p.leasing_id",$userdata['leasing_id'])
                ->where("p.daft_id",$id);
                $res = $this->db->get();
                 // echo $this->db->last_query();
                 // exit;
                return $res->row_array();
        }

        function get_detail($tbname,$col,$value) {
                $this->db->where($col,$value);
                return $this->db->get($tbname)->row_array();
        }



        function get_id_cabang($cabang) {
            $cabang = strtoupper(str_replace(" ", "", $cabang));

            $sql = "select * from t_cabang where upper(replace(cabang_nama,' ','')) = '$cabang'";
            $res = $this->db->query($sql);
            if($res->num_rows() == 0 ){
              return null;
            }
            else {
              $data = $res->row_array();
              return $data['cabang_id'];
            }

        }






}
?>
