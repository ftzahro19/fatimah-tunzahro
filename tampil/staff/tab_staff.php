<?php 
include "../../config/config.php"; 
include "../librari/inc.koneksidb.php"; 
include "../librari/inc.session.php";

	$username = $_SESSION['klinik'];
	$sql = "SELECT * FROM user WHERE username='$username'";
	$qry = mysql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" type="text/css" href="<? echo $url;?>media/css/tab.css" />
</head>
<body>
<ul id="tabnav">
<li class="tab1"><a href="index.php" title="Informasi pribadi">Info</a></li>
<li class="tab2"><a href="photo.php" title="Photo">Photo</a></li>
</ul>
</body>
</html>
