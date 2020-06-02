<?php
$my['host']	= "localhost"; //Biarkan seperti adanya
$my['user']	= "root"; // Username phpmyadmin
$my['pass']	= "12345678"; //Password phpmyadmin
$my['dbs']	= "klinikdb"; // Nama database yang kita buat

$koneksi	= mysql_connect($my['host'], 
							$my['user'], 
							$my['pass']);
if (! $koneksi) {
  echo "Gagal koneksi boss..!";
  mysql_error();
}
mysql_select_db($my['dbs'])
	 or die ("Database tidak ada dalam phpmyadmin !".mysql_error());
?>
