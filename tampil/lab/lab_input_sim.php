<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";

$n = $_POST['n'];
for ($i=0; $i<=$n-1; $i++)
   {
   if (isset($_POST['lab'.$i]))
   {
   $tanggal_hasil	= $_POST['tanggal_hasil'];
   $jam_hasil		= $_POST['jam_hasil'];
   $lab 			= $_POST['lab'.$i];
   $dr_lab 			= $_POST['dr_lab'];
   $hasil 			= $_POST['hasil'.$i];
   {
   $query = "UPDATE lab SET tanggal_hasil='$tanggal_hasil',jam_hasil='$jam_hasil',hasil='$hasil',dr_lab='$dr_lab' WHERE id='$lab'";
      mysql_query($query);	  
   }
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
    $kd_kunjungan = $_GET['kd_kunjungan'];
	$sql = "SELECT * FROM lab WHERE kd_kunjungan='$kd_kunjungan'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
<meta http-equiv="refresh" content="1;url=lab_input.php?kd_kunjungan=<?php echo "".$data['kd_kunjungan']."";?>" />
<?php
}
?>
<title>Data berhasil disimpan !</title>
</head>
<body id="tab1">
<h3 align="center">Sedang menyimpan...</h3>
<h3 align="center"><img src="<?php echo $url;?>media/image/facebook.gif"/></h3>
</div>
</body>
</html>