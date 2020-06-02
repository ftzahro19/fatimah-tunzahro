<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
$nama_klinik	= $_REQUEST['nama_klinik'];
$keterangan		= $_REQUEST['keterangan'];
$alamat1		= $_REQUEST['alamat1'];
$alamat2		= $_REQUEST['alamat2'];
$telpon1		= $_REQUEST['telpon1'];
$telpon2		= $_REQUEST['telpon2'];
$email			= $_REQUEST['email'];
$fax			= $_REQUEST['fax'];

 
	$sql  = " UPDATE data_klinik SET
			  	nama_klinik ='$nama_klinik',
				keterangan ='$keterangan',
				alamat1  ='$alamat1',
				alamat2  ='$alamat2',
				telpon1    ='$telpon1',
				telpon2	 ='$telpon2',
				email	  ='$email',
				fax	   ='$fax'
                WHERE kode='$kode' ";
	mysql_query($sql, $koneksi) 
		  or die ("SQL Error".mysql_error());
		  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="0;url=user_view.php" />
<title>Terima kasih !</title>
</head>
<body>
<h1>Okay !!</h1>
<h2>Database staff berhasil diupdate !</h2>
</div>
</body>
</html>
