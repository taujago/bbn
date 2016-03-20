<?php 
$userdata = $this->session->userdata("userdata");
?>
<script>
var daft_id = false;
$(document).ready(function(){
 
 $("#fuckyouform").submit(function(){

		$.ajax({
				url : '<?php echo site_url("$controller/cek_status"); ?>',
				dataType:'json',
				beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},
				// complete : function(){
				// 	$("#benar").hide();
				// },
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					 if(obj.error==true){
							$("#benar").hide('fast');
						 	$("#salah").show('fast');
							$("#message").html(obj.message);
							$("#data_detail").hide('fast');
							 
					 }
					 else {
							
							$("#data_detail").show('fast');


						 	$("#benar").show('fast');
						 	$("#salah").hide('fast');
							$("#message2").html(obj.message);

							$("#NoRangka").html(obj.data.NoRangka);
							$("#ThnBuat").html(obj.data.ThnBuat);
							$("#BahanBakar").html(obj.data.BahanBakar);
							$("#Model").html(obj.data.Model);
							$("#TglCetakBpkb").html(obj.data.TglCetakBpkb);
							$("#TglPenyerahan").html(obj.data.TglPenyerahan);
							$("#Jenis").html(obj.data.Jenis);
							$("#NoIdentitas").html(obj.data.NoIdentitas);
							$("#TglVerifikasi").html(obj.data.TglVerifikasi);
							$("#TglDaftar").html(obj.data.TglDaftar);
							$("#ThnRakit").html(obj.data.ThnRakit);


							$("#Warna").html(obj.data.Warna);
							$("#Alamat").html(obj.data.Alamat);
							$("#NoMesin").html(obj.data.NoMesin);
							$("#TglCetakKartuInduk").html(obj.data.TglCetakKartuInduk);
							$("#Tipe").html(obj.data.Tipe);
							$("#Merk").html(obj.data.Merk);
							$("#NoFaktur").html(obj.data.NoFaktur);
							$("#TglFaktur").html(obj.data.TglFaktur);
							$("#Pemohon").html(obj.data.Pemohon);
							$("#Pemilik").html(obj.data.Pemilik);
							$("#TglEntri").html(obj.data.TglEntri);
							$("#VolSilinder").html(obj.data.VolSilinder);
							$("#Status").html(obj.data.Status);
							
							if(obj.data.Status == "AKTIF" ) {
								$("#Status").css( "color", "green" );
							}
							else {
								$("#Status").css( "color", "red" );
							}
							 	 
						}
				}
			});
			
			return false;
		});
		
		
});





</script>