
<script>
$(document).ready(function(){
	// var dt = $("#leasing").dataTable(
	// 	{
	// 		"order": [[ 0, "desc" ]],
	// 	 	"iDisplayLength": 50

	// 	});

	 var dt = $("#leasing").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "ajax": '<?php echo site_url("baru_daftar/get_data") ?>'
		 	});


	$("#tanggal_awal").datepicker();
	$("#tanggal_akhir").datepicker();	


	$("#btn_cari").click(function(){
				//alert('oooo.. somebody click me');
				 var i = 5;
				 var v =$("#no_rangka").val();
				 var tanggal_awal = $("#tanggal_awal").val();
				 var tanggal_akhir = $("#tanggal_akhir").val();
				 
			
				 console.log(i);
				 console.log(v);
				 var status = $("#arr_status").val();

				 dt.columns(i).search(v)
				 .column(4).search(tanggal_awal)
				 .column(6).search(tanggal_akhir)
				 .column(7).search(status)
				 .draw();
			});



	/*
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
							$("#benar").hide('slow');
						 	$("#salah").show('slow');
							$("#message").html(obj.message);
							$("#tabel-bpkb tbody").hide();
							dt.fnClearTable();
					 }
					 else {
							$("#leasing tbody").show();
						 	$("#salah").hide('slow');
							// $("#benar").show('slow');
							// $("#message2").html('DATA DITEMUKAN');
							dt.fnClearTable();
						    dt.fnAddData(obj.message);
						   	dt.fnDraw(); 		 
						}
				}
			});
			
			return false;
		}); */


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

function cetak(daft_id){

	$.ajax({
		url : '<?php echo site_url("baru_verifikasi/cek_status") ?>/'+daft_id,
		dataType:'json',
		success : function (hasil) {
			if(hasil.error == true) {
				alert('Dokumen tidak dapat dicetak');
			}
			else {
				var newWin = window.open('<?php echo site_url("baru_verifikasi/cetak_berkas/"); ?>/'+daft_id);
				newWin.location = href;
				
			}
		}
	});

	
}


function reset_cari(){
	$("#no_rangka").val('');
	$("#tanggal_awal").val('');
	$("#tanggal_akhir").val('');
	$("#arr_status").val('0').attr('selected','selected');
	$("#btn_cari").click(); 
}


</script>