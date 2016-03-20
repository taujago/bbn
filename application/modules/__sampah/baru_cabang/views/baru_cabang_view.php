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

<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a><br><br>



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

<!--<div class="row">
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
                     
                      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Query </button>
                      <a href="#" onclick="reset_cari();" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset Query</a>
              </form>
                
                
                
            </div>
        </div>
</div>

</div>-->
<table id="leasing" class="display" cellspacing="0" width="100%">
<thead>
	<tr style="background-color:#CCC">
        <th width="5%">ID</th>
        <th width="12%">NAMA KANTOR CABAG</th>
        <th width="19%">ALAMAT</th>  
        <th width="18%">NO. TELPON</th>    
        
        <th width="11%">&nbsp;</th>
    </tr>
	
</thead>

<tbody>
<?php 
$no= 0;
 foreach($data->result() as $row): 
 $no++;
 ?>	
<tr>
	  <td><?php echo $no; ?></td>
	  <td><?php echo $row->cabang_nama; ?></td>
	  <td><?php echo $row->cabang_alamat; ?></td>
 	  <td><?php echo $row->cabang_telpon; ?></td>
	  <td> 
	    
	    <a class="btn btn-sm btn-success"  href="<?php echo site_url("$controller/edit/$row->cabang_id"); ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
        <a onclick="return confirm('Yakin akan dihapus ? ');" class="btn btn-sm btn-danger"  href="<?php echo site_url("$controller/hapus/$row->cabang_id"); ?>"><i class="glyphicon glyphicon-remove"></i>Hapus</a>
    </td></tr>
 <?php endforeach; ?>
	 
</tbody>

</table>
<?php $this->load->view("baru_cabang_view_js") ?>
