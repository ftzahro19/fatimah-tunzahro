<?php

  mysql_connect('localhost','root','12345678');
    mysql_select_db('latihan');

    $id      = $_GET['id'];
    $query   = "SELECT * FROM upload WHERE id = '$id'";
    $hasil  = mysql_query($query);
    $data = mysql_fetch_array($hasil);
 
    // header yang menunjukkan nama file yang akan didownload

    header("Content-Disposition: attachment; filename=".$data['name']);

    // header yang menunjukkan ukuran file yang akan didownload

    header("Content-length: ".$data['size']);

    // header yang menunjukkan jenis file yang akan didownload

    header("Content-type: ".$data['type']);

	$fp      = fopen("data/".$data['name'], 'r');
	$content = fread($fp, filesize('data/'.$data['name']));
	fclose($fp);

    echo $content;
	
    exit;

?>
