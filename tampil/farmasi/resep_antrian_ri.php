<?php 
include "../librari/inc.koneksidb.php";
include "../librari/inc.resolusi.php";
include "tab_farmasi.php";
?>
<html>
<head>
<title>Daftar pasien per tanggal <? echo date("d-m-Y");?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<style type="text/css">
<!--
a:link {
	color: #FF0000;
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
<body id="tab2">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<tr bgcolor="#D9E8F3">
<td colspan="5">ANTRIAN RESEP RAWAT INAP </td>
</tr> 
<?php 
	$sql = "SELECT * FROM data_pasien,reg,pasien_rawat,resep WHERE  
	data_pasien.prn=reg.prn AND
	reg.kd_kunjungan=resep.kd_kunjungan AND
	reg.kd_kunjungan=pasien_rawat.kd_kunjungan AND
	resep.unit='Ranap' AND
	reg.selesai!='Selesai' AND
	resep.status='Order' GROUP BY reg.kd_kunjungan";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
  <td width="28%"><div align="center"><strong>Nama [ PRN ]</strong></div></td>
  <td width="13%"><div align="center"><strong>Jam</strong></div></td>
  <td width="20%"><div align="center"><strong>Ruangan</strong></div></td>
  <td width="20%"><div align="center"><strong>Dokter</strong></div></td>
  <td><div align="center"><strong>Keterangan</strong></div></td>
</tr>
<?php
	while ($data=mysql_fetch_array($qry)) {
?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
<td><a href="resep_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','<?php echo $lebar;?>','<?php echo $tinggi;?>','yes');return false"><?php echo $data['nama'];?> [<?php echo $data['prn'];?>]</td>
<td><a href="resep_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','<?php echo $lebar;?>','<?php echo $tinggi;?>','yes');return false"><?php echo $data['jam_rx'];?></td>
<td><a href="resep_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','<?php echo $lebar;?>','<?php echo $tinggi;?>','yes');return false"><?php echo $data['ruang'];?></td>
<td><a href="resep_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','<?php echo $lebar;?>','<?php echo $tinggi;?>','yes');return false"><?php
	$dokter = $data['dokter'];
	$sql4 = "SELECT * FROM user WHERE username='$dokter'";
    $qry4 = mysql_query($sql4, $koneksi) or die ("gagal Query");
	$data4 =mysql_fetch_array($qry4);
	echo $data4['nama'];
	?></td>
<td width="14%">
<div align="center"><a href="resep_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','<?php echo $lebar;?>','<?php echo $tinggi;?>','yes');return false"><?php echo $data['status'];?></div></td>
<?php
}
?>
</table>
</body>
</html>
