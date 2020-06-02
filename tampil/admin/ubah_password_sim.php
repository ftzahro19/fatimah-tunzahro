<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$username		= $_REQUEST['username'];
$password		= $_REQUEST['password'];
$password2		= $_REQUEST['password2'];
$password3		= $_REQUEST['password3'];
 
$sql_cek = "SELECT * FROM user WHERE username='$username' 
		    AND password=PASSWORD('$password')";
$qry_cek = mysql_query($sql_cek, $koneksi) 
		   or die ("Gagal Cek".mysql_error());
$data = mysql_num_rows($qry_cek);
$data = mysql_fetch_array($qry_cek);


if ($data >=1&&$password2!=$password3) {
   echo "<div align='center'>PASSWORD BARU TIDAK SAMA</div>";
	include "ubah_password.php"; 
	exit;
}
elseif ($data <1&&$password2==$password3) {
   echo "<div align='center'>PASSWORD LAMA TIDAK SESUAI</div>";
	include "ubah_password.php"; 
	exit;
}
elseif ($data >=1&&$password2==$password3) {
    echo "<div align='center'>PASSWORD BERHASIL DIUPDATE !</div>";
	$sql  = " UPDATE user SET password=PASSWORD('$password3') WHERE username='$username' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
	include "../staff/index.php";
	exit;
}
else {
	echo "<div align='center'>PASSWORD LAMA TIDAK SESUAI atau PASSWORD BARU TIDAK SAMA</div>";
	include "ubah_password.php"; 
	exit;
}

?>
