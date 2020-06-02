<?php 
include "../librari/inc.koneksidb.php";
	
# Baca variabel Form (If Register Global ON)
 
$query = "SELECT * FROM inbox WHERE Processed='true'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
   // baca inbox
$ID	= $_REQUEST['ID'];
$TextDecoded = $_REQUEST['TextDecoded'];
$SenderNumber = $_REQUEST['SenderNumber'];
$ReceivingDateTime = $_REQUEST['ReceivingDateTime'];

   // insert data ke tabel kirim
   $query2 = "INSERT INTO sms_inbox (msg,sender,time,flagRead,flagReply) VALUES ('$TextDecoded', '$SenderNumber', '$ReceivingDateTime','0','0')";
   $hasil2 = mysql_query($query2);

   // jika proses insert ke tabel kirim sukses maka kirim sms ucapan
   if ($hasil2)
   {
      // isi pesan SMS ucapan ultah, disertai nama temannya
	  $sql = "DELETE FROM inbox WHERE ID='$ID'";
	  
   }
}

?>

