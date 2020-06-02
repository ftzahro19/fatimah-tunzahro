<?php 
include "../librari/inc.koneksidb.php";
include "inc.session.php";
include "../../config/config.php"; 

$username = $_REQUEST['username'];
if ($username !="") {
   $sql = "SELECT * FROM user WHERE username='$username'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $data['nama'];?></title>
</head>

<body>
<div align="center"><?php
	$username = $data['username'];
	$photo = $data['photo'];
	$jenis_kelamin = $data['jenis_kelamin'];
        if ($photo=="" & $jenis_kelamin=="LAKI-LAKI") {
	echo "<img src='../../media/photo/nopic_male.gif' width='300' height='400' align='middle' />";
	}
	elseif ($photo=="" & $jenis_kelamin=="PEREMPUAN") {
	echo "<img src='../../media/photo/nopic.gif' width='300' height='400' align='middle/>";
	}
	else {?>
	<a href="photo.php?username=<?php echo $data['username'];?>" title="<?php echo $data['nama'];?>" onClick="NewWindow(this.href,'name','320','420','yes');return false"><img src="../../media/photo/<?php echo $data['photo'];?>" width="300" height="400" align="middle"/></a>
	<?php
	}
	?>
<a href="upload_photo.php?username=<?php echo $data['username'];?>">Ganti photo</a></div>
</body>
</html>
