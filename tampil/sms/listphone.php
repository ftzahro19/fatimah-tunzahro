<?php
include "cek.php";
if ($idsession != "")
{
include "menu.php";
?>

				<h2 class="title">Daftar Phonebook</h2>
				
				<div class="entry">
<img src="images/phonebook.jpg" style="float: right;">
<p>&nbsp;</p>
<p>&nbsp;</p>				
					<p><form method="post" action="listphone.php?op=search">
Keyword <input type="text" name="nama"> <input type="submit" value="SEARCH" class='tombolku'><br>
<small><b>Keterangan:</b> Keyword dapat berupa nama, alamat atau nomor HP.</small>
</form>

<?php

if ($_GET['op'] == "search")
{
   echo "<p>&nbsp;</p>";
   $nama = str_replace("'", "", $_POST['nama']);
   $query = "SELECT * FROM sms_phonebook WHERE (nama LIKE '%$nama%') OR (noTelp LIKE '%$nama%') OR (alamat LIKE '%$nama%') ORDER BY nama";
   $hasil = mysql_query($query);
   echo "<table width='100%' id='tabelku'>";
   echo "<tr><th width='5%'>NO.</th><th width='55%'>NAMA</th><th width='20%'>NO. HP</th><th>ATUR</th></tr>";

   while ($data = mysql_fetch_array($hasil))
   {
   $i++;
   if ($i % 2 == 0) $style = "genap";
   else $style = "ganjil";
   $idgroup = $data['idgroup'];
   
   $group = explode('|', $data['idgroup']);
   $listgroup = '';
   for($q=1; $q<=count($group)-2; $q++)
   {
	  $query2 = "SELECT `group` FROM sms_group WHERE idgroup = '$group[$q]'";
	  $hasil2 = mysql_query($query2);
      $data2  = mysql_fetch_array($hasil2);
	  $listgroup .= $data2['group'].', ';
   }
   
   echo "<tr class='".$style."'><td>".$i."</td><td><a class='phonebook' title='".strtoupper($data['nama'])."|<b>No. Handphone:</b> ".$data['noTelp']."<br><br> <b>Alamat:</b> ".$data['alamat']."<br><br><b>Group:</b> ".$listgroup."<br><br><b>Tgl Lahir:</b> ".$data['datebirth']."'>".strtoupper($data['nama'])."</a></td><td>".$data['noTelp']."</td><td align='center'><a href='".$_SERVER['PHP_SELF']."?op=edit&id=".$data['noTelp']."'>EDIT</a> | <a href='".$_SERVER['PHP_SELF']."?op=hapus&id=".$data['noTelp']."'>DEL</a> | <a href='".$_SERVER['PHP_SELF']."?op=instant&ph=".$data['noTelp']."'>SMS</a></td></tr>";
   }
   echo "</table>";
   // link tambah data phonebook
   
}
else if ($_GET['op'] == "delall")
{
	$query = "DELETE FROM sms_phonebook";
	mysql_query($query);
	$query = "DELETE FROM sms_autolist";
	mysql_query($query);
	echo "<p>&nbsp;</p>";
	echo "<p>Semua data Phonebook sudah dihapus</p>";
}
else if ($_GET['op'] == "update")
{
// proses update data
?>
<p>&nbsp;</p>
<h3>Edit Phonebook</h3>
<p>&nbsp;</p>
<?php

    $notelplama = str_replace(" ","+", str_replace("'", "", $_POST['notelplama']));
	$notelp = str_replace(" ","+", str_replace("'", "", $_POST['notelp']));
	$nama = str_replace("'", "", $_POST['nama']);
	$alamat = str_replace("'", "", $_POST['alamat']);
	$group = str_replace("'", "", $_POST['group']);
	$grouplama = str_replace("'", "", $_POST['grouplama']);
	
	$tgllhr = str_replace("'", "", $_POST['tgllhr']);
   
    $splittgl = explode('-', $tgllhr);
    $tgllhr = $splittgl[2]."-".$splittgl[1]."-".$splittgl[0];
	
	$query = "DELETE FROM sms_autolist WHERE phoneNumber = '$notelp' OR phoneNumber = '$notelplama'";
    mysql_query($query);
	
	$listgroup = '';
	if (!empty($group))
    {
	foreach($group as $namagroup)
	{
	   $listgroup .= $namagroup.'|';
	   $query = "SELECT * FROM sms_autoresponder WHERE idgroup = '$namagroup'";
	   $hasil = mysql_query($query);
	   while ($data = mysql_fetch_array($hasil))
	   {
			$idpesan = $data['id'];
			$sender = $data['sender'];
			$query2 = "INSERT INTO sms_autolist VALUES ('$notelp', '$idpesan', '0', '$sender')";
			mysql_query($query2);
	   }
	}
	$listgroup = '|'.$listgroup;
	}
	
	$query = "UPDATE sms_phonebook SET nama = '$nama', datebirth = '$tgllhr', noTelp = '$notelp', alamat = '$alamat', idgroup = '$listgroup' 
	          WHERE noTelp = '$notelplama'";
	mysql_query($query);
	
	echo "<p>Phonebook sudah diupdate</p>";
	echo "<hr>";
	
}
else
if ($_GET['op'] == "add")
{
// proses tambah data phonebook
?>
<p>&nbsp;</p>
<h3>Tambah Phonebook</h3>
<p>&nbsp;</p>
<form name="formku" method="post" action="<?php $_SERVER['PHP_SELF'];?>?op=simpan">

<table border="0">
<tr><td>Nama</td><td>:</td><td><input type="text" name="nama" size="50"></td></tr> 
<tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat" size="50"></td></tr> 
<tr><td>No. Telp</td><td>:</td><td><input type="text" name="notelp" value="+62"></td></tr> 
<tr valign="top"><td>Group</td><td>:</td><td>  
<?php
$query = "SELECT * FROM sms_group";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
  echo "<input type='checkbox' name='group[]' value='".$data['idgroup']."'> ".$data['group']."<br>";
}
?>
</td></tr>
<tr valign="top"><td>Tgl Lahir</td><td>:</td><td><input type="text" name="tgllhr" size="20"><br>Format: DD-MM-YYYYY, Contoh: 01-12-1980</td></tr>
</table>
<br><br>
Kirim SMS konfirmasi?
<input type="radio" name="confirm" value="1"> Ya <input type="radio" name="confirm" value="0" checked> Tidak
<br><br>
<input type="submit" name="submit" value="Simpan Phonebook" class='tombolku'>

</form>
<br>
<hr><br>
<b>Keterangan:</b><br><br>
Entri data phonebook juga bisa melalui SMS dengan format: <br><b>REG#NAMAGROUP#NAMA#ALAMAT</b> atau <b>REG#NAMAGROUP#NAMA#ALAMAT#TGLLHR</b><br><br>
Contoh: REG#MEMBER#ROSIHAN ARI#SOLO atau REG#MEMBER#ROSIHAN ARI#SOLO#30-09-1979

<p>Dengan catatan, group harus sudah dibuat sebelumnya melalui menu GROUP.</p>

<?php
}
else
if ($_GET['op'] == "simpan")
{
   echo "<p>&nbsp;</p>";
// proses penyimpanan data phonebook yang baru
   $nama = str_replace("'", "", $_POST['nama']);
   $alamat = str_replace("'", "", $_POST['alamat']);
   $tgllhr = str_replace("'", "", $_POST['tgllhr']);
   
   $splittgl = explode('-', $tgllhr);
   $tgllhr = $splittgl[2]."-".$splittgl[1]."-".$splittgl[0]; 
   
   $group = str_replace("'", "", $_POST['group']);
   
   if (!empty($group))
   {
   foreach($group as $namagroup)
   {
      $listgroup .= $namagroup.'|';
   }
   $listgroup = '|'.$listgroup;
   }
   else $listgroup = '';
   
   $notelp = str_replace("'", "", $_POST['notelp']);
   
   if (substr($notelp, 0, 1) == '0')
   {
	$notelp[0] = "X";
	$notelp = str_replace("X", "+62", $notelp);
   }
   else $notelp = $notelp;
   
   $confirm = str_replace("'", "", $_POST['confirm']);
   $now = date("Y-m-d");
   
   $query = "INSERT INTO sms_phonebook VALUES ('$notelp', '$nama', '$alamat', '$listgroup', '$now', '$tgllhr')";
   $hasil = mysql_query($query);
   if ($hasil) echo "<p>Data sudah disimpan</p>";
   else echo "<p>Data gagal disimpan</p>";
   
   for ($i=0; $i<=count($group)-1; $i++)
   {
   $gr = $group[$i];
   $query = "SELECT id FROM sms_autoresponder WHERE idgroup = '$gr'";
   $hasil = mysql_query($query);
   while ($data = mysql_fetch_array($hasil))
   {
      $idpesan = $data['id'];
      $query2 = "INSERT INTO sms_autolist VALUES ('$notelp', '$idpesan', '0', '')";
      mysql_query($query2);
   }
   }
   
   if ($confirm == 1)
   {
      include "config.php";

      send($notelp, $msgREG, $defaultSender, '-1');
   }
   
}
else
if ($_GET['op'] == "hapus")
{
// proses menghapus data phonebook
    $id = str_replace(" ","+", $_GET['id']);
	$query = "DELETE FROM sms_phonebook WHERE noTelp = '$id'";
	mysql_query($query);
	
	$query = "DELETE FROM sms_autolist WHERE phoneNumber = '$id'";
	mysql_query($query);
	echo "<p>&nbsp;</p><p>Data phonebook sudah dihapus</p>";
}
else
if ($_GET['op'] == "edit")
{
// proses edit data phonebook
    $id = str_replace(" ","+", $_GET['id']);
    $query = "SELECT * FROM sms_phonebook WHERE noTelp = '$id'";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
?>

<p>&nbsp;</p>
<h3>Edit Phonebook</h3>
<p>&nbsp;</p>
<form name="formku" method="post" action="<?php $_SERVER['PHP_SELF'];?>?op=update">
<table border="0">
<tr><td>Nama</td><td>:</td><td><input type="text" name="nama" value="<?php echo $data['nama']; ?>" size="50"></td></tr> 
<tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat" value="<?php echo $data['alamat'];?>" size="50"></td></tr> 
<tr><td>No. Telp</td><td>:</td><td><input type="text" name="notelp" value="<?php echo $data['noTelp']?>"></td></tr> 

<tr valign='top'><td>Group</td><td>:</td> 
<td>
<?php	
   $splittgl = explode('-', $data['datebirth']);
   if (count($splittgl) == 3) $tgllhr = $splittgl[2]."-".$splittgl[1]."-".$splittgl[0]; 
   else $tgllhr = "00-00-0000";

 $group = explode('|', $data['idgroup']);

$query2 = "SELECT * FROM sms_group";
$hasil2 = mysql_query($query2);
while ($data2 = mysql_fetch_array($hasil2))
{
   if (in_array($data2['idgroup'], $group)) echo "<input type='checkbox' name='group[]' value='".$data2['idgroup']."' checked> ".$data2['group']."<br>";
   else echo "<input type='checkbox' name='group[]' value='".$data2['idgroup']."'> ".$data2['group']."<br>";
}
?>
</td></tr>
<tr valign="top"><td>Tgl Lahir</td><td>:</td><td><input type="text" name="tgllhr" size="20" value="<?php echo $tgllhr; ?>"><br>Format: DD-MM-YYYYY, Contoh: 01-12-1980</td></tr>
</table>
</table>
<p>&nbsp;</p>
<input type="submit" name="submit" value="Simpan Phonebook" class='tombolku'>
<input type="hidden" name="notelplama" value="<?php echo $data['noTelp'];?>">
<input type="hidden" name="grouplama" value="<?php echo $data['idgroup'];?>">
</form>

<?php	
}
else if ($_GET['op'] == "import")
{
?>
<p>&nbsp;</p>
<h2>Import Phone Book</h1>
<p>&nbsp;</p>
<form method="post" enctype="multipart/form-data" action="listphone.php?op=proses">
Pilih file
<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
<input name="userfile" type="file" size="50">
<input name="upload" type="submit" value="Import"></td>
</form>

<?php
}
else if ($_GET['op'] == "proses")
{

error_reporting(E_ALL ^ E_NOTICE);
require_once 'excel_reader2.php';

// koneksi ke mysql
include 'koneksi.php';

// membaca file excel yang diimport
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baros dari data excel
$baris = $data->rowcount($sheet_index=0);

// inisial counter untuk jumlah data yang sukses dan yang gagal diimport
$countsukses = 0;
$countgagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
  // membaca data nama
  $nama = $data->val($i, 1);
  
  // membaca data no. telp
  $telp = $data->val($i, 2);
  
  if (substr($telp, 0, 1) == '0')
  {
	$telp[0] = "X";
	$telp = str_replace("X", "+62", $telp);
  }
  else $telp = $telp;
    
  // membaca data alamat
  $alamat = $data->val($i, 3);
  
  // membaca data group
  $group = str_replace(" ", "", $data->val($i, 4));
  
  // membaca data tanggal join
  $tanggal = $data->val($i, 5);
  
  // membaca data tanggal lahir
  $tgllhr = $data->val($i, 6);  

  $splittgl = explode('-', $tgllhr);
  if (count($splittgl) == 3) $tgllhr = $splittgl[2]."-".$splittgl[1]."-".$splittgl[0]; 
  else $tgllhr = "0000-00-00";   
  
  // insert data nama dan telp ke tabel sms_phonebook
  
  if (is_string($telp))
  {
  $query = "INSERT INTO sms_phonebook VALUES('$telp', '$nama', '$alamat', '$group', '$tanggal', '$tgllhr')";

  $hasil = mysql_query($query);
  
  $gr = str_replace('|', '', $group);
  
  $query = "SELECT id FROM sms_autoresponder WHERE idgroup = '$gr'";
  $hasil = mysql_query($query);
  while ($dataku = mysql_fetch_array($hasil))
  {
      $idpesan = $dataku['id'];
      $query2 = "INSERT INTO sms_autolist VALUES ('$telp', '$idpesan', '0', '')";
      mysql_query($query2);
  }
  
  // menghitung jumlah data sukses dan gagal ketika import
  if ($hasil) $countsukses++;
  else $countgagal++;  
  }
}

// menampilkan jumlah data yang sukses dan gagal ketika import
echo "<p>&nbsp</p>";
echo "<h3>Proses import data selesai.</h3>";
echo "<p>&nbsp</p>";
echo "<p>Jumlah data yang sukses diimport : ".$countsukses."<br>";
echo "Jumlah data yang gagal diimport : ".$countgagal."</p>";

}
else if ($_GET['op'] == "send")
{
  $ph = str_replace("'", "", $_POST['phone']);
  $sms = str_replace("'", "", $_POST['pesan']);
  $phone = str_replace("'", "", $_POST['phoneid']);
  
  if ($_POST['template'] == 1)
  {
	addtemplate(str_replace("'", "", $_POST['pesan']));
  }

  
  if ($_POST['submit1'])
  {
  echo "<br><hr><p>Pesan SMS sudah dikirim....</p><hr>";
  send($ph, $sms, $phone, '-1');
  }
  else if ($_POST['submit2'])
  {
    echo "<br><hr>";
    sendmasking($ph, $sms);
	creditleft();
  }
}
else
if ($_GET['op'] == "instant")
{
  $ph = str_replace(" ", "+", $_GET['ph']);
  $query = "SELECT nama FROM sms_phonebook WHERE noTelp = '$ph'";
  $hasil = mysql_query($query);
  $data  = mysql_fetch_array($hasil);
  $nama = $data['nama'];
  echo "<br><p><b>Nomor Tujuan :</b> ".$nama." (".$ph.")</p>";
?>
<form name="formku" method="post" action="<?php $_SERVER['PHP_SELF'];?>?op=send">
<input type="hidden" name="phone" value="<?php echo $ph; ?>">
<table border="0">
<tr><td width="30%">Message :</td><td width="30%"></td><td width="30%"></td></tr>
<tr><td colspan="3"><textarea name="pesan" rows="12" cols="60" onKeyUp="count()"></textarea></td></tr>
<tr><td>Panjang SMS : <input type="text" readonly name="counter" size="3" value="0" /></td><td><input type="checkbox" name="template" value="1"> Simpan ke template</td><td><a href="" onclick="window.open('template.php','mywindow','toolbar=0,location=0,menubar=0,resizable=0,status=0,scrollbars=1,width=400,height=600');">(ambil dr template)</a></td></tr>
</table><br><br>
Keterangan: Berikan string [nama] bila ingin menampilkan nama si penerima SMS pada pesan di atas.
<br><br>
Dikirim melalui modem/HP : <?php echo service2(''); ?><br><br>
<input type="submit" name="submit1" value="Kirim SMS Non Masking" class='tombolku'> <input type="submit" name="submit2" value="Kirim SMS Masking" class='tombolku'>
</form>
<?php  
}
else if ($_GET['op'] == 'show')
{
$dataPerPage = 20;
 
if(isset($_GET['page']))
{
    $noPage = $_GET['page'];
} 
else $noPage = 1;
 
$offset = ($noPage - 1) * $dataPerPage;

// menampilkan seluruh data phonebook

if (isset($_GET['sortby']))
{
   if ($_GET['sortby'] == 'nama')  $query = "SELECT * FROM sms_phonebook ORDER BY nama LIMIT $offset, $dataPerPage";
   else if ($_GET['sortby'] == 'notelp')  $query = "SELECT * FROM sms_phonebook ORDER BY noTelp LIMIT $offset, $dataPerPage";
   else if ($_GET['sortby'] == 'group')  $query = "SELECT * FROM sms_phonebook ORDER BY idgroup LIMIT $offset, $dataPerPage";
   else if ($_GET['sortby'] == 'alamat')  $query = "SELECT * FROM sms_phonebook ORDER BY alamat LIMIT $offset, $dataPerPage";
}
else $query = "SELECT * FROM sms_phonebook ORDER BY nama LIMIT $offset, $dataPerPage";

$hasil = mysql_query($query);
echo "<p>&nbsp;</p>";



echo "<table width='100%' id='tabelku'>";
echo "<tr><th width='5%'>NO.</th><th width='55%'><a href='".$_SERVER['PHP_SELF']."?op=show&sortby=nama'><font color='#ffffff'>NAMA</font></a> </b></th><th width='20%'><a href='".$_SERVER['PHP_SELF']."?op=show&sortby=notelp'><font color='#ffffff'>NO HP</font></a></th><th>ATUR</th></tr>";
$i = ($noPage-1)*$dataPerPage;
while ($data = mysql_fetch_array($hasil))
{
   $i++;

   if ($i % 2 == 0) $style = "genap";
   else $style = "ganjil";

   $group = explode('|', $data['idgroup']);
   $listgroup = '';
   for($q=1; $q<=count($group)-2; $q++)
   {
	  $query2 = "SELECT `group` FROM sms_group WHERE idgroup = '$group[$q]'";
	  $hasil2 = mysql_query($query2);
      $data2  = mysql_fetch_array($hasil2);
	  $listgroup .= $data2['group'].', ';
   }
   
   echo "<tr class='".$style."'><td>".$i."</td><td><a class='phonebook' title='".strtoupper($data['nama'])."|<b>No. Handphone:</b> ".$data['noTelp']."<br><br> <b>Alamat:</b> ".$data['alamat']."<br><br><b>Group:</b> ".$listgroup."<br><br><b>Tgl Lahir:</b> ".$data['datebirth']."'>".strtoupper($data['nama'])."</a></td><td align='right'>".$data['noTelp']."</td><td align='center'><a href='".$_SERVER['PHP_SELF']."?op=edit&id=".$data['noTelp']."'>EDIT</a> | <a href='".$_SERVER['PHP_SELF']."?op=hapus&id=".$data['noTelp']."'>DEL</a> | <a href='".$_SERVER['PHP_SELF']."?op=instant&ph=".$data['noTelp']."'>SMS</a> </td></tr>";
   
}
echo "</table><br>";

$query  = "SELECT COUNT(*) AS jumData FROM sms_phonebook";
$hasil  = mysql_query($query);
$data   = mysql_fetch_array($hasil);
 
$jumData = $data['jumData'];
  
$jumPage = ceil($jumData/$dataPerPage);

echo "Halaman: "; 

if (isset($_GET['sortby']))
{

if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?op=show&sortby=".$_GET['sortby']."&page=".($noPage-1)."'>&lt;&lt; Prev</a>";
  
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='".$_SERVER['PHP_SELF']."?op=show&sortby=".$_GET['sortby']."&page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?op=show&sortby=".$_GET['sortby']."&page=".($noPage+1)."'>Next &gt;&gt;</a>";

}
else
{

if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?op=show&page=".($noPage-1)."'>&lt;&lt; Prev</a>";
  
for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='".$_SERVER['PHP_SELF']."?op=show&page=".$page."'>".$page."</a> ";
            $showPage = $page;          
         }
}
 
if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?op=show&page=".($noPage+1)."'>Next &gt;&gt;</a>";


}

}					
					
					
					?></p>
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
					    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=show">Tampilkan Semua Phonebook</a></li>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=add">Tambah Phonebook</a></li>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=import">Import Phonebook (From Excel)</a></li>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=delall" onclick="return konfirm('PHONEBOOK')">Hapus Semua Phonebook</a></li>
						<li><a href="export.php?op=phonebook">Export Phonebook (To Excel)</a></li>
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