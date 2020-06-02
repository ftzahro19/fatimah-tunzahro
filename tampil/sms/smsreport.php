<?php
include "koneksi.php";

$dataPerPage = 20;
 
if(isset($_GET['page']))
{
    $noPage = $_GET['page'];
} 
else $noPage = 1;
  
$offset = ($noPage - 1) * $dataPerPage;

$query = "SELECT count(*) AS jum FROM outbox";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$belum = $data['jum'];

$query = "SELECT count(*) AS jum FROM sentitems WHERE status = 'SendingError'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$error = $data['jum'];

$query = "SELECT count(*) AS jum FROM sentitems WHERE status LIKE 'SendingOK%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$sukses = $data['jum'];

echo "<h2>Statistik SMS</h2><br>";
echo "<table>";
echo "<tr valign='top'><td><b>SMS Belum Terkirim</b></td><td>:</td><td>".$belum." &lt;&lt; <a href='report.php?op=del'>Batalkan Semua SMS</a>  |  <a href='report.php?op=queue&page=1'>Lihat Antrian SMS</a> &gt;&gt;</td></tr>";
echo "<tr valign='top'><td><b>SMS Gagal Terkirim</b></td><td>:</td><td>".$error." &lt;&lt; <a href='report.php?op=resend&page=1'>Kirim Kembali</a> &gt;&gt;</td></tr>";
echo "<tr><td><b>SMS Sukses Terkirim</b></td><td>:</td><td>".$sukses."</td></tr>";
echo "</table>";
echo "<br>";
echo "<table id='tabelku' width='100%'>";
echo "<tr><th>NO TUJUAN</th><th>PESAN SMS</th><th>STATUS</th></tr>";
$query = "SELECT DISTINCT ID FROM sentitems ORDER BY SendingDateTime DESC LIMIT $offset, $dataPerPage";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
   $id = $data['ID'];
   $query2 = "SELECT * FROM sentitems WHERE ID = '$id' ORDER BY SequencePosition";
   $hasil2 = mysql_query($query2);
   $text = "";
   while ($data2 = mysql_fetch_array($hasil2))
   {
      $text .= $data2['TextDecoded'];
	  if ($data2['SequencePosition'] == 1)
	  {
		$status = $data2['Status'];
		$sender = $data2['SenderID'];
		$time = $data2['SendingDateTime'];
		$destination = $data2['DestinationNumber'];
	  }	  
   }
   
   $notelp = $destination;
   $query2 = "SELECT nama FROM sms_phonebook WHERE noTelp = '$notelp'";
   $hasil2 = mysql_query($query2);
   if (mysql_num_rows($hasil2) > 0)
   {
		$data2  = mysql_fetch_array($hasil2);
		$nama   = $data2['nama'];
   }
   else $nama = $notelp;
   
   if ($i % 2 == 0) $style = "genap";
   else $style = "ganjil";
   
   echo "<tr valign='top' class='".$style."'><td>".$nama."</td><td><small><i>".$time." - Dikirim Melalui :<b>".$sender."</b></i></small><br><br>".$text."</td><td>".$status."<br><br>(<a href='report.php?op=resend2&id=".$id."&page=".$noPage."'>Kirim kembali</a>)</td></tr>";
   $i++;
}


echo "</table><br>";

$query   = "SELECT count(DISTINCT ID) AS jumData FROM sentitems";
$hasil  = mysql_query($query);
$data     = mysql_fetch_array($hasil);
 
$jumData = $data['jumData'];

 
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
 
$jumPage = ceil($jumData/$dataPerPage);
 
// menampilkan link previous

echo "Halaman: "; 
if ($noPage > 1) echo  "<a href='report.php?op=show&page=".($noPage-1)."'>&lt;&lt; Prev</a>";
 
// memunculkan nomor halaman dan linknya
 
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='report.php?op=show&page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
// menampilkan link next
 
if ($noPage < $jumPage) echo "<a href='report.php?op=show&page=".($noPage+1)."'>Next &gt;&gt;</a>";

?>