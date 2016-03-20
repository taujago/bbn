<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
	$("#leasing").dataTable();
});
</script>

<a href="<?php echo site_url("$controller/daftar"); ?>" class="btn btn-success">Tambah Baru </a><br><br>

<table id="leasing" class="display" cellspacing="0" width="100%">
<thead>
	<tr style="background-color:#CCC">
        <th width="3%">ID</th>
        <th width="12%">TGL. DAFTAR</th>
        <th width="16%">NO. BPKB</th>
        <th width="18%">NO. MESIN</th>
        <th width="15%">NO. RANGKA</th>
        <th width="12%">NAMA</th>
        <th width="12%">ALAMAT</th>
        <th width="12%">&nbsp;</th>
    </tr>
	
</thead>

<tbody>
<?php 
 foreach($data as $row): 
?>	
<tr>
	  <td><?php echo $row['DAFT_ID']; ?></td>
	  <td><?php echo $row['DAFT_DATE']; ?></td>
	  <td><?php echo $row['NO_BPKB']; ?></td>
	  <td><?php echo $row['NO_MESIN']; ?></td>
	  <td><?php echo $row['NO_RANGKA']; ?></td>
	  <td><?php echo $row['NAMA_PEMILIK']; ?></td>
	  <td><?php echo $row['ALAMAT_PEMILIK']; ?></td>
	  <td><a href="<?php echo site_url("$controller/edit/".$row['DAFT_ID']); ?>" class="btn btn-xs btn-primary">Edit</a> 
      <a href="#" class="btn btn-xs btn-danger" onClick="return hapus('<?php echo $row['DAFT_ID'] ?>')">Hapus</a></td>
    </tr>
 <?php endforeach; ?>
	 
</tbody>

</table>

<script>

function hapus(id) {
	a = confirm('Yakin akan menghapus data ini ? ');
	if(a){
			$.ajax({
				url : '<?php echo site_url("$controller/hapus") ?>/'+id,
				dataType : 'json',
				success : function(obj) {
					if(obj.error=="false") { 
					alert(obj.message);
					location.href=('<?php echo site_url("leasing"); ?>');
					}
					else {
						alert(obj.message);
					}
				}
			});
	}
	else {
		return false;
	}
}
</script>