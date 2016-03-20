<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
	$("#leasing").dataTable();
});
</script>

<a href="<?php echo site_url("$controller/baru"); ?>" class="btn btn-success">Tambah Baru </a><br><br>

<table id="leasing" class="display" cellspacing="0" width="100%">
<thead>
	<tr style="background-color:#CCC">
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Telpon</th>
        <th>Fax</th>
        <th>Kota</th>
        <th>&nbsp;</th>
    </tr>
	
</thead>

<tbody>
<?php 
 foreach($record->result_array() as $row): 
?>	
<tr>
	  <td><?php echo $row['leasing_id']; ?></td>
	  <td><?php echo $row['leasing_nama']; ?></td>
	  <td><?php echo $row['leasing_alamat']; ?></td>
	  <td><?php echo $row['leasing_telp']; ?></td>
	  <td><?php echo $row['leasing_kota']; ?></td>
	  <td><?php echo $row['leasing_fax']; ?></td>
	  <td><a href="<?php echo site_url("$controller/edit/".$row['leasing_id']); ?>" class="btn btn-xs btn-primary">Edit</a> 
      <a href="#" class="btn btn-xs btn-danger" onClick="return hapus('<?php echo $row['leasing_id'] ?>')">Hapus</a></td>
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