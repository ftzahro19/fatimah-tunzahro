<?php
include "../librari/inc.koneksidb.php";

$kd_kunjungan = $_REQUEST['kd_kunjungan'];
$username = $_REQUEST['username'];
$kd_tm = $_REQUEST['kd_tm'];
$keterangan_tm = $_REQUEST['keterangan_tm'];
$nama_tm = $_REQUEST['nama_tm'];

if (isset($_GET['action'])) {
if ($_GET['action'] == "selesai")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['tm'.$i]))
     {
       $tm = $_POST['tm'.$i];
       $kd_tm = $_POST['kd_tm'.$i];
	   $status_tm = $_POST['status_tm'.$i];
       $query = "UPDATE tm SET status_tm='Selesai' WHERE kd_kunjungan='$tm' AND kd_tm='$kd_tm'";
       mysql_query($query);

     }
   }
}
}
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
exit();
?>