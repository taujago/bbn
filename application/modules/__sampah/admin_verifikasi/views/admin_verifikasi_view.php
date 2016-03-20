<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

<style>

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
<div class="col-md-9">
		<div class="panel panel-default">
            <div class="panel-heading">PENCARIAN</div>
            <div class="panel-body">
            
            	
                <form class="form-inline" id="fuckyouform">
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_awal" placeholder="Tangal Awal" 
                        data-date-format="dd-mm-yyyy" value="<?php echo $tanggal_awal ?>" 
                        name="tanggal_awal" style="width:100px">
                      </div>
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_akhir" placeholder="Tanggal Akhir"
                        data-date-format="dd-mm-yyyy" style="width:100px"
                        name="tanggal_akhir" value="<?php echo $tanggal_akhir ?>" >
                      </div>
                      
                      <div class="form-group">
                         
                        <input type="text" class="form-control" style="width:200px"
                        id="no_rangka" placeholder="NOMOR RANGKA / BPKB"
                        name="no_rangka">
                      </div>
                      <div class="form-group">
                       <?php 
					   	$arr_status = $this->cm->arr_status;
						echo form_dropdown('',$arr_status,'','id="arr_status" class="form-control"');
					   ?>
                      </div>
                     
               <!--       <button id="btn_cari" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Query </button>-->
                      <a href="#"  id="btn_cari"   class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</a>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
              </form>
                
                
                
            </div>
        </div>
</div>


<?php 
$userdata = $this->session->userdata("userdata");
if($userdata['user_level'] == 3) : 
?>
<div class="col-md-3">
    <div class="panel panel-default">
            <div class="panel-heading">VERIFIKASI</div>
            <div class="panel-body">
            
              
               <a href="#" onclick='verifikasi_all();' class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> VERIVIKASI</a>
              <a href="#" onclick="validasi_all();" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> VALIDASI</a>
           
                
                
                
            </div>
        </div>
</div>

<?php 
endif;
?>
</div>

<form id="frm_validasi" method="post" target="<?php echo site_url("$controller/verifikasi_all") ?>">

 <table  width="100%" border="0" id="leasing" class="table table-striped 
             table-bordered table-hover dataTable no-footer" role="grid">
<thead>
	<tr style="background-color:#CCC">

        <th width="4%"><input type="checkbox" name="checkbox" id="selall" /> </th>
        <th width="4%">ID</th>
        <th width="7%">TGL. DAFT.</th>
        <th width="16%">NO. SURAT</th>
        <th width="15%">CABANG</th>  
      <th width="15%">NO. RANGKA/BPKB</th>    
        
      <th width="19%">NAMA PEMOHON </th>
        <th width="14%">STATUS</th>
      <th width="10%">PROSES</th>
    </tr>
	
</thead>
</table>
</form>







<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="modal-dialog" class="modal-dialog modal-vertical-centered" style="width:60%; min-height:600px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              VERIFIKASI PENDAFTARAN KENDARAAN
            </h4>
         </div>
         <div class="modal-body">
            <!-- Add some text here --> 
            <table width="100%">
           	  <tr>
            	<td width="50%" align="right">NOMOR SURAT </td><TD width="2%">:</TD>
           	  <TD width="48%"><span id="NO_SURAT"></span></TD> 
           	  </tr>
            	<tr><td align="right" >TANGGAL DAFTAR </td>
           	  <TD>:</TD><TD><span id="DAFT_DATE"></span></TD></tr>
            	<tr><td align="right" >STATUS PENDAFTARAN </td>
           	  <TD>:</TD><TD><span id="STATUS"></span></TD></tr>
            	<tr><td align="right">NOMOR RANGKA </td>
           	  <TD>:</TD><TD><span id="NO_RANGKA"></span></TD></tr>
                <tr><td align="right">NOMOR MESIN </td>
              <TD>:</TD><TD><span id="NO_MESIN"></span></TD></tr>
                <tr><td align="right">TAHUN KENDARAAN </td>
              <TD>:</TD><TD><span id="TAHUN_KENDARAAN"></span></TD></tr>
                <tr><td align="right">JENIS KENDARAAAN </td>
              <TD>:</TD><TD><span id="JENIS_NAMA"></span></TD></tr>
                <tr><td align="right">MERK </td>
              <TD>:</TD><TD><span id="MERK_NAMA"></span></TD></tr>
                <tr><td align="right">WARNA </td>
              <TD>:</TD><TD><span id="WARNA_NAMA"></span></TD></tr>
            	<tr><td align="right">NAMA PEMOHON</td>
           	  <TD>:</TD><TD><span id="NAMA_PENGAJUAN_LEASING"></span></TD></tr>
                <tr><td align="right">ALAMAT PEMOHON</td>
              <TD>:</TD><TD><span id="ALAMAT_PENGAJUAN_LEASING"></span></TD></tr>
            	
            	 
            </table>
        <br />
            <center>
            <a id="batal" onclick="batal()" href="#" class="btn btn-md btn-danger">BATAL VERIFIKASI </a> 
            <a id="oke" onclick="verifikasi()" href="#"  class="btn btn-md btn-primary">VERIFIKASI LEVEL 2</a>
            <a id="oke3" onclick="verifikasi3()" href="#"  class="btn btn-md btn-primary">VERIFIKASI LEVEL 3</a>
           
            </center>
             
            
            
            
         </div> <!-- end of modal body  --> 
         <!--<div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">Close
            </button>
            <button type="button" class="btn btn-primary">
               Submit changes
            </button>
         </div>-->
      </div><!-- /.modal-content -->
</div><!-- /.modal -->




<?php $this->load->view("admin_verifikasi_view_js") ?>
