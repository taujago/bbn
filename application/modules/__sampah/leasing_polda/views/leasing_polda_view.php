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
     	<th width="5%">NO.</th>
        
        <th width="23%">Leasing</th>
        <th width="21%">Polda</th>
        <th width="13%">User</th>
        <th width="17%">Password</th>
        <th width="9%">Hash </th>
        <th width="12%">Proses</th>
        
    </tr>
	
</thead>

<tbody>

<?php 
$n=0;
 foreach($record->result_array() as $row): 
 $n++;
?>	
<tr>
	  <td><?php echo $n; ?></td>
	  
	  <td><?php echo $row['leasing_nama']; ?></td><td><?php echo $row['nama_polda']; ?></td>
	  <td><?php echo $row['service_user']; ?></td>
      <td><?php echo $row['service_pass']; ?></td>
	  <td><?php echo $row['service_salt']; ?></td>
 	  <td><a href="<?php echo site_url("$controller/edit/".$row['id_polda']."/".$row['leasing_id']); ?>" class="btn btn-xs btn-primary">Edit</a> 
      <a href="#" class="btn btn-xs btn-danger" onClick="return hapus('<?php echo $row['id_polda'] ?>','<?php echo $row['leasing_id'] ?>')">Hapus</a></td>
    </tr>
 <?php endforeach; ?>
	 
</tbody>

</table>

<script>

function hapus(id_polda,leasing_id) {
	a = confirm('Yakin akan menghapus data ini ? ');
	if(a){
			$.ajax({
				url : '<?php echo site_url("$controller/hapus") ?>/',
				dataType : 'json',
				type : 'post',
				data : { id_polda : id_polda, leasing_id : leasing_id } ,
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