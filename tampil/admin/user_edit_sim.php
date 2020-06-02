<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$username			= $_REQUEST['username'];
$password			= $_REQUEST['password'];
$nama				= $_REQUEST['nama'];
$level				= $_REQUEST['level'];
$kategori			= $_REQUEST['kategori'];
$spesialis			= $_REQUEST['spesialis'];
$alamat				= $_REQUEST['alamat'];
$kota				= $_REQUEST['kota'];
$hp					= $_REQUEST['hp'];
$telp				= $_REQUEST['telp'];
$email				= $_REQUEST['email'];
$tanggal_masuk		= $_REQUEST['tanggal_masuk'];
$photo				= $_FILES['userfile']['name'];
$status				= $_REQUEST['status'];
 
	$sql  = " UPDATE user SET
			  	nama_user ='$nama',
				level='$level',
		  		unit='$kategori',
				spesialis='$spesialis',
				alamat='$alamat',
				kota='$kota',
				hp='$hp',
				telp='$telp',
				email='$email',
				tanggal_masuk='$tanggal_masuk'
                WHERE username='$username' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
		  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="0;url=user_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Database staff berhasil diupdate !</h2>
</div>
</body>
</html>
