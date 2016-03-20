<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<script>


	$(document).ready(function(){
		
 
		$(".tanggal").datepicker().on('changeDate', function(ev){                 
   			 $('.tanggal').datepicker('hide');
		});
 		
		
		 
		 
		$("#frm_daftar").submit(function(){
			console.log('hallo..');
			$('#myPleaseWait').modal('show');
			//var post_data = $(this).serialize();
			//post_data.push({vIS_CARI : $("#vISCari").val()});
			$.ajax({
				
				//als.push({name: 'nameOfTextarea', value: CKEDITOR.instances.ta1.getData()});
				url : '<?php echo site_url("$controller/simpan_lama"); ?>',
				dataType:'json',
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					$('#myPleaseWait').modal('hide');
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
	
	
	

		
		
		
		///// cek data ke server 
		
		$("#frm_no_bpkb").submit(function(){
			 
			$('#myPleaseWait').modal('show');
			
			$.ajax({
				url : '<?php echo site_url("$controller/get_detail_kendaraan"); ?>',
				dataType:'json',
				beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},
				complete : function(){
					//$("#benar").hide();
				},
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					$('#myPleaseWait').modal('hide');
					 if(obj.error==true){
							$("#benar").hide('fast');
						 	$("#salah").show('fast');
							$("#message").html(obj.message);
							// $("#tabel-bpkb tbody").hide();
							// dt.fnClearTable();
					 }
					 else {
							// $("#leasing tbody").show();
						 	$("#salah").hide('fast');
						 	$("#benar").show('fast');
						 	$("#message2").html("DATA DITEMUKAN");
							$("#frm_daftar").loadJSON(obj.message);
							// dt.fnClearTable();
						 //    dt.fnAddData(obj.message);
						 //   	dt.fnDraw(); 		 
						}
				}
			});
			
			return false;
		});
		
		
		
	});
	 
</script>