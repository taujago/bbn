<script>


	$(document).ready(function(){		
		
		//$("#frm_daftar .form-control").attr('readonly','readonly'); 
		$("#tombol").prop("disabled", true);	
		 
		
		$("#frm_cek").submit(function(){
			
			$.ajax({
				url : '<?php echo site_url("$controller/inq_lepas_daft"); ?>',
				dataType:'json',
				type : 'post',
				data : $(this).serialize(),
				beforeSend : function() {
					$("#benar").show('fast');
					$("#salah").hide();
					$("#message2").html("Sedang diproses.Mohon menunggu.... ");
				},
				complete : function(){
					$("#benar").hide('fast');
				},
				success : function(obj) {
					 
					if(obj.error==false) {
						//$("#frm_daftar .form-control").removeAttr('readonly'); 
						console.log(obj.message);
						$("#frm_daftar").loadJSON(obj.message);
						//$("#frm_daftar .form-control").attr('readonly','readonly'); 
						if(obj.message.STATUS=="TERDAFTAR") {
							$("#tombol").prop("disabled", false);
						}
						else {
							$("#message").html(obj.message.STATUS);
							$("#salah").show();
							$("#tombol").prop("disabled", true);
						}
						
					}
					else {
							
							$("#tombol").prop("disabled", true);
							$("#message").html(obj.message);
							$("#salah").show();
							$("#benar").hide();
							$("#frm_daftar .form-control").val('');
							
					}
						
					 
				}
			});
			
			return false;
			 
			
		});
		
		
		/// form daftar 
		
		$("#frm_daftar").submit(function(){
			 a = confirm("Apakah anda yakin akan melepas blokir ? ");
			if(a) { 
			
			//var dform = $(this).serialize();
			//dform.push({IS_CARI : $("#vIS_CARI").val()  });

			$.ajax({
				url : '<?php echo site_url("$controller/lepas_blokir"); ?>/'+$("#vIS_CARI").val(),
				dataType:'json',
				type : 'post',
				data : $(this).serialize(),
				
				success : function(obj) {
					if(obj.error ==false){
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#message2").html(obj.message);
						$("#salah").hide();
						$("#benar").show();
						$("#tombol").prop("disabled", true);	
					}
					else {
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#message").html(obj.message);
						$("#salah").show();
						$("#benar").hide();
						$("#tombol").prop("disabled", true);	
						
						
					}
				}
			});
			
			return false;
			}
			else {
				return false;
			}
		});
	
	
	

		
		
	});
/*	
function actif(){
	$(".form-control").prop("disabled", false);	
	$("#tombol").prop("disabled", false);
	$("#vNO_BPKB_SEARCH").prop("disabled", false);
}
function nonactif(){
	$(".form-control").prop("disabled", true);	
	$("#tombol").prop("disabled", true);
	$("#vNO_BPKB_SEARCH").prop("disabled", false);
}*/
</script>