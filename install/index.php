<h2 align="center">INSTALASI SISTEM INFORMASI KLINIK </h2>
<h2 align="center"> SIK V1.0</h2>
<?php
  if ($_POST['submit']) 
  {
    $dbname = $_POST['db'];
	$dbuser = $_POST['username'];
	$dbpass = $_POST['password'];
	
	mysql_connect("localhost", $dbuser, $dbpass);
	$query = "DROP DATABASE IF EXISTS ".$dbname;
	$result = mysql_query($query);
	$query = "CREATE DATABASE ".$dbname;
	$result = mysql_query($query);
	
	if (!$result) {
    die('<b>Error: </b>' . mysql_error());
    }

    $handle = @fopen("mysql-table.sql", "r");
	$content = fread($handle, filesize("mysql-table.sql"));
	$split = explode(";", $content);
	
	mysql_select_db($dbname);
	
	for ($i=0; $i<=count($split)-1; $i++)
	{
	  mysql_query($split[$i]);
    }

	fclose($handle);
	echo "<p>Database <b>\"".$dbname."\"</b> sudah berhasil dibuat, untuk keamanan hapuslah folder install,</br> dan.... silahkan login <a href='http://localhost/klinik'>DISINI</a></p>";
  }
?> 

<p>Masukkan konfigurasi koneksi MySQL!</p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<table width="884">
 <tr><td width="133">USERNAME</td>
 <td width="3">:</td>
 <td width="713"><input type="text" name="username" value="root">
   * Defaultnya adalah &quot;root&quot; tanpa tanda petik </td>
 </tr>
 <tr><td>PASSWORD</td><td>:</td><td><input type="password" name="password"> 
 *Sama dengan password saat install WebServer (AppServ atau Xampp), default : 12345678 </td>
 </tr>
 <tr><td>NAMA DATABASE</td><td>:</td><td><input type="text" name="db" value="klinikdb">
 *Nama database yang akan dibuat, disarankan untuk menggunakan defaultnya </td>
 </tr>
 <tr><td></td><td></td><td><input type="submit" name="submit" value="INSTALL"></td></tr>
</table>

</form>
