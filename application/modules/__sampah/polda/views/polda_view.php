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
     	<th width="5%">ID</th>
        <th width="9%">No. Urut</th>
        <th width="24%">Nama Polda</th>
        <th width="24%">Singkatan</th>
        <th width="17%">Alamat</th>
        <th width="10%">Kota</th>
        <th width="11%">Proses</th>
        
    </tr>
	
</thead>

<tbody>
<?php 
 foreach($record->result_array() as $row): 
?>	
<tr>
	  <td><?php echo $row['id_polda']; ?></td>
	  <td><?php echo $row['no_urut']; ?></td>
	  <td><?php echo $row['nama_polda']; ?></td>
	  <td><?php echo $row['nama_polda_singkatan']; ?></td>
      <td><?php echo $row['alamat_polda']; ?></td>
	  <td><?php echo $row['kota_polda']; ?></td>
 	  <td><a href="<?php echo site_url("$controller/edit/".$row['id_polda']); ?>" class="btn btn-xs btn-primary">Edit</a> 
      <a href="#" class="btn btn-xs btn-danger" onClick="return hapus('<?php echo $row['id_polda'] ?>')">Hapus</a></td>
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