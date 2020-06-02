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
<table align="left" width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="6%" bgcolor="#D9E8F3"><div align="center">No</div></td>
    <td width="66%" bgcolor="#D9E8F3"><div align="center">Keluhan</div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="center">Diagnosa</div></td>
  </tr>
  <?php 
	$kd_kunjungan = $_REQUEST['kd_kunjungan'];
	$sql1 = "SELECT * FROM pasien_poliklinik WHERE kd_kunjungan='$kd_kunjungan'";
	$qry1 = mysql_query($sql1);
	$n=1;
	while ($data1 = mysql_fetch_array($qry1)){ 
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center"><?php echo $n++;?></td>
    <td class="style1"><?php echo $data1['keluhan'];?></td>
    <td class="style1"><?php echo $data1['group_diagnosa'];?></td>
  </tr>
 <tr bgcolor="#FFFFFF">
    <td width="6%" bgcolor="#D9E8F3"><div align="center">No</div></td>
    <td width="66%" bgcolor="#D9E8F3"><div align="center">Nama Obat </div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="center">Keterangan</div></td>
  </tr>
  <?php 
  	}
	$kd_kunjungan = $_REQUEST['kd_kunjungan'];
	$sql1 = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan'";
	$qry1 = mysql_query($sql1);
	$no=1;
	while ($data1 = mysql_fetch_array($qry1)){ 
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center"><?php echo $no++;?></td>
    <td class="style1"><?php echo $data1['nama_obat'];?></td>
    <td class="style1"><?php echo $data2['keterangan'];?></td>
  </tr>
  <?php
  }
  ?>
   <tr bgcolor="#FFFFFF">
    <td width="6%" bgcolor="#D9E8F3"><div align="center">No</div>    </td>
    <td width="66%" bgcolor="#D9E8F3"><div align="center">Nama Tindakan </div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="center">Keterangan</div></td>
  </tr>
  <?php
  	$sql2 = "SELECT * FROM tm WHERE kd_kunjungan='$kd_kunjungan'";
	$qry2 = mysql_query($sql2);
	$i=1;
	while ($data2 = mysql_fetch_array($qry2)){ 

  ?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center"><?php echo $i++;?></td>
    <td class="style1"><?php echo $data2['nama_tm'];?></td>
    <td class="style1"><?php echo $data2['keterangan_tm'];?></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
</body>
</html>
