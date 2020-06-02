<?php 
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$prn		= $_REQUEST['prn'];
	$sql  = "DELETE FROM data_pasien WHERE prn='$prn' ";
	mysql_query($sql, $koneksi) 
		  or die ("Maaf, data belum berhasil di-update !");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="0;url=baru.php" />
<title>Data pasien berhasil disimpan !</title>
</head>
<body id="tab1">
<h3 align="center">Sedang menyimpan...</h3>
<h3 align="center"><img src="<?php echo $url;?>media/image/facebook.gif"/></h3>
</div>
</body>
</html>
