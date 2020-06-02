<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

$uploaddir = 'data/';

$fileName = $_FILES['userfile']['name'];     

$uploadfile = $uploaddir . $fileName;

// nama file temporary yang akan disimpan di server

$tmpName  = $_FILES['userfile']['tmp_name']; 

// ukuran file yang diupload

$fileSize = $_FILES['userfile']['size'];

// jenis file yang diupload

$fileType = $_FILES['userfile']['type'];


mysql_connect('localhost','root','12345678');
    mysql_select_db('latihan');

// menyimpan file ke tabel upload dalam db

$query = "SELECT count(*) as jum FROM upload WHERE name = '$fileName'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);

if ($data['jum'] > 0)
{
   $query = "UPDATE upload SET size = '$fileSize' WHERE name = '$fileName'";
}
else $query = "INSERT INTO upload (name, size, type) VALUES ('$fileName', '$fileSize', '$fileType')";

mysql_query($query);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
include "list.php";
?> 
