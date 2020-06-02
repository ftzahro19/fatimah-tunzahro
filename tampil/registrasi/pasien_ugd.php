<?php 
include "../librari/inc.koneksidb.php"; 
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
<body id="tab1">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<tr bgcolor="#D9E8F3">
<td colspan="6">UNIT GAWAT DARURAT</td>
</tr>  
<?php 
	$tanggal = date("Y:m:d");
	$dokter = $data[dokter];
	$sql = "SELECT * FROM data_pasien,pasien_ugd WHERE data_pasien.prn=pasien_ugd.prn
		AND pasien_ugd.selesai!='Selesai'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
?>
<tr onmouseover="this.bgColor='lightyellow'" onmouseout="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
<td><? echo $data['prn'];?></td>
<td><? echo $data['nama'];?></td>
<td><? echo $data['tgl_lahir'];?></td>
<td><? echo $data['nama_klinik'];?></td>
<td><? echo $data['selesai'];?></td>
<td width="10%">
<div align="center"><a href="pasien_edit.php?kd_kunjungan=<? echo $data['kd_kunjungan']; ?>">Edit</div>
</td>
<?php
}
?>
</table>
</body>
</html>
