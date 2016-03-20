<?php 
$userdata = $this->session->userdata("userdata");
?>
<script>
var daft_id = false;
$(document).ready(function(){
 	
$("#selall").click(function(){
	
	if(this.checked) { // check select status
            $('.ck_data').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.ck_data').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }

	
});


// $("#frm_validasi").submit(function(){
// 	alert('hehehehel');
// 	$(this).ajaxSubmit({

// 	});
// 	return false;
// });



		 var dt = $("#leasing").dataTable(
		 	{
		 		"order": [[ 0, "desc" ]],
		 		"iDisplayLength": 50
		 	});
		
			$("#tanggal_awal").datepicker();
			$("#tanggal_akhir").datepicker();
		
		
		
			$("#fuckyouform").submit(function(){
			 


			
			$.ajax({
				url : '<?php echo site_url("$controller/get_list_daftar"); ?>',
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
							dt.fnClearTable();
					 }
					 else {
							$("#leasing tbody").show();
						 	$("#salah").hide('fast');
							
							dt.fnClearTable();
						    dt.fnAddData(obj.message);
						   	dt.fnDraw(); 		 
						}
				}
			});
			
			return false;
		});
		
		
});



function verifikasi_all(){


					 

	$.ajax({
		url : $("#frm_validasi").attr('target'),
		type : 'post',
		beforeSend : function(){
					$("#salah").hide(); 
					$("#benar").show();
					$("#message2").html('Sedang melakukan verifikasi. Harap menunggu...');
				},
		dataType : 'json',
		data : $("#frm_validasi").serialize(),
		success : function(obj){
			console.log(obj);
			if(obj.error == true) {
				$("#benar").hide('fast');
			 	$("#salah").show('fast');
				$("#message").html(obj.message);
			}
			else {
				$("#benar").show('fast');
			 	$("#salah").hide('fast');
				$("#message2").html(obj.message);
				//location.href='<?php echo site_url("$controller") ?>';
			}

		}
	});

}


function validasi(){
	$.ajax({
		url : '<?php echo site_url("depan_baru/cekvalidasi") ?>',
		beforeSend : function(){
					 
					$("#benar").show();
					$("#message2").html('Sedang diproses. Harap menunggu...');
				},
		complete : function(){
			$("#message2").html('Proses validasi selesai. silahkan cek kembali dengan merefresh halaman ini.');
		}

	});
}


function show_modal(id){
	$("#myModal").modal('show');
	$.ajax({
		url : '<?php echo site_url("baru_verifikasi/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(hasil) {
			daft_id = hasil.daft_id;
			 $("#NO_SURAT").html(hasil.no_surat);
			 $("#DAFT_DATE").html(hasil.daft_date);
			 $("#STATUS").html(hasil.status2);
			 $("#NO_RANGKA").html(hasil.no_rangka);
			 $("#NO_MESIN").html(hasil.no_mesin);

			 $("#TAHUN_KENDARAAN").html(hasil.tahun_kendaraan);
			 $("#JENIS_NAMA").html(hasil.jenis_nama);
			 $("#MERK_NAMA").html(hasil.merk_nama);
			 $("#WARNA_NAMA").html(hasil.warna_nama);
			 $("#NAMA_PENGAJUAN_LEASING").html(hasil.nama_pengajuan_leasing);
			 $("#ALAMAT_PENGAJUAN_LEASING").html(hasil.alamat_pengajuan_leasing);
			 
			 
			 // kalo level 2, 
			 if( parseFloat(<?php echo $userdata["user_level"] ?>) == 2 )
			 {
			 	$("#oke3").hide();
			 	if(parseFloat(hasil.status) < 2 )
			 	{
			 		$("#oke").show();
			 		$("#batal").hide();
			 	}
			 	else if(parseFloat(hasil.status)==2)
			 	{
			 		$("#oke").hide();
			 		$("#batal").show();
			 	}
			 	else {
			 		$("#oke").hide();
			 		$("#batal").hide();
			 	}

			 } 
			 else {
			 	// level 3 
			 	$("#oke").hide();
			 	$("#batal").hide();
			 	if (parseFloat(hasil.status) == 2) {
			 		$("#oke3").show();
					$("#batal").hide();
			 	}
			 	else {
			 		$("#oke3").hide();
			 	}
			 }


			  

		}

	});

}



function verifikasi(){
	//alert(DAFT_ID);
	a = confirm('ANDA AKAN MELAKUKAN VERIFIKASI. ANDA YAKIN ?  ? ');
	if(a){

		$.ajax({
			url:'<?php echo site_url("baru_verifikasi/verifikasi") ?>/'+daft_id,
			dataType : 'json',
			success : function(hasil) {
				if(hasil.error == false) {
					alert(hasil.message);
					$("#myModal").modal('hide');
					location.href=('<?php echo site_url("baru_verifikasi") ?>');
				}
				else {
					alert(hasil.message);
				}
			}
		});
	}

}


function verifikasi3(){
	//alert(DAFT_ID);
	//return false;
	// a = confirm('ANDA AKAN MELAKUKAN VERIFIKASI. ANDA YAKIN ?  ? ');
	// if(a){

		$.ajax({
			url:'<?php echo site_url("polisi_verifikasi/verifikasi3") ?>/'+daft_id,
			dataType : 'json',
			success : function(hasil) {
				console.log(hasil);
				if(hasil.error == false) {

					 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: hasil.message,
			                 
			            });     

					//alert(hasil.message);
				 
				}
				else {
					 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: hasil.message,
			                 
			            }); 
					//alert(hasil.message);
				}
			}
		});
	//}

}


function batal(){
	a = confirm('ANDA AKAN MEMBATALKAN VERIFIKASI. ANDA YAKIN ?  ? ');
	if(a){

		$.ajax({
			url:'<?php echo site_url("baru_verifikasi/batal") ?>/'+daft_id,
			dataType : 'json',
			success : function(hasil) {
				if(hasil.error == false) {
					alert(hasil.message);
					$("#myModal").modal('hide');
					location.href=('<?php echo site_url("baru_verifikasi") ?>');
				}
				else {
					alert(hasil.message);
				}
			}
		});
	}

}


function edit(id){
	$.ajax({
		url : '<?php echo site_url("$controller/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(obj) {
			console.log(obj.verifikasi_by);
			
			if(obj.verifikasi_by != null) {
				alert('record sudah diverifikasi. tidak dapat diedit');
				return false;
			}
			else {
				location.href=('<?php echo site_url("$controller/edit/");?>/'+id);
			}
		}
			
	});
	 
}



function hapus(id) {
	a = confirm('Yakin akan menghapus data ini ? ');
	if(a){
		
		
			$.ajax({
		url : '<?php echo site_url("$controller/get_pendaftaran_detail") ?>/'+id,
		dataType : 'json',
		success : function(obj) {
			 
			console.log(obj.VERIFIKASI_BY);
			if(obj.STATUS != "0") {
				alert('record sudah diverifikasi. tidak dapat dihapus');
				return false;
			}
			else {
				 
				// return false;
					 $.ajax({
					url : '<?php echo site_url("$controller/hapus") ?>/'+id,
					dataType : 'json',
					success : function(obj) {
						if(obj.error==false) { 
						alert(obj.message);
						location.href=('<?php echo site_url("baru_daftar"); ?>');
						}
						else {
							alert(obj.message);
						}
					}
				});
				 
				 
			}
		}
			
	});
	 
			
		///// 	
			
		////// 
	}
	else {
		return false;
	}
}


function cetak(daft_id){

	$.ajax({
		url : '<?php echo site_url("$controller/cek_status") ?>/'+daft_id,
		dataType:'json',
		success : function (hasil) {
			if(hasil.error == true) {
				alert('Dokumen tidak dapat dicetak');
			}
			else {
				var newWin = window.open('<?php echo site_url("$controller/cetak_berkas/"); ?>/'+daft_id);
				newWin.location = href;
				
			}
		}
	});

	
}



function reset_cari(){
	$("#no_rangka").val('');
	$("#tanggal_awal").val('');
	$("#tanggal_akhir").val('');
	$("#fuckyouform").submit();
}



</script>