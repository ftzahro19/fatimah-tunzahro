<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$dokter			= $_REQUEST['dokter'];
$hari			= $_REQUEST['hari'];
$jam_mulai		= $_REQUEST['jam_mulai'];
$jam_selesai	= $_REQUEST['jam_selesai'];
$keterangan		= $_REQUEST['keterangan'];

$sql  = " INSERT INTO jadwal_praktek (kd_dokter,hari,jam_mulai,jam_selesai,keterangan)";
$sql .= "VALUES ('$dokter','$hari','$jam_mulai','$jam_selesai','$keterangan')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="1;url=jadwal_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Jadwal berhasil ditambahkan !</h2>
</div>
</body>
</html>
