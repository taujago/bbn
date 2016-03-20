<script>


	$(document).ready(function(){
		
		var dt = $('#tabel-bpkb').dataTable();
		 
		$("#vTGL_DAFTAR1").datepicker();
		$("#vTGL_DAFTAR2").datepicker();
	 
		 
		
		
		$("#frm_cek, #frm_bpkb").submit(function(){
			 
			
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
					 }
					 else {
							$("#tabel-bpkb tbody").show();
						 	$("#salah").hide('fast');
							
							dt.fnClearTable();
						    dt.fnAddData(obj.message);
						   	dt.fnDraw(); 		 
						}
				}
			});
			
			return false;
		});
		
		
		 
$("#frm_blokir").submit(function(){	



	$.ajax({
		url : '<?php echo site_url("$controller/simpan_blokir"); ?>',
		type : 'post',
		dataType : 'json',
		data : { DAFT_ID : $("#DAFT_ID").val() },
		success : function(obj) {
			if(obj.error==false){
				$("#benar_modal").show();
				$("#salah_modal").hide();
				$("#benar_message").html(obj.message);

				 $('#myModal').animate({
			        scrollTop: $("#benar_modal").offset().top
			      }, 500);
			}
			else {
				$("#benar_modal").hide();
				$("#salah_modal").show();
				$("#salah_message").html(obj.message);

				$('#myModal').animate({
			        scrollTop: $("#salah_modal").offset().top
			      }, 500);
			}
		}
	});
	return false;
});	

 
		
		
});
	
	
function detail(id)
{

	$("#salah_modal").hide();
	$("#benar_modal").hide();
	$("#dvblokir").hide();

	$.ajax({
		url : '<?php echo site_url("$controller/get_detail_pendaftaran"); ?>/'+id,
		type : 'post',
		dataType :'json',
		//data : { v_is_cari : "2", v_cari : id },
		success: function(obj){
			console.log(obj);	

			$("#myModal").modal('show');
			$("#panel_detail").show('fast');
			$("#NO_BPKB").html(obj.NO_BPKB);		
			$("#TGL_BPKB").html(obj.TGL_BPKB2);	
			$("#DAFT_DATE").html(obj.DAFT_DATE);	
			$("#NO_RANGKA").html(obj.NO_RANGKA);	 
			$("#VERIFIKASI_DATE").html(obj.VERIFIKASI_DATE2);	
			$("#NO_MESIN").html(obj.NO_MESIN);	
			$("#VERIFIKASI_KET").html(obj.VERIFIKASI_KET);	
			$("#NAMA_PEMILIK").html(obj.NAMA_PEMILIK);	
			$("#DAFT_LEVEL2_DATE").html(obj.DAFT_LEVEL2_DATE2);	
			$("#ALAMAT_PEMILIK").html(obj.ALAMAT_PEMILIK);	
			$("#DAFT_LEVEL3_DATE").html(obj.DAFT_LEVEL3_DATE3);
			//$("#DAFT_LEVEL3_DATE").html(obj.DAFT_LEVEL3_DATE32);	
			$("#DAFT_ID").val(obj.DAFT_ID);	
			$("#DAFT_ID2").val(obj.DAFT_ID);	
			$("#LEVEL2_TGLSURAT").val(obj.LEVEL2_TGLSURAT2);
			$("#LEVEL2_NOSURAT").val(obj.LEVEL2_NOSURAT);


			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	
			// $("#NO_BPKB").html(obj.NO_BPKB);	

		}
	});
	
	
	 
}	
	



 

function blokir(){
	
 	a = confirm('Apakan anda yakin akan melepas blokir ? ');
 	if(a){
 			$.ajax({
				url : '<?php echo site_url("$controller/simpan_blokir"); ?>',
				type : 'post',
				dataType : 'json',
				data : { DAFT_ID : $("#DAFT_ID").val() },
				success : function(obj) {
					if(obj.error==false){
						$("#benar_modal").show();
						$("#salah_modal").hide();
						$("#benar_message").html(obj.message);

						 $('#myModal').animate({
					        scrollTop: $("#benar_modal").offset().top
					      }, 500);
					}
					else {
						$("#benar_modal").hide();
						$("#salah_modal").show();
						$("#salah_message").html(obj.message);

						$('#myModal').animate({
					        scrollTop: $("#salah_modal").offset().top
					      }, 500);
					}
				}
			});
 	}

}
 

</script>