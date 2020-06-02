<?php
session_start();
include "config/config.php";
include_once "tampil/librari/inc.koneksidb.php";

$TxtUser   = $_POST['TxtUser'];
$TxtPasswd = $_POST['TxtPasswd'];

if (trim($TxtUser)=="") {
	echo "<div align='center'>USERNAME BELUM DIISI</div>";
	include "Login.php"; exit;
}
elseif (trim($TxtPasswd)=="") {
	echo "<div align='center'>PASSWORD BELUM DIISI</div>";
	include "".$url."Login.php"; exit;
}

$sql_cek = "SELECT * FROM user WHERE username='$TxtUser' 
		    AND password=PASSWORD('$TxtPasswd') AND status='Aktif'";
$qry_cek = mysql_query($sql_cek, $koneksi) 
		   or die ("Gagal Cek".mysql_error());
$data = mysql_num_rows($qry_cek);
$data = mysql_fetch_array($qry_cek);
if ($data >=1) {
        $_SESSION['klinik'] = $data['username'];
		$_SESSION['password'] = $data['password'];
        $_SESSION['nama'] = $data['nama_user'];

	header ("location: home.php");
	exit;
}
else {
	echo "<div align='center'>USER DAN PASSWORD TIDAK SESUAI</div>";
	include "Login.php"; 
	exit;
}
?>
 
