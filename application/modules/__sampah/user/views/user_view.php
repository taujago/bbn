<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
	$("#leasing").dataTable();
});
</script>

<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a><br><br>

<table   id="leasing" class="display" cellspacing="0" width="100%">
<thead>
	<tr style="background-color:#CCC">
        <th width="7%">ID</th>
        <th width="16%">Username</th>
        <th width="16%">Alamat</th>
        <th width="20%">POLDA </th>
        <th width="11%">&nbsp;</th>
    </tr>
	
</thead>

<tbody>
<?php 
 foreach($data->result_array() as $row): 
?>	
<tr>
	  <td><?php echo $row['user_id']; ?></td>
	  <td><?php echo $row['user_name']; ?></td>
	  <td><?php echo $row['user_alamat']; ?></td>
	  <td><?php echo $row['nama_polda']; ?></td>
	  <td><a href="<?php echo site_url("$controller/edit/".$row['user_id']); ?>" class="btn btn-xs btn-primary">Edit</a> 
      <a href="#" class="btn btn-xs btn-danger" onClick="return hapus('<?php echo $row['user_id'] ?>')">Hapus</a></td>
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
					if(obj.error==false) { 
					alert(obj.message);
					location.href=('<?php echo site_url("$controller"); ?>');
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