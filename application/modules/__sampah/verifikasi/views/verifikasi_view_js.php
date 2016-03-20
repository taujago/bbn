<script>


	$(document).ready(function(){
		
		var dt = $('#tabel-bpkb').dataTable();
		 
		$("#vTGL_DAFTAR").datepicker();
		//$("#vTGL_BPKB").datepicker();		
		//$("#tabel-bpkb").dataTable();
		//var tableAjax = $('#tabel-bpkb').dataTable();
		
		 
		
		/*$('#example').on('click', 'a.editor_view', function (e) {
		  e.preventDefault();
		  var rowIndex = oTable.fnGetPosition( $(this).closest('tr')[0] );
		  aData = oTable.fnGetData(rowIndex,0);
		  alert(aData);
		} );*/
		
		
		$("#frm_cek").submit(function(){
			 
			
			$.ajax({
				url : '<?php echo site_url("$controller/inq_get_list_daftar"); ?>',
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
					    dt.fnAddData(obj.message.data);
					   	dt.fnDraw(); 
						 
						 
					
					  
											  
						
					 }
				}
			});
			
			return false;
		});
		
		
		/// form daftar 
		
		$("#frm_ver").submit(function(){
			//console.log('hallo..');
			
			// if($("#vSTATUS").val() != "0") {
			// 	alert('tidak bisa divefirikasi. status kendaraan tidak sesuai');
			// 	return false;
			// }
			
			
			$.ajax({
				url : '<?php echo site_url("$controller/simpan"); ?>',
				dataType:'json',
				beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},				
				type : 'post',
				data : $(this).serialize(),
				success : function(obj) {
					$("#benar").hide();
					if(obj.error == false){
						
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#message2").html(obj.message);
						$("#salah").hide();
						$("#benar").show();
						$("#myModal").modal('hide');
						 
						$("#detail_kendaraan")[0].reset();
						
					}
					else {
						$("#myModal").modal('hide');
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
	
	
function detail(id,daft_id)
{
	$.ajax({
		url : '<?php echo site_url("$controller/get_data"); ?>',
		type : 'post',
		dataType :'json',
		data : { v_is_cari : "1", v_cari : id },
		success: function(obj){
			
			if(obj.error==false) {
				$("#myModal").modal('show');
				 
				
				$("#detail_kendaraan").loadJSON(obj.message);
				
				$("#STATUS").html(obj.message.BPKB_STATUS);
				$("#vSTATUS").val(obj.message.BPKB_STATUS);
			}
			else {

					$("#salah").show();
					$("#message").html('Data tidak ditemukan atau nomor BPKB salah');

				 bersih();
			}
		}
	});
	
	
	$.ajax({
		url : '<?php echo site_url("verifikasi/get_detail_pendaftaran"); ?>/'+daft_id,
		dataType : 'json',
		success : function(obj){
			$("#vLEASING_ID").val(obj.LEASING_ID);
			$("#vDAFT_ID").val(obj.DAFT_ID);
			
		}
	});
}	
	
	
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

function bersih() {
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
</script>