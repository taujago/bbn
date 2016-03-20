<script>


	$(document).ready(function(){
		
		 	
		
		 
		 
		
		 
		
		
		/// form daftar 
		
		$("#frm_daftar").submit(function(){
			console.log('hallo..');
			//var post_data = $(this).serialize();
			//post_data.push({vIS_CARI : $("#vISCari").val()});
			$.ajax({
				
				//als.push({name: 'nameOfTextarea', value: CKEDITOR.instances.ta1.getData()});
				url : '<?php echo site_url("$controller/simpan"); ?>',
				dataType:'json',
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					if(obj.error == false){
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#message2").html(obj.message);
						$("#salah").hide();
						$("#benar").show();			
						 
						$("#frm_daftar")[0].reset();				 

						
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
	 
</script>