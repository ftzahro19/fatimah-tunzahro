<html>
<head>
<title>TRANSAKSI PASIEN</title>
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

$query = "SELECT * FROM data_pasien,pasien_poliklinik 
		WHERE data_pasien.prn=pasien_poliklinik.prn
		AND pasien_poliklinik.selesai='Selesai' 
		AND pasien_poliklinik.batal='Tidak' 
		ORDER BY kd_kunjungan";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $data['tgl_respon'];?> <?php echo $data['jam_respon'];?></td>
    <td class="style1"><?php echo $data['nama'];?></td>
    <td class="style1"><?php echo $data['prn'];?></td>
    <td class="style1"><?php echo $data['tgl_lahir'];?></td>
    <td class="style1"><?php
	$kd_kunjungan = $data['kd_kunjungan'];
	$sql1 = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
      	$result1 = @mysql_query($sql1);
	$data1 = mysql_num_rows($result1);
	$hasil1 = mysql_fetch_array($result1);
	{
	echo "<a href='transaksi_tindakan.php?kd_kunjungan=".$hasil1['kd_kunjungan']."'>Transaksi</a>";
	}
	?>
    </td>
    </tr>
  <?php
}
?>
  <?php
$query = "SELECT * FROM data_pasien,pasien_poliklinik 
		WHERE data_pasien.prn=pasien_poliklinik.prn
		AND pasien_poliklinik.selesai='Selesai' 
		AND pasien_poliklinik.batal='Tidak' 
		ORDER BY kd_kunjungan";
$hasil = mysql_query($query);
$num_rows = mysql_num_rows($hasil);
?>
  <tr bgcolor="#FFFFFF">
    <td>Jumlah</td>
    <td colspan="4"><?php echo $num_rows;?></td>
  </tr>
</table>
</body>
</html>

