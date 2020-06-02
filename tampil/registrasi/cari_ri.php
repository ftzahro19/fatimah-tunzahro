<html>
<head>
<title>Terima kasih !</title>

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
    <td width="26%" bgcolor="#D9E8F3"><div align="center">Nama</div></td>
    <td width="17%" bgcolor="#D9E8F3"><div align="center">Tanggal Lahir</div></td>
    <td width="13%" bgcolor="#D9E8F3"><div align="center">PRN</div></td>
    <td width="38%" bgcolor="#D9E8F3"><div align="center">Alamat</div></td>
    <td width="6%" bgcolor="#D9E8F3"><div align="center">Sex</div></td>
  </tr>
  <?php
// koneksi ke mysql
include "../librari/inc.koneksidb.php";
// query untuk mencari file berdasarkan kategori
$query1 = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.tindak_lanjut='Rawat' AND selesai!='Selesai' AND selesai!='Rawat'";
$hasil1 = mysql_query($query1);
while ($data = mysql_fetch_array($hasil1))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><a href="baru_edit2.php?prn=<?php echo $data['prn'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan'];?>"><?php echo $data['nama'];?></a></td>
    <td class="style1"><div align="center"><a href="baru_edit2.php?prn=<?php echo $data['prn'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan'];?>"><?php echo $data['tgl_lahir'];?></a></div></td>
    <td class="style1"><div align="center"><a href="baru_edit2.php?prn=<?php echo $data['prn'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan'];?>"><?php echo $data['prn'];?></a></div></td>
    <td class="style1"><a href="baru_edit2.php?prn=<?php echo $data['prn'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan'];?>"><?php echo $data['alamat'];?></a></td>
    <td class="style1"><div align="center"><a href="baru_edit2.php?prn=<?php echo $data['prn'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan'];?>"><?php echo $data['jenis_kelamin'];?></a><a href="baru_edit2.php?prn=<?php echo $data['prn'];?>"></a></div></td>
  </tr>
  <?php
}
?>
  <?php
$query2 = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.tindak_lanjut='Rawat' AND selesai!='Selesai' AND selesai!='Rawat'";
$hasil2 = mysql_query($query2);
$num_rows = mysql_num_rows($hasil2);
?>
  <tr bgcolor="#FFFFFF">
    <td>Jumlah</td>
    <td colspan="5"><? echo $num_rows;?></td>
  </tr>
</table>
</body>
</html>