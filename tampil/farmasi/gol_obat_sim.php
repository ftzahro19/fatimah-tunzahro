<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_gol_obat		= $_REQUEST['kd_gol_obat'];
$gol_obat		= $_REQUEST['gol_obat'];

 
	$sql  = " INSERT INTO gol_obat (kd_gol_obat,gol_obat)";
	$sql .=	" VALUES ('$kd_gol_obat','$gol_obat')";
	mysql_query($sql, $koneksi) 
		  or die ("Error, data tidak dapat disimpan !");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 

	$sql = "SELECT * FROM gol_obat";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
	$no++;
  ?>
<meta http-equiv="refresh" content="1;url=gol_obat.php?kd_gol_obat=<? echo $data['kd_gol_obat'];?>" />
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
