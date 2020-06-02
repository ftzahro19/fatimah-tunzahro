<?php
include "../librari/admin.session.php";
include "terbilang.php";
include "order_header.php";
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
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="20%" bgcolor="#D9E8F3"><div align="center">Kode Obat</div></td>
    <td width="15%" bgcolor="#D9E8F3"><div align="center">Kode Gol</div></td>
    <td width="13%" bgcolor="#D9E8F3"><div align="center">QTY DB</div></td>
    <td width="12%" bgcolor="#D9E8F3"><div align="center">Nama Obat</div></td>
    <td width="14%" bgcolor="#D9E8F3"><div align="center">Beli</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Jual</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Total</div></td>
 </tr>
  <?php
// koneksi ke mysql
include "../librari/inc.koneksidb.php";
include "../librari/inc.umum.php";
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM obat_db";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1"><a href="header.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>">
    <? echo $data['kd_obat'];?></a></td>
    <td class="style1"><div align="center"><a href="header.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>">
    <? echo $data['kd_gol_obat'];?></a></div></td>
    <td class="style1"><div align="center"><a href="header.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>">
    <? echo $data['qty_obat'];?></a></div></td>
    <td class="style1"><a href="header.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>">
    <? echo $data['nama_obat'];?></a></td>
    <td class="style1"><a href="header.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>">
    <? echo $data['harga_beli'];?></a></td>
<?php
$harga = ($data['harga_beli'] * 50/100 + $data['harga_beli']) ;
$sub_total = $harga * $data['qty_obat']; 
$harga_total = $harga_total + $sub_total;
?>
    <td class="style1"><a href="header.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>">
     <input name="harga_jual" type="text" id="harga_jual" size="8" value="<? echo $harga ;?>"></a></td>
    <td class="style1"><div align="center"><a href="header.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>"><input name="harga_jual" type="text" id="harga_jual" size="8" value="<? echo $sub_total ;?>"></a></div></td>
  </tr>
  <?php
}
?>
<?php  
$query ="SELECT harga_beli,qty_obat,SUM(harga_beli),SUM(qty_obat) FROM obat_db";
$result =mysql_query($query) or die(mysql_error());
while($data=mysql_fetch_array($result)){
	$no++;
  ?>
<tr bgcolor="#FFFFFF">
    <td width="20%" bgcolor="#FFFFFF"><div align="center"></div></td>
    <td width="15%" bgcolor="#FFFFFF"><div align="center"></div></td>
    <td width="13%" bgcolor="#FFFFFF"><div align="center"></div></td>
    <td width="12%" bgcolor="#FFFFFF"><div align="center"></div></td>
    <td width="14%" bgcolor="#FFFFFF"><div align="center"></div></td>
    <td width="11%" bgcolor="#FFFFFF"><div align="center"></div></td>
    <td width="11%" bgcolor="#FFFFFF"><div align="center"><? echo $harga_total;?></div></td>
 </tr>
<tr bgcolor="#FFFFFF">
    <td width="20%" bgcolor="#D9E8F3" colspan="7"><div align="right">Terbilang <? echo terbilang($harga_total);?> rupiah</div></td>
</tr>
<?php
}
?>
</table>
</body>
</html>


