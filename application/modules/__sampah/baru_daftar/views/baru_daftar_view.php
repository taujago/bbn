<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

 
<style>

.green {
color:green;
 }
.red {
	color:red;
 	
}
</style>

<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">
<i class="glyphicon glyphicon-plus"></i>
Tambah Baru </a>

 
<a href="<?php echo site_url("baru_import"); ?>" class="btn btn-primary">
<i class="glyphicon glyphicon-import"></i>
Import </a>
 
<br><br>



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
                         
                        <input type="text" class="form-control" 
                        id="tanggal_awal" placeholder="Tangal Awal" 
                        data-date-format="dd-mm-yyyy" 
                        name="tanggal_awal">
                      </div>
                      <div class="form-group">
                         
                        <input type="text" class="form-control" 
                        id="tanggal_akhir" placeholder="Tanggal Akhir"
                        data-date-format="dd-mm-yyyy"
                        name="tanggal_akhir">
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

                      <button id="btn_cari" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Query </button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
              </form>
                
                
                
            </div>
        </div>
</div>

</div>
<table id="leasing" class="display" cellspacing="0" width="100%">
<thead>
	<tr style="background-color:#CCC">
        <th width="5%">ID</th>
        <th width="12%">TGL. DAFTAR</th>
        <th width="19%">NO. SURAT</th>
        <th width="18%">KANTOR CABANG</th>  
        <th width="18%">NO. RANGKA</th>    
        
        <th width="25%">NAMA PEMOHON </th>
        <th width="10%">STATUS</th>
        <th width="11%">&nbsp;</th>
    </tr>
	
</thead>
<!-- 
<tbody>
<?php 
 foreach($data->result_array() as $row): 
 $warna = ($row['approved'] == 1) ? "green":"red";
?>	
<tr>
	  <td><?php echo $row['daft_id']; ?></td>
	  <td><?php echo flipdate($row['daft_date']); ?></td>
	  <td><?php echo $row['no_surat']; ?></td>
	  <td><?php echo $row['cabang_nama']; ?></td>
 	  <td><?php echo $row['no_rangka']; ?></td>
	  <td><?php echo $row['nama_pengajuan_leasing']; ?></td>
	  <td><?php echo $row['status2']."  / <span class='$warna'>".$row['approved2'].'</span>'; ?></td>
	  <td> 
    
    <div class="btn-group">
  <a class="btn dropdown-toggle btn-primary" data-toggle="dropdown" href="#">
    Proses
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
     <li><a onclick="return edit('<?php echo $row['daft_id'];  ?>')" href="#" >Edit</a></li>
     <li><a onclick="return hapus('<?php echo $row['daft_id'];  ?>')" href="#">Hapus</a></li>
     <li><a   href="<?php echo site_url("baru_verifikasi/detail/")."/".$row['daft_id'] ; ?>" >Detail</a></li>
     <li><a  onclick="cetak('<?php echo $row['daft_id']; ?>');" href="#" >Cetak</a></li>
  </ul>
</div>
    </td></tr>
 <?php endforeach; ?>
	 
</tbody>
 -->
</table>
<?php $this->load->view("baru_daftar_view_js") ?>
