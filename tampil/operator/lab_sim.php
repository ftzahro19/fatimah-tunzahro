<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

$n = $_POST['n'];
for ($i=0; $i<=$n-1; $i++)
   {
   if (isset($_POST['lx'.$i]))
   {
   $kd_kunjungan = $_POST['kd_kunjungan'];
   $tanggal_lab = $_POST['tanggal_lab'];
   $jam_lab   	= $_POST['jam_lab'];
   $lx 			= $_POST['lx'.$i];
   $nama_lab	= $_POST['nama_lab'.$i];
   $dr_pengirim	= $_POST['dr_pengirim'];
   $harga_lab 	= $_POST['harga_lab'.$i];
   $keterangan 	= $_POST['keterangan'.$i];
   {
      $query = "INSERT INTO lab (kd_kunjungan,tanggal_lab,jam_lab,kd_lab,nama_lab,harga_lab,dr_pengirim,keterangan,status) 	
	  			VALUES('$kd_kunjungan','$tanggal_lab','$jam_lab','$lx','$nama_lab','$harga_lab','$dr_pengirim','$keterangan','Order')";
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