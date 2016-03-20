<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.loadJSON.js") ?>">
	
</script>

<script>


	$(document).ready(function(){

 $(".tr_polsek").hide(); 


		
		$(".tanggal").datepicker().on('changeDate', function(ev){                 
   			 $('.tanggal').datepicker('hide');
		});
 		
	
	$("#jenis").change(function(){
		if($(this).val() == "polres") {
			$(".tr_polsek").hide(); 

		}
		else {
			$(".tr_polsek").show(); 
		}
	});

		


	

	$("#fuckyouform").submit(function(){
			$('#myPleaseWait').modal('show'); 
			//var post_data = $(this).serialize();
			//post_data.push({vIS_CARI : $("#vISCari").val()});
			$.ajax({
				
				//als.push({name: 'nameOfTextarea', value: CKEDITOR.instances.ta1.getData()});
				url : '<?php echo site_url("$controller/get_kendaraan_detail"); ?>',
				dataType:'json',
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					console.log(obj);
					$('#myPleaseWait').modal('hide');
					if(obj.error == false){
						//$("html, body").animate({ scrollTop: 0 }, "slow");
						console.log('berhasil..');
						
						$("#no_rangka2").val(obj.message.NoRangka);
						$("#no_mesin").val(obj.message.NoMesin);
						$("#merk").val(obj.message.Merk);
						$("#warna").val(obj.message.Warna);
						$("#pemilik_nama").val(obj.message.Pemilik);
						$("#pemilik_alamat").val(obj.message.Alamat);
						$("#tahun_pembuatan").val(obj.message.ThnBuat);
						
						// $("#message2").html(obj.message);
						// $("#salah").hide();
						// $("#benar").show();			
						 
						// $("#frm_daftar")[0].reset();				 

						
					}
					else {
						// $("html, body").animate({ scrollTop: 0 }, "slow");
						// $("#message").html(obj.message);
						// $("#salah").show();
						// $("#benar").hide();
						
						
					}
				}
			});
			
			return false;
		});

		 
		
		 
		
		
		/// form daftar 
		
		$("#frm_daftar").submit(function(){
			$('#myPleaseWait').modal('show'); 
			//var post_data = $(this).serialize();
			//post_data.push({vIS_CARI : $("#vISCari").val()});
			$.ajax({
				
				//als.push({name: 'nameOfTextarea', value: CKEDITOR.instances.ta1.getData()});
				url : '<?php echo site_url("$controller/$method"); ?>',
				dataType:'json',
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					$('#myPleaseWait').modal('hide');
					if(obj.error == false){

						 BootstrapDialog.alert({
		                      type: BootstrapDialog.TYPE_PRIMARY,
		                      title: 'Informasi',
		                       hotkey: 13,
		                      message: obj.message,
		                       
		                  });     

						$("html, body").animate({ scrollTop: 0 }, "slow");
						// $("#message2").html(obj.message);
						// $("#salah").hide();
						// $("#benar").show();			
						 
						$("#frm_daftar")[0].reset();				 

						
					}
					else {

						BootstrapDialog.alert({
		                      type: BootstrapDialog.TYPE_DANGER,
		                      title: 'ERROR',
		                       hotkey: 13,
		                      message: obj.message,
		                       
		                  });     

						$("html, body").animate({ scrollTop: 0 }, "slow");
						// $("#message").html(obj.message);
						// $("#salah").show();
						// $("#benar").hide();
						
						
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

			$("#jenis").val(jsondata.jenis).attr('selected');

			if(jsondata.jenis=="polsek"){
				$(".tr_polsek").show();
			}
			else {
				$(".tr_polsek").hide();
			}
	}

});


<?php 
endif;
?>
		
		
	});
	 
</script>