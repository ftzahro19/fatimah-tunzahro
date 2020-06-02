<?php 
include "../librari/inc.koneksidb.php";
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
$uploaddir = '../staff/gambar/';
$fileName = $_FILES['userfile']['name'];     
$uploadfile = $uploaddir . $fileName;
// nama file temporary yang akan disimpan di server
$tmpName  = $_FILES['userfile']['tmp_name']; 
// ukuran file yang diupload
$fileSize = $_FILES['userfile']['size'];
// jenis file yang diupload
$fileType = $_FILES['userfile']['type'];

// menyimpan file ke tabel upload dalam db
$nik		= $_REQUEST['nik'];
$nama		= $_REQUEST['nama'];
$gambar		= $_REQUEST['gambar'];

$query = "SELECT count(*) as jum FROM biodata WHERE nama = '$fileName'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);

$sql  = " INSERT INTO biodata (nama,nik,gambar)";
$sql .= "VALUES ('$nama','$nik','$fileName')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

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
<meta http-equiv="refresh" content="2;url=staff_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Data berhasil ditambahkan !</h2>
</div>
</body>
</html>
