<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.loadJSON.js") ?>">
	
</script>

<script>


	$(document).ready(function(){

 


		
		$("#tanggal").datepicker().on('changeDate', function(ev){                 
   			 $('#tanggal').datepicker('hide');
		});
 		
		
	 
		 
		
		 
		
		
		/// form daftar 
		
		$("#frm_daftar").submit(function(){
			 
			//var post_data = $(this).serialize();
			//post_data.push({vIS_CARI : $("#vISCari").val()});
			$.ajax({
				
				//als.push({name: 'nameOfTextarea', value: CKEDITOR.instances.ta1.getData()});
				url : '<?php echo site_url("$controller/$method"); ?>',
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
	
	
	
<?php 
if($mode=="U") : 
?>

$.ajax({

	url:'<?php echo site_url("$controller/get_pendaftaran_detail/$daft_id") ?>',
	dataType : 'json',
	success : function(jsondata){
			$("#frm_daftar").loadJSON(jsondata);
	}

});


<?php 
endif;
?>
		
		
	});
	 
</script>