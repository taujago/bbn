<style>
* {
font-size : 9px;
}

.garisbawah {
	border-bottom : #000 solid 2px;
}

</style>

<table width="100%" border="0">
   
  <tr>
    <td width="50%" align="center"><b><img width="70px" height="70px" align="middle" src="<?php echo base_url(); ?>/assets/images/logo.png" /><br />
    <?php echo $nama_polda ?></b></td>
    <td width="17%">&nbsp;</td>
    <td width="33%">&nbsp;</td>
  </tr>
  <tr>
    <td class="garisbawahs" align="center"><strong>DIREKTORAT LALU LINTAS </strong><br />
      <?php echo $alamat_polda ?><br />   </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr /></td>
    <td>&nbsp;</td>
    <td><?php echo $kota_polda ?>, <?php echo ($daft_date); ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="34%">No. Pol </td>
        <td width="4%">:</td>
        <td width="62%"><?php echo $no_blokir; ?></td>
      </tr>
      <tr>
        <td>Klasifikasi</td>
        <td>:</td>
        <td>BIASA </td>
      </tr>
      <tr>
        <td>Lampiran </td>
        <td>:</td>
        <td>-</td>
      </tr>
      <tr>
        <td>Perihal</td>
        <td>:</td>
        <td>Hasil Pembloiran BPKB</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td valign="baseline">Kepada</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">Yth</td>
    <td valign="baseline">DIR <?php  echo $leasing_nama ?> <?php  echo $leasing_kota ?></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="98%"><img src="<?php echo base_url(); ?>/assets/images/stempel-merah.png" /></td>
      </tr>

    </table></td>
    <td valign="baseline">di</td>
  </tr>
  <tr>
    <td valign="baseline"><?php  echo $leasing_alamat ?></td>
  </tr>
  <tr>
    <td valign="baseline">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="1">
  
  <tr>
    <td width="4%"  valign="top">1</td>
    <td  width="96%" valign="top">Rujukan</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
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
    <td>2</td>
    <td>Sehubungan dengan rujukan tersebut di atas, bersama ini kami beritahukan bahwa kendaraan bermotor dengan identitas sebagai berikut : </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>NomorRangka </td>
        <td>:</td>
        <td><?php echo $no_rangka; ?></td>
      </tr>
      <tr>
        <td>Nomor Mesin </td>
        <td>:</td>
        <td>-</td>
      </tr>
      <tr>
        <td>Atas Nama</td>
        <td>:</td>
        <td><?php echo $nama_pengajuan_leasing; ?></td>
      </tr>
      <tr>
        <td>Alamat </td>
        <td>:</td>
        <td><?php echo $alamat_pengajuan_leasing; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Telah dilakukan pemblokiran di seksi BPKB Subdit Regident Dit Lantas  <?php echo $nama_polda ?> terhitung sejak tanggal <?php echo $tgl_blokir; ?> sampai dengan tanggal <?php echo ($tgl_blokir2); ?></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Demikian untuk dimaklumi </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><table width="100%" border="0">
      <tr>
        <td align="left"><img width="100px" height="100px" src="<?php echo base_url(); ?>/assets/images/qrcode/<?php echo "$file_name" ?>" /></td>
        <td align="right"><img src="<?php echo base_url(); ?>/assets/images/<?php echo $stempel_file ?>" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<?php  
//unlink(FCPATH."/assets/images/qrcode/$file_name");
?>
