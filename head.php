<?php
include "tampil/librari/inc.koneksidb.php";
include "tampil/librari/inc.session.php";
include "menu3.php";
include "menu4.php";
include "menu5.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="media/css/style.css" type="text/css" />
</head>
<body>

	<div id="container">
		<div id="wrapper">
        <div id="top">
	<!-- motto -->
	<ul class="motto">
	<li class="left"></li>
	<li><a href="home.php" target="_Parent"><?php echo "".$_SESSION['nama']."";?>@SIK V1.0</a>
	</li>
	</ul> 
	<!-- / motto -->
	</div> 
<!-- / top -->
 	</div><!-- / end wrapper -->
	</div><!-- / end container -->
</body>
</html>
