<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<style>


#frm td {
	padding:5px;
}
</style>
 <div class="row">
 <form id="frm_cek" name="frm_cek" method="post" action="">
     <div class="col-md-7">
     
    <?php echo form_dropdown("vLEASING_ID",$arr_leasing,'','id="LEASING_ID" 
	class="form-control"'); ?>
     </div>
 	
    <div class="col-md-3">
    	<div class="form-group input-group">
            <input name="vTGL_DAFTAR" id="vTGL_DAFTAR" class="form-control" 
            type="text" placeholder="Tanggal Pendaftaran" data-date-format="dd-mm-yyyy">
            <span class="input-group-btn">
            <button class="btn btn-default" type="submit" value="CEK DATA" >
            <i class="fa fa-search"></i>
            </button>
            </span>
        </div> 
    </div>
 
</form>
</div> 


<div class="row">
  <div id="salah" class="col-lg-12" style="display:none">
            <div class="alert alert-danger" role="alert" id="message">
            	
            </div>
        </div>
    </div>
    
  <div class="row">
  <div id="benar" class="col-lg-12" style="display:none">
            <div class="alert alert-success" role="alert" id="message2">
            	
            </div>
        </div>
    </div> 
<!-- lets begin table section  -->

<div class="row">
	<div class="col-md-12">
    	<div class="panel panel-default">
            <div class="panel-heading">DATA VERIFIKASI</div>
            <div class="panel-body">
             <table width="100%" border="0" id="tabel-bpkb" class="table table-striped 
             table-bordered table-hover dataTable no-footer" role="grid">
              <thead>
              <tr>
                <th width="8%" scope="col">ID </th>
                <!-- <th width="29%" scope="col">TANGGAL</th> -->
                <th width="29%" scope="col">NO. BPKB</th>
                <th width="35%" scope="col">NO. MESIN</th>
                <th width="28%" scope="col">NO. RANGKA</th>
              </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
	<div class="col-md-12">
    	
    </div>
</div>



 


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" style="width:90%; min-height:600px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              VERIFIKASI KENDARAAN
            </h4>
         </div>
         <div class="modal-body">
            <!-- Add some text here --> 
            
            
            <div class="panel panel-default">
            <div class="panel-heading">PROSES VERIFIKASI</div>
            <div class="panel-body">
            <h3> STATUS : <span id="STATUS"> </span></h3>
           	  <form action="#" id="frm_ver">
                <textarea placeholder="Keterangan Verifikasi" class="form-control" name="VERIFIKASI_KET" id="vVERIFIKASI_KET"></textarea><br />
                	 
                           <input name="IS_VERIFIED" type="radio" value="1" checked="checked" /> Boleh Blokir 
                           <input type="radio" value="0" name="IS_VERIFIED" /> Tidak Boleh Blokir 
                           <input class="btn btn-md btn-primary" type="submit" 
                           name="Submit" id="tombol" value="Simpan">
                    
                <input type="hidden" name="LEASING_ID" id="vLEASING_ID" />
            	<input type="hidden" name="DAFT_ID" id="vDAFT_ID" />
           	    
                <input type="hidden" name="STATUS" id="vSTATUS" />
           	  </form>
            </div>
        </div>
            
            
            
            
            <div class="panel panel-default">
        	 <div class="panel-heading">DETAIL KENDARAAN</div>
             <form id="detail_kendaraan" >   
             
             	<div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs ">
                                <li class="active"><a aria-expanded="true" href="#home" data-toggle="tab">I. IDENTITAS KENDARAAN</a>
                                </li>
                                <li ><a   href="#profile" data-toggle="tab">II. IDENTITAS PEMILIK</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">III. IDENTITAS PABEAN/ASAL USUL</a>
                                </li>
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
    <table width="100%" border="0" class="table tbdata" >
                                      <tr>
                                        <td width="14%">Nomor BPKB</td>
                                        <td width="32%"><input type="text" name="NO_BPKB" id="NO_BPKB" class="form-control" />
                                        <input type="hidden" name="DAFT_ID" id="DAFT_ID" /></td>
                                        <td width="15%">No. Reg BPKB</td>
                                        <td width="39%"><input type="text" name="textfield22" id="textfield22"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Dikeluarkan di </td>
                                        <td><input type="text" name="TEMPAT_KELUAR" id="TEMPAT_KELUAR"  class="form-control" /></td>
                                        <td>Tanggal</td>
                                        <td><input type="text" name="TGL_BPKB" id="TGL_BPKB"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Nomor rangka</td>
                                        <td><input type="text" name="NO_RANGKA" id="NO_RANGKA"  class="form-control" /></td>
                                        <td>Nomor mesin</td>
                                        <td><input type="text" name="NO_MESIN" id="NO_MESIN"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Merk</td>
                                        <td><input type="text" name="MERK_NAMA" id="MERK_NAMA"  class="form-control" /></td>
                                        <td>Tipe 1</td>
                                        <td><input type="text" name="TIPE" id="TIPE"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Jenis</td>
                                        <td><input type="text" name="JENIS_NAMA" id="JENIS_NAMA"  class="form-control" /></td>
                                        <td>Tipe 2</td>
                                        <td><input type="text" name="TIPE2" id="TIPE2"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Tahun buat</td>
                                        <td><input type="text" name="THN_BUAT" id="THN_BUAT"  class="form-control" /></td>
                                        <td>Model</td>
                                        <td><input type="text" name="MODEL_NAMA" id="MODEL_NAMA"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Silinder </td>
                                        <td><input type="text" name="VOL_SILINDER" id="VOL_SILINDER"  class="form-control" /></td>
                                        <td>Thn. Rakit</td>
                                        <td><input type="text" name="THN_RAKIT" id="THN_RAKIT"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Jumlah roda</td>
                                        <td><input type="text" name="JML_RODA" id="JML_RODA"  class="form-control" /></td>
                                        <td>Warna</td>
                                        <td><input type="text" name="WARNA_NAMA" id="WARNA_NAMA"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Bahan bakar</td>
                                        <td><input type="text" name="textfield9" id="textfield9"  class="form-control" /></td>
                                        <td>Jml. Sumbu</td>
                                        <td><input type="text" name="JML_SUMBU" id="JML_SUMBU"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Peruntukan</td>
                                        <td><input type="text" name="textfield10" id="textfield10"  class="form-control" /></td>
                                        <td>No. TPT</td>
                                        <td><input type="text" name="NO_TPT" id="NO_TPT"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Warna TNKB</td>
                                        <td><input type="text" name="WARNATNKB" id="WARNATNKB"  class="form-control" /></td>
                                        <td>No. SUT</td>
                                        <td><input type="text" name="NO_SUT" id="NO_SUT"  class="form-control" /></td>
                                      </tr>
                                    </table>
                                   
        </div>
                                <div class="tab-pane fade" id="profile">
                                    
                                    <table width="100%" border="0" class="table tbdata" >
                                      <tr>
                                        <td width="14%">Nomor Identitas</td>
                                        <td width="86%"><input type="text" name="NO_IDENTITAS" id="NO_IDENTITAS" class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Nama Pemilik</td>
                                        <td><input type="text" name="NAMA_PEMILIK" id="NAMA_PEMILIK"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Alamat Pemilik</td>
                                        <td><input type="text" name="ALAMAT_PEMILIK" id="ALAMAT_PEMILIK"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Kode Pos</td>
                                        <td><input type="text" name="KODE_POS" id="KODE_POS"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Nomor Ponsel</td>
                                        <td><input type="text" name="NO_PONSEL" id="NO_PONSEL"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Pekerjaan</td>
                                        <td><input type="text" name="PEKERJAAN" id="PEKERJAAN"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Wilayah</td>
                                        <td><input type="text" name="WILAYAH" id="WILAYAH"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Provinsi</td>
                                        <td><input type="text" name="PROVINSI" id="PROVINSI"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Kabupaten</td>
                                        <td><input type="text" name="KABUPATEN" id="textfield7"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Kecamatan</td>
                                        <td><input type="text" name="KECAMATAN" id="textfield8"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Kelurahan</td>
                                        <td><input type="text" name="KELURAHAN" id="KELURAHAN"  class="form-control" /></td>
                                      </tr>
                                    </table>
                                    <p>&nbsp;</p>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                  <table width="100%" border="0" class="table tbdata" >
                                    <tr>
                                        <td width="14%">Jenis daftaran</td>
                                        <td width="43%"><input type="text" name="JENIS_DAFTARAN" id="JENIS_DAFTARAN" class="form-control" /></td>
                                        <td width="14%">&nbsp;</td>
                                        <td width="29%">&nbsp;</td>
                                    </tr>
                                      <tr>
                                        <td>Nomor faktur</td>
                                        <td><input type="text" name="NO_FAKTUR" id="NO_FAKTUR"  class="form-control" /></td>
                                        <td>Tanggal</td>
                                        <td><input type="text" name="TGL_FAKTUR" id="TGL_FAKTUR"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Nomor pabean</td>
                                        <td><input type="text" name="NO_PABEAN" id="NO_PABEAN"  class="form-control" /></td>
                                        <td>Tanggal</td>
                                        <td><input type="text" name="TGL_PABEAN" id="TGL_PABEAN"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Pelabuhan</td>
                                        <td><input type="text" name="PELABUHAN" id="PELABUHAN"  class="form-control" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>Nomor PIB</td>
                                        <td><input type="text" name="NO_PIB" id="NO_PIB"  class="form-control" /></td>
                                        <td>Tanggal</td>
                                        <td><input type="text" name="TGL_PIB" id="TIPE4"  class="form-control" /></td>
                                      </tr>
                                      <tr>
                                        <td>Cara Import</td>
                                        <td><input type="text" name="CARA_IMPORT" id="CARA_IMPORT"  class="form-control" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>Nama Importir/APM</td>
                                        <td><input type="text" name="NAMA_IMPORTIR" id="NAMA_IMPORTIR"  class="form-control" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>Ket. lain</td>
                                        <td><input type="text" name="KETR_PABEAN" id="KETR_PABEAN"  class="form-control" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>Pemohon</td>
                                        <td><input type="text" name="PEMOHON" id="textfield2"  class="form-control" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>Lokasi STNK</td>
                                        <td><input type="text" name="LOKASI_STNK" id="textfield3"  class="form-control" /></td>
                                        <td>Tgl. berlaku STNK</td>
                                        <td><input type="text" name="TGL_STNK" id="TGL_STNK"  class="form-control" /></td>
                                      </tr>
                                  </table>
                                    <p>&nbsp;</p>
                                </div>
                                
                          </div>
                        </div>
             
             
             </form>
        </div>
    </div>
            
            
            
            
         </div> <!-- end of modal body  --> 
         <!--<div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">Close
            </button>
            <button type="button" class="btn btn-primary">
               Submit changes
            </button>
         </div>-->
      </div><!-- /.modal-content -->
</div><!-- /.modal -->


<?php $this->load->view("verifikasi_view_js"); ?>