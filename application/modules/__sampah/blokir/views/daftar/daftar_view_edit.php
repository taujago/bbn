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
  <tr><td width="20%">Tanggal Pendaftaran </td><td width="80%"> <input name="DAFT_DATE" type="text" class="form-control" id="vDAFT_DATE" placeholder="Tanggal" data-date-format="dd-mm-yyyy" value="<?php echo  isset($DAFT_DATE)?$DAFT_DATE:""; ?>"/> </td></tr>
  <tr>
    <td><p>Nama Pemilik Sesuai BPKB</p></td>
    <td><input name="NAMA_PEMILIK"  id="vNAMA_PEMILIK" type="text" class="form-control"  placeholder="Nama Pemilik " value="<?php echo  isset($NAMA_PEMILIK)?$NAMA_PEMILIK:""; ?>"/></td>
  </tr>
  <tr>
    <td><p>Alamat Pemilik Sesuai BPKB</p></td>
    <td><input name="ALAMAT_PEMILIK" type="text" class="form-control" id="vALAMAT_PEMILIK" placeholder="Alamat Sesuai BPKB"  value="<?php echo  isset($ALAMAT_PEMILIK)?$ALAMAT_PEMILIK:""; ?>"/></td>
  </tr>
  <tr>
    <td><p>No BPKB</p></td>
    <td><input name="NO_BPKB"  id="vNO_BPKB" type="text" class="form-control"  placeholder="Nomor BPKB"  value="<?php echo  isset($NO_BPKB)?$NO_BPKB:""; ?>"/></td>
  </tr>
  <tr>
    <td><p>No Register BPKB</p></td>
    <td><input name="NREG_BPKB" type="text" class="form-control" id="vNREG_BPKB" placeholder="Nomor Registrasi BPKB"  value="<?php echo  isset($NREG_BPKB)?$NREG_BPKB:""; ?>"/></td>
  </tr>
  <tr>
    <td><p>Tanggal BPKB</p></td>
    <td><input name="TGL_BPKB"  type="text"  class="form-control" id="vTGL_BPKB" placeholder="Tanggal BPKB" data-date-format="dd-mm-yyyy" value="<?php echo  isset($TGL_BPKB)?$TGL_BPKB:""; ?>"  /></td>
  </tr>
  <tr>
    <td><p>No Polisi</p></td>
    <td><input name="NO_POLISI" type="text" class="form-control" id="vNO_POLISI" placeholder="Nomor Polisi" value="<?php echo  isset($NO_POLISI)?$NO_POLISI:""; ?>"/></td>
  </tr>
  <tr>
    <td><p>No Rangka</p></td>
    <td><input name="NO_RANGKA" type="text" class="form-control" id="vNO_RANGKA" placeholder="Nomor Rangka"  value="<?php echo  isset($NO_RANGKA)?$NO_RANGKA:""; ?>"/></td>
  </tr>
  <tr>
    <td><p>No Mesin</p></td>
    <td><input name="NO_MESIN" type="text" class="form-control" id="vNO_MESIN" placeholder="Nomor Mesin" value="<?php echo  isset($NO_MESIN)?$NO_MESIN:""; ?>" /></td>
  </tr>
  <tr>
    <td><p>Merk Kendaraan</p></td>
    <td><?php 
			$MERK_ID = isset($MERK_ID)?$MERK_ID:"";
		echo form_dropdown("MERK_ID",$arr_merk,$MERK_ID,'id="vMERK_ID" class="form-control"');
	?></td>
  </tr>
  <tr>
    <td><p>Type Kendaraan</p></td>
    <td><?php
		$TYPE_KENDARAAN = isset($TYPE_KENDARAAN)?$TYPE_KENDARAAN:""; 
		echo form_dropdown("TYPE_KENDARAAN",$arr_jenis,$TYPE_KENDARAAN,'id="vTYPE_KENDARAAN" class="form-control"');
	?></td>
  </tr>
  <tr>
    <td><p>Warna Kendaraan</p></td>
    <td><?php 
		$WARNA_ID = isset($WARNA_ID)?$WARNA_ID:""; 
		echo form_dropdown("WARNA_ID",$arr_warna,$WARNA_ID,'id="vWARNA_ID" class="form-control"');
	?></td>
  </tr>
  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input name="TAHUN_KENDARAAN" type="text" class="form-control" id="vTAHUN_KENDARAAN" placeholder="Tahun Kendaraan"  value="<?php echo  isset($TAHUN_KENDARAAN)?$TAHUN_KENDARAAN:""; ?>"/></td>
  </tr>
  <tr>
    <td><p>Nama Pemohon dalam proses pengajuan kredit</p></td>
    <td><input name="NAMA_PENGAJUAN_LEASING" type="text" class="form-control" id="vNAMA_PENGAJUAN_LEASING" placeholder="Nama Pemohon"  value="<?php echo  isset($NAMA_PENGAJUAN_LEASING)?$NAMA_PENGAJUAN_LEASING:""; ?>"/></td>
  </tr>
  <tr>
    <td><p>Alamat Pemohon dalam proses pengajuan kredit</p></td>
    <td><input name="ALAMAT_PENGAJUAN_LEASING" type="text" class="form-control" id="vALAMAT_PENGAJUAN_LEASING" placeholder="Alamat Pemohon"  value="<?php echo  isset($ALAMAT_PENGAJUAN_LEASING)?$ALAMAT_PENGAJUAN_LEASING:""; ?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-lg btn-primary" type="submit" name="Submit" id="tombol" value="Simpan">
      <a class="btn btn-lg btn-danger" href="<?php echo site_url("blokir/pendaftaran_list"); ?>" >Kembali 
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      <input type="hidden" name="DAFT_ID" id="vDAFT_ID"  value="<?php echo isset($DAFT_ID)?$DAFT_ID:""; ?>" />
      </a></td>
  </tr>
  </table>
  
       
</div>
</div>
</form>

<?php $this->load->view("daftar_view_edit_js"); ?>