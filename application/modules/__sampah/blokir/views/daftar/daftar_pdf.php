<style>
* {
	font-size:11px;
}
</style>

<table width="100%" border="0">
  <tr>
    <td width="14%">U.P</td>
    <td width="86%">: Kanit Reg. Ident</td>
  </tr>
  <tr>
    <td>Perihal</td>
    <td>: Pemeriksaan /keaslian BPKB </td>
  </tr>
</table>
<p>Dengan hormat,</p>
<p>Dengan ini kami sampaikan kepada Bapak, bahwa kendaraan dengan spesifikasi dibawah ini :</p>
<table width="100%" border="0">
  <tr>
    <td width="16%">&nbsp;</td>
    <td width="20%">Nama Pemilik  </td>
    <td width="64%">: <?php echo isset($NAMA_PEMILIK)?$NAMA_PEMILIK:""; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Jenis Kendaraan</td>
    <td>: <?php echo isset($JENIS_NAMA)?$JENIS_NAMA:""; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Merk/Type</td>
    <td>: <?php echo isset($MERK_NAMA)?$MERK_NAMA:"";
				echo isset($TIPE)?" / ".$TIPE:"";
	 ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Warna / Tahun</td>
    <td>: <?php echo isset($WARNA_NAMA)?$WARNA_NAMA:""; 
		echo isset($TAHUN_KENDARAAN)?" / ".$TAHUN_KENDARAAN:"";
	?></td> 
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>No. BPKB</td>
    <td>: <?php echo isset($NO_BPKB)?$NO_BPKB:""; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>No. Polisi</td>
    <td>: <?php echo isset($NO_POLISI)?$NO_POLISI:""; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>No. Rangka</td>
    <td>: <?php echo isset($NO_RANGKA)?$NO_RANGKA:""; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>No. Mesin</td>
    <td>: <?php echo isset($NO_MESIN)?$NO_MESIN:""; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Register</td>
    <td>: <?php echo isset($NREG_BPKB)?$NREG_BPKB:""; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tanggal</td>
    <td>: <?php echo isset($TGL_BPKB2)?$TGL_BPKB2:""; ?></td>
  </tr>
</table>
<p>Terhitung sejak tanggal diterimanya surat inin akan dijadikan sebagai jaminan atas suatu pinjaman pada perusahaan kami.</p>
<p>Sehubungan dengan ini kami mohon agar BPKB kendaraan tersebut dapat di periksa keabsahannya sesuai dengan peraturan yang berlaku,</p>
<p>Kami sangat berharap jika dari Bapak dapat memberikan suatu bukti tertulis yang menunjang keabsahan BPKB tersebut, Bukti tertulis ini akan kami gunakan untuk kalangan intern kami (sebagai kelengkapan dokumentasi administrasi).</p>
<p>Demikian harap dimaklumi,atas bantuan Bapak,kami ucapkan terima kasih. </p>

<?php  
$userdata = $this->session->userdata("userdata");
//show_array($userdata); exit;
?>
<table width="100%" border="0">
  <tr>
    <td width="31%" align="center"><?php echo isset($userdata['LEASING_KOTA'])?$userdata['LEASING_KOTA']:"";
	echo ", ". $DAFT_DATE2; ?></td>
    <td width="69%">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo isset($userdata['LEASING_NAMA'])?$userdata['LEASING_NAMA']:""; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">(______________________)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">MANAGER </td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
