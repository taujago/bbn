<script>


	$(document).ready(function(){
		
		 
		
		$("#frm_cek").submit(function(){
			//console.log('hallo..');
			
			$.ajax({
				url : '<?php echo site_url("$controller/get_data"); ?>',
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
					 
					 if(obj.error==false) { 

					 	$("#detail").loadJSON(obj.message);

					 // $("#NO_BPKB").val(obj.message.stnk_bpkb.NO_BPKB);
					 // $("#TEMPAT_KELUAR").val(obj.message.stnk_bpkb.TEMPAT_KELUAR);
					 
					 // $("#NO_RANGKA").val(obj.message.stnk_bpkb.NO_RANGKA);
					 // $("#MERK_NAMA").val(obj.message.stnk_bpkb.MERK_NAMA);
					 // $("#JENIS_NAMA").val(obj.message.stnk_bpkb.JENIS_NAMA);
					 // $("#THN_BUAT").val(obj.message.stnk_bpkb.THN_BUAT);
					 // $("#VOL_SILINDER").val(obj.message.stnk_bpkb.VOL_SILINDER);
					 // $("#JML_RODA").val(obj.message.stnk_bpkb.JML_RODA);
					 // $("#WARNATNKB").val(obj.message.stnk_bpkb.WARNATNKB);
					 
					 //  $("#JML_SUMBU").val(obj.message.stnk_bpkb.JML_SUMBU);
					 // $("#WARNA_NAMA").val(obj.message.stnk_bpkb.WARNA_NAMA);
					 // $("#NO_MESIN").val(obj.message.stnk_bpkb.NO_MESIN);
					 // $("#TIPE").val(obj.message.stnk_bpkb.TIPE);
					 
					 // $("#THN_RAKIT").val(obj.message.stnk_bpkb.THN_RAKIT);
					 // $("#MODEL_NAMA").val(obj.message.stnk_bpkb.MODEL_NAMA);
					 
					 
					 //  $("#NO_SUT").val(obj.message.stnk_bpkb.NO_SUT);
					 // $("#NO_TPT").val(obj.message.stnk_bpkb.NO_TPT);
					 
					 // // SECTION TAB 2 
					 // $("#NO_IDENTITAS").val(obj.message.stnk_bpkb.NO_IDENTITAS);
					 // $("#NAMA_PEMILIK").val(obj.message.stnk_bpkb.NAMA_PEMILIK);
					 // $("#ALAMAT_PEMILIK").val(obj.message.stnk_bpkb.ALAMAT_PEMILIK);
					 // $("#KODE_POS").val(obj.message.stnk_bpkb.KODE_POS);
					 // $("#NO_PONSEL").val(obj.message.stnk_bpkb.NO_PONSEL);
					 // $("#PEKERJAAN").val(obj.message.stnk_bpkb.PEKERJAAN);
					 // $("#WILAYAH").val(obj.message.stnk_bpkb.WILAYAH);
					 // $("#PROVINSI").val(obj.message.stnk_bpkb.PROVINSI);
					 // $("#KABUPATEN").val(obj.message.stnk_bpkb.KABUPATEN);
					 // $("#KECAMATAN").val(obj.message.stnk_bpkb.KECAMATAN);
					 // $("#KELURAHAN").val(obj.message.stnk_bpkb.KELURAHAN);
					 // $("#TGL_BPKB").val(obj.message.stnk_bpkb.TGL_BPKB);
					 
					 // /// SECTION 3
					 // $("#NO_FAKTUR").val(obj.message.stnk_bpkb.NO_FAKTUR);
					 // $("#TGL_FAKTUR").val(obj.message.stnk_bpkb.TGL_FAKTUR);
					 // $("#NO_PABEAN").val(obj.message.stnk_bpkb.NO_PABEAN);
					 // $("#TGL_PABEAN").val(obj.message.stnk_bpkb.TGL_PABEAN);
					 // $("#PELABUHAN").val(obj.message.stnk_bpkb.PELABUHAN);
					 // $("#NO_PIB").val(obj.message.stnk_bpkb.NO_PIB);
					 // $("#TGL_PIB").val(obj.message.stnk_bpkb.TGL_PIB);
					 // $("#CARA_IMPORT").val(obj.message.stnk_bpkb.CARA_IMPORT);
					 // $("#NAMA_IMPORTIR").val(obj.message.stnk_bpkb.NAMA_IMPORTIR);
					 // $("#KETR_PABEAN").val(obj.message.stnk_bpkb.KETR_PABEAN);
					 // $("#PEMOHON").val(obj.message.stnk_bpkb.PEMOHON);
					 // $("#LOKASI_STNK").val(obj.message.stnk_bpkb.WILAYAH_NAMA);
					 // $("#TGL_STNK").val(obj.message.stnk_bpkb.TGL_STNK);
					 
					   
					 
					 $("#message").html(obj.message);	 
					 $("#salah").hide('fast');
					 }
					 else {
						 
					 $("#message").html(obj.message);	 
					 $("#salah").show('fast');
						 
					 $("#NO_BPKB").val('');
					 $("#TEMPAT_KELUAR").val('');
					 
					 $("#NO_RANGKA").val('');
					 $("#MERK_NAMA").val('');
					 $("#JENIS_NAMA").val('');
					 $("#THN_BUAT").val('');
					 $("#VOL_SILINDER").val('');
					 $("#JML_RODA").val('');
					 $("#WARNATNKB").val('');
					 
					  $("#JML_SUMBU").val('');
					 $("#WARNA_NAMA").val('');
					 $("#NO_MESIN").val('');
					 $("#TIPE").val('');
					 
					 $("#THN_RAKIT").val('');
					 $("#MODEL_NAMA").val('');
					 
					 
					  $("#NO_SUT").val('');
					 $("#NO_TPT").val('');
					 
					 // SECTION TAB 2 
					 $("#NO_IDENTITAS").val('');
					 $("#NAMA_PEMILIK").val('');
					 $("#ALAMAT_PEMILIK").val('');
					 $("#KODE_POS").val('');
					 $("#NO_PONSEL").val('');
					 $("#PEKERJAAN").val('');
					 $("#WILAYAH").val('');
					 $("#PROVINSI").val('');
					 $("#KABUPATEN").val('');
					 $("#KECAMATAN").val('');
					 $("#KELURAHAN").val('');
					 $("#TGL_BPKB").val('');
					 
					 /// SECTION 3
					 $("#NO_FAKTUR").val('');
					 $("#TGL_FAKTUR").val('');
					 $("#NO_PABEAN").val('');
					 $("#TGL_PABEAN").val('');
					 $("#PELABUHAN").val('');
					 $("#NO_PIB").val('');
					 $("#TGL_PIB").val('');
					 $("#CARA_IMPORT").val('');
					 $("#NAMA_IMPORTIR").val('');
					 $("#KETR_PABEAN").val('');
					 $("#PEMOHON").val('');
					 $("#LOKASI_STNK").val('');
					 $("#TGL_STNK").val('');
					 }
				}
			});
			
			return false;
		});
		
		
		 
	
	

		
		
	});
 
</script>