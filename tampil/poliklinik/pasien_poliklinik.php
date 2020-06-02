<html>
<head>
<title>PASIEN TERDAFTAR</title>
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
</head>
<body id="tab2">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#FFFFFF">
    <td width="20%" bgcolor="#CCCCCC"><div align="center">Tanggal/jam</div></td>
    <td width="20%" bgcolor="#CCCCCC"><div align="center">Nama</div></td>
    <td width="20%" bgcolor="#CCCCCC"><div align="center">PRN</div></td>
    <td width="15%" bgcolor="#CCCCCC"><div align="center">Tanggal Lahir</div></td>
    <td width="13%" bgcolor="#CCCCCC"><div align="center"></div></td>
 </tr>
  <?php
// koneksi ke mysql
include "../librari/inc.koneksidb.php";
// query untuk mencari file berdasarkan kategori
	
$query = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.selesai='Proses' AND reg.batal='Tidak' ORDER BY kd_kunjungan";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $data['tgl_reg'];?> <?php echo $data['jam_reg'];?></td>
    <td class="style1"><?php echo $data['nama'];?></td>
    <td class="style1"><?php echo $data['prn'];?></td>
    <td class="style1"><?php echo $data['tgl_lahir'];?></td>
    <td class="style1">
	<?php
    $kd_kunjungan = $data['kd_kunjungan'];
	$sql1 = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
    $result1 = @mysql_query($sql1);
	$data1 = mysql_num_rows($result1);
	$hasil1 = mysql_fetch_array($result1);
	{
	echo "<a href='lap_poli_edit.php?kd_kunjungan=".$hasil1['kd_kunjungan']."'>Klik</a>";
	}
	?>
    </td>
    </tr>
  <?php
}
?>
  <?php
$query2 = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.klinik!='Gawat Darurat' AND reg.selesai='Proses' AND reg.batal='Tidak'";
$hasil2 = mysql_query($query2);
$juml2 = mysql_num_rows($hasil2);
?>
  <tr bgcolor="#FFFFFF">
    <td>Jumlah</td>
    <td colspan="4"><?php echo $juml2;?></td>
  </tr>
</table>
</body>
</html>

