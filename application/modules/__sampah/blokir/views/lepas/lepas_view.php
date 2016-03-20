<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>
<style>
#frm td {
	padding:5px;
}
</style>



<div class="row">
<form id="frm_cek" name="frm_cek" method="post" action="">
<div class="col-md-3">
<?php 
$arr_cari = array(1=>"Nomor Rangka","Nomor BPKB ");
echo form_dropdown("IS_CARI",$arr_cari,'','id="vIS_CARI" class="form-control"'); ?>
</div>

<div class="col-md-6">


<div class="form-group input-group">
<input name="NO_BPKB" id="vNO_BPKB_SEARCH" class="form-control" type="text" placeholder="Masukkan NO. BPKB atau No. Rangka">
<span class="input-group-btn">
<button class="btn btn-default" type="submit" value="CEK DATA" >
<i class="fa fa-search"></i>
</button>
</span>
</div>
</form>
</div> 
</div>
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
  <tr><td width="20%">Tanggal Pendaftaran </td><td width="80%"> <input name="DAFT_DATE" type="text" class="form-control" id="DAFT_DATE" placeholder="Tanggal" data-date-format="dd-mm-yyyy" /> </td></tr>
  <tr>
    <td><p>Nama Pemilik Sesuai BPKB</p></td>
    <td><input name="NAMA_PEMILIK"  id="NAMA_PEMILIK" type="text" class="form-control"  placeholder="Nama Pemilik " /></td>
  </tr>
  <tr>
    <td><p>Alamat Pemilik Sesuai BPKB</p></td>
    <td><input name="ALAMAT_PEMILIK" type="text" class="form-control" id="ALAMAT_PEMILIK" placeholder="Alamat Sesuai BPKB" /></td>
  </tr>
  <tr>
    <td><p>No BPKB</p></td>
    <td><input name="NO_BPKB"  id="NO_BPKB" type="text" class="form-control"  placeholder="Nomor BPKB" /></td>
  </tr>
  <tr>
    <td><p>No Register BPKB</p></td>
    <td><input name="NREG_BPKB" type="text" class="form-control" id="NREG_BPKB" placeholder="Nomor Registrasi BPKB" /></td>
  </tr>
  <tr>
    <td><p>Tanggal BPKB</p></td>
    <td><input name="TGL_BPKB"  type="text"  class="form-control" id="TGL_BPKB" placeholder="Tanggal BPKB" data-date-format="dd-mm-yyyy"   /></td>
  </tr>
  <tr>
    <td><p>No Polisi</p></td>
    <td><input name="NO_POLISI" type="text" class="form-control" id="NO_POLISI" placeholder="Nomor Polisi" /></td>
  </tr>
  <tr>
    <td><p>No Rangka</p></td>
    <td><input name="NO_RANGKA" type="text" class="form-control" id="NO_RANGKA" placeholder="Nomor Rangka" /></td>
  </tr>
  <tr>
    <td><p>No Mesin</p></td>
    <td><input name="NO_MESIN" type="text" class="form-control" id="NO_MESIN" placeholder="Nomor Mesin" /></td>
  </tr>
  <tr>
    <td><p>Merk Kendaraan</p></td>
    <td><input name="MERK_NAMA" type="text" class="form-control" id="MERK_NAMA" placeholder="Merk Kendaraan" /></td>
  </tr>
  <tr>
    <td><p>Type Kendaraan</p></td>
    <td><input name="JENIS_NAMA" type="text" class="form-control" id="JENIS_NAMA" placeholder="Nomor Mesin" /></td>
  </tr>
  <tr>
    <td><p>Warna Kendaraan</p></td>
    <td><input name="WARNA_NAMA" type="text" class="form-control" id="WARNA_NAMA" placeholder="WARNA KENDARAAN" /></td>
  </tr>
  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input name="TAHUN_KENDARAAN" type="text" class="form-control" id="TAHUN_KENDARAAN" placeholder="Tahun Kendaraan" /></td>
  </tr>
  <tr>
    <td><p>Nama Pemohon dalam proses pengajuan kredit</p></td>
    <td><input name="NAMA_PENGAJUAN_LEASING" type="text" class="form-control" id="NAMA_PENGAJUAN_LEASING" placeholder="Nama Pemohon" /></td>
  </tr>
  <tr>
    <td><p>Alamat Pemohon dalam proses pengajuan kredit</p></td>
    <td><input name="ALAMAT_PENGAJUAN_LEASING" type="text" class="form-control" id="ALAMAT_PENGAJUAN_LEASING" placeholder="Alamat Pemohon" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-lg btn-danger" type="submit" name="Submit" id="tombol" value="LEPAS BLOKIR"></td>
  </tr>
  </table>
  
       
</div>
</div>
</form>

<?php $this->load->view("lepas_view_js"); ?>