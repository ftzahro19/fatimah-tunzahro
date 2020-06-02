<?php
include "../../tampil/librari/config.php";
include "../../tampil/librari/inc.koneksidb.php";
include_once "../../tampil/librari/inc.session.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="jquery-1.2.1.min.js" type="text/javascript"></script>
<script src="menu.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Simple JQuery Accordion menu</title>
<!--[if lt IE 8]>
<style type="text/css">
li a {display:inline-block;}
li a {display:block;}
</style>
<![endif]-->
<style type="text/css">
body { background-image: url('hendi.jpg'); background-repeat: no-repeat; background-position: top left; background-attachment: scroll; }
</style>
</head>
<body oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;'>
<ul id="menu">
<li>
	<div align="center"><a href="#" align="center"><strong>M E N U</strong></a>    </div>
</li>
<?php 
$username = $_SESSION['klinik'];
$query1 ="SELECT * FROM menu,menu_user WHERE menu.kd_menu=menu_user.kd_menu AND menu_user.username='$username' GROUP BY menu.kd_menu ORDER BY menu.urutan ASC";
$result1 =mysql_query($query1) or die(mysql_error());
while($data1=mysql_fetch_array($result1)){
?>
<li>
	<a href="#"><?php echo $data1['nama_menu'];?></a>
	<ul>
<?php
$kd_menu = $data1['kd_menu'];
$query2 ="SELECT * FROM menu_sub,menu_user WHERE menu_sub.kd_sub_menu=menu_user.kd_sub_menu AND menu_sub.kd_menu='$kd_menu' AND menu_user.username='$username'  ORDER BY menu_sub.kd_sub_menu ASC";
$result2 =mysql_query($query2) or die(mysql_error());
while($data2=mysql_fetch_array($result2)){
?>
		<li><a href="<?php echo $data2['link'];?>" target="mainFrame"><?php echo $data2['nama_sub_menu'];?></a></li>
<?php
}
?>
	</ul>
</li>
<?php
}
?>
<li><a href="../../LoginOut.php" target="_top" >LOGOUT</a></li>
</ul>
</body>
</html>
