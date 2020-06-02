<?php 
include "../librari/inc.koneksidb.php"; 
include "tab_pasien.php";
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
<?php 
$query ="SELECT ruang, COUNT(ruang) FROM pasien_rawat WHERE status='Aktif' GROUP BY ruang ORDER BY ruang ASC";
$result =mysql_query($query) or die(mysql_error());
while($data=mysql_fetch_array($result)){
$no++;
?>
<tr bgcolor="#CCCCCC">
<td colspan="6"><? echo $data['ruang'];?></td>
</tr>  
<?php 
	$tanggal = date("Y:m:d");
	$ruang = $data[ruang];
	$sql = "SELECT * FROM data_pasien,pasien_rawat WHERE pasien_rawat.ruang='$ruang' 
		AND data_pasien.prn=pasien_rawat.prn 
		AND pasien_rawat.status='Aktif'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
?>
<tr onmouseover="this.bgColor='lightyellow'" onmouseout="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
<td><? echo $data['prn'];?></td>
<td><? echo $data['nama'];?></td>
<td><? echo $data['tgl_lahir'];?></td>
<td><? echo $data['kamar'];?></td>
<td><? echo $data['kelas'];?></td>
<td width="10%">
<div align="center"><a href="reg_ri_edit.php?kd_kunjungan=<? echo $data['kd_kunjungan']; ?>" title="Klik jika pasien sudah pulang"><? echo $data['status'];?></a></div>
</td>
<?php
}
}
?>
</table>
</body>
</html>
