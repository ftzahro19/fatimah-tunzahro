<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style2 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body>
<?php
$page	= $_GET['page'];

if ($page=='muka') {
	if(file_exists ("muka.php")) {
		include "muka.php";
		}
		else {
		echo "<div align='left' class='style3'>Halaman muka tidak ada!</div>";
		}
	}

if ($page=="infus") {
	if(file_exists ("infus.php")) {
		include "infus.php";
		}
		else {
		echo "<div align='left' class='style3'>Rumus hitung infus tidak ada!</div>";
		}
	}
	
if ($page=="tpm") {
	if(file_exists ("tpm.php")) {
		include "tpm.php";
		}
		else {
		echo "<div align='left' class='style3'>Rumus hitung dosis obat tidak ada!</div>";
		}
	}

if ($page=="pump") {
	if(file_exists ("pump.php")) {
		include "pump.php";
		}
		else {
		echo "<div align='left' class='style3'>Rumus hitung dosis obat tidak ada!</div>";
		}
	}
?>
</body>
</html>