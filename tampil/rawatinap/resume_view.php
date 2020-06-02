<?php
include "../librari/inc.koneksidb.php";
include "tab_ranap.php";
?>
<html>
<head>
<title>RESUME MEDIS</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"><style type="text/css">
<!--
a:link {
	color: #000080;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
.style1 {font-size: 16px}
-->
</style>
</head>
<body id="tab7">
<table align="center" width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong>Keluhan</strong></div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="left"><strong>Keterangan</strong></div></td>
  </tr>
  <?php 
	$kd_kunjungan = $_REQUEST['kd_kunjungan'];
	$sql1 = "SELECT * FROM catatanmedis WHERE kd_kunjungan='$kd_kunjungan' LIMIT 1";
	$qry1 = mysql_query($sql1);
	$a=1;
	while ($data1 = mysql_fetch_array($qry1)){ 
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $data1['catatanmedis'];?></td>
    <td class="style1"><?php echo $data1['keterangan'];?></td>
  </tr>
  <?php
  }
  ?>
 <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong>Laboratorium</strong></div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="left"><strong>Keterangan</strong></div></td>
  </tr>
  <?php 
	$sql2 = "SELECT * FROM lab WHERE kd_kunjungan='$kd_kunjungan'";
	$qry2 = mysql_query($sql2);
	$b=1;
	while ($data2 = mysql_fetch_array($qry2)){ 
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $b++;?>. <?php echo $data2['nama_lab'];?></td>
    <td class="style1"><?php echo $data2['keterangan'];?></td>
  </tr>
  <?php
  }
  ?>
   <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong>Radiologi</strong></div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="left"><strong>Keterangan</strong></div></td>
  </tr>
  <?php
  	$sql3 = "SELECT * FROM rad WHERE kd_kunjungan='$kd_kunjungan'";
	$qry3 = mysql_query($sql3);
	$c=1;
	while ($data3 = mysql_fetch_array($qry3)){ 

  ?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $c++;?>. <?php echo $data3['nama_rad'];?></td>
    <td class="style1"><?php echo $data3['keterangan'];?></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong> Nama Obat </strong></div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="left"><strong>Keterangan</strong></div></td>
  </tr>
  <?php
  	$sql4 = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan'";
	$qry4 = mysql_query($sql4);
	$d=1;
	while ($data4 = mysql_fetch_array($qry4)){ 
  ?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $d++;?>. <?php echo $data4['nama_obat'];?></td>
    <td class="style1"><?php echo $data4['keterangan'];?></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong>Nama Tindakan </strong></div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="left"><strong>Keterangan</strong></div></td>
  </tr>
  <?php
  	$sql5 = "SELECT * FROM tm WHERE kd_kunjungan='$kd_kunjungan'";
	$qry5 = mysql_query($sql5);
	$e=1;
	while ($data5 = mysql_fetch_array($qry5)){ 

  ?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $e++;?>. <?php echo $data5['nama_tm'];?></td>
    <td class="style1"><?php echo $data5['keterangan_tm'];?></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
</body>
</html>
