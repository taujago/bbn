<style>
* {
font-size : 12pt;
font-family:Arial, Helvetica, sans-serif;

}
 
u {
  margin : 10px;
}
.garisbawah {
	border-bottom : #000 solid 2px;
}

.alamat {
    /*display:block;*/
	margin:0px;
	padding: 0px;
	border-bottom:#000 5px solid;
}

</style>
<body>
<table width="100%" border="0">
   
  <tr>
    <td width="56%" align="center"><b><img width="70px" height="70px" align="middle" src="<?php  echo FCPATH; ?>/assets/images/logo.png" /><br />
    <?php echo $nama_polda ?></b></td>
    <td width="6%">&nbsp;</td>
    <td width="38%">&nbsp;</td>
  </tr>
  <tr>
    <td class="garisbawahs" align="center"><strong>DIREKTORAT LALU LINTAS </strong><br /><u><?php echo $alamat_polda. " ". $kode_pos ?></u><br></td>
    <td>&nbsp;</td>
    <td valign="bottom"><br />
    <br /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td colspan="2" align="center" valign="top"><strong><u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SURAT KETERANGAN &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;</u></strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">Nomor : KET-ABS/<?php echo $daft_id."/".date("Y")."/DITLANTAS";?></td>
  </tr>
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td valign="baseline">&nbsp;</td>
  </tr>
  <tr>
    <td width="6%" align="right" valign="top">&nbsp;</td>
    <td width="94%" valign="baseline">Kepala Seksi BPKB Subdir Min Regident Direktorat Lalu Lintas <?php echo  ucwords(strtolower($nama_polda_singkatan)); ?> menerangkan </td>
  </tr>
  <tr>
    <td colspan="2" valign="top">bahwa, BPKB kendaraan bermotor dengan data - data sebagai berikut : </td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="26%">Nomor polisi</td>
    <td width="3%">:</td>
    <td width="71%"><?php echo $no_polisi; ?></td>
  </tr>
  <tr>
    <td>Merk</td>
    <td>:</td>
    <td><?php echo $merk_nama; ?></td>
  </tr>
  <tr>
    <td>Type </td>
    <td>:</td>
    <td><?php echo $type_kendaraan; ?></td>
  </tr>
  <tr>
    <td>Jenis</td>
    <td>:</td>
    <td><?php echo $tahun_kendaraan; ?></td>
  </tr>
  <tr>
    <td>Tahun</td>
    <td>: </td>
    <td><?php echo $jenis_nama; ?></td>
  </tr>
  <tr>
    <td>No. Rangka </td>
    <td>:</td>
    <td><?php echo $no_rangka; ?></td>
  </tr>
  <tr>
    <td>No. Mesin </td>
    <td>:</td>
    <td><?php echo $no_mesin; ?></td>
  </tr>
  <tr>
    <td>Warna </td>
    <td>:</td>
    <td><?php echo $warna_nama; ?></td>
  </tr>
  <tr>
    <td>Atas Nama</td>
    <td>:</td>
    <td><?php echo $pemilik_nama; ?></td>
  </tr>
  <tr>
    <td>Alamat </td>
    <td>:</td>
    <td><?php echo $pemilik_alamat; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Berdasarkan hasil Penelitian / Pengecekan berkasi / asrip BPKB kendaraan bermotor dimaksud, BPKB asli dengan nomor seri 
<?php echo $no_bpkb; ?>  adalah <strong>BENAR</strong> dan telah dikeluarkan / terdaftar di SIE BPKB DITLANTAS pada tanggal <?php echo  tgl_indo($tgl_bpkb); ?>  No. Reg <?php echo $nreg_bpkb; ?></p>
<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Demikian Surat Keterangan ini dibuat untuk dapat digunakan seperlunya dan yang berkepentingan agar dapat mengetahui dan maklum adanya. </p>
<table width="100%" border="0">
  <tr>
    <td align="left">&nbsp;</td>
    <td align="center" valign="top"><?php echo strtoupper($kota_polda) .", ". tgl_indo(date("d-m-Y")) ?></td>
  </tr>
  <tr>
    <td width="30%" align="left">&nbsp;</td>
    <td width="70%" align="right" valign="top"><img src="<?php echo FCPATH; ?>/assets/images/<?php echo $stempel_file ?>" /></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php  
//unlink(FCPATH."/assets/images/qrcode/$file_name");
?>

</body>