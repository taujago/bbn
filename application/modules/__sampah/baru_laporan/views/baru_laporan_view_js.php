
<script>
$(document).ready(function(){
	var dt = $("#leasing").dataTable({
		"scrollX": true
	});
	$("#tanggal_awal").datepicker();
	$("#tanggal_akhir").datepicker();	
	$("#fuckyouform").submit(function(){
	 


			
			$.ajax({
				url : '<?php echo site_url("$controller/get_list_daftar"); ?>',
				dataType:'json',
				beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},
				complete : function(){
					$("#benar").hide();
				},
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					 if(obj.error==true){
							$("#benar").hide('fast');
						 	$("#salah").show('fast');
							$("#message").html(obj.message);
							$("#tabel-bpkb tbody").hide();
							dt.fnClearTable();
					 }
					 else {
							$("#leasing tbody").show();
						 	$("#salah").hide('fast');
							
							dt.fnClearTable();
						    dt.fnAddData(obj.message);
						   	dt.fnDraw(); 		 
						}
				}
			});
			
			return false;
		});


});




function edit(id){
	$.ajax({
		url : '<?php echo site_url("$controller/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(obj) {
			console.log(obj.verifikasi_by);
			
			if(obj.status != "0" ) {
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
			if(obj.status != "0") {
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
						location.href=('<?php echo site_url("baru_daftar"); ?>');
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

function cetak(){

	data = $("#fuckyouform").serialize();
	var newWin = window.open('<?php echo site_url("$controller/cetak"); ?>/?'+data);
	newWin.location = href;
	 	
}


function excel(){

	data = $("#fuckyouform").serialize();
	var newWin = window.open('<?php echo site_url("$controller/excel"); ?>/?'+data);
	newWin.location = href;
	 	
}



function reset_cari(){
	$("#id_polda").val('x').attr('selected','selected');
	$("#tanggal_awal").val('');
	$("#tanggal_akhir").val('');
	$("#jenis_permohonan").val('x').attr('selected','selected');
	$("#fuckyouform").submit();
}

</script>