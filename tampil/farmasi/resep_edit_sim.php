<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

$kd_kunjungan = $_POST['kd_kunjungan'];
$tanggal_rx   = $_POST['tanggal_rx'];
$jam_rx   = $_POST['jam_rx'];
$rx = $_POST['kd_obat'];
$nama_obat = $_POST['nama_obat'];
$username = $_SESSION['username'];
$update   	= $_POST['status'];
$keterangan   	= $_POST['keterangan'];
$status   	= $_POST['status'];
$jumMK = $_POST['jumMK'];


for($i = 1; $i <= $jumMK; $i++)
{
   $rx 		= $_POST['rx'.$i];
   $nama_obat		= $_POST['nama_obat'.$i];
   $qty 		= $_POST['qty'.$i];
   $aturan   	= $_POST['aturan'.$i];
   $rute   	= $_POST['rute'.$i];
   $harga   	= $_POST['harga'.$i];
   $update   	= $_POST['status'.$i];
   $keterangan   	= $_POST['keterangan'.$i];
   if (!empty($rx))
   {
      $query = "INSERT INTO resep VALUES('$kd_kunjungan','$tanggal_rx','$jam_rx','$rx','$qty','$aturan','$rute','$harga','$username','$update','$keterangan','Order')";
      mysql_query($query);	  
   }
}    
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>
