<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$kd_ruang   = $_REQUEST['kd_ruang'];
$ruang   = $_REQUEST['ruang'];
$kamar   = $_REQUEST['kamar'];
$kelas   = $_REQUEST['kelas'];
$harga   = $_REQUEST['harga'];

$sql  = " INSERT INTO ruang (ruang,kamar,kelas,harga)";
$sql .= "VALUES ('$ruang','$kamar','$kelas','$harga')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="1;url=ruangan_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Database ruangan berhasil ditambahkan !</h2>
</div>
</body>
</html>
