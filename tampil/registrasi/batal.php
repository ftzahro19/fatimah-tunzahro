<html>
<head>
<title>PASIEN TERDAFTAR</title>
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
<body>
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="20%" bgcolor="#D9E8F3"><div align="center">Nama</div></td>
    <td width="15%" bgcolor="#D9E8F3"><div align="center">Tanggal Lahir</div></td>
    <td width="13%" bgcolor="#D9E8F3"><div align="center">PRN</div></td>
    <td width="7%" bgcolor="#D9E8F3"><div align="center">Tanggal Daftar</div></td>
    <td width="14%" bgcolor="#D9E8F3"><div align="center">Jam Daftar</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Klinik 1</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Klinik 2</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Klinik 3</div></td>
 </tr>
  <?php
// koneksi ke mysql
include "../librari/inc.koneksidb.php";
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.batal='No' ORDER BY jam_reg";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><? echo $data['nama'];?></a></td>
    <td class="style1"><div align="center"><a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><? echo $data['tgl_lahir'];?></a></div></td>
    <td class="style1"><div align="center"><a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><? echo $data['prn'];?></a></div></td>
    <td class="style1"><a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><? echo $data['tgl_reg'];?></a></td>
    <td class="style1"><a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><? echo $data['jam_reg'];?></a></td>
    <td class="style1"><div align="center"><a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"></a>
     <a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><? echo $data['klinik1'];?></a></div></td>
    <td class="style1"><div align="center"><a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><? echo $data['klinik2'];?></a></div></td>
<td class="style1"><div align="center"><a href="batal_sim.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><? echo $data['klinik3'];?></a></div></td>
  </tr>
  <?php
}
?>
  <?php
$query = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.batal='No'";
$hasil = mysql_query($query);
$num_rows = mysql_num_rows($hasil);
?>
  <tr bgcolor="#FFFFFF">
    <td>Jumlah</td>
    <td colspan="7"><? echo $num_rows;?></td>
  </tr>
</table>
</body>
</html>

