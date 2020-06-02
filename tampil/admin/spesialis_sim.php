<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_klinik		= $_REQUEST['kd_klinik'];
$kategori   = $_REQUEST['kategori'];
$nama_klinik		= $_REQUEST['nama_klinik'];

$sql  = " INSERT INTO klinikdb (kd_klinik,kd_gol_tm,nama_klinik)";
$sql .= "VALUES ('$kd_klinik','$kategori','$nama_klinik')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="2;url=spesialis_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Spesialisasi berhasil ditambahkan !</h2>
</div>
</body>
</html>
