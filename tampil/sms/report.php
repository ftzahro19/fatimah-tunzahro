<?php
include "cek.php";
if ($idsession != "")
{
include "menu.php";
?>

				<h2 class="title">Outbox SMS</h2>
				
				<div class="entry">
<img src="images/outbox.jpg" style="float: right;">
<p>&nbsp;</p>
<p>&nbsp;</p>				
					<p>
					<?php
					if ($_GET['op'] == "hapus")
{
   $query = "DELETE FROM sentitems";
   mysql_query($query);
   $query = "DELETE FROM sms_sentmsg";
   mysql_query($query); 
   echo "<p>Semua data outbox sudah dihapus</p>";   
}
else if ($_GET['op'] == "del")
{
   $query = "DELETE FROM outbox";
   mysql_query($query);
   $query = "DELETE FROM outbox_multipart";
   mysql_query($query);
   echo "<p>Semua SMS yang akan dikirim sudah dibatalkan</p>";   
} 
else if ($_GET['op'] == "resend")
{
   $query = "SELECT ID, DestinationNumber, SenderID, CreatorID FROM sentitems WHERE status = 'SendingError' GROUP BY ID";	
   $hasil = mysql_query($query);
   while ($data = mysql_fetch_array($hasil))
   {
	  $creatorid = $data['CreatorID'];
	  $sender = $data['SenderID'];
	  $destination = $data['DestinationNumber'];
	  $id = $data['ID'];
	
      $query2 = "SELECT textdecoded FROM sms_temp WHERE id = '$creatorid'";
      $hasil2 = mysql_query($query2);
      $data2  = mysql_fetch_array($hasil2);
      $text   = $data2['textdecoded']; 	  
   
	  if (get_magic_quotes_gpc() == 1)
	  {
		$text = str_replace("'", "\'", $text);
		$text = str_replace('"', '\"', $text);
	  }	
	  
 	  send2($destination, $text, $sender, '-1', $creatorid);
	  
	  $query = "DELETE FROM sentitems WHERE ID = '$id'";
	  mysql_query($query);
	  $query = "DELETE FROM outbox_multipart WHERE ID = '$id'";
	  mysql_query($query);
	  $query = "DELETE FROM outbox WHERE ID = '$id'";
	  mysql_query($query);
   }
   
   echo "<div id='sms'></div>";
}
else if ($_GET['op'] == 'queue')
{

$dataPerPage = 5;
 
if(isset($_GET['page']))
{
    $noPage = $_GET['page'];
} 
else $noPage = 1;
  
$offset = ($noPage - 1) * $dataPerPage;

if ($_GET['act'] == 'cancel')
{
	$id = $_GET['id'];
	$query = "DELETE FROM outbox WHERE ID = '$id'";
	mysql_query($query);
	$query = "DELETE FROM outbox_multipart WHERE ID = '$id'";
	mysql_query($query);
}

?>
<h3>Antrian SMS Keluar</h3>
<?php

$query = "SELECT * FROM outbox ORDER BY ID DESC LIMIT $offset, $dataPerPage";
$hasil = mysql_query($query);

echo "<table id='tabelku' width='100%'>";
echo "<tr><th>NO TUJUAN</th><th>PESAN SMS</th><th>STATUS</th></tr>";
while ($data = mysql_fetch_array($hasil))
{
	$id = $data['ID'];
	$notujuan = $data['DestinationNumber'];
	$sender = $data['SenderID'];
	$query2 = "SELECT * FROM outbox_multipart WHERE ID = '$id' ORDER BY SequencePosition";
	$hasil2 = mysql_query($query2);
	$text = $data['TextDecoded'];
	while ($data2 = mysql_fetch_array($hasil2))
	{
      $text .= $data2['TextDecoded'];
	}
	
	$query2 = "SELECT nama FROM sms_phonebook WHERE noTelp = '$notujuan'";
	$hasil2 = mysql_query($query2);
	if (mysql_num_rows($hasil2) > 0)
	{
		$data2  = mysql_fetch_array($hasil2);
		$nama   = $data2['nama'];
	}
	else $nama = $notujuan;
	
	if ($i % 2 == 0) $style = "genap";
    else $style = "ganjil";
   
    echo "<tr valign='top' class='".$style."'><td>".$nama."</td><td><small>Dikirim Melalui :<b>".$sender."</b></small><br><br>".$text."</td><td>(<a href='report.php?op=queue&act=cancel&id=".$id."&page=".$noPage."'>Batalkan</a>)</td></tr>";
    $i++;
}

echo "</table><br>";

$query   = "SELECT count(*) as jumData FROM outbox";
$hasil  = mysql_query($query);
$data     = mysql_fetch_array($hasil);
 
$jumData = $data['jumData'];

 
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
 
$jumPage = ceil($jumData/$dataPerPage);
 
// menampilkan link previous

echo "Halaman: "; 
if ($noPage > 1) echo  "<a href='report.php?op=queue&page=".($noPage-1)."'>&lt;&lt; Prev</a>";
 
// memunculkan nomor halaman dan linknya
 
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='report.php?op=queue&page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
// menampilkan link next
 
if ($noPage < $jumPage) echo "<a href='report.php?op=queue&page=".($noPage+1)."'>Next &gt;&gt;</a>";


}
else if ($_GET['op'] == "resend2")
{
   $id = $_GET['id'];
   $query = "SELECT DestinationNumber, SenderID, CreatorID FROM sentitems WHERE ID = '$id'";	
   $hasil = mysql_query($query);
   $data = mysql_fetch_array($hasil);
  
	  $creatorid = $data['CreatorID'];
	  $sender = $data['SenderID'];
	  $destination = $data['DestinationNumber'];
	
      $query2 = "SELECT textdecoded FROM sms_temp WHERE id = '$creatorid'";
      $hasil2 = mysql_query($query2);
      $data2  = mysql_fetch_array($hasil2);
      $text   = $data2['textdecoded']; 	  
   
	  if (get_magic_quotes_gpc() == 1)
	  {
		$text = str_replace("'", "\'", $text);
		$text = str_replace('"', '\"', $text);
	  }	
	  
 	  send2($destination, $text, $sender, '-1', $creatorid);
	  
	  $query = "DELETE FROM sentitems WHERE ID = '$id'";
	  mysql_query($query);
	  $query = "DELETE FROM outbox_multipart WHERE ID = '$id'";
	  mysql_query($query);
	  $query = "DELETE FROM outbox WHERE ID = '$id'";
	  mysql_query($query);
   
   
   echo "<div id='sms'></div>";
}
else if ($_GET['op'] == "show")
{
					?>
					
					<div id="sms">
                    </div>
<?php
}
?>					
					</p>
				</div>
			</div>
			</div>
			</div>
			
		<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<h2>Sub menu</h2>
					<ul>
					    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=show&page=1">Outbox</a></li>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=queue&page=1">Antrian SMS</a></li>
						<li><a href="export.php?op=report">Export Outbox ke Excel</a></li>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=hapus" onclick="return konfirm('OUTBOX')">Hapus Semua Outbox</a></li>
						<?php
						if (isset($_SESSION['login']))
						{
						echo '<li><a href="indeks.php?op=logout">Logout</a></li>';
						}
						?>
					</ul>
				</li>
			
				
			</ul>
			<img src="images/sms.jpg">
		</div>
		
<?php
}
else exit;
include "footer.php";
?>