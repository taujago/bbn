<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

<style>
#Status {
	font-weight:bold;
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
            <div class="panel-heading">PENCARIAN</div>
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
                <hr />
                
<div id="data_detail" style="display:none;">                
             
             <h1> STATUS BPKB : <span id="Status"></span> </h1>
                
              <table width="80%" border="0" cellpadding="3">
                  <tr>
                    <td width="30%">NOMOR RANGKA</td>
                    <td width="2%">:</td>
                    <td width="68%"><span id="NoRangka"></span></td>
                  </tr>
                  <!-- <tr>
                    <td>STATUS BPKB</td>
                    <td>:</td>
                    <td></td>
                  </tr>-->
                 <!-- <tr>
                    <td>NOMOR BPKB</td>
                    <td>:</td>
                    <td><span id="NoRangka"></span></td>
                  </tr>-->
                  <tr>
                    <td>NOMOR MESIN</td>
                    <td>:</td>
                    <td><span id="NoMesin"></span></td>
                  </tr>
                  <tr>
                    <td>NOMOR FAKTUR</td>
                    <td>:</td>
                    <td><span id="NoFaktur"></span></td>
                  </tr>
                  <tr>
                    <td>TANGGAL FAKTUR</td>
                    <td>:</td>
                    <td><span id="TglFaktur"></span></td>
                  </tr>
                  <tr>
                    <td>MERK</td>
                    <td>:</td>
                    <td><span id="Merk"></span></td>
                  </tr>
                  <tr>
                    <td>TYPE</td>
                    <td>:</td>
                    <td><span id="Tipe"></span></td>
                  </tr>
                  <tr>
                    <td>JENIS</td>
                    <td>:</td>
                    <td><span id="Jenis"></span></td>
                  </tr>
                  <tr>
                    <td>MODEL</td>
                    <td>:</td>
                    <td><span id="Model"></span></td>
                  </tr>
                  <tr>
                    <td>BAHAN BAKAR</td>
                    <td>:</td>
                    <td><span id="BahanBakar"></span></td>
                  </tr>
                  <tr>
                    <td>TAHUN PEMBUATAN</td>
                    <td>:</td>
                    <td><span id="ThnBuat"></span></td>
                  </tr>
                  <tr>
                    <td>TAHUN PERAKITAN</td>
                    <td>:</td>
                    <td><span id="ThnRakit"></span></td>
                  </tr>
                  <tr>
                    <td>WARNA</td>
                    <td>:</td>
                    <td><span id="Warna"></span></td>
                  </tr>
                  <tr>
                    <td>VOLUME SILINDER</td>
                    <td>:</td>
                    <td><span id="VolSilinder"></span></td>
                  </tr>
                  <tr>
                    <td>NAMA PEMILIK</td>
                    <td>:</td>
                    <td><span id="Pemilik"></span></td>
                  </tr>
                  <tr>
                    <td>NOMO IDENTITAS</td>
                    <td>:</td>
                    <td><span id="NoIdentitas"></span></td>
                  </tr>
                  <tr>
                    <td>ALAMAT</td>
                    <td>:</td>
                    <td><span id="Alamat"></span></td>
                  </tr>
                  <tr>
                    <td>PEMOHON</td>
                    <td>:</td>
                    <td><span id="Pemohon"></span></td>
                  </tr>
                  <tr>
                    <td>TANGGAL DAFTAR</td>
                    <td>:</td>
                    <td><span id="TglDaftar"></span></td>
                  </tr>
                  <tr>
                    <td>TANGGAL ENTRY</td>
                    <td>:</td>
                    <td><span id="TglEntri"></span></td>
                  </tr>
                  <tr>
                    <td>TANGGAL VERIFIKASI</td>
                    <td>:</td>
                    <td><span id="TglVerifikasi"></span></td>
                  </tr>
                  <tr>
                    <td>TANGGAL CETAK KARTU INDUK</td>
                    <td>:</td>
                    <td><span id="TglCetakKartuInduk"></span></td>
                  </tr>
                  <tr>
                    <td>TANGGAL CETAK BPKB</td>
                    <td>:</td>
                    <td><span id="TglCetakBpkb"></span></td>
                  </tr>
                  <tr>
                    <td>TANGGAL PENYERAHAN</td>
                    <td>:</td>
                    <td><span id="TglPenyerahan"></span></td>
                  </tr>
              </table>
              
              </div>
            </div>
        </div>
</div>

</div>







<?php $this->load->view($controller."_view_js") ?>
