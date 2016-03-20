<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>
<style>
#frm td {
	padding:5px;
}
</style>


<form id="frm_cek" name="frm_cek" method="post" action="">
<div class="row">
<div class="col-lg-3">
<?php echo form_dropdown("vISCari",$arr_cari,'','id="vISCari" class="form-control"');
?>
</div>
<div class="col-lg-6">


<div class="form-group input-group">
<input name="vCari" id="vCari" class="form-control" type="text" placeholder="Masukkan kunci pencarian">
<span class="input-group-btn">
<button class="btn btn-default" type="submit" value="CEK DATA" >
<i class="fa fa-search"></i>
</button>
</span>
</div>

</div> </div>
</form>
 <!-- <input type="text" name="vNO_BPKB" id="vNO_BPKB" class="form-control" style="width:300px; float:left;">
  <a  style="margin-left:10px;" class="btn btn-success" type="submit" name="button" id="button" ><i class="fa fa-search fa-fw"> </i>CEK DATA </a>-->

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
  <tr><td width="20%">Tanggal Pendaftaran </td><td width="80%"> <input name="DAFT_DATE" type="text" class="form-control" id="vDAFT_DATE" placeholder="Tanggal" data-date-format="dd-mm-yyyy" /> </td></tr>
  <tr>
    <td><p>Nama Pemilik Sesuai BPKB</p></td>
    <td><input name="NAMA_PEMILIK"  id="vNAMA_PEMILIK" type="text" class="form-control"  placeholder="Nama Pemilik " /></td>
  </tr>
  <tr>
    <td><p>Alamat Pemilik Sesuai BPKB</p></td>
    <td><input name="ALAMAT_PEMILIK" type="text" class="form-control" id="vALAMAT_PEMILIK" placeholder="Alamat Sesuai BPKB" /></td>
  </tr>
  <tr>
    <td><p>No BPKB</p></td>
    <td><input name="NO_BPKB"  id="vNO_BPKB" type="text" class="form-control"  placeholder="Nomor BPKB" /></td>
  </tr>
  <tr>
    <td><p>No Register BPKB</p></td>
    <td><input name="NREG_BPKB" type="text" class="form-control" id="vNREG_BPKB" placeholder="Nomor Registrasi BPKB" /></td>
  </tr>
  <tr>
    <td><p>Tanggal BPKB</p></td>
    <td><input name="TGL_BPKB"  type="text"  class="form-control" id="vTGL_BPKB" placeholder="Tanggal BPKB" data-date-format="dd-mm-yyyy"   /></td>
  </tr>
  <tr>
    <td><p>No Polisi</p></td>
    <td><input name="NO_POLISI" type="text" class="form-control" id="vNO_POLISI" placeholder="Nomor Polisi" /></td>
  </tr>
  <tr>
    <td><p>No Rangka</p></td>
    <td><input name="NO_RANGKA" type="text" class="form-control" id="vNO_RANGKA" placeholder="Nomor Rangka" /></td>
  </tr>
  <tr>
    <td><p>No Mesin</p></td>
    <td><input name="NO_MESIN" type="text" class="form-control" id="vNO_MESIN" placeholder="Nomor Mesin" /></td>
  </tr>
  <tr>
    <td><p>Merk Kendaraan</p></td>
    <td><?php 
		
		echo form_dropdown("MERK_ID",$arr_merk,'','id="vMERK_ID" class="form-control"');
	?></td>
  </tr>
  <tr>
    <td><p>Type Kendaraan</p></td>
    <td><?php 
		echo form_dropdown("TYPE_KENDARAAN",$arr_jenis,'','id="vTYPE_KENDARAAN" class="form-control"');
	?></td>
  </tr>
  <tr>
    <td><p>Warna Kendaraan</p></td>
    <td><?php 
		echo form_dropdown("WARNA_ID",$arr_warna,'','id="vWARNA_ID" class="form-control"');
	?></td>
  </tr>
  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input name="TAHUN_KENDARAAN" type="text" class="form-control" id="vTAHUN_KENDARAAN" placeholder="Tahun Kendaraan" /></td>
  </tr>
  <tr>
    <td><p>Nama Pemohon dalam proses pengajuan kredit</p></td>
    <td><input name="NAMA_PENGAJUAN_LEASING" type="text" class="form-control" id="vNAMA_PENGAJUAN_LEASING" placeholder="Nama Pemohon" /></td>
  </tr>
  <tr>
    <td><p>Alamat Pemohon dalam proses pengajuan kredit</p></td>
    <td><input name="ALAMAT_PENGAJUAN_LEASING" type="text" class="form-control" id="vALAMAT_PENGAJUAN_LEASING" placeholder="Alamat Pemohon" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-lg btn-primary" type="submit" name="Submit" id="tombol" value="Simpan">
      <a class="btn btn-lg btn-danger" href="<?php echo site_url("blokir/pendaftaran_list"); ?>" >Kembali 
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      <input type="hidden" name="DAFT_ID" id="vDAFT_ID"  value="<?php echo isset($DAFT_ID)?$USER_ID:""; ?>" />
      </a></td>
  </tr>
  </table>
  
       
</div>
</div>
</form>

<?php $this->load->view("daftar_view_js"); ?>