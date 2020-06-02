<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_gol_tm		= $_REQUEST['kd_gol_tm'];
$gol_tm		= $_REQUEST['gol_tm'];

$sql  = " INSERT INTO gol_tm (kd_gol_tm,gol_tm)";
$sql .= "VALUES ('$kd_gol_tm','$gol_tm')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="1;url=kategori_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Kategori SDM berhasil ditambahkan !</h2>
</div>
</body>
</html>
