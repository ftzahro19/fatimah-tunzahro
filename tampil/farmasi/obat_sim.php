<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_obat		= $_REQUEST['kd_obat'];
$kd_gol_obat		= $_REQUEST['kd_gol_obat'];
$nama_obat		= $_REQUEST['nama_obat'];
$harga_beli		= $_REQUEST['harga_beli'];
$harga_jual		= $_REQUEST['harga_jual'];
$qty_obat		= $_REQUEST['qty_obat'];
$discount		= $_REQUEST['discount'];


 
	$sql  = " INSERT INTO obat_db (kd_obat,kd_gol_obat,nama_obat,harga_beli,harga_jual,qty_obat,discount)";
	$sql .=	" VALUES ('$kd_obat','$kd_gol_obat','$nama_obat','$harga_beli','$harga_jual','$qty_obat','$discount')";
	mysql_query($sql, $koneksi) 
		  or die ("Error, data tidak dapat disimpan !".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 

	$sql = "SELECT * FROM obat_db";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
	$no++;
  ?>
<meta http-equiv="refresh" content="1;url=obat_db.php?kd_obat=<? echo $data['kd_obat'];?>" />
<?php
}
?>
<title>Terima kasih !</title>
</head>
<body>
<h3 align="center">Sedang menyimpan...</h3>
<h3 align="center"><img src="../image/loading2.gif"/></h3>
</div>
</body>
</html>
