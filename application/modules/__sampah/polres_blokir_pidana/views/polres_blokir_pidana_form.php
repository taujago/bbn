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
 <div class="col-lg-12">
 
 </div>
 </div> 
  
<div class="row">
<div class="col-md-12">
		<div class="panel panel-default">
            <div class="panel-heading">PENCARIAN</div>
            <div class="panel-body">
            
            	
                <form class="form-inline" id="fuckyouform">
                      
<div class="form-group">
<?php 
$jenis = array(1=>"Nomor Rangka","Nomor BPKB");
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
                <hr />
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
    <td colspan="2"><strong>DATA  KENDARAAN </strong></td>
  </tr>
  <tr>
    <td width="20%"><p>No Rangka</p></td>
    <td width="80%"><input name="no_rangka" type="text" class="form-control" id="no_rangka2" placeholder="Nomor Rangka"  style="width:200px"  /></td>
  </tr>
  <tr>
    <td>No Mesin</td>
    <td><input name="no_mesin" type="text" class="form-control" id="no_mesin" placeholder="Nomor Mesin" style="width:200px"  /></td>
  </tr>
  <tr>
    <td>No. Polisi</td>
    <td><input name="no_polisi" type="text" class="form-control" id="no_polisi" placeholder="Nomor Polisi"  style="width:200px" /></td>
  </tr>
<!--  <tr>
    <td>No. BPKB</td>
    <td><input name="no_bpkb" type="text" class="form-control" id="no_bpkb" placeholder="Nomor BPKB"  style="width:200px" /></td>
  </tr>
 <tr>
    <td>No. Reg BPKB</td>
    <td><input name="no_reg_bpkb" type="text" class="form-control" id="no_reg_bpkb" placeholder="Nomor Reg BPKB"  style="width:200px" /></td>
  </tr>
  --> 
  <tr>
    <td>Jumlah Roda</td>
    <td><input name="jumlah_roda" type="text" class="form-control" id="jumlah_roda" placeholder="Jml. Roda"  style="width:50px" /></td>
  </tr>
  <tr>
    <td>Merk</td>
    <td><input name="merk" type="text" class="form-control" id="merk" placeholder="Merk"  style="width:200px" /></td>
  </tr>
  <tr>
    <td>Warna</td>
    <td><input name="warna" type="text" class="form-control" id="warna" placeholder="Warna"  style="width:200px" /></td>
  </tr>
  <tr>
    <td>Tahun Pembuatan </td>
    <td><input name="tahun_pembuatan" type="text" class="form-control" id="tahun_pembuatan" placeholder="Tahun Pembuatan"  style="width:200px" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <td><input  name="pemilik_alamat" type="text" class="form-control" id="pemilik_alamat" size="100" placeholder="Alamt Pemilik" /></td>
  </tr>  
  
  
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2"><strong>KETERANGAN PIDANA </strong></td>
    </tr>
  <tr>
    <td>Tanggal</td>
    <td><input name="tanggal" type="text" class="form-control tanggal" id="tanggal" placeholder="Tanggal" data-date-format="dd-mm-yyyy" style="width:100px" /></td>
  </tr>
  <tr>
    <td>Tanggal Kejadian</td>
    <td><input name="pidana_tgl" type="text" class="form-control tanggal" id="pidana_tgl" placeholder="Tanggal Kejadian" data-date-format="dd-mm-yyyy" style="width:100px" /></td>
  </tr>
  <tr>
    <td>Tanggal Laporan </td>
    <td><input name="surat_laporan_tanggal" type="text" class="form-control tanggal" id="surat_laporan_tanggal" placeholder="Tanggal Kejadian" data-date-format="dd-mm-yyyy" style="width:100px" /></td>
  </tr>
  <tr>
    <td>Tempat Kejadian Perkara</td>
    <td><textarea placeholder="Tempat Kejadian Perkara" class="form-control" name="pidana_tkp" id="pidana_tkp" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>Waktu Kejadian Perkara</td>
    <td><input name="pidana_waktu" type="text" class="form-control" id="pidana_waktu" style="width:100px" size="5" placeholder="hh:mm" /></td>
  </tr>
  <tr>
    <td>Jenis Tindak Pidana</td>
    <td><input name="jenis_pidana" type="text" class="form-control" id="jenis_pidana" placeholder="Pencurian/Perampasan" style="width:300px" /></td>
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
    <td>Keterangan</td>
    <td><textarea placeholder="Keterangan" class="form-control" name="keterangan" id="keterangan" cols="45" rows="5"></textarea></td>
  </tr>
  

<tr>
    <td colspan="2"><strong>DATA PELAPORANKEPOLISIAN</strong></td>
    </tr>
  <tr>
    <td>Jenis Instansi </td>
    <td> 
    <?php 
		$jenis_instansi = array("polres"=>"POLISI RESORT","polsek"=>"POLISI SEKTOR");
		echo form_dropdown('jenis',$jenis_instansi,'','id="jenis" class="form-control" style="width:150px;"');
	?>
    </td>
  </tr>
 <!-- <tr>
    <td>No. KTP Pemilik</td>
    <td><input name="pemilik_ktp" type="text" class="form-control" id="pemilik_ktp" placeholder="No. KTP Pemilik" /></td>
  </tr>-->
  <tr>
    <td>Nama POLRES</td>
    <td><input  name="nama_polres" type="text" class="form-control" id="nama_polres" size="100" placeholder="Nama Polres" /></td>
  </tr>  
  
  
  <tr class="tr_polsek">
    <td valign="top">Nama POLSEK</td>
    <td><input  name="nama_polsek" type="text" class="form-control" id="nama_polsek" size="100" placeholder="Nama Polsek" /></td>
  </tr>
  <tr>
    <td valign="top">Alamat Instansi </td>
    <td><textarea placeholder="Alamat Polres / polsek" class="form-control" name="alamat_instansi" id="alamat_instansi" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td valign="top">Nama Kepala Polres / Polsek</td>
    <td><input  name="ttd_nama" type="text" class="form-control" id="ttd_nama" size="100" placeholder="Nama kepala Polres / Polsek" /></td>
  </tr>
  <tr>
    <td valign="top">NRP Kepala Polres  / Polsek </td>
    <td><input  name="ttd_nrp" type="text" class="form-control" id="ttd_nrp" size="100" placeholder="NRP Kepala Polres / Polsek" /></td>
  </tr>
  <tr>
    <td valign="top">Pangkat Kepala Polres / Polsek</td>
    <td><input  name="ttd_pangkat" type="text" class="form-control" id="ttd_pangkat" size="100" placeholder="Pangkat Kepala Polres / Polsek" /></td>
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