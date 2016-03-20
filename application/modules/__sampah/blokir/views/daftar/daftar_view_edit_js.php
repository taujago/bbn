<script>


	$(document).ready(function(){
		
		$("#vDAFT_DATE").datepicker();
		$("#vTGL_BPKB").datepicker();
		
		 
		/// form daftar 
		
		$("#frm_daftar").submit(function(){
			console.log('hallo..');
			
			$.ajax({
				url : '<?php echo site_url("$controller/daftar_update"); ?>',
				dataType:'json',
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					if(obj.error ==false){
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#message2").html(obj.message);
						$("#salah").hide();
						$("#benar").show();
						
						//nonactif();
						 
						
					}
					else {
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#message").html(obj.message);
						$("#salah").show();
						$("#benar").hide();
						
						
					}
				}
			});
			
			return false;
		});
	
	
	

		
		
	});
	
function actif(){
	$(".form-control").prop("disabled", false);	
	$("#tombol").prop("disabled", false);
	$("#vNO_BPKB_SEARCH").prop("disabled", false);
}
function nonactif(){
	$(".form-control").prop("disabled", true);	
	$("#tombol").prop("disabled", true);
	$("#vNO_BPKB_SEARCH").prop("disabled", false);
}
</script>