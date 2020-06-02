<?php
$dbUser = "root";
$dbPass = "12345678";
$dbName = "klinikdb";
$dbHost = "localhost";

mysql_connect($dbHost, $dbUser, $dbPass);
mysql_select_db($dbName);
?>