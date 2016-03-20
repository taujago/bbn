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
  <tr>
    <td colspan="2"><strong>DATA  KENDARAAN </strong></td>
    </tr>
  <tr><td width="20%">Tanggal  </td><td width="80%"> <input name="tanggal" type="text" class="form-control" id="tanggal" placeholder="Tanggal" data-date-format="dd-mm-yyyy" style="width:100px" /> </td></tr>
   
  <tr>
    <td><p>No Rangka</p></td>
    <td><input name="no_rangka" type="text" class="form-control" id="no_rangka" placeholder="Nomor Rangka"  style="width:200px"  /></td>
  </tr>
  <tr>
    <td>No Mesin</td>
    <td><input name="no_mesin" type="text" class="form-control" id="no_mesin" placeholder="Nomor Mesin" style="width:200px"  /></td>
  </tr>
  <tr>
    <td>No. Polisi</td>
    <td><input name="no_polisi" type="text" class="form-control" id="no_polisi" placeholder="Nomor Polisi"  style="width:200px" /></td>
  </tr>
  <tr>
    <td>No. BPKB</td>
    <td><input name="no_bpkb" type="text" class="form-control" id="no_bpkb" placeholder="Nomor BPKB"  style="width:200px" /></td>
  </tr>
  <tr>
    <td>No. Reg BPKB</td>
    <td><input name="no_reg_bpkb" type="text" class="form-control" id="no_reg_bpkb" placeholder="Nomor Reg BPKB"  style="width:200px" /></td>
  </tr>
  
  <tr>
    <td colspan="2"><strong>DATA PEMILIK KENDARAAN
      </strong></td>
    </tr>
  <tr>
    <td>Nama Pemilik</td>
    <td><input name="pemilik_nama" type="text" class="form-control" id="pemilik_nama" placeholder="Nama Pemilik" style="width:300px" /></td>
  </tr>
 <!-- <tr>
    <td>No. KTP Pemilik</td>
    <td><input name="pemilik_ktp" type="text" class="form-control" id="pemilik_ktp" placeholder="No. KTP Pemilik" /></td>
  </tr>-->
  <tr>
    <td>Alamat Pemilik</td>
    <td><input  name="pemilik_alamat" type="text" class="form-control" id="pemilik_alamat" placeholder="Alamt Pemilik" /></td>
  </tr>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Keterangan</td>
    <td><textarea placeholder="Keterangan" class="form-control" name="keterangan" id="keterangan" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-lg btn-primary" type="submit" name="Submit" id="tombol" value="Simpan">
      <a class="btn btn-lg btn-danger" href="<?php echo site_url("polres_blokir_pidana"); ?>" >Kembali 
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      <input type="hidden" name="daft_id" id="vDAFT_ID"  value="<?php echo isset($daft_id)?$daft_id:""; ?>" />
      </a></td>
  </tr>
  </table>
  
       
</div>
</div>
</form>

<?php $this->load->view("polres_blokir_pidana_form_js"); ?>