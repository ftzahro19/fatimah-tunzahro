<?php
include "../librari/inc.koneksidb.php";
include "data_pasien.php";
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
<table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong>Keluhan</strong></div></td>
  </tr>
  <?php 
	$kd_kunjungan = $_REQUEST['kd_kunjungan'];
	$sql1 = "SELECT * FROM pasien_poliklinik WHERE kd_kunjungan='$kd_kunjungan'";
	$qry1 = mysql_query($sql1);
	$n=1;
	while ($data1 = mysql_fetch_array($qry1)){ 
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $data1['keluhan'];?></td>
  </tr>
  
  <!--	/*Baris Diagnosa Medis*/ -->
 <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong>Diagnosa Medis</strong></div></td>
  </tr>
  <?php 
  	}
	$kd_kunjungan = $_REQUEST['kd_kunjungan'];
	$sql1 = "SELECT * FROM diagnosa WHERE kd_kunjungan='$kd_kunjungan'";
	$qry1 = mysql_query($sql1);
	$n1=1;
	while ($data1 = mysql_fetch_array($qry1)){ 
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $n1++;?>. <?php echo $data1['nama_diagnosa'];?></td>
  </tr>

	<!--	/*Baris Nama Obat*/ -->
  <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong>Nama Obat </strong></div></td>
  </tr>
  <?php 
  	}
	$kd_kunjungan = $_REQUEST['kd_kunjungan'];
	$sql2 = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan'";
	$qry2 = mysql_query($sql2);
	$n2=1;
	while ($data2 = mysql_fetch_array($qry2)){ 
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $n2++;?>. <?php echo $data2['nama_obat'];?></td>
  </tr>
  <?php
  }
  ?>
  <!--	/*Baris Tindakan Medis*/ -->
  
   <tr bgcolor="#FFFFFF">
    <td width="66%" bgcolor="#D9E8F3"><div align="left"><strong>Nama Tindakan </strong></div></td>
  </tr>
  <?php
  	$sql3 = "SELECT * FROM tm WHERE kd_kunjungan='$kd_kunjungan'";
	$qry3 = mysql_query($sql3);
	$n3=1;
	while ($data3 = mysql_fetch_array($qry3)){ 

  ?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $n3++;?>. <?php echo $data3['nama_tm'];?></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
</body>
</html>
