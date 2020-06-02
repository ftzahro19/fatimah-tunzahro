<?php
include "../librari/inc.session.php";
include "../librari/inc.koneksidb.php";
?>
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
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#FFFFFF">
    <td width="5%" bgcolor="#D9E8F3"><div align="center">No</div></td>
    <td width="30%" bgcolor="#D9E8F3"><div align="center">Nama Obat</div></td>
    <td width="9%" bgcolor="#D9E8F3"><div align="center">Qty</div></td>
    <td width="28%" bgcolor="#D9E8F3"><div align="center">Harga</div></td>
    <td width="14%" bgcolor="#D9E8F3"><div align="center">Sub Total </div></td>
    <td width="14%" bgcolor="#D9E8F3"><div align="center"></div></td>
 </tr>
  <?php
// koneksi ke mysql
// query untuk mencari file berdasarkan kategori
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
$query = "SELECT * FROM data_pasien,reg,resep WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan=resep.kd_kunjungan AND resep.kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$num_rows = mysql_num_rows($hasil);
$no=1;
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><?php echo $no++;?></td>
    <td class="style1"><?php echo $data['nama_obat'];?></td>
    <td class="style1"><?php echo $data['qty'];?></td>
    <td class="style1"><?php echo $data['harga'];?></td>
    <td class="style1">
	<?php 
	$qty = $data['qty'];
	$harga = $data['harga'];
	$sub_total = $qty * $harga;
	$total = $total + $sub_total;
	echo "".$sub_total."";
	;?>
	</div></td>
    <td class="style1"><div align="center"><a href="reg_edit.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>">Lihat</a></div>  </td>
  </tr>
  <?php
}
$num_rows = mysql_num_rows($hasil);
?>
  <tr bgcolor="#FFFFFF">
    <td colspan="6">Total harga : Rp. <?php echo $total;?>,-</td>
  </tr>
</table>
</body>
</html>

