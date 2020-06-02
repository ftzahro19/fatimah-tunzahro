<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['kd_tm'.$i]))
     {
   $kd_kunjungan = $_POST['kd_kunjungan'];
   $tanggal_tm 		= $_POST['tanggal_tm'];
   $jam_tm 		= $_POST['jam_tm'];
   $kd_tm 		= $_POST['kd_tm'.$i];
   $kd_tm 		= $_POST['kd_tm'.$i];
   $nama_tm 		= $_POST['nama_tm'.$i];
   $qty_tm 			= $_POST['qty_tm'];
   $harga_tm   		= $_POST['harga_tm'.$i];
   $jasa_tm   		= $_POST['jasa_tm'.$i];
   $username 		= $_SESSION['klinik'];
   $keterangan_tm  	= $_POST['keterangan_tm'.$i];
   $operator   		= $_POST['operator'];
   {
      $query = "INSERT INTO tm (kd_kunjungan,tanggal_tm,jam_tm,kd_tm,nama_tm,qty_tm,harga_tm,jasa_tm,unit,keterangan_tm,username,operator,status_tm) 
	  VALUES('$kd_kunjungan','$tanggal_tm','$jam_tm','$kd_tm','$nama_tm','1','$harga_tm','$jasa_tm','Rajal','$keterangan_tm','$username','$operator','Order')";
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