<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$batal		= $_REQUEST['batal'];
 
	$sql  = " UPDATE reg SET batal='Batal'
		WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($sql, $koneksi) 
		  or die ("Maaf, proses pembatalan gagal !");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
        $prn = $_GET['kd_kunjungan'];
	$sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
	$no++;
  ?>
<meta http-equiv="refresh" content="1;url=batal.php?kd_kunjungan=<? echo $data['kd_kunjungan'];?>" />
<?php
}
?>
<title>Terima kasih !</title>
</head>
<body>
<h3 align="center">Sedang menyimpan...</h3>
<h3 align="center"><img src="../image/loading2.gif"/></h3>
</div>
</body>
</html>
