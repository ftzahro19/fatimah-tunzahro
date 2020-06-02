<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$kd_kunjungan	= $_REQUEST['kd_kunjungan'];
$status		= $_REQUEST['status'];
$batal		= $_REQUEST['batal'];
$bydate1	= $_REQUEST['tgl_reg'];
 
	$sql  = " UPDATE reg SET batal='Tidak' WHERE kd_kunjungan='$kd_kunjungan' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="2;url=proses_pembatalan.php?bydate1=<?php echo $bydate1;?>" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Transaksi sudah aktif kembali</h2>
</div>
</body>
</html>
