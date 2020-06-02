<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_obat   = $_REQUEST['kd_obat'];
$kd_gol_obat   = $_REQUEST['kd_gol_obat'];
$gol_obat   = $_REQUEST['gol_obat'];
$nama_obat   = $_REQUEST['nama_obat'];
$qty_obat   = $_REQUEST['qty_obat'];
$harga_beli   = $_REQUEST['harga_beli'];
$harga_jual   = $_REQUEST['harga_jual'];
$markup   = $_REQUEST['markup'];
$ppn   = $_REQUEST['ppn'];

$sql  = " INSERT INTO obat_db (kd_obat,gol_obat,nama_obat,qty_obat,harga_beli,harga_jual,markup,ppn)";
$sql .= "VALUES ('$kd_obat','$gol_obat','$nama_obat','$qty_obat','$harga_beli','$harga_jual','$markup','$ppn')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="0;url=obat_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Obat berhasil ditambahkan !</h2>
</div>
</body>
</html>
