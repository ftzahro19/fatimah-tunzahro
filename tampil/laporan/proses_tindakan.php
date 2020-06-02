<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
$bydate1	= $_REQUEST['bydate1'];
$bydate2	= $_REQUEST['bydate2'];
?>
<html>
<head>
<title>LAPORAN FEE DOKTER</title>
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
<h3 align="center">LAPORAN FEE DOKTER</h3>
<h4 align="center">Tanggal <?php echo $bydate1;?> sd <?php echo $bydate1;?>
<form>
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<?php
$query1 = "SELECT * FROM user,tm WHERE user.username=tm.operator AND tanggal_tm>='$bydate1' AND tanggal_tm<='$bydate2' GROUP BY operator";
$hasil1 = mysql_query($query1);
$no=1;
while ($data1 = mysql_fetch_array($hasil1))
{
?>
 <tr bgcolor="#D9E8F3">
   <td colspan="7">Nama Dokter : <?php echo $data1['nama'];?></td>
  </tr>
 <tr bgcolor="#D9E8F3">
    <td width="3%"><div align="center">No</div></td>
    <td width="11%"><div align="center">Tanggal </div></td>
    <td width="15%"><div align="center">No Kunjungan </div></td>
    <td width="21%"><div align="center">Nama Pasien </div></td>
    <td width="8%"><div align="center">Kode </div></td>
    <td width="23%">Nama Tindakan </td>
    <td width="19%">Biaya</td>
 </tr>
<?php
$operator = $data1['operator'];
$query2 = "SELECT * FROM data_pasien,reg,tm WHERE data_pasien.prn=reg.prn 
			AND reg.batal='Tidak'
			AND reg.kd_kunjungan=tm.kd_kunjungan 
			AND operator='$operator'";
$hasil2 = mysql_query($query2);
while ($data2 = mysql_fetch_array($hasil2)) {
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $no++;?></td>
    <td class="style1"><?php echo $data2['tanggal_tm'];?></td>
    <td class="style1"><?php echo $data2['kd_kunjungan'];?></td>
    <td class="style1"><?php echo $data2['nama'];?></td>
    <td class="style1"><?php echo $data2['kd_tm'];?></td>
    <td class="style1"><?php echo $data2['nama_tm'];?></td>
    <td class="style1"><?php echo $data2['jasa_tm'];?></td>
  </tr>
<?php
}
?>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" colspan="7">
	Total jasa dokter : <?php
$query3 = "SELECT SUM(jasa_tm) FROM reg,tm WHERE reg.kd_kunjungan=tm.kd_kunjungan AND tanggal_tm>='$bydate1' AND tanggal_tm<='$bydate2' AND operator='$operator' AND reg.batal='Tidak'";
$hasil3 = mysql_query($query3);
$data3 = mysql_fetch_array($hasil3);
echo "Rp. ";
echo angka($data3['SUM(jasa_tm)']);
?>
	</td>
  </tr>
<?php
}
?>
</table>
<input align="left" class="noPrint" type="button" value="Print" onClick="window.print()">
</form>
</body>
</html>