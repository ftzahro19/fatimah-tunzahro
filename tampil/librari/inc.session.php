<?php
session_start();
include "config.php";
if(!isset ($_SESSION['klinik'])) {

	echo "<div align=center><h1><b></b></h1></br></div>";
	echo "<p align=center> </p>";
	include "Login.php";
	exit;
}
?>