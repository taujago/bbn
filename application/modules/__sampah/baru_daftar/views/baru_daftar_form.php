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


 
<div class="row">
<div class="col-md-12">
		<div class="panel panel-default">
            <div class="panel-heading">CEK DATA APM</div>
            <div class="panel-body">
            
            <form class="form-inline" id="fuckyouform">
                      
<div class="form-group">
<?php 
	echo form_dropdown("jenis",$jenis,'','class="form-control"');				   
?>  
                       
                      </div>                      
<div class="form-group">
                         
                        <input type="text" class="form-control" style="width:600px"
                        id="no_rangka" placeholder="NOMOR RANGKA / BPKB"
                        name="no_rangka">
                      </div>
                     
                      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Query </button>
                      
              </form>
            </div>
        </div>
</div>
</div>


<form id="frm_daftar" >

<div class="row">
<div class="col-lg-12">
  <hr />
  <table width="100%" id="frm" >
  <tr>
    <td>Kantor Cabang</td>
    <td><?php 
		
		echo form_dropdown("cabang_id",$arr_cabang,'','id="cabang_id" class="form-control" style="width:300px;"');
	?></td>
  </tr>
  <tr><td width="20%">Tanggal Pendaftaran </td><td width="80%"> <input name="daft_date" type="text" class="form-control" id="vDAFT_DATE" placeholder="Tanggal" data-date-format="dd-mm-yyyy" /> </td></tr>
   
  <tr>
    <td><p>No Rangka</p></td>
    <td><input name="no_rangka" type="text" class="form-control" id="vNO_RANGKA" placeholder="Nomor Rangka" /></td>
  </tr>
  <tr>
    <td><p>No Mesin</p></td>
    <td><input name="no_mesin" type="text" class="form-control" id="vNO_MESIN" placeholder="Nomor Mesin" /></td>
  </tr>
  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input style="width:100px;" name="tahun_kendaraan" type="text" class="form-control" id="tahun_kendaraan" placeholder="Tahun" /></td>
  </tr>
   <tr>
    <td><p>Jenis Kendaraan</p></td>
    <td><?php 
		
		//echo //form_dropdown("jenis_id",$arr_jenis,'','id="jenis_id" class="form-control"');
	?>
      <input name="jenis_nama" type="text" class="form-control" id="jenis_nama" placeholder="Jenis Kendaraan" /></td>
  </tr>
  <tr>
    <td><p>Merk Kendaraan</p></td>
    <td><?php 
		
		//echo //form_dropdown("merk_id",$arr_merk,'','id="vMERK_ID" class="form-control"');
	?>
      <input name="merk_nama" type="text" class="form-control" id="merk_nama" placeholder="Jenis Kendaraan" /></td>
  </tr>
 <!-- <tr>
    <td><p>Type Kendaraan</p></td>
    <td><?php 
		///echo form_dropdown("type_kendaraan",$arr_jenis,'','id="vTYPE_KENDARAAN" class="form-control"');
	?></td>
  </tr>-->
  <tr>
    <td><p>Warna Kendaraan</p></td>
    <td><?php 
		//echo form_dropdown("warna_id",$arr_warna,'','id="vWARNA_ID" class="form-control"');
	?>
      <input name="warna_nama" type="text" class="form-control" id="warna_nama" placeholder="Jenis Kendaraan" /></td>
  </tr>
 <!--  <tr>
    <td><p>Tahun Kendaraan</p></td>
    <td><input name="TAHUN_KENDARAAN" type="text" class="form-control" id="vTAHUN_KENDARAAN" placeholder="Tahun Kendaraan" /></td>
  </tr> -->
  <tr>
    <td colspan="2"><strong>DATA PEMILIK KENDARAAN
      </strong></td>
    </tr>
  <tr>
    <td>Nama Pemilik</td>
    <td><input name="pemilik_nama" type="text" class="form-control" id="pemilik_nama" placeholder="Nama Pemilik" /></td>
  </tr>
  <tr>
    <td>No. KTP Pemilik</td>
    <td><input name="pemilik_ktp" type="text" class="form-control" id="pemilik_ktp" placeholder="No. KTP Pemilik" /></td>
  </tr>
  <tr>
    <td>Alamat Pemilik</td>
    <td><input name="pemilik_alamat" type="text" class="form-control" id="pemilik_alamat" placeholder="Alamt Pemilik" /></td>
  </tr>
  
  
  
  <tr>
    <td colspan="2"><strong>DATA CUSTOMER 
      <input type="checkbox" name="saa" id="saa" />
    </strong>Data customer sama dengan data pemilik</td>
    </tr>
  <tr>
    <td><p>Nama Customer</p></td>
    <td><input name="nama_pengajuan_leasing" type="text" class="form-control" id="nama_pengajuan_leasing" placeholder="Nama Customer" /></td>
  </tr>
  <tr>
    <td>No. KTP</td>
    <td><input name="customer_ktp" type="text" class="form-control" id="customer_ktp" placeholder="Nomor KTP Customer" /></td>
  </tr>
  <tr>
    <td><p>Alamat Customer</p></td>
    <td><input name="alamat_pengajuan_leasing" type="text" class="form-control" id="alamat_pengajuan_leasing" placeholder="Alamat Customer" /></td>
  </tr>
  <!--<tr>
    <td>Kelurahan</td>
    <td><input name="customer_kelurahan" type="text" class="form-control" id="customer_kelurahan" placeholder="Kelurahan Customer" /></td>
  </tr>
  <tr>
    <td>Kecamatan</td>
    <td><input name="customer_kecamatan" type="text" class="form-control" id="customer_kecamatan" placeholder="Kecamatan Customer" /></td>
  </tr>
  <tr>
    <td>Kab. / Kota</td>
    <td><input name="customer_kab" type="text" class="form-control" id="customer_kab" placeholder="Kab/Kota Customer" /></td>
  </tr>
  <tr>
    <td>Provinsi</td>
    <td><input name="customer_prov" type="text" class="form-control" id="customer_prov" placeholder="Provinsi Customer" /></td>
  </tr>-->
  
  <!-- <tr>
   <td>Kelurahan</td>
    <td><input name="pemilik_kelurahan" type="text" class="form-control" id="pemilik_kelurahan" placeholder="Kelurahan Pemilik" /></td>
  </tr>
  <tr>
    <td>Kecamatan</td>
    <td><input name="pemilik_kecamatan" type="text" class="form-control" id="pemilik_kecamatan" placeholder="Kecamatan Pemilik" /></td>
  </tr>
  <tr>
    <td>Kab./Kota</td>
    <td><input name="pemilik_kab" type="text" class="form-control" id="pemilik_kab" placeholder="Kab/Kota Pemilik" /></td>
  </tr>
  <tr>
    <td>Provinsi</td>
    <td><input name="pemilik_prov" type="text" class="form-control" id="pemilik_prov" placeholder="Provinsi Pemilik" /></td>
  </tr>-->
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

<?php $this->load->view("baru_daftar_form_js"); ?>