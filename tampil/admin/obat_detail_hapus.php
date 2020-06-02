<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$no	= $_REQUEST['no'];
$no_faktur	= $_REQUEST['no_faktur'];
$kd_obat	= $_REQUEST['kd_obat'];
$jumlah		= $_REQUEST['jumlah'];
$keterangan	= $_REQUEST['keterangan'];
 
	$sql  = "DELETE FROM obat_stock WHERE no='$no'";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
		   
	$sql1 = "SELECT * FROM obat_faktur WHERE no_faktur='$no_faktur'";
	$qry1 = mysql_query($sql1, $koneksi) 
		 or die ("SQL Error".mysql_error());
	$data1=mysql_fetch_array($qry1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="1;url=obat_detail_view.php?no_faktur=<?php echo $data1['no_faktur'];?>" />
<title>Hapus penambahan stock !</title>
</head>
<body>
<h1>Ops !!</h1>
<h2>Penambahan stock  berhasil dihapus!</h2>
</div>
</body>
</html>