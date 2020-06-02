<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

$kd_tm 		= $_POST['kd_tm'];
$kd_kunjungan = $_POST['kd_kunjungan'];
$tanggal_tm   = $_POST['tanggal_tm'];
$jam_tm   = $_POST['jam_tm'];
$nama_tm = $_POST['nama_tm'];
$jasa_tm   		= $_POST['jasa_tm'.$i];
$operator   	= $_POST['operator'];
$username = $_SESSION['klinik'];
$jumMK = $_POST['jumMK'];


for($i = 1; $i <= $jumMK; $i++)
{
   $kd_tm 		= $_POST['kd_tm'.$i];
   $nama_tm 		= $_POST['nama_tm'.$i];
   $qty_tm 			= $_POST['qty_tm'.$i];
   $harga_tm   		= $_POST['harga_tm'.$i];
   $jasa_tm   		= $_POST['jasa_tm'.$i];
   $username 		= $_SESSION['klinik'];
   $keterangan_tm  	= $_POST['keterangan_tm'.$i];
   $operator   		= $_POST['operator'.$i];
   
   if (!empty($kd_tm))
   {
      $query = "INSERT INTO tm VALUES('$kd_kunjungan','$tanggal_tm','$jam_tm','$kd_tm','$nama_tm','1','$harga_tm','$jasa_tm','$keterangan_tm','$username','$operator','Order')";
      mysql_query($query);	  
   }
}    
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>