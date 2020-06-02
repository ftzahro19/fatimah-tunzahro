<?php 
include "../librari/inc.koneksidb.php";

# Baca variabel Form (If Register Global ON)
$username			= $_REQUEST['username'];
$password			= $_REQUEST['password'];
$nama				= $_REQUEST['nama'];
$level				= $_REQUEST['level'];
$kategori				= $_REQUEST['kategori'];
$spesialis				= $_REQUEST['spesialis'];
$alamat				= $_REQUEST['alamat'];
$kota				= $_REQUEST['kota'];
$hp				= $_REQUEST['hp'];
$telp				= $_REQUEST['telp'];
$email				= $_REQUEST['email'];
$tanggal_masuk		= $_REQUEST['tanggal_masuk'];
$photo				= $_FILES['userfile']['name'];
$status				= $_REQUEST['status'];

$sql  = " INSERT INTO user (username,password,nama_user,level,unit,spesialis,alamat,kota,hp,telp,email,tanggal_masuk,photo,status)";
$sql .= "VALUES ('$username',PASSWORD('$password'),'$nama','User','$kategori','$spesialis','$alamat','$kota','$hp','$telp','$email','$tanggal_masuk','$photo','Aktif')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

$uploaddir = 'gambar/';
$fileName = $_FILES['userfile']['name'];     
$uploadfile = $uploaddir . $fileName;
// nama file temporary yang akan disimpan di server
$tmpName  = $_FILES['userfile']['tmp_name']; 
// ukuran file yang diupload
$fileSize = $_FILES['userfile']['size'];
// jenis file yang diupload
$fileType = $_FILES['userfile']['type'];


mysql_query($query);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="0;url=javascript:history.back()" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Data berhasil ditambahkan !</h2>
</div>
</body>
</html>
