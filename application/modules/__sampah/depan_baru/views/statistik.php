<style>
.statistik {
	font-size:10px;
}
.statistik th {
 padding:5px 3px;
 background-color:#999;
 font-weight:bold;
}
.statistik td {
 padding:3px;
}

 

.headstat{
	background-color:#CCC;
}
.headstat th{
	text-align:center;
	padding:5px;
}

.headstat td{
	text-align:center;
	padding:5px;
    background-color:	#f0ad4e; 
	color:#FFF;
}

.panel-body a {
	display:block;
}
/*
.tdata {
	color: #333;
  font-family: sans-serif;
  font-size: font-size:10px;
  font-weight: 300;
  text-align: left;
  line-height: 40px;
  border-spacing: 0;
  border: 1px solid #428bca;
  width: 100%;
  margin: 5px auto;
}


thead tr:first-child {
  background: #428bca;
  color: #fff;
  border: none;
}

th {font-weight: bold;}
th:first-child, td:first-child {padding: 0 15px 0 20px;}

thead tr:last-child th {border-bottom: 2px solid #ddd;}

tbody tr:hover {background-color: #f0fbff;}
tbody tr:last-child td {border: none;}
tbody td {border-bottom: 1px solid #ddd;}

td:last-child {
  /*text-align: right;
  padding-right: 10px;
} 

.button {
  color: #696969;
  padding-right: 5px;
  cursor: pointer;
}

.alterar:hover {
  color: #428bca;
}

.excluir:hover {
  color: #dc2a2a;
}
*/
</style>

     <!--<div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $level1; ?></div>
                                        <div>Proses Level 1</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $level2; ?></div>
                                        <div>Proses Level 2</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $level3; ?></div>
                                        <div>Proses Level 3</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $approved; ?></div>
                                        <div>Approve dari Kepolisian</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>-->

<!--<table width="50%" border="0" cellpadding="3">
  <tr>
    <th colspan="3">RINGKASAN </th>
  </tr>
  <tr>
    <td width="38%">Proses Level 1</td>
    <td width="2%">:</td>
    <td width="60%"><?php echo $level1; ?></td>
  </tr>
  <tr>
    <td>Proses Level 2</td>
    <td>:</td>
    <td><?php echo $level2; ?></td>
  </tr>
  <tr>
    <td>Proses Level 3</td>
    <td>:</td>
    <td><?php echo $level3; ?></td>
  </tr>
  <tr>
    <td>Approve dari Kepolisian</td>
    <td>:</td>
    <td><?php echo $approved; ?></td>
  </tr>
</table>-->
<p>&nbsp;</p>
<div class="row">
  <div class="col-md-2">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><center>LEVEL 1</center></h3>
      </div>
      <div class="panel-body"><span class="huge"><center>
	  <a href="#">
		  <?php echo ribuan($level1); ?> </a>
	  <?php //echo $level1; ?></center></span></div>
    </div>

  </div>
  <div class="col-md-2">
    
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><center>LEVEL 2</center></h3>
      </div>
      <div class="panel-body"><span class="huge"><center>
	  <a href="<?php echo site_url("baru_verifikasi?status=1"); ?>">
		  <?php echo ribuan($level2); ?> </a>
	  <?php //echo $level2; ?></center></span></div>
    </div>  	
  
  
  </div>
  <div class="col-md-3">
       
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><center>MENUNGGU BLOKIR</center></h3>
          </div>
          <div class="panel-body"><span class="huge"><center>
		   <a href="<?php echo site_url("baru_verifikasi?status=2"); ?>">
		  <?php echo ribuan($level3); ?> </a>
		  <?php //echo $level3; ?></center></span></div>
        </div>
  
  </div>
  <div class="col-md-2">
  
<div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><center>GAGAL BLOKIR</center></h3>
          </div>
          <div class="panel-body"><span class="huge"><center>
		  <a href="<?php echo site_url("baru_verifikasi?status=3"); ?>">
		  <?php echo ribuan($level3a); ?> </a>
		  <?php //echo $level3a; ?></center></span></div>
        </div>
  
  </div>
  <div class="col-md-3">

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><center>APPROVED BLOKIR</center></h3>
          </div>
          <div class="panel-body"><span class="huge"><center>
		  <a href="<?php echo site_url("baru_verifikasi?status=4"); ?>">
		  <?php echo ribuan($approved); ?> </a>
          
          </center></span></div>
        </div> 
          
  </div>
   
</div>

<table class="statistik" width="100%" border="1" cellpadding="3">
<thead>
  <tr>
    <th width="3%" align="center" scope="col"><strong>NO</strong></th>
    <th width="6%" align="center" scope="col"><strong>TGL. DAFTAR</strong></th>
    <th width="10%" align="center" scope="col">CABANG</th>
    <th width="9%" align="center" scope="col"><strong>NO.POLISI <br />
    </strong></th>
    <th width="12%" align="center" scope="col">NO. RANGKA</th>
    <th width="8%" align="center" scope="col">NO. BPKB</th>
    <th width="9%" align="center" scope="col"><strong>TGL BKPB</strong></th>
    <th width="13%" align="center" scope="col"><strong>NAMA PEMOHON</strong></th>
    <th width="14%" align="center" scope="col">NO. BLOKIR</th>
    <th width="6%" align="center" scope="col"><strong>TGL. BLOKIR</strong></th>
    <th width="10%" align="center" scope="col"><strong>JENIS/MERK</strong></th>
  </tr>
  </thead>
  <tbody>
  <?php 
  $n=0;
  foreach($record->result() as $row) : 
  $n++;
  ?>
 <tr>
    <td width="3%" scope="col"><?php echo $n; ?></td>
    <td width="6%" scope="col"><?php echo $row->daft_date; ?></td>
    <td width="10%" scope="col"><?php echo $row->cabang_nama; ?></td>
    <td width="9%" scope="col"><?php echo $row->no_polisi; ?></td>
    <td width="12%" scope="col"><?php echo $row->no_rangka; ?></td>
    <td width="8%" scope="col"><?php echo $row->no_bpkb; ?></td>
    <td width="9%" scope="col"><?php echo $row->tgl_bpkb; ?></td>
    <td width="13%" scope="col"><?php echo $row->nama_pengajuan_leasing; ?></td>
    <td width="14%" scope="col"><?php  echo $row->no_blokir; ?></td>
    <td width="6%" scope="col"><?php echo $row->tgl_blokir; ?></td>
    <td width="10%" scope="col"><?php echo $row->jenis_nama."<br />".$row->merk_nama; ?></td>
  </tr>
 <?php 
 endforeach;
 ?>
 </tbody>
  </table>
