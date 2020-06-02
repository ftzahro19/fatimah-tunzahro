<?php
include "../librari/admin.session.php";
include "../librari/inc.koneksi.php";

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
<?php  
$query ="SELECT harga_beli,qty_obat,SUM(harga_beli),SUM(qty_obat) FROM obat_db";
$result =mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_array($result)){
	$no++;
  ?>
<?php
$harga = ($row['harga_beli'] * 50/100 + $row['harga_beli']) ;
$sub_total = $harga * $row['qty_obat']; 
$harga_total = $harga_total + $sub_total;
include "terbilang.php";
?>
<tr bgcolor="#FFFFFF">
    <td width="20%" bgcolor="#D9E8F3"><div align="center"><? echo terbilang($bil);?></div></td>
    <td width="15%" bgcolor="#D9E8F3"><div align="center">Hendi</div></td>
    <td width="13%" bgcolor="#D9E8F3"><div align="center"><? echo $row['SUM(qty_obat)'];?></div></td>
    <td width="12%" bgcolor="#D9E8F3"><div align="center"></div></td>
    <td width="14%" bgcolor="#D9E8F3"><div align="center"><? echo $row['SUM(harga_beli)'];?></div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center"><? echo $sub_total;?></div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center"><? echo $harga_total;?></div></td>
 </tr>
<?php
}
?>
</table>
</body>
</html>
