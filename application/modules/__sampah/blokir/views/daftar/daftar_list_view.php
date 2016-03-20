<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
	$("#leasing").dataTable();
});
</script>

<style>
.dropdown-menu {
	width:50px;
}
</style>

<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a><br><br>

<table id="leasing" class="display" cellspacing="0" width="100%">
<thead>
	<tr style="background-color:#CCC">
        <th width="5%">ID</th>
        <th width="14%">TGL. DAFTAR</th>
        <th width="15%">NO. BPKB</th>
        <th width="17%">NO. MESIN</th>
        <th width="19%">NO. RANGKA</th>
        <th width="16%">NAMA</th>
        <th width="14%">&nbsp;</th>
    </tr>
	
</thead>

<tbody>
<?php 
 foreach($data->result_array() as $row): 
?>	
<tr>
	  <td><?php echo $row['DAFT_ID']; ?></td>
	  <td><?php echo $row['DAFT_DATE']; ?></td>
	  <td><?php echo $row['NO_BPKB']; ?></td>
	  <td><?php echo $row['NO_MESIN']; ?></td>
	  <td><?php echo $row['NO_RANGKA']; ?></td>
	  <td><?php echo $row['NAMA_PEMILIK']; ?></td>
	  <td><!--<a onclick="return edit('<?php echo $row['DAFT_ID'];  ?>')" href="#" class="btn btn-xs btn-primary">Edit</a>
	    <a onclick="return hapus('<?php echo $row['DAFT_ID'];  ?>')" href="#" class="btn btn-xs btn-danger">Hapus</a>
	    
    <a target="_blank" href="<?php echo site_url("$controller/cetak_berkas/".$row['DAFT_ID']); ?>" class="btn btn-xs btn-default">Cetak</a>-->
    
    <div class="btn-group">
  <a class="btn dropdown-toggle btn-primary" data-toggle="dropdown" href="#">
    Proses
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
     <li><a onclick="return edit('<?php echo $row['DAFT_ID'];  ?>')" href="#" >Edit</a></li>
     <li><a onclick="return hapus('<?php echo $row['DAFT_ID'];  ?>')" href="#">Hapus</a></li>
     <li><a target="_blank" href="<?php echo site_url("$controller/cetak_berkas/".$row['DAFT_ID']); ?>" >Cetak</a></li>
  </ul>
</div>
    </td></tr>
 <?php endforeach; ?>
	 
</tbody>

</table>

<script>

function edit(id){
	$.ajax({
		url : '<?php echo site_url("$controller/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(obj) {
			console.log(obj.VERIFIKASI_BY);
			
			if(obj.VERIFIKASI_BY != null) {
				alert('record sudah diverifikasi. tidak dapat diedit');
				return false;
			}
			else {
				location.href=('<?php echo site_url("$controller/edit/");?>/'+id);
			}
		}
			
	});
	 
}



function hapus(id) {
	a = confirm('Yakin akan menghapus data ini ? ');
	if(a){
		
		
			$.ajax({
		url : '<?php echo site_url("$controller/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(obj) {
			 
			console.log(obj.VERIFIKASI_BY);
			if(obj.VERIFIKASI_BY != null) {
				alert('record sudah diverifikasi. tidak dapat dihapus');
				return false;
			}
			else {
				 
				// return false;
					 $.ajax({
					url : '<?php echo site_url("$controller/hapus") ?>/'+id,
					dataType : 'json',
					success : function(obj) {
						if(obj.error==false) { 
						alert(obj.message);
						location.href=('<?php echo site_url("blokir/pendaftaran_list"); ?>');
						}
						else {
							alert(obj.message);
						}
					}
				});
				 
				 
			}
		}
			
	});
	 
			
		///// 	
			
		////// 
	}
	else {
		return false;
	}
}
</script>