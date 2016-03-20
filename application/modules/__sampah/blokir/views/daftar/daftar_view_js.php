<script>


	$(document).ready(function(){
		
		$("#vDAFT_DATE").datepicker();
		$("#vTGL_BPKB").datepicker();
		
		
		$(".form-control").prop("disabled", true);
		$("#tombol").prop("disabled", true);
		
		$("#vCari").prop("disabled", false);
		$("#vISCari").prop("disabled", false);
		
		$("#frm_cek").submit(function(){
			console.log('hallo..');
			
			$.ajax({
				url : '<?php echo site_url("$controller/cekdata"); ?>',
				dataType:'json',
				type : 'post',
				beforeSend : function(){
						$("#message2").html('Sedang diproses. harap menunggu');
						$("#salah").hide();
						$("#benar").show();

				},				 
				data : $(this).serialize(),
				success : function(obj) {
				 
				 $("#benar").hide();
				 
				 console.log(obj.STATUS);

				 if(obj.STATUS == "TERSEDIA"){
						$("#message2").html('NOMOR BPKB TERSEDIA SIAP UNTUK DIBLOKIR');
						$("#salah").hide();
						$("#benar").show();
						
						
						/*$("#vNO_BPKB").val($("#vNO_BPKB_SEARCH").val());
						$("#vNO_BPKB").attr('readonly','readonly');*/
						
						if($("#vISCari").val() == "2") {  // bpkb 
							$("#vNO_RANGKA").val('');
							$("#vNO_RANGKA").removeAttr('readonly');
							$("#vNO_BPKB").attr('readonly','readonly');
							$("#vNO_BPKB").val( $("#vCari").val());
						}
						else { // nomor rangka 
							$("#vNO_BPKB").val('');
							$("#vNO_BPKB").removeAttr('readonly');
							$("#vNO_RANGKA").attr('readonly','readonly');
							$("#vNO_RANGKA").val( $("#vCari").val());
						}
						
						actif();
						
						
					}
					else if(obj.STATUS == "TIDAK TERSEDIA") {
						$("#message").html('<strong>'+obj.STATUS+'</strong><br /> Telah diblokir oleh '+obj.BLOKIR_OLEH);
						$("#salah").show();
						$("#benar").hide();
						$("#vNO_BPKB").val('');
						nonactif();
						$("#vCari").prop("disabled", false);
						$("#vISCari").prop("disabled", false);
					}
				 ///////
					
					
				}
			});
			
			return false;
		});
		
		
		/// form daftar 
		
		$("#frm_daftar").submit(function(){
			console.log('hallo..');
			//var post_data = $(this).serialize();
			//post_data.push({vIS_CARI : $("#vISCari").val()});
			$.ajax({
				
				//als.push({name: 'nameOfTextarea', value: CKEDITOR.instances.ta1.getData()});
				url : '<?php echo site_url("$controller/daftar_simpan"); ?>/'+$("#vISCari").val(),
				dataType:'json',
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					if(obj.error == false){
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#message2").html(obj.message);
						$("#salah").hide();
						$("#benar").show();
						
						nonactif();
						$("#frm_daftar")[0].reset();
						$("#vCari").prop("disabled", false);
						$("#vISCari").prop("disabled", false);

						
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