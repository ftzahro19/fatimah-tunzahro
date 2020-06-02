<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_gol_obat   = $_REQUEST['kd_gol_obat'];
$gol_obat   = $_REQUEST['gol_obat'];

$sql  = " INSERT INTO gol_obat (kd_gol_obat,gol_obat)";
$sql .= "VALUES ('$kd_gol_obat','$gol_obat')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="0;url=obat_gol_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Golongan o bat berhasil ditambahkan !</h2>
</div>
</body>
</html>
