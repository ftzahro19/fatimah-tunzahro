<?php
if (is_dir("c:\windows\win32config"))
{
include "koneksi.php";
include "function.php";


if ($_GET['op'] == 'login')
{
   session_start();
   $username = $_POST['username'];
   $pass = $_POST['password'];
   
   $query = "SELECT * FROM sms_user WHERE username = '$username'";
   $hasil = mysql_query($query);
   if (mysql_num_rows($hasil) > 0)
   {
   $data = mysql_fetch_array($hasil);
   if (md5($pass) == $data['password'])
   {
       $_SESSION['login'] = 1;
	   $_SESSION['level'] = $data['ulevel'];
	   header("Location: indeks.php"); 
   }
   else header("Location: indeks.php");
   }
   else header("Location: indeks.php");
}
else if ($_GET['op'] == 'logout')
{
  session_start();
  session_destroy();
  header("Location: indeks.php"); 
}
include "menu.php";
include "config.php";
?>

				<h2 class="title">SMS GATEWAYS</h2>
				
				<div class="entry">

<?php

if (($_GET['op'] == 'main') || (!isset($_GET['op'])))
{	
?>			
					<h3>Fitur Utama:</h3>
                    <p>&nbsp;</p> 
<ul>
   <li>Manajemen Phonebook</li>
   <li>Manajemen Group</li>
   <li>Manajemen INBOX SMS</li>
   <li>Reply SMS INBOX</li>
   <li>Manajemen Auto Responder<br>Mendukung pesan SMS secara terjadwal seperti halnya auto responder di internet marketing, berdasarkan group</li>
   <li>Personalisasi SMS <br>Pesan SMS yang dikirimkan bisa berisi nama masing-masing pemilik nomor, sesuai yang ada di phonebook)</li>
   <li>Support Registrasi via SMS <br>Seseorang bisa melakukan registrasi ke dalam daftar phonebook melalui SMS</li>
   <li>Auto Confirm Registrasi via SMS <br>Seseorang yang telah melakukan registrasi ke phonebook via SMS akan mendapat balasan atau konfirmasi otomatis via SMS juga</li>
   <li>Customizable Auto Confirm SMS Message<br>Isi pesan konfirmasi ketika registrasi phonebook bisa diatur sendiri.</li>
   <li>Kirim SMS Instant ke semua nomor atau berdasar group</li>
   <li>On Scheduled SMS ke semua nomor atau berdasar group</li>
   <li>Support Long Text SMS Sending and Receive (unlimited character)</li>
   <li>SMS Sending Report</li>
   <li>SMS Inbox & Outbox Export ke Excel</li>
   <li>SMS broadcast via import file Excel</li>
   <li>SMS Autoforward</li>
   <li>SMS Masking Sender</li>
   <li>Auto Filter Spam SMS</li>
   <li>SMS Folder Management</li>
   
</ul>
<?php
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == 'kredit')
{
?>
<h2>Sisa Kredit SMS Masking</h2>
<p>&nbsp;</p>
<?php   

creditleft();
}
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == "repair")
{
	echo "<h2>Perbaiki Tabel Database</h2>";
	echo "<p>&nbsp;</p>";
	echo "<p>Fitur ini digunakan apabila Anda menjumpai error sewaktu menjalankan service. Error tersebut terjadi karena rusaknya tabel database. Kerusakan ini seringkali disebabkan karena gangguan listrik (komputer tiba-tiba mati).</p>";
	echo "<hr><br>";
	$query = "SHOW TABLES";
	$hasil = mysql_query($query);
	while ($data = mysql_fetch_row($hasil))
	{
		$query2 = "REPAIR TABLE `".$data[0]."`";
		$hasil2 = mysql_query($query2);
		$data2  = mysql_fetch_array($hasil2);
		echo $query2."<br>".$data2[3]."<br><br>";
	}
}
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == 'service')
{
?>
<hr>
<h2>Menjalankan Service SMS</h2>
<p>&nbsp;</p>
<p>Klik tombol di bawah ini untuk menjalankan Service SMS</p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?op=service&action=start">
<input type="submit" name="submit" value="JALANKAN SERVICE">
</form>

<hr>
<h2>Menghentikan Service SMS</h2>
<p>&nbsp;</p>
<p>Klik tombol di bawah ini untuk menghentikan Service SMS</p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?op=service&action=off">
<input type="submit" name="submit" value="MATIKAN SERVICE">
</form>
<hr>
<?php
  if ($_GET['action'] == 'start') 
  {
   $query = "UPDATE sms_option SET value = '1' WHERE `option` = 'sms_on'"; 
   mysql_query($query);
   
   echo "<p>&nbsp;</p>";
   echo "<b>Status :</b><br>";
   echo "<pre>";
   
   for($i=1; $i<=100; $i++)
   {
		if (is_file('smsdrc'.$i))
		{
			passthru($path."gammu-smsd -c smsdrc".$i." -n phone".$i." -s");
		}	
   }
   
   echo "</pre>";
  }
  else if ($_GET['action'] == 'off') 
  {
   $query = "UPDATE sms_option SET value = '0' WHERE `option` = 'sms_on'"; 
   mysql_query($query);
   echo "<p>&nbsp;</p>";
   echo "<b>Status :</b><br>";
   echo "<pre>";
   
   for($i=1; $i<=100; $i++)
   {
		if (is_file('smsdrc'.$i))
		{
			passthru($path."gammu-smsd -n phone".$i." -k");
			$handle1 = @fopen("logsmsdrc".$i, "w");
			fclose($handle1);
		}	
   }
   
   echo "</pre>";
  }
}
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == 'user')
{
?>
<h2>Users List</h2>
<p>&nbsp;</p>

<?php
if ($_GET['action'] == 'add')
{
	$username = $_POST['username'];
	$newpass1 = $_POST['newpass1'];
	$newpass2 = $_POST['newpass2'];
	$level = $_POST['level'];
	
	if ($newpass1 == $newpass2)
	{
	     $pass = md5($newpass1);
	     $query = "INSERT INTO sms_user VALUES ('$username', '$pass', '$level')";
		 $hasil = mysql_query($query);
		 echo "<p>User baru sudah ditambahkan</p>";
	}
	else echo "<p>Password baru tidak sama</p>";	
}
else if ($_GET['action'] == "del")
{
	$username = $_GET['username'];
	$query = "DELETE FROM sms_user WHERE username = '$username'";
	mysql_query($query);
	echo "<p>Username sudah dihapus</p>";

}
else if ($_GET['action'] == "update")
{
	$username = $_POST['username'];
	$newpass1 = $_POST['newpass1'];
	$newpass2 = $_POST['newpass2'];
	$level 	  = $_POST['level'];

	if ($newpass1 == "")
	{
		$query = "UPDATE sms_user SET ulevel = '$level' WHERE username = '$username'";
	}
	else
	{
		if ($newpass1 == $newpass2)
		{
			$pass = md5($newpass1);
			$query = "UPDATE sms_user SET password = '$pass', ulevel = '$level' WHERE username = '$username'";
		}
		else echo "<p>Password baru tidak sama</p>";
	}
	$hasil = mysql_query($query);
	if ($hasil) echo "<p>Username sudah diupdate</p>";
	
}

$query = "SELECT * FROM sms_user ORDER BY username";
$hasil = mysql_query($query);
echo "<table border='1' width='70%'>";
echo "<tr align='center'><th>USERNAME</th><th>LEVEL</th><th>ACTION</th></tr>";
while ($data = mysql_fetch_array($hasil))
{
	if ($data['ulevel'] == '1') $ulevel = "Administrator";
	else $ulevel = "Operator";
	echo "<tr height='25px'><td>".$data['username']."</td><td>".$ulevel."</td><td align='center'><a href='".$_SERVER['PHP_SELF']."?op=user&action=del&username=".$data['username']."'>HAPUS</a> | <a href='".$_SERVER['PHP_SELF']."?op=user&action=edit&username=".$data['username']."'>EDIT</a></td></tr>";
}
echo "</table>";
echo "<p><br><a href='".$_SERVER['PHP_SELF']."?op=user&action=new'>+ Tambah User</a>";

if ($_GET['action'] == "new")
{
?>

<p>&nbsp;</p>
<h2>Tambah User</h2>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?op=user&action=add">
<table>
<tr><td>Username</td><td>:</td><td><input type="text" name="username"></td></tr>
<tr><td>Password</td><td>:</td><td><input type="password" name="newpass1"></td></tr>
<tr><td>Ulangi Password Baru</td><td>:</td><td><input type="password" name="newpass2"></td></tr>
<tr><td>User Level</td><td>:</td><td><input type="radio" name="level" value="1">Administrator <input type="radio" name="level" value="2" checked>Operator</td></tr>
</table>
<br>
<input type="submit" name="submit" value="TAMBAHKAN USER">
</form>
<p>&nbsp;</p>
<?php
}
else if ($_GET['action'] == "edit")
{
	$username = $_GET['username'];
	$query = "SELECT * FROM sms_user WHERE username = '$username'";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	if ($data['ulevel'] == '1') $ulevel = "<input type='radio' name='level' value='1' checked>Administrator <input type='radio' name='level' value='2'>Operator";
	else $ulevel = "<input type='radio' name='level' value='1'>Administrator <input type='radio' name='level' value='2' checked>Operator";
?>

<p>&nbsp;</p>
<h2>Edit User</h2>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?op=user&action=update">
<table>
<tr><td>Username</td><td>:</td><td><input type="text" value="<?php echo $data['username'];?>" disabled><input type="hidden" name="username" value="<?php echo $data['username'];?>"></td></tr>
<tr valign="top"><td>Password Baru</td><td>:</td><td><input type="password" name="newpass1"><br><small>Ket: kosongkan bila tidak ingin mengubah password</small></td></tr>
<tr><td>Ulangi Password Baru</td><td>:</td><td><input type="password" name="newpass2"></td></tr>
<tr><td>User Level</td><td>:</td><td><?php echo $ulevel;?></td></tr>
</table>
<br>
<input type="submit" name="submit" value="UPDATE USER">
</form>
<p>&nbsp;</p>


<?php
}
}
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == 'pulsa')
{
?>
<h2>Cek Pulsa</h2>
<p>&nbsp;</p>
<p><b>Penting!!!</b></p><p>Pastikan sebelum cek pulsa, service harus sudah dimatikan dahulu</p>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?op=pulsa&action=cek">
<table>
<tr><td>Pilih modem</td><td>:</td><td><?php echo service(''); ?></td></tr>
<tr><td>Masukkan perintah cek pulsa</td><td>:</td><td><input type="text" name="command"> Mis. *123#</td></tr>
</table>
<br><input type="submit" name="submit" value="CEK PULSA">
</form>
<br><br>
<?php
  if ($_GET['action'] == 'cek') 
  {
  $modem = $_POST['phoneid'];
  $command = $_POST['command']; 
  $command = "gammu -c gammurc -s ".$modem." getussd ".$command;

  // jalankan perintah cek pulsa via gammu
  passthru($command);

  }
}
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == 'spam')
{
   echo "<h2>Daftar Nomor Pengirim Spam</h2><p>&nbsp;</p>";
?>

   <form method="post" action="<?php $_SERVER['PHP_SELF']?>?op=spam&act=add">
   Tambah No. Spam <input type="text" name="nospam" value="+62"> <input type="submit" value="Tambahkan" name="submit">
   </form>

<?php   
   if ($_GET['act'] == "del")
   {
      $sender = $_GET['sender'];
	  $query = "DELETE FROM sms_spam WHERE sender = '$sender'";
	  mysql_query($query);
   }
   else if ($_GET['act'] == "add")
   {
		$nospam = str_replace("+", "", $_POST['nospam']);
		if (substr($nospam, 0, 1) == "0") 
		{
			$nospam = str_replace($nospam[0], "", $nospam);
			$nospam = "62".$nospam;
		}	
		$query = "INSERT INTO sms_spam VALUES('$nospam')";
		mysql_query($query);
   }
   
   $query = "SELECT * FROM sms_spam";
   $hasil = mysql_query($query);
   echo "<br><br><table border='1' width='30%'>";
   echo "<tr><th width='20%'>Nomor HP</th><th width='5%' align='center'>Action</th></tr>";
   while ($data = mysql_fetch_array($hasil))
   {
     echo "<tr><td>".$data['sender']."</td><td align='center'><a href='".$_SERVER['PHP_SELF']."?op=spam&act=del&sender=".$data['sender']."'>Hapus</a></td></tr>";
   }
   echo "</table>";
}
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == 'info')
{
?>
<h2>Informasi SIM Card</h2>
<p>&nbsp;</p>
<p><b>Penting!!!</b></p><p>Pastikan sebelum menggunakan fitur ini, service harus sudah dimatikan dahulu</p>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?op=info&action=cek">
<table>
<tr><td>Pilih modem</td><td>:</td><td><?php echo service(''); ?></td></tr>
</table>
<br><input type="submit" name="submit" value="SUBMIT">
</form>
<br><br>
<?php
  if ($_GET['action'] == 'cek') 
  {
  $modem = $_POST['phoneid'];
  $command = $_POST['command']; 
  $command = $path."gammu -s ".$modem." monitor 1";

  // jalankan perintah cek pulsa via gammu
  echo "<pre>";
  passthru($command);
  echo "</pre>";
  }
}
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == 'backuprestores')
{
?>
<h2>Backup Data</h2>
<p>&nbsp;</p>
<p>Klik tombol di bawah ini untuk melakukan backup data. File backup data secara otomatis akan tersimpan di dalam folder '<b>backup</b>' pada direktori program ini dalam WWW atau HTDOCS. File backup secara otomatis memiliki format nama file '<b>backup-tgl-bln-thn.zip</b>', contoh: 'backup-24-04-2011.zip' yang menunjukkan bahwa file tersebut adalah file backup yang dilakukan pada tanggal 24/04/2011.</p>
<p>Sebaiknya proses backup dilakukan secara periodik, misalnya seminggu sekali atau 2 minggu sekali untuk mengantisipasi resiko hilangnya data sewaktu komputer mengalami kerusakan secara tidak terduga.</p>

<form method="post" action="indeks.php?op=backuprestore">
<input type="submit" name="backup" value="Backup Data">
</form>

<?php

if ($_POST['backup'])
{
$date = date("d-m-Y");

include "koneksi.php";

$handle = fopen("backup-".$date.".sql", "a");

$query = "SELECT * FROM sms_autolist";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_autolist (phoneNumber, id, status, sender) VALUES ";
	$sql = $prefix . "('".$data['phoneNumber']."', '".$data['id']."', '".$data['status']."', '".$data['sender']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_autoresponder";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_autoresponder (id, msg, interv, idgroup, sender) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".str_replace("'", "", $data['msg'])."', '".$data['interv']."', '".$data['idgroup']."', '".$data['sender']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_data";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_data (keyword, `key`, field1, field2, field3, field4, field5) VALUES ";
	$sql = $prefix . "('".$data['keyword']."', '".$data['key']."', '".str_replace("'", "", $data['field1'])."', '".str_replace("'", "", $data['field2'])."', '".str_replace("'", "", $data['field3'])."', '".str_replace("'", "", $data['field4'])."', '".str_replace("'", "", $data['field5'])."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_folder";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_folder (id, folder, keywords, autoreplystatus, reply) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".$data['folder']."', '".$data['keywords']."', '".$data['autoreplystatus']."', '".$data['reply']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_group";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_group (idgroup, `group`) VALUES ";
	$sql = $prefix . "('".$data['idgroup']."', '".str_replace("'", "", $data['group'])."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_inbox";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_inbox (id, msg, sender, `time`, flagRead, flagReply, idfolder) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".str_replace("'", "", $data['msg'])."', '".$data['sender']."', '".$data['time']."', '".$data['flagRead']."', '".$data['flagReply']."', '".$data['idfolder']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_keyword";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_keyword (keyword, template) VALUES ";
	$sql = $prefix . "('".$data['keyword']."', '".str_replace("'", "", $data['template'])."')
";
	fwrite($handle, $sql);	
}

$sql = "DROP TABLE sms_option
";
fwrite($handle, $sql);

$query = "SELECT * FROM sms_option";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_option (`option`, `value`) VALUES ";
	$sql = $prefix . "('".$data['option']."', '".str_replace("'", "", $data['value'])."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_message";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_message (id, message, pubdate, status, idgroup, sender) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".str_replace("'", "", $data['message'])."', '".$data['pubdate']."', '".$data['status']."', '".$data['idgroup']."', '".$data['sender']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_phonebook";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_phonebook (noTelp, nama, alamat, idgroup, dateJoin, datebirth) VALUES ";
	$sql = $prefix . "('".$data['noTelp']."', '".str_replace("'", "", $data['nama'])."', '".str_replace("'", "", $data['alamat'])."', '".$data['idgroup']."', '".$data['dateJoin']."', '".$data['datebirth']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_poll_main";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_poll_main (id, description, status, `limited`, `open`, keyword) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".$data['description']."', '".$data['status']."', '".$data['limited']."', '".$data['open']."', '".$data['keyword']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_poll_option";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_poll_option (id, `option`, `desc`, timeinsert) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".$data['option']."', '".$data['desc']."', '".$data['timeinsert']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_poll_vote";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_poll_vote (id, phoneNumber, vote) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".$data['phoneNumber']."', '".$data['vote']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_spam";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_spam (sender) VALUES ";
	$sql = $prefix . "('".$data['sender']."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_template";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_template (id, template) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".str_replace("'", "", $data['template'])."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sms_autoreply";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sms_autoreply (id, keyword, reply) VALUES ";
	$sql = $prefix . "('".$data['id']."', '".str_replace("'", "", $data['keyword'])."', '".str_replace("'", "", $data['reply'])."')
";
	fwrite($handle, $sql);	
}

$query = "SELECT * FROM sentitems";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$prefix = "INSERT INTO sentitems (UpdatedInDB, SendingDateTime, DestinationNumber, TextDecoded, ID, SenderID, SequencePosition, Status, CreatorID) VALUES ";
	$sql = $prefix . "('".$data['UpdatedInDB']."', '".$data['SendingDateTime']."', '".$data['DestinationNumber']."', '".str_replace("'", "", $data['TextDecoded'])."', '".$data['ID']."', '".$data['SenderID']."', '".$data['SequencePosition']."', '".$data['Status']."', '".$data['CreatorID']."')
";
	fwrite($handle, $sql);	
}

fclose($handle);


$zip = new ZipArchive;
if ($zip->open('backup/backup-'.$date.'.zip', ZipArchive::CREATE) === TRUE) {
    $zip->addFile('backup-'.$date.'.sql', 'backup-'.$date.'.sql');
    $zip->close();
	echo "<br><p><b>Proses Backup Data Selesai</b></p>";
}

unlink('backup-'.$date.'.sql');

}

?>

<br>
<hr>
<h2>Restore Data</h2>
<p>&nbsp;</p>

<form method="post" enctype="multipart/form-data" action="indeks.php?op=backuprestore">
<table>
<tr><td>Pilih File Backup <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        <input name="userfile" type="file" size="50">
    </td>
    <td><input name="restore" type="submit" value="Restore Data">
	</td>
</tr>
</table>
</form>

<?php

if ($_POST['restore'])
{
// membaca nama file
$fileName = $_FILES['userfile']['name'];     

$split = explode('.zip', $fileName);
$namafile = $split[0];

// membaca size file
$fileSize = $_FILES['userfile']['size'];

// menggabungkan nama folder dan nama file
$uploadfile = $fileName;

// proses upload file ke folder 'data'
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
{

	$zip = new ZipArchive;
	if ($zip->open($uploadfile) === TRUE) 
	{
		$zip->extractTo('.');
		$zip->close();
		
		include 'koneksi.php';
		
		$handle = fopen($namafile.".sql", "r");
		if ($handle) {
			while (!feof($handle)) {
			$buffer = fgets($handle);
				$query = mysql_query($buffer);
			}
		fclose($handle);
		unlink($namafile.".sql");
		unlink($namafile.".zip");
		echo '<br><p><b>Proses Restore Selesai</b></p>';
		}			
	} 
	else 
	{
		echo 'Gagal';
	}
} 
else 
{
    echo "File gagal direstore";
}
}


}
}

if ($_SESSION['level'] == '1')
{
if ($_GET['op'] == 'config')
{
include "config.php";

if ($_GET['action'] == 'proses')
{
$path = $_POST['path'];
$msgREG = $_POST['regsukses'];
$msgErrorREG = $_POST['reggagal'];
$msgGroupErrorREG = $_POST['msgGroupErrorREG'];
$msgFWD = $_POST['fwdsukses'];
$msgErrorFWD = $_POST['fwdgagal'];
$msgUNREG = $_POST['msgUNREG'];
$msgErrorUNREG = $_POST['msgErrorUNREG'];
$msgGroupErrorUNREG = $_POST['msgGroupErrorUNREG'];
$msgINBOX = $_POST['smsinbox'];
$msgErrorData = $_POST['errordata'];
$msgErrorKeyword = $_POST['errorkeyword'];
$msgErrorInfo = $_POST['errorinfo'];
$deltaJam = $_POST['deltaJam'];
$commandREG = strtoupper($_POST['commandREG']);
$commandINFO = strtoupper($_POST['commandINFO']);
$commandFWD = strtoupper($_POST['commandFWD']);
$commandUNREG = strtoupper($_POST['commandUNREG']);
$autoReplyInbox = $_POST['autoReplyInbox'];
$defaultSender = $_POST['phoneid'];
$usermasking = $_POST['usermasking'];
$passmasking = $_POST['passmasking'];
$header = $_POST['header'];
$footer = $_POST['footer'];
$autoresend = $_POST['autoresend'];
$replyonsamemodem = $_POST['replyonsamemodem'];
$keywordSave = $_POST['keywordSave'];
$autostart = $_POST['autostart'];

$query = "UPDATE sms_option SET value = '$header' WHERE `option` = 'sms_header'";
mysql_query($query);
$query = "UPDATE sms_option SET value = '$footer' WHERE `option` = 'sms_footer'";
mysql_query($query);
 
$path = "\$path = \"".$path."\";
";
$msgREG = "\$msgREG = \"".$msgREG."\";
";
$msgErrorREG = "\$msgErrorREG = \"".$msgErrorREG."\";
";
$msgGroupErrorREG = "\$msgGroupErrorREG = \"".$msgGroupErrorREG."\";
";
$msgFWD = "\$msgFWD = \"".$msgFWD."\";
";
$msgErrorFWD = "\$msgErrorFWD = \"".$msgErrorFWD."\";
";
$msgUNREG = "\$msgUNREG = \"".$msgUNREG."\";
";
$msgErrorUNREG = "\$msgErrorUNREG = \"".$msgErrorUNREG."\";
";
$msgGroupErrorUNREG = "\$msgGroupErrorUNREG = \"".$msgGroupErrorUNREG."\";
";
$msgINBOX = "\$msgINBOX = \"".$msgINBOX."\";
";
$msgErrorData = "\$msgErrorData = \"".$msgErrorData."\";
";
$msgErrorKeyword = "\$msgErrorKeyword = \"".$msgErrorKeyword."\";
";
$msgErrorInfo = "\$msgErrorInfo = \"".$msgErrorInfo."\";
";
$deltaJam = "\$deltaJam = \"".$deltaJam."\";
";
$commandREG = "\$commandREG = \"".$commandREG."\";
";
$commandINFO = "\$commandINFO = \"".$commandINFO."\";
";
$commandFWD = "\$commandFWD = \"".$commandFWD."\";
";
$commandUNREG = "\$commandUNREG = \"".$commandUNREG."\";
";
$autoReplyInbox = "\$autoReplyInbox = \"".$autoReplyInbox."\";
";
$defaultSender = "\$defaultSender = \"".$defaultSender."\";
";
$usermasking = "\$usermasking = \"".$usermasking."\";
";
$passmasking = "\$passmasking = \"".$passmasking."\";
";
$serial = "\$serial = \"".$serial."\";
";
$autoresend = "\$autoresend = \"".$autoresend."\";
";
$replyonsamemodem = "\$replyonsamemodem = \"".$replyonsamemodem."\";
";
$keywordSave = "\$keywordSave = \"".$keywordSave."\";
";
$autostart = "\$autostart = \"".$autostart."\";
";
  
$file = "config.php";
 
$arrayRead = file($file);
 
$arrayRead[1] = $path;
$arrayRead[2] = $msgREG;
$arrayRead[3] = $msgErrorREG;
$arrayRead[4] = $msgGroupErrorREG;
$arrayRead[5] = $msgFWD;
$arrayRead[6] = $msgErrorFWD;
$arrayRead[7] = $msgUNREG;
$arrayRead[8] = $msgErrorUNREG;
$arrayRead[9] = $msgGroupErrorUNREG;
$arrayRead[10] = $msgINBOX;
$arrayRead[11] = $msgErrorData;
$arrayRead[12] = $msgErrorKeyword;
$arrayRead[13] = $msgErrorInfo;
$arrayRead[14] = $deltaJam;
$arrayRead[15] = $commandREG;
$arrayRead[16] = $commandINFO;
$arrayRead[17] = $commandFWD;
$arrayRead[18] = $commandUNREG;
$arrayRead[19] = $autoReplyInbox;
$arrayRead[20] = $defaultSender;
$arrayRead[21] = $usermasking;
$arrayRead[22] = $passmasking;
$arrayRead[23] = $serial;
$arrayRead[24] = $autoresend;
$arrayRead[25] = $replyonsamemodem;
$arrayRead[26] = $keywordSave;
$arrayRead[27] = $autostart;
 
$simpan = file_put_contents($file, implode($arrayRead));
echo "<p>Konfigurasi sudah tersimpan</p>";
}
else
{

$query = "SELECT * FROM sms_option WHERE `option` = 'sms_header'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$header = $data['value'];

$query = "SELECT * FROM sms_option WHERE `option` = 'sms_footer'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$footer = $data['value'];

?>

<h2>Setting Konfigurasi</h2>
<p>&nbsp;</p>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?op=config&action=proses">
<table width="100%">
<tr><td>Reply REG (sukses)</td><td>:</td><td><input type="text" name="regsukses" size="60" value="<?php echo $msgREG; ?>"><input type="hidden" name="path" size="60" value="<?php echo $path; ?>"></td></tr>
<tr><td>Reply REG (gagal)</td><td>:</td><td><input type="text" name="reggagal" size="60" value="<?php echo $msgErrorREG; ?>"></td></tr>
<tr><td>Reply REG (Group Error)</td><td>:</td><td><input type="text" name="msgGroupErrorREG" size="60" value="<?php echo $msgGroupErrorREG; ?>"></td></tr>
<tr><td>Reply FWD (sukses)</td><td>:</td><td><input type="text" name="fwdsukses" size="60" value="<?php echo $msgFWD; ?>"></td></tr>
<tr><td>Reply FWD (gagal)</td><td>:</td><td><input type="text" name="fwdgagal" size="60" value="<?php echo $msgErrorFWD; ?>"></td></tr>
<tr><td>Reply UNREG (sukses)</td><td>:</td><td><input type="text" name="msgUNREG" size="60" value="<?php echo $msgUNREG; ?>"></td></tr>
<tr><td>Reply UNREG (gagal)</td><td>:</td><td><input type="text" name="msgErrorUNREG" size="60" value="<?php echo $msgErrorUNREG; ?>"></td></tr>
<tr><td>Reply UNREG (Group Error)</td><td>:</td><td><input type="text" name="msgGroupErrorUNREG" size="60" value="<?php echo $msgGroupErrorUNREG; ?>"></td></tr>
<tr><td>Reply SMS INBOX </td><td>:</td><td><input type="text" name="smsinbox" size="60" value="<?php echo $msgINBOX; ?>"></td></tr>
<tr><td>Reply INFO (Error Data) </td><td>:</td><td><input type="text" name="errordata" size="60" value="<?php echo $msgErrorData; ?>"></td></tr>
<tr><td>Reply INFO (Error Keyword) </td><td>:</td><td><input type="text" name="errorkeyword" size="60" value="<?php echo $msgErrorKeyword; ?>"></td></tr>
<tr><td>Reply INFO (Error Info) </td><td>:</td><td><input type="text" name="errorinfo" size="60" value="<?php echo $msgErrorInfo; ?>"></td></tr>
<tr valign="top"><td>Beda Waktu dg WIB (GMT +7)</td><td>:</td><td><input type="text" name="deltaJam" size="10" value="<?php echo $deltaJam; ?>"> jam<br><br>Contoh: Jika waktu di daerah Anda 1 jam lebih dahulu dari WIB, isikan 1. <br>Jika tertinggal 1 jam setelah WIB, isikan -1.</td></tr>
<tr><td>Perintah SMS REG </td><td>:</td><td><input type="text" name="commandREG" size="60" value="<?php echo $commandREG; ?>"></td></tr>
<tr><td>Perintah SMS INFO </td><td>:</td><td><input type="text" name="commandINFO" size="60" value="<?php echo $commandINFO; ?>"></td></tr>
<tr><td>Perintah SMS FORWARD </td><td>:</td><td><input type="text" name="commandFWD" size="60" value="<?php echo $commandFWD; ?>"></td></tr>
<tr><td>Perintah SMS UNREG </td><td>:</td><td><input type="text" name="commandUNREG" size="60" value="<?php echo $commandUNREG; ?>"></td></tr>
<tr valign="top"><td>Auto Reply SMS Inbox </td><td>:</td><td><input type="text" name="autoReplyInbox" size="4" value="<?php echo $autoReplyInbox; ?>"><br><br>Isikan 0 untuk menonaktifkan auto reply SMS Inbox. <br>Isikan 1 untuk mengaktifkan auto reply SMS Inbox</td></tr>
<tr valign="top"><td>Default Sender </td><td>:</td><td><?php echo service2($defaultSender); ?><br><br>Default modem/HP yang digunakan untuk mengirim SMS balasan REG, FWD, INFO.</td></tr>
<tr><td>Username SMS Masking </td><td>:</td><td><input type="text" name="usermasking" size="60" value="<?php echo $usermasking; ?>"></td></tr>
<tr><td>Password SMS Masking </td><td>:</td><td><input type="text" name="passmasking" size="60" value="<?php echo $passmasking; ?>"></td></tr>
<tr valign="top"><td>Header SMS </td><td>:</td><td><input type="text" name="header" value="<?php echo $header; ?>" size="60"></td></tr>
<tr valign="top"><td>Footer SMS </td><td>:</td><td><input type="text" name="footer" value="<?php echo $footer; ?>" size="60"></td></tr>
<tr valign="top"><td>Auto Resend SMS (Sending Error) </td><td>:</td><td><input type="text" name="autoresend" value="<?php echo $autoresend; ?>" size="4"><br><br>Isikan 1 untuk mengaktifkan auto resend SMS ketika Sending Error. <br>Isikan 0 untuk menonaktifkannya</td></tr>
<tr valign="top"><td>Reply SMS Dari Modem yg Sama Ketika Terima</td><td>:</td><td><input type="text" name="replyonsamemodem" value="<?php echo $replyonsamemodem; ?>" size="4"><br>Isikan 1 untuk mengaktifkan fitur ini<br>Isikan 0 untuk menonaktifkan</td></tr>
<tr valign="top"><td>Simpan SMS Berkeyword</td><td>:</td><td><input type="text" name="keywordSave" value="<?php echo $keywordSave; ?>" size="4"><br>Isikan 1 untuk menyimpan semua SMS yang memuat keyword ke INBOX.<br>Isikan 0 untuk menonaktifkan</td></tr>
<tr valign="top"><td>Auto Start Service </td><td>:</td><td><input type="text" name="autostart" value="<?php echo $autostart; ?>" size="4"><br><br>Isikan 1 untuk mengaktifkan auto start service<br>Isikan 0 untuk menonaktifkannya</td></tr>
</table>
<br>
<input type="submit" value="SIMPAN KONFIGURASI">
</form>

<?php
}
}
}

if ($_GET['op'] == 'koneksi')
{
include "koneksi.php";

if ($_GET['action'] == 'proses')
{
$dbhost = $_POST['dbhost'];
$dbuser = $_POST['dbuser'];
$dbpass = $_POST['dbpass'];
$dbname = $_POST['dbname'];
 
$dbhost = "\$dbhost = \"".$dbhost."\";
";
$dbuser = "\$dbuser = \"".$dbuser."\";
";
$dbpass = "\$dbpass = \"".$dbpass."\";
";
$dbname = "\$dbname = \"".$dbname."\";
";
  
$file = "koneksi.php";
 
$arrayRead = file($file);
 
$arrayRead[1] = $dbhost;
$arrayRead[2] = $dbuser;
$arrayRead[3] = $dbpass;
$arrayRead[4] = $dbname;
 
$simpan = file_put_contents($file, implode($arrayRead));
echo "<p>Konfigurasi koneksi MySQL sudah tersimpan</p>";
}
else
{
?>

<h2>Setting Koneksi MySQL</h2>
<p>&nbsp;</p>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?op=koneksi&action=proses">
<table>
<tr><td>DB Host</td><td>:</td><td><input type="text" name="dbhost" size="50" value="<?php echo $dbhost; ?>"></td></tr>
<tr><td>DB User</td><td>:</td><td><input type="text" name="dbuser" size="50" value="<?php echo $dbuser; ?>"></td></tr>
<tr><td>DB Password</td><td>:</td><td><input type="text" name="dbpass" size="50" value="<?php echo $dbpass; ?>"></td></tr>
<tr><td>DB Name</td><td>:</td><td><input type="text" name="dbname" size="50" value="<?php echo $dbname; ?>"></td></tr>
</table>
<br>
<input type="submit" value="SIMPAN">
</form>

<?php
}
}
else if ($_GET['op'] == 'install')
{

$handle = @fopen("tabel-suplemen.sql", "r");
$content = fread($handle, filesize("tabel-suplemen.sql"));
$split = explode(";", $content);
	
mysql_select_db($dbname) or die(mysql_error());
	
for ($i=0; $i<=count($split)-1; $i++)
{
   mysql_query($split[$i]);
}

fclose($handle);

echo "<h3>Instalasi Sukses</h3>";
}

?>
				</div>
			</div>
			</div>
			</div>
			
		<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		<div id="sidebar">
		<ul>
		<?php
		if (isset($_SESSION['login']))
		{
			if ($_SESSION['level'] == '1')
			{
		?>
				<li>
					<h2>Administrasi</h2>
					<ul>
						<li><a href="indeks.php?op=config">Setting Konfigurasi</a></li>
						<li><a href="indeks.php?op=user">Pengaturan User</a></li>				
						<li><a href="indeks.php?op=service">Status Service</a></li>
						<li><a href="indeks.php?op=pulsa">Cek Pulsa</a></li>
						<li><a href="indeks.php?op=kredit">Cek Kredit SMS Masking</a></li>
						<li><a href="indeks.php?op=info">Cek Informasi SIM Card</a></li>
						<li><a href="indeks.php?op=spam">Daftar Nomor Spam</a></li>
						<li><a href="indeks.php?op=repair">Perbaiki Tabel Database</a></li>
						<li><a href="indeks.php?op=backuprestores">Backup dan Restore Data</a></li>
						<?php
						if (isset($_SESSION['login']))
						{
						echo '<li><a href="indeks.php?op=logout">Logout</a></li>';
						}
						?>
					</ul>
				</li>
				
				<?php
				if ($_GET['op'] == 'service')
				{
				?>
				<li>
					<h2>Status Service</h2>
					<ul>
					<li>
					<div id="service">
					
					</div>
					</li>
					</ul>
				</li>
				<?php
				}
				?>
		<?php
		}
		else
		{
		?>
		
		<li>
					<h2>Administrasi</h2>
					<ul>
						<?php
						if (isset($_SESSION['login']))
						{
						echo '<li><a href="indeks.php?op=logout">Logout</a></li>';
						}
						?>
					</ul>
				</li>
		
		
		<?php
		}
		}
		else
		{
		?>
		
		<li>
					<h2>Login</h2>
					<ul>
					    <li>
   					    <form method="post" action="indeks.php?op=login">
						Username:<br>
						<input type="text" name="username"><br>
						Password:<br>
						<input type="password" name="password"><br>
						<input type="submit" name="submit" value="Submit">
						</form>
						</li>						
					</ul>
				</li>
		
		<?php
		}
		?>
					
			</ul>
			<img src="images/sms.jpg">
		</div>
		
<?php
include "footer.php";
}
?>