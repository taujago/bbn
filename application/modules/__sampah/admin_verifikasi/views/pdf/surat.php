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
    <br />      <?php echo $kota_polda ?>, <?php echo (tgl_indo($daft_date)); ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="3%">&nbsp;</td>
        <td width="30%">No. Pol </td>
        <td width="2%">:</td>
        <td width="65%"><?php // echo //$no_blokir; ?><?php echo $no_polisi; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Klasifikasi</td>
        <td>:</td>
        <td>BIASA </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Lampiran </td>
        <td>:</td>
        <td>-</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Perihal</td>
        <td>:</td>
        <td><u>Hasil Pemblokiran BPKB</u></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td colspan="2" valign="top">&nbsp;</td>
    <td width="33%" valign="baseline"><span class="alamat">Kepada</span></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="top"><span class="alamat">Yth, </span></td>
    <td valign="baseline"><span class="alamat">DIR
        <?php  echo $leasing_nama ?>
        <?php  echo $leasing_kota ?>
    </span></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">&nbsp;</td>
    <td valign="baseline">di</td>
  </tr>
  <tr>
    <td colspan="2" valign="bottom">&nbsp;</td>
    <td valign="baseline"><u><?php  echo $leasing_kota ?></u></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="1">
  
  <tr>
    <td width="2%"  valign="top">&nbsp;</td>
    <td width="4%" align="left"  valign="top">1</td>
    <td  width="96%" valign="top">Rujukan : </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellpadding="3">
      <tr>
        <td width="4%">a.</td>
        <td width="96%">Undang - undang no. 22 Tahun 2009 tentang Lalu Lintas dan Angkutan Jalan;</td>
      </tr>
      <tr>
        <td>b.</td>
        <td>Perkap No. 5 Tahun 2012 tanggal 16 Pebruari 2012 Tentang Registrasi dan Identifikasi Kendaraan Bermotor; </td>
      </tr>
      <tr>
        <td>c.</td>
        <td>Surat DIR 
          <?php  echo $leasing_nama ?> Nomor 
          <?php  echo $no_surat  ?> Tanggal <?php echo ($daft_date); ?> perihal PEMBLOKIRAN BPKB.</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">2</td>
    <td>Sehubungan dengan rujukan tersebut di atas, bersama ini kami beritahukan bahwa kendaraan bermotor dengan identitas sebagai berikut : </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="26%">Merk</td>
        <td width="3%">:</td>
        <td width="71%"><?php echo $merk_nama; ?></td>
      </tr>
      <tr>
        <td>Tahun / Jenis</td>
        <td>:</td>
        <td><?php echo $tahun_kendaraan; ?> / <?php echo $jenis_nama; ?></td>
      </tr>
      <tr>
        <td>Warna </td>
        <td>:</td>
        <td><?php echo $warna_nama; ?></td>
      </tr>
      <tr>
        <td>Nomor polisi</td>
        <td>:</td>
        <td><?php echo $no_polisi; ?></td>
      </tr>
      <tr>
        <td>Nomor  BPKB </td>
        <td>:</td>
        <td><?php echo $no_bpkb; ?></td>
      </tr>
      <tr>
        <td>Nomor Register</td>
        <td>:</td>
        <td><?php echo $nreg_bpkb; ?></td>
      </tr>
      <tr>
        <td>Nomor Rangka </td>
        <td>:</td>
        <td><?php echo $no_rangka; ?></td>
      </tr>
      <tr>
        <td>Nomor Mesin </td>
        <td>:</td>
        <td><?php echo $no_mesin; ?></td>
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
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td>Telah dilakukan pemblokiran di seksi BPKB Subdit Regident Dit Lantas  <?php echo $nama_polda ?> terhitung sejak tanggal <?php echo $tgl_blokir; ?> sampai dengan tanggal <?php echo ($tgl_blokir2); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><br />
      <br />
    3</td>
    <td><br />
      <br />
    Demikian untuk menjadi maklum.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="right"><table width="100%" border="0">
      <tr>
        <td width="30%" align="left"><img width="100px" height="100px" src="<?php  echo FCPATH; ?>/assets/images/qrcode/<?php echo "$file_name" ?>" /></td>
        <td width="70%" rowspan="3" align="right" valign="top"><p><br>
          </p>
          <p><img src="<?php echo FCPATH; ?>/assets/images/<?php echo $stempel_file ?>" /></p></td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
        </tr>
      <tr>
        <td align="left">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<?php  
//unlink(FCPATH."/assets/images/qrcode/$file_name");
?>

</body>