<?php
include "../librari/inc.koneksidb.php";

$kd_kunjungan = $_POST['kd_kunjungan'];
$tanggal_rad   = $_POST['tanggal_rad'];
$jam_rad   = $_POST['jam_rad'];

$n = $_POST['n'];
for ($i=0; $i<=$n-1; $i++)
   {
   if (isset($_POST['rad'.$i]))
   {
   $kd_kunjungan 	= $_POST['kd_kunjungan'];
   $tanggal_rad   	= $_POST['tanggal_rad'];
   $jam_rad   		= $_POST['jam_rad'];
   $rad 			= $_POST['rad'.$i];
   $nama_rad		= $_POST['nama_rad'.$i];
   $harga_rad 		= $_POST['harga_rad'.$i];
   $dr_pengirim 	= $_POST['dr_pengirim'];
   $ket 			= $_POST['ket'.$i];
   {
      $query = "INSERT INTO rad (kd_kunjungan,tanggal_rad,jam_rad,kd_rad,nama_rad,harga_rad,dr_pengirim,unit,keterangan,status) VALUES('$kd_kunjungan','$tanggal_rad','$jam_rad','$rad','$nama_rad','$harga_rad','$dr_pengirim','Ranap','$ket','Order')";
      mysql_query($query);	  
   }
}    
}
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>

