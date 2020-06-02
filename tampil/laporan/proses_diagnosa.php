<?php
include "../librari/inc.koneksidb.php";
$bydate1	= $_REQUEST['bydate1'];
$bydate2	= $_REQUEST['bydate2'];
?>
<html>
<head>
<title>Laporan Sebaran Diagnosa <?php echo $bydate1;?> sd <?php echo $bydate1;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<style type="text/css">
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
<style>
@media print {
input.noPrint { display: none; }
}
@page 
        {
            size: auto;   /* auto is the initial value */
			margin: 20mm;
        }

</style>
</head>
<body>
<h3 align="center">LAPORAN SEBARAN DIAGNOSA </h3>
<h4 align="center">Tanggal <?php echo $bydate1;?> sd <?php echo $bydate2;?> 
<form>
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#D9E8F3">
    <td width="5%"><div align="center">No</div></td>
    <td width="20%"><div align="center">Kode Diagnosa</div></td>
    <td width="60%"><div align="center">Nama Diagnosa</div></td>
	<td width="15%"><div align="center">Jumlah</div></td>
</tr>
<?php
// koneksi ke mysql
$query = "SELECT DISTINCT kd_diagnosa,nama_diagnosa FROM diagnosa WHERE tanggal_dx>='$bydate1' AND tanggal_dx<='$bydate2'";
$hasil = mysql_query($query);
$no=1;
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $no++;?></td>
    <td class="style1"><?php echo $data['kd_diagnosa'];?></td>
    <td class="style1"><?php echo $data['nama_diagnosa'];?></td>
	<td class="style1">
	<?php 
	$query1 = "SELECT COUNT(kd_diagnosa) FROM diagnosa WHERE kd_diagnosa='$data[kd_diagnosa]'";
	$hasil1 = mysql_query($query1);
	$data1 = mysql_fetch_array($hasil1);
	echo $data1['COUNT(kd_diagnosa)'];
	?>
	</td>
    </tr>
<?php
}
?>
  <tr bgcolor="#D9E8F3">
    <td colspan="4"><input class="noPrint" type="button" value="Print" onClick="window.print()">
</td>
  </tr>
</table>
</form>
</body>
</html>

