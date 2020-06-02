<?php
include "cari_daftar.php";
?>
<html>
<head>
<title>Terima kasih !</title>
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
$prn = $_REQUEST['prn'];
$nama = $_REQUEST['nama'];
$tgl_lahir = $_REQUEST['tgl_lahir'];
$query = "SELECT * FROM data_pasien WHERE prn='$prn' OR tgl_lahir='$tgl_lahir' OR nama='%$nama%'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><a href="reg.php?prn=<? echo $data['prn'];?>"><? echo $data['nama'];?></a></td>
    <td class="style1"><div align="center"><a href="reg.php?prn=<? echo $data['prn'];?>"><? echo $data['tgl_lahir'];?></a></div></td>
    <td class="style1"><div align="center"><a href="reg.php?prn=<? echo $data['prn'];?>"><? echo $data['prn'];?></a></div></td>
    <td class="style1"><a href="reg.php?prn=<? echo $data['prn'];?>"><? echo $data['alamat'];?></a></td>
    <td class="style1"><div align="center"><a href="reg.php?prn=<? echo $data['prn'];?>"><? echo $data['jenis_kelamin'];?></a><a href="reg.php?prn=<? echo $data['prn'];?>"></a></div></td>
  </tr>
  <?php
}
?>
  <?php
$query = "SELECT * FROM data_pasien WHERE nama='%$nama%' OR tgl_lahir='$tgl_lahir' OR prn='$prn'";
$hasil = mysql_query($query);
$num_rows = mysql_num_rows($hasil);
?>
  <tr bgcolor="#FFFFFF">
    <td>Jumlah</td>
    <td colspan="5"><? echo $num_rows;?></td>
  </tr>
</table>
</body>
</html>

