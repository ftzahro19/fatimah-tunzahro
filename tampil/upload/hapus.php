<?php

    mysql_connect('localhost','root','12345678');
    mysql_select_db('latihan');

    $id      = $_GET['id'];
    $query   = "SELECT * FROM upload WHERE id = '$id'";
    $hasil   = mysql_query($query);
    $data    = mysql_fetch_array($hasil);
    $namaFile = $data['name'];
	
	$query = "DELETE FROM upload WHERE name = '$namaFile'";
	mysql_query($query);
	
	unlink("data/".$namaFile);
	echo "File telah dihapus";

?>
