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

<form id="frm_daftar" >

<div class="row">
<div class="col-lg-12">
  <hr />
  <table width="100%" id="frm" >
  <tr><td width="20%">Tanggal Pendaftaran </td><td width="80%"> <input name="daft_date" type="text" class="form-control" id="vDAFT_DATE" placeholder="Tanggal" data-date-format="dd-mm-yyyy" /> </td></tr>
   
  <tr>
    <td><p>No Rangka</p></td>
    <td><input name="no_rangka" type="text" class="form-control" id="no_rangka" placeholder="Nomor Rangka" /></td>
  </tr>
  <tr>
    <td><p>No Mesin</p></td>
    <td><input name="no_mesin" type="text" class="form-control" id="no_mesin" placeholder="Nomor Mesin" /></td>
  </tr>
  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input style="width:100px;" name="tahun_kendaraan" type="text" class="form-control" id="tahun_kendaraan" placeholder="Tahun" /></td>
  </tr>
  <tr>
    <td><p>Jenis Kendaraan</p></td>
    <td><?php 
		
		echo form_dropdown("jenis_id",$arr_jenis,'','id="jenis_id" class="form-control"');
	?></td>
  </tr>
  <tr>
    <td><p>Merk Kendaraan</p></td>
    <td><?php 
		
		echo form_dropdown("merk_id",$arr_merk,'','id="merk_id" class="form-control"');
	?></td>
  </tr>
 <!-- <tr>
    <td><p>Type Kendaraan</p></td>
    <td><?php 
		echo form_dropdown("type_kendaraan",$arr_jenis,'','id="type_kendaraan" class="form-control"');
	?></td>
  </tr>-->
  <tr>
    <td><p>Warna Kendaraan</p></td>
    <td><?php 
		echo form_dropdown("warna_id",$arr_warna,'','id="warna_id" class="form-control"');
	?></td>
  </tr>
 <!--  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input name="TAHUN_KENDARAAN" type="text" class="form-control" id="vTAHUN_KENDARAAN" placeholder="Tahun Kendaraan" /></td>
  </tr> -->
  <tr>
    <td><p>Nama Pemohon dalam proses pengajuan kredit</p></td>
    <td><input name="nama_pengajuan_leasing" type="text" class="form-control" id="vNAMA_PENGAJUAN_LEASING" placeholder="Nama Pemohon" /></td>
  </tr>
  <tr>
    <td><p>Alamat Pemohon dalam proses pengajuan kredit</p></td>
    <td><input name="alamat_pengajuan_leasing" type="text" class="form-control" id="vALAMAT_PENGAJUAN_LEASING" placeholder="Alamat Pemohon" /></td>
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

<?php $this->load->view("baru_daftar_form_edit_js"); ?>