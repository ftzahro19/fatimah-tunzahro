<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

$n = $_POST['n'];
for ($i=0; $i<=$n-1; $i++)
   {
   if (isset($_POST['lx'.$i]))
   {
   $kd_kunjungan = $_POST['kd_kunjungan'];
   $tanggal_rad = $_POST['tanggal_rad'];
   $jam_rad   	= $_POST['jam_rad'];
   $rdx 			= $_POST['rdx'.$i];
   $nama_rad	= $_POST['nama_rad'.$i];
   $dr_pengirim	= $_POST['dr_pengirim'];
   $harga_rad 	= $_POST['harga_rad'.$i];
   $keterangan 	= $_POST['keterangan'.$i];
   {
      $query = "INSERT INTO rad (kd_kunjungan,tanggal_rad,jam_rad,kd_rad,nama_rad,harga_rad,dr_pengirim,keterangan,status) 	
	  			VALUES('$kd_kunjungan','$tanggal_rad','$jam_rad','$rdx','$nama_rad','$harga_rad','$dr_pengirim','$keterangan','Order')";
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