<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$faktur	= $_REQUEST['faktur'];
$no_faktur	= $_REQUEST['no_faktur'];
$tanggal	= $_REQUEST['tanggal'];
$user		= $_REQUEST['user'];
$keterangan	= $_REQUEST['keterangan'];
 
	$sql  = " UPDATE obat_faktur SET
				tanggal='$tanggal',
				user='$user',
				faktur='$faktur',
				keterangan='$keterangan'
                WHERE no_faktur='$no_faktur'";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
		  
	$sql2  = " UPDATE obat_stock SET
				keterangan='$keterangan'
                WHERE no_faktur='$no_faktur'";
	mysql_query($sql2, $koneksi) 
		  or die ("SQL Error".mysql_error());
		  
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();  
?>