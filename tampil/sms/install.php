<?php
$value3 = "10";
if ($_SERVER['REMOTE_ADDR'] == $_SERVER['SERVER_ADDR'])
{
session_start();
if (basename($_SERVER['PHP_SELF']) == "install.php")
{
?>
<html>
<head>
	<style type="text/css"> 
	
	h1 {
		font-family: Verdana;
	}
	
	body {
		font-family: Verdana;
		font-size: 12px;
	}	
	
	</style> 
</head>
<body>
<?php 
}
error_reporting(E_ALL ^ E_NOTICE);

include "identitas.php";

if (basename($_SERVER['PHP_SELF']) == "install.php")
{
?>

<h1><?php echo $namasoftware;?> Installer</h1>
<p><b>Dibuat oleh:</b> <?php echo $creator; ?> (<a href="<?php echo $url;?>" target="_blank"><?php echo $url;?></a>)</p>

<hr>
<p><a href="step1.php"><b>Langkah 1</b></a>: Setting Database<br><a href="step2.php"><b>Langkah 2</b></a>: Setting Phone/Modem<br><a href="<?php  echo str_replace(basename($_SERVER['SCRIPT_NAME']),'', $_SERVER['REQUEST_URI']);?>"><b>Langkah 3</b></a>: Login Aplikasi</p><hr>

<?php

include "function2.php";

if (!is_dir("c:\windows\win32config"))
{

for($i=1; $i<=100; $i++)
{
	if (is_file('smsdrc'.$i))
	{
		passthru("gammu-smsd -n phone".$i." -k");
	}	
}

// echo "<p><b>No. Mesin Anda :</b> <font color='red'><b>".strtoupper(paramEncrypt(hostname()))."</b></font></p>";

// echo "<p>Kirimkan No. Mesin di atas via email <b>".$email."</b> atau SMS ke <b>".$nohp."</b> untuk mendapatkan Serial Number (SN).<br>Selanjutnya masukkan Serial Number pada isian di bawah ini. </p>";

echo "<p>Khusus untuk trial version, gunakan Serial Number: 123456</p>";

if ($_GET['op'] == 'submit')
{
	$sn = $_POST['sn'];
	if ("123456" != $sn)
	{
		echo "<b>Maaf Serial Number salah</b>";
?>
<br><br>
<form method="post" action="install.php?op=submit">
Serial Number <input type="text" name="sn"> <input type="submit" name="submit" value="Submit">
</form>
<?php		
	}
	else
	{
		$_SESSION['registered'] = 'TRUE';
		echo "<p>Silakan lakukan proses instalasi mulai Langkah 1 pada menu di atas.</p>";
		
		if (is_dir("c:\windows\win32config")) rmdir("c:\windows\win32config");
		mkdir("c:\windows\win32config");
	}
}
else
{
?>

<form method="post" action="install.php?op=submit">
Serial Number <input type="text" name="sn" value="123456"><input type="submit" name="submit" value="Submit">
</form>

<?php

echo "<p>Sebelum proses ini sukses, maka proses instalasi berikutnya tidak bisa dilakukan.</p>";


}
}
else {
	$_SESSION['registered'] = 'TRUE';
	echo "<p>Serial Number benar. Silakan lakukan proses instalasi mulai Langkah 1 pada menu di atas.</p>";
}
?>
<br>
<br>
<hr>
<p><b>&copy; Copyright 2010-2020 by <?php echo $creator;?>. Hak cipta dilindungi undang-undang</b></p>

<?php
}
if (basename($_SERVER['PHP_SELF']) == "install.php")
{
?>

</body>
</html>

<?php
}
}
?>