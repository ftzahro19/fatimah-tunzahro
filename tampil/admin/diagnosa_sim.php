<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_diagnosa		= $_REQUEST['kd_diagnosa'];
$nama_diagnosa		= $_REQUEST['nama_diagnosa'];

$sql  = " INSERT INTO group_diagnosa (id_diagnosa,group_diagnosa)";
$sql .= "VALUES ('$kd_diagnosa','$nama_diagnosa')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="2;url=diagnosa_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Diagnosa berhasil ditambahkan !</h2>
</div>
</body>
</html>
