<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>
<style>
#frm td {
	padding:5px;
}
</style>

  
 <div class="row">
  <div id="salah" class="col-lg-12" style="display:none">
            <div class="alert alert-danger" role="alert" id="message">
            	
            </div>
        </div>
    </div>
    
  <div class="row">
  <div id="benar" class="col-lg-12" style="display:none">
            <div class="alert alert-success" role="alert" id="message2">
            	
            </div>
        </div>
    </div> 


  <!--<div class="row">
         <form id="frm_no_bpkb" name="frm_no_rangka" method="post" action="">    
             
            <div class="col-md-6">
            <div class="form-group input-group">
              <input name="no_bpkb" id="no_rangka" class="form-control" 
                    type="text" placeholder="Nomor Rangka" >
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" value="CEK DATA" >
                    <i class="fa fa-search"></i>
                    </button>
                    </span>
                </div> 
            </div>
         
        </form>
        </div>  -->

<form id="frm_daftar" >

<div class="row">
<div class="col-lg-12">
  <hr />
  <table width="100%" id="frm" >
  <tr>
    <td width="20%">Kantor Cabang</td>
    <td><?php 
		
		echo form_dropdown("cabang_id",$arr_cabang,'','id="cabang_id" class="form-control" style="width:300px;"');
	?></td>
  </tr>
  <tr>
    <td>Tanggal Pendaftaran</td><td width="80%"> <input style="width:100px;" name="daft_date" type="text" class="form-control tanggal" id="vDAFT_DATE" placeholder="Tanggal" data-date-format="dd-mm-yyyy" /> </td></tr>
   <tr>
    <td><p>Nama Pemohon </p></td>
    <td><input name="nama_pengajuan_leasing" type="text" class="form-control" id="vNAMA_PENGAJUAN_LEASING" placeholder="Nama Pemohon" /></td>
  </tr>
  <tr>
    <td><p>Alamat Pemohon </p></td>
    <td><input name="alamat_pengajuan_leasing" type="text" class="form-control" id="vALAMAT_PENGAJUAN_LEASING" placeholder="Alamat Pemohon" /></td>
  </tr>
  
  <tr>
    <td>No. KTP Pemohon </td>
    <td><input name="customer_ktp" type="text" class="form-control" id="customer_ktp" placeholder="KTP Pemohon" /></td>
  </tr>
  <tr>
    <td><p>No Rangka</p></td>
    <td><input   name="no_rangka" type="text" class="form-control" id="vNO_RANGKA" placeholder="Nomor Rangka" /></td>
  </tr>
  <tr>
    <td><p>No Mesin</p></td>
    <td><input   name="no_mesin" type="text" class="form-control" id="vNO_MESIN" placeholder="Nomor Mesin" /></td>
  </tr>
  <tr>
    <td>No. BPKB</td>
    <td><input   style="width:200px;" name="no_bpkb" type="text" class="form-control" id="no_bpkb" placeholder="Nomor BPKB" /></td>
  </tr>
  <tr>
    <td>Tgl. BPKB</td>
    <td><input   style="width:200px;" name="tgl_bpkb" type="text" class="form-control tanggal" id="tgl_bpkb" placeholder="Tanggal BPKB" data-date-format="dd-mm-yyyy" /></td>
  </tr>
  <tr>
    <td>No. Polisi </td>
    <td><input   style="width:200px;" name="no_polisi" type="text" class="form-control" id="no_polisi" placeholder="No. Polisi" /></td>
  </tr>
  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input style="width:100px;" name="tahun_kendaraan" type="text" class="form-control" id="tahun_kendaraan" placeholder="Tahun" /></td>
  </tr>
   <tr>
    <td><p>Jenis Kendaraan</p></td>
    <td><input   style="width:200px;" name="jenis_nama" type="text" class="form-control" id="jenis_nama" placeholder="Jenis" /></td>
  </tr>
  <tr>
    <td><p>Merk Kendaraan</p></td>
    <td><input   style="width:200px;" name="merk_nama" type="text" class="form-control" id="merk_nama" placeholder="Merk" /></td>
  </tr>

  <tr>
    <td><p>Warna Kendaraan</p></td>
    <td><input style="width:200px;" name="warna_nama" type="text" class="form-control" id="warna_nama" placeholder="Warna" /></td>
  </tr>
 <!--  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input name="TAHUN_KENDARAAN" type="text" class="form-control" id="vTAHUN_KENDARAAN" placeholder="Tahun Kendaraan" /></td>
  </tr> -->
  
  <tr>
    <td>Nama Pemilik</td>
    <td><input   style="width:300px;" name="pemilik_nama" type="text" class="form-control" id="pemilik_nama" placeholder="Nama Pemilik " /></td>
  </tr>
  <tr>
    <td>Alamat Pemilik </td>
    <td><input    name="pemilik_alamat" type="text" class="form-control" id="pemilik_alamat" placeholder="Alamat" /></td>
  </tr>
  <tr>
    <td>Nomor KTP Pemilik</td>
    <td><input   style="width:300px;" name="pemilik_ktp" type="text" class="form-control" id="pemilik_ktp" placeholder="No. KTP  Pemilik " /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-lg btn-primary" type="submit" name="Submit" id="tombol" value="Simpan">
      <a class="btn btn-lg btn-danger" href="<?php echo site_url("baru_daftar"); ?>" >Kembali 
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      <input type="hidden" name="daft_id" id="vDAFT_ID"  value="<?php echo isset($daft_id)?$daft_id:""; ?>" />
      </a></td>
  </tr>
  </table>
  
       
</div>
</div>
</form>

<?php $this->load->view("lama_daftar_form_js"); ?>