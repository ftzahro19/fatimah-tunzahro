<?php 
include "../librari/inc.koneksidb.php";
?>
<html>
<head>
<title>Daftar pasien per tanggal <?php echo date("d-m-Y");?></title>
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
<tr bgcolor="#CCCCCC">
<td colspan="6">PASIEN RAWAT JALAN</td>
</tr> 
<?php 
	$no = 1;
	$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn 
		AND reg.tindak_lanjut!='Rawat'
		AND reg.selesai!='Selesai'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {

?>
<tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff" span class="style1">
<td><?php echo $no;?></td>
<td><?php echo $data['prn'];?></td>
<td><?php echo $data['nama'];?></td>
<td><?php echo $data['tgl_lahir'];?></td>
<td><?php echo $data['dokter'];?></td>
<td><?php echo $data['selesai'];?></td>
<?php
$no++;
}
?>
</table>
</body>
</html>
