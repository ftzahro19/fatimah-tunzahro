<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";

$n = $_POST['n'];
for ($i=0; $i<=$n-1; $i++)
   {
   if (isset($_POST['rx'.$i]))
   {
   $kd_kunjungan = $_POST['kd_kunjungan'];
   $tanggal_rx   = $_POST['tanggal_rx'];
   $jam_rx   	 = $_POST['jam_rx'];
   $rx 			 = $_POST['rx'.$i];
   $nama_obat	 = $_POST['nama_obat'.$i];
   $qty 		 = $_POST['qty'.$i];
   $aturan   	 = $_POST['aturan'.$i];
   $rute   		 = $_POST['rute'.$i];
   $harga   	 = $_POST['harga'.$i];
   $username   	 = $_POST['username'];
   $update   	 = $_POST['status'.$i];
   $keterangan   = $_POST['keterangan'.$i];
   {
      $query = "INSERT INTO resep (kd_kunjungan,tanggal_rx,jam_rx,kd_obat,nama_obat,qty,aturan,rute,harga,username,farmasi,unit,keterangan,status)
	  VALUES('$kd_kunjungan','$tanggal_rx','$jam_rx','$rx','$nama_obat','$qty','$aturan','$rute','$harga','$username','$update','Rajal','$keterangan','Order')";
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

