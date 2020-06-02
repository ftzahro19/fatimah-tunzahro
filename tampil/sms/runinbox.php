<?php
if (is_dir("c:\windows\winconfig"))
{
include "koneksi.php";
$dataPerPage = 20;
 
if(isset($_GET['page']))
{
    $noPage = $_GET['page'];
} 
else $noPage = 1;
  
$offset = ($noPage - 1) * $dataPerPage;

?>
<form name="myform" method="post" action="inbox.php?op=delmulti">
<table border="0" width="100%" style="font-size: 11px;" id="tabelku">
<tr><th><input type='checkbox' name='pilih' onclick='pilihan()' /></th><th>ISI SMS</th><th>[R]</th><th>PENGIRIM</th><th width="14%">ACTION</th></tr>

<?php
$query = "SELECT * FROM sms_inbox WHERE idfolder IS NULL OR idfolder = '0' ORDER BY `time` DESC LIMIT $offset, $dataPerPage";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
  $pesan = substr($data['msg'], 0, 50);

  $idfolder = $data['idfolder'];
  $query3 = "SELECT * FROM sms_folder WHERE id = '$idfolder'";
  $hasil3 = mysql_query($query3);
  $data3  = mysql_fetch_array($hasil3);
  $folder = $data3['folder'];
  
  $nosender = $data['sender'];
  $query3 = "SELECT nama FROM sms_phonebook WHERE noTelp = '$nosender'";
  $hasil3 = mysql_query($query3);
  $data3  = mysql_fetch_array($hasil3);
  
  if ($data3['nama'] == "") $sendername = $data['sender'];
  else $sendername = $data3['nama'];  
   
  if ($data['flagReply'] == 0) $status = "&nbsp;";
  else $status = "[R]";
  
  if ($i % 2 == 0) $style = "genap";
  else $style = "ganjil";
  
    if ($data['flagRead'] == 0){
	$teks = "<b><font color='#000000'>".$pesan."</font></b>";
	$style = "unread";
	}
  else $teks = $pesan;
  
    
  echo "<tr valign='top' class='".$style."'><td><input type='checkbox' name='inbox[]' value='".$data['id']."' /></td><td><a href='inbox.php?op=view&id=".$data['id']."'>".$teks."...</a></td><td align='center'>".$status."</td><td>".$sendername."</td><td><a href='inbox.php?op=delete&id=".$data['id']."&page=".$noPage."'>DEL</a> | <a href='inbox.php?op=spam&id=".$nosender."&page=".$noPage."'>SPAM</a></td></tr>";
  $i++;
}
echo "</table><br>";
echo "<input type='submit' name='submit' value='Hapus SMS' class='tombolku'>";
echo "</form><br><br>";

$query   = "SELECT COUNT(*) AS jumData FROM sms_inbox WHERE idfolder IS NULL OR idfolder = '0'";
$hasil  = mysql_query($query);
$data     = mysql_fetch_array($hasil);
 
$jumData = $data['jumData'];
 
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
 
$jumPage = ceil($jumData/$dataPerPage);
 
// menampilkan link previous

echo "Halaman: "; 
if ($noPage > 1) echo  "<a href='inbox.php?page=".($noPage-1)."'>&lt;&lt; Prev</a>";
 
// memunculkan nomor halaman dan linknya
 
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='inbox.php?page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
// menampilkan link next
 
if ($noPage < $jumPage) echo "<a href='inbox.php?page=".($noPage+1)."'>Next &gt;&gt;</a>";
}
?>