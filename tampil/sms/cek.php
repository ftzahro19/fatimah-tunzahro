<?php
session_start();
include "config.php";
include "function2.php";
include "koneksi.php";
include "send.php";
include "function.php";
include "identitas.php";
include "install.php";
include "step1.php";
include "step2.php";
 
$idsession = "9";

if (($value1 != "10") || ($value2 != "10") || ($value3 != "10"))
{
	exit;
}

if (!isset($_SESSION['login']))
{
echo "<hr><h1>".$namasoftware."</h1><hr><h3>Anda belum login</h3><p>Silakan login dahulu <a href='index.php'>di sini</a></p>";
exit;
}

if (!is_dir("c:\windows\win32config"))
{
	echo "<hr><h1>".$namasoftware."</h1><hr><h3>Anda belum melakukan instalasi dengan sukses, silakan lakukan instalasi <a href='install.php'>di sini</a></h3></p>";
	exit;
}

?>