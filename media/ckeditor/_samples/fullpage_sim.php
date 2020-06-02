<?php
$my['host']	= "localhost";
$my['user']	= "root";
$my['pass']	= "12345678";
$my['dbs']	= "test";

$koneksi	= mysql_connect($my['host'], 
							$my['user'], 
							$my['pass']);
if (! $koneksi) {
  echo "Gagal koneksi boss..!";
  mysql_error();
}
mysql_select_db($my['dbs'])
	 or die ("Database nggak ada tuh".mysql_error());
	
# Baca variabel Form (If Register Global ON)
$no		= $_REQUEST['no'];
$fullpage	= $_REQUEST['fullpage'];

	$sql  = " INSERT INTO fullpage (fullpage)";
	$sql .=	" VALUES ('$fullpage')";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="2;url=fullpage_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Diagnosa berhasil ditambahkan !</h2>
</div>
</body>
</html>
