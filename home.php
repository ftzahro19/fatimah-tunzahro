<?php
include "tampil/librari/inc.koneksidb.php";
include_once "tampil/librari/inc.session.php";
$sql = "SELECT * FROM data_klinik";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="head.css" />
<link rel="shortcut icon" href="media/image/logo_kareo.png" type="image/x-icon">
<title><?php echo "".$_SESSION['nama']."";?>@<?php echo $data['nama_klinik'];?></title>
</head>
<frameset rows="40, *" framespacing="0" frameborder="1" border="1">
<!-frame atas --> 
<frame src="head.php" name="topFrame" id="topFrame" scrolling="No" noresize="noresize"/> 
<frameset cols="20%, *"> 
<!-frame kiri --> 
<frame src="media/sidebar/index.php" name="leftFrame" id="leftFrame" scrolling="No"noresize="noresize"/>  
<!-frame tengah --> 
<frame src="tampil/index.php" name="mainFrame" id="mainFrame" noresize="noresize"/> 
<!-- Ini ditampilkan jika browser tidak support frame --> 
<noframes> 
Browser Tidak Suport Frame 
</noframes> </frameset> </frameset>
<body oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;'>
</body>
</html>