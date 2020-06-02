<?php
include "cek.php";
if ($idsession != "")
{
include "menu.php";
?>

				<h2 class="title">SMS Instant</h2>
				
<div class="entry">
<img src="images/instan.jpg" style="float: right;">
<p>&nbsp;</p>
<p>&nbsp;</p>				
					<p>
<?php
if ($_GET['op'] == "send")
{
  echo "<hr><p>SMS sudah dikirim....</p><hr>";
  
  if ($_POST['template'] == 1)
  {
	addtemplate(str_replace("'", "", $_POST['pesan']));
  }
  
  if ($_POST['submit1'])
  { 
   $phone = $_POST['phoneid'];
   $tipe = $_POST['tipe'];

   if ($tipe == 'flash') $type = '0';
   else if ($tipe == 'normal') $type = '-1';
   
   // jika pengirimannya berdasarkan group
   if ($_POST['kirim'] == "group")
   {
   // membaca group
   $group = $_POST['group'];
   // membaca pesan yang akan dikirim dari form
   $pesan = $_POST['pesan'];
   
 
     
   // membaca  no. telp dari phonebook berdasarkan group
   
   if ($group == 0) $query = "SELECT * FROM sms_phonebook";
   else if ($group > 0) $query = "SELECT * FROM sms_phonebook WHERE idgroup LIKE '%|$group|%'";
   
   $hasil = mysql_query($query);
   
   while ($data = mysql_fetch_array($hasil))
   {
      // proses pengiriman pesan SMS ke semua no. telp
      $notelp = $data['noTelp'];
	  
      send($notelp, $pesan, $phone, $type);  
   }
   }
   // jika pengirimannya berdasarkan single
   else if ($_POST['kirim'] == "single")
   {
   
   // membaca no hp dari single
   $notelp = $_POST['nohp'];
   // membaca pesan yang akan dikirim dari form
   $pesan = $_POST['pesan'];
   
   send($notelp, $pesan, $phone, $type);
   }
   else if ($_POST['kirim'] == "single2")
   {
   // membaca no hp dari single
   $notelp = $_POST['nohp2'];
   // membaca pesan yang akan dikirim dari form
   $pesan = $_POST['pesan'];
   
   send($notelp, $pesan, $phone, $type);   
   }
   else if ($_POST['kirim'] == 'multiple')
   {
	 $pesan = $_POST['pesan']; 
	 $karakter = Array('+', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	 
     if (isset($_POST['multinohp']))
	 {
		 $multinohp = $_POST['multinohp'];
		 //echo addslashes($multinohp);
		 
	     $split = explode(';', str_replace(' ', '', $multinohp));
		 for($i=0; $i<=count($split)-1; $i++)
		 {
		    $split2 = explode(')', $split[$i]);
			for($j=0; $j<=count($split2)-1; $j++)
			{
			  $split3 = explode('(', $split2[$j]);
			  $mystring = $split3[0];
			  
              for($k=0; $k<=strlen($mystring)-1; $k++)
			  {
                 if (!in_array($mystring[$k], $karakter)) $mystring[$k] = ' ';    
              }		
              $mystring = str_replace(" ", "", $mystring);
			  if (strlen($mystring) > 1)
			  {
			  //echo $mystring."<br>"; 			  
			  send($mystring, $pesan, $phone, $type);
			  }
			}
		 }
	 }
   }
 }
 else if ($_POST['submit2'])
 {
   $phone = $_POST['phoneid'];
   $tipe = $_POST['tipe'];

   if ($tipe == 'flash') $type = '0';
   else if ($tipe == 'normal') $type = '-1';
   
   // jika pengirimannya berdasarkan group
   if ($_POST['kirim'] == "group")
   {
   // membaca group
   $group = $_POST['group'];
   // membaca pesan yang akan dikirim dari form
   $pesan = $_POST['pesan'];
   
  
     
   // membaca  no. telp dari phonebook berdasarkan group
   
   if ($group == 0) $query = "SELECT * FROM sms_phonebook";
   else if ($group > 0) $query = "SELECT * FROM sms_phonebook WHERE idgroup LIKE '%|$group|%'";
   
   $hasil = mysql_query($query);
   
   while ($data = mysql_fetch_array($hasil))
   {
      // proses pengiriman pesan SMS ke semua no. telp
      $notelp = $data['noTelp'];
	  
      sendmasking($notelp, $pesan);  
   }
   }
   // jika pengirimannya berdasarkan single
   else if ($_POST['kirim'] == "single")  
   {
   
   // membaca no hp dari single
   $notelp = $_POST['nohp'];
   // membaca pesan yang akan dikirim dari form
   $pesan = $_POST['pesan'];
   
   sendmasking($notelp, $pesan);
   }
   else if ($_POST['kirim'] == "single2")
   {
   
     // membaca no hp dari single
   $notelp = $_POST['nohp2'];
   // membaca pesan yang akan dikirim dari form
   $pesan = $_POST['pesan'];
   
   sendmasking($notelp, $pesan);
   
   }
   else if ($_POST['kirim'] == 'multiple')
   {
	 $pesan = $_POST['pesan']; 
	 $karakter = Array('+', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	 
     if (isset($_POST['multinohp']))
	 {
		 $multinohp = $_POST['multinohp'];
		 //echo addslashes($multinohp);
		 
	     $split = explode(';', str_replace(' ', '', $multinohp));
		 for($i=0; $i<=count($split)-1; $i++)
		 {
		    $split2 = explode(')', $split[$i]);
			for($j=0; $j<=count($split2)-1; $j++)
			{
			  $split3 = explode('(', $split2[$j]);
			  $mystring = $split3[0];
			  
              for($k=0; $k<=strlen($mystring)-1; $k++)
			  {
                 if (!in_array($mystring[$k], $karakter)) $mystring[$k] = ' ';    
              }		
              $mystring = str_replace(" ", "", $mystring);
			  if (strlen($mystring) > 1)
			  {
			  //echo $mystring."<br>"; 	
			  sendmasking($mystring, $pesan);		
			  }
			}
		 }
	 }
   }
   
   creditleft();
   
 }
}
else if ($_GET['op'] == 'autoreply2')
{

?>
<h2>Short Keyword Auto Reply SMS</h2>
<p>&nbsp;</p>

<?php
	if ($_GET['act'] == 'save')
	{
		$key = $_POST['key'];
		$reply = str_replace("'", "", $_POST['reply']);
		$query = "INSERT INTO sms_autoreply (keyword, reply) VALUES ('$key', '$reply')";
		mysql_query($query);
		echo "<br><p>Auto Reply Sudah Disimpan</p>";
	}
	else if ($_GET['act'] == 'update')
	{
		$key = $_POST['key'];
		$reply = str_replace("'", "", $_POST['reply']);
		$id = $_POST['id'];
		$query = "UPDATE sms_autoreply SET keyword = '$key', reply = '$reply' WHERE id = '$id'";
		mysql_query($query);
		echo "<br><p>Auto Reply Sudah Diupdate</p>";
	}
	else if ($_GET['act'] == 'del')
	{
		$id = $_GET['id'];
		$query = "DELETE FROM sms_autoreply WHERE id = '$id'";
		mysql_query($query);
		echo "<br><p>Auto Reply Sudah Dihapus</p>";
	}
?>

<table id="tabelku" width="100%">
	<tr><th width="25%">KEYWORD</th><th width="60%">REPLY</th><th align="center">ACTION</th></tr>

<?php
	$query = "SELECT * FROM sms_autoreply ORDER BY id";
	$hasil = mysql_query($query);
	
	while ($data = mysql_fetch_array($hasil))
	{
		echo "<tr valign='top'><td>".$data['keyword']."</td><td>".$data['reply']."</td><td align='center'><a href='sendsms.php?op=autoreply2&act=edit&id=".$data['id']."'>EDIT</a> | <a href='sendsms.php?op=autoreply2&act=del&id=".$data['id']."'>DEL</a></td></tr>";
	}
?>
</table>
<br>
<p><a href="sendsms.php?op=autoreply2&act=add">+ Tambah Keyword</a></p>
<?php
	if ($_GET['act'] == 'add')
	{
?>
	<form method="post" action="sendsms.php?op=autoreply2&act=save">
	<table>
		<tr valign="top"><td>KEYWORD</td><td>:</td><td><input type="text" name="key" size="50"><br>Contoh: INFO DONASI</td></tr>
		<tr valign="top"><td>REPLY</td><td>:</td><td><textarea name="reply" cols="50" rows="5"></textarea><br>Contoh: Donasi dapat ditransfer ke rekening BCA, No. Rekening: XXXXX</td></tr>		
	</table>
	<br>
	<input type="submit" name="submit" class="tombolku" value="Simpan Auto Reply">
	</form>
<?php		
	}
	else if ($_GET['act'] == 'edit')
	{
		$id = $_GET['id'];
		$query = "SELECT * FROM sms_autoreply WHERE id = '$id'";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$key = $data['keyword'];
		$reply = $data['reply'];
?>
	<form method="post" action="sendsms.php?op=autoreply2&act=update">
	<table>
		<tr valign="top"><td>KEYWORD</td><td>:</td><td><input type="text" name="key" size="50" value="<?php echo $key;?>"><br>Contoh: INFO DONASI</td></tr>
		<tr valign="top"><td>REPLY</td><td>:</td><td><textarea name="reply" cols="50" rows="5"><?php echo $reply; ?></textarea><br>Contoh: Donasi dapat ditransfer ke rekening BCA, No. Rekening: XXXXX</td></tr>		
	</table>
	<br>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" name="submit" class="tombolku" value="Simpan Auto Reply">
	</form>
<?php		
	}
	
}
else if ($_GET['op'] == 'broadcast')
{
?>
<h2>SMS Broadcast Via Upload File</h2>
<p>&nbsp;</p>
<?php
   if ($_GET['action'] == 'proses')
   {
    echo "<hr>SMS telah dikirim....<hr>";
   
    if ($_POST['upload1'])
	{
    $phone = $_POST['phoneid'];
	$tipe = $_POST['tipe'];
	
	if ($tipe == 'flash') $type = '0';
	else if ($tipe == 'normal') $type = '-1';
	
    error_reporting(E_ALL ^ E_NOTICE);
	require_once 'excel_reader2.php';

	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

	$baris = $data->rowcount($sheet_index=0);
	$kolom = $data->colcount($sheet_index=0);

	for ($i=2; $i<=$baris; $i++)
	{
		$string = $_POST['template'];
		preg_match_all("|\[(.*)\]|U", $string, $hasil, PREG_PATTERN_ORDER);

		for($j=1; $j<=$kolom; $j++)
		{
			$value[strtoupper($data->val(1, $j))] = $data->val($i, $j);
			$nohp = $data->val($i, 1);	
		}
     
		foreach($hasil[1] as $key => $nilai)
		{
   			$string = str_replace('['.$nilai.']', '['.strtoupper($nilai).']', $string);
			$kapital = strtoupper($nilai);
			$string = str_replace('['.$kapital.']', $value[$kapital], $string);
		}
  
		if (is_string($nohp) && ($nohp != ''))
		{
		  send($nohp, $string, $phone, $type);
		}  
	}
	}
	else if ($_POST['upload2'])
	{
	  error_reporting(E_ALL ^ E_NOTICE);
	  require_once 'excel_reader2.php';

	  $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

	  $baris = $data->rowcount($sheet_index=0);
	  $kolom = $data->colcount($sheet_index=0);

	  for ($i=2; $i<=$baris; $i++)
	  {
		$string = $_POST['template'];
		preg_match_all("|\[(.*)\]|U", $string, $hasil, PREG_PATTERN_ORDER);

		for($j=1; $j<=$kolom; $j++)
		{
			$value[strtoupper($data->val(1, $j))] = $data->val($i, $j);
			$nohp = $data->val($i, 1);	
		}
     
		foreach($hasil[1] as $key => $nilai)
		{
   			$string = str_replace('['.$nilai.']', '['.strtoupper($nilai).']', $string);
			$kapital = strtoupper($nilai);
			$string = str_replace('['.$kapital.']', $value[$kapital], $string);
		}
  
		if (is_string($nohp) && ($nohp != ''))
		{
		  sendmasking($nohp, $string);
		}  
	  }
	  creditleft();
	}
	   
   }
   else
	{
?>

<form method="post" enctype="multipart/form-data" action="sendsms.php?op=broadcast&action=proses">
Pilih file source<br>
<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
<input name="userfile" type="file" size="50"><br><br>
Masukkan template SMS<br>
<textarea name="template" cols="50" rows="8"></textarea><br><br>
Tipe SMS : <input type="radio" name="tipe" value="flash"> Flash <input type="radio" name="tipe" value="normal" checked> Normal<br><br>
Kirim melalui modem/HP : <?php echo service2(''); ?><br><br>
<input name="upload1" type="submit" value="Kirim SMS Non Masking" class='tombolku'> <input name="upload2" type="submit" value="Kirim SMS Masking" class='tombolku'></td>
</form>

<?php	
	}

}
else if ($_GET['op'] == 'autoreply')
{
?>
<h2>Long Keyword Auto Reply SMS</h2>
<p>&nbsp;</p>
<form method="post" enctype="multipart/form-data" action="sendsms.php?op=autoreply&action=proses">
Pilih file source<br>
<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
<input name="userfile" type="file" size="50"> <input name="upload" type="submit" value="Import Data"></td>
</form>
<p>&nbsp;</p>
<h3><small>Daftar Keyword</small></h3>
<br>
<table id="tabelku" width='100%'>
<tr><th>NO</th><th>KEYWORD</th><th>ACTION</th></tr>
<?php

if ($_GET['action'] == 'delete')
{
   $key = $_GET['key'];
   $query = "DELETE FROM sms_data WHERE keyword = '$key'";
   mysql_query($query);
   $query = "DELETE FROM sms_keyword WHERE keyword = '$key'";
   mysql_query($query);
   echo "<br><p>Data Auto Reply Keyword ".$key." Sudah Dihapus</p>";
}
else if ($_GET['action'] == 'proses')
{
    error_reporting(E_ALL ^ E_NOTICE);
	require_once 'excel_reader2.php';

	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

	$baris = $data->rowcount($sheet_index=0);
	$kolom = $data->colcount($sheet_index=0);
	
	$sukses = 0;
	$gagal = 0;
	
	for ($i=2; $i<=$baris; $i++)
	{
	    $keyword = str_replace(" ", "", strtoupper($data->val($i, 1)));
		$key = strtoupper($data->val($i, 2));
		$field1 = $data->val($i, 3);
		$field2 = $data->val($i, 4);
		$field3 = $data->val($i, 5);
		$field4 = $data->val($i, 6);
		$field5 = $data->val($i, 7);
		
		if (($keyword != '') && ($key != ''))
		{
		$query = "INSERT INTO sms_data VALUES ('$keyword', '$key', '$field1', '$field2', '$field3', '$field4', '$field5')";
		$hasil = mysql_query($query);
		if ($hasil) $sukses++;
		else $gagal++;
		$katakunci = $keyword;
		}
	}
    echo "<br><p>Data telah diimport</p>";
	echo "<p>Jumlah Data: ".($gagal+$sukses).", Jumlah Data Sukses Diimport: ".$sukses.", Jumlah Data Gagal Diimport: ".$gagal."</p>";
	
	$query = "INSERT INTO sms_keyword VALUES ('$katakunci', '')";
	mysql_query($query);
	
}


$query = "SELECT keyword FROM sms_keyword ORDER BY keyword";
$hasil = mysql_query($query);
$i = 1;
while ($data = mysql_fetch_array($hasil))
{
   echo "<tr><td>".$i."</td><td>".$data['keyword']."</td><td> <a href='".$_SERVER['PHP_SELF']."?op=autoreply&action=view&key=".$data['keyword']."'>VIEW DATA</a> | <a href='".$_SERVER['PHP_SELF']."?op=autoreply&action=template&key=".$data['keyword']."'>SET TEMPLATE</a> | <a href='".$_SERVER['PHP_SELF']."?op=autoreply&action=delete&key=".$data['keyword']."'>DEL</a></td></tr>";
   $i++;
} 
echo "</table>";

if ($_GET['action'] == 'view')
{
   $key = $_GET['key'];
   
   if ($_GET['act'] == 'del')
   {
		$kunci = $_GET['kunci'];
		$query = "DELETE FROM sms_data WHERE keyword = '$key' AND `key` = '$kunci'";
		mysql_query($query);
   }
   else if ($_GET['act'] == 'update')
   {
		$kuncilama = str_replace("'", "", $_POST['kuncilama']);
		$kuncibaru = str_replace("'", "", $_POST['kuncibaru']);		
		$field1 = str_replace("'", "", $_POST['field1']);
		$field2 = str_replace("'", "", $_POST['field2']);
		$field3 = str_replace("'", "", $_POST['field3']);
		$field4 = str_replace("'", "", $_POST['field4']);
		$field5 = str_replace("'", "", $_POST['field5']);

		$query = "UPDATE sms_data SET `key` = '$kuncibaru', field1 = '$field1', field2 = '$field2', field3 = '$field3', 
		          field4 = '$field4', field5 = '$field5' WHERE keyword = '$key' AND `key` = '$kuncilama'";
		mysql_query($query);
   }
   else if ($_GET['act'] == 'edit')
   {
		$kunci = $_GET['kunci'];
		$query = "SELECT * FROM sms_data WHERE keyword = '$key' AND `key` = '$kunci'";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
?>
<p>&nbsp;</p>

<form method="post" action="sendsms.php?op=autoreply&action=view&key=<?php echo $key; ?>&act=update">

<table>
	<tr><td>KEY</td><td>:</td><td><input type="text" name="kuncibaru" value="<?php echo $data['key'];?>" size="20"></td></tr>
	<tr><td>FIELD 1</td><td>:</td><td><input type="text" name="field1" value="<?php echo $data['field1'];?>" size="80"></td></tr>
	<tr><td>FIELD 2</td><td>:</td><td><input type="text" name="field2" value="<?php echo $data['field2'];?>" size="80"></td></tr>
	<tr><td>FIELD 3</td><td>:</td><td><input type="text" name="field3" value="<?php echo $data['field3'];?>" size="80"></td></tr>
	<tr><td>FIELD 4</td><td>:</td><td><input type="text" name="field4" value="<?php echo $data['field4'];?>" size="80"></td></tr>
	<tr><td>FIELD 5</td><td>:</td><td><input type="text" name="field5" value="<?php echo $data['field5'];?>" size="80"></td></tr>	
</table>
<br>
<input type="hidden" name="kuncilama" value="<?php echo $data['key'];?>">
<input type="submit" name="submit" value="Update Data Autoreply" class='tombolku'>
</form>
<?php		
   }
   
   $query = "SELECT * FROM sms_data WHERE keyword = '$key'";
   $hasil = mysql_query($query);
   $i = 1;
   echo "<br><br><table id='tabelku' width='100%'>";
   echo "<tr><th>NO</th><th>KEYWORD</th><th>KEY</th><th>FIELD1</th><th>FIELD2</th><th>FIELD3</th><th>FIELD4</th><th>FIELD5</th><th>ACTION</th></tr>";
   while ($data = mysql_fetch_array($hasil))
   {
     echo "<tr valign='top'><td>".$i."</td><td>".$data['keyword']."</td><td>".$data['key']."</td><td>".$data['field1']."</td><td>".$data['field2']."</td><td>".$data['field3']."</td><td>".$data['field4']."</td><td>".$data['field5']."</td><td><a href='sendsms.php?op=autoreply&action=view&act=edit&key=".$key."&kunci=".$data['key']."' title='Edit Data Autoreply'><img src='images/edit.jpg'></a> <a href='sendsms.php?op=autoreply&action=view&act=del&key=".$key."&kunci=".$data['key']."' title='Hapus Data'><img src='images/delete.jpg'></a></td></tr>";
	 $i++;
   }
   echo "</table>";

}
else if ($_GET['action'] == 'updatetemplate')
{
   $key = str_replace("'", "", $_POST['key']);
   $template = str_replace("'", "", $_POST['template']);
   $query = "UPDATE sms_keyword SET template = '$template' WHERE keyword = '$key'";
   mysql_query($query);
   echo "<br><p>Template sudah diupdate</p>";
}
else if ($_GET['action'] == 'template')
{
   $key = $_GET['key'];
   $query = "SELECT * FROM sms_keyword WHERE keyword = '$key'";
   $hasil = mysql_query($query);
   $data = mysql_fetch_array($hasil);
   $template = str_replace("'", "", $data['template']);
   echo "<br><br><p><b>SET TEMPLATE KEYWORD : ".$key."</b></p>";
?>
   <form method="post" action="sendsms.php?op=autoreply&action=updatetemplate">
   <textarea cols="50" rows="5" name="template"><?php echo $template; ?></textarea><br><br>
   <input type="hidden" name="key" value="<?php echo $key; ?>">
   <input type="submit" name="submit" value="Simpan Template" class='tombolku'>
   </form>
<?php
}

}
else if ($_GET['op'] == 'single')
{
?>
<form name="formku" method="post" action="<?php $_SERVER['PHP_SELF'];?>?op=send">
<table border="0">
<tr><td width="30%">Message :</td><td width="30%"></td><td width="30%"></td></tr>
<tr><td colspan="3"><textarea name="pesan" rows="12" cols="60" onKeyUp="count()"></textarea></td></tr>
<tr><td>Panjang SMS : <input type="text" readonly name="counter" size="3" value="0" /></td><td><input type="checkbox" name="template" value="1"> Simpan ke template</td><td><a href="" onclick="window.open('template.php','mywindow','toolbar=0,location=0,menubar=0,resizable=0,status=0,scrollbars=1,width=400,height=600');">(ambil dr template)</a></td></tr>
</table><br><br>
<b>Keterangan:</b> <br>Berikan string [nama] bila ingin menampilkan nama si penerima SMS pada pesan di atas. <br>Contoh: "Hallo [nama], apa kabar?"
<br><br>
<table>
<tr><td width="40%"><input type="radio" name="kirim" value="group"> Kirim Ke Group </td><td> 
<select name='group' onchange="selected(1);">
<option value="0" selected>All</option>
<?php
$query = "SELECT * FROM sms_group";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
  echo "<option value='".$data['idgroup']."'>".$data['group']."</option>";
}
?>
</select></td></tr>
<tr>
<td><input type="radio" name="kirim" value="single"> Kirim Ke Single </td><td>
<select name='nohp' onchange="selected(2);">
<?php
$query = "SELECT * FROM sms_phonebook ORDER BY nama";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
  echo "<option value='".$data['noTelp']."'>".strtoupper($data['nama'])."</option>";
}
?> 
</select></td></tr>
<tr> <td><input type="radio" name="kirim" value="single2"> Kirim Ke Nomor Tertentu </td><td><input type="text" name="nohp2" value="+62" onclick="selected(3);"></td></tr>
<tr valign="top"> <td><input type="radio" name="kirim" value="multiple"> Kirim Ke Bbrp Nomor Tertentu <br><br></td><td><textarea name="multinohp" cols="40" rows="5"></textarea><br><input type="button" onclick="window.open('phonebook.php','mywindow','toolbar=0,location=0,menubar=0,resizable=0,status=0,scrollbars=1,width=400,height=600'); selected(4);" value="Cari Phonebook" class='tombolku'></td></tr>
<tr><td>Tipe SMS</td><td><input type="radio" name="tipe" value="flash"> Flash <input type="radio" name="tipe" value="normal" checked> Normal</td></tr>
<tr><td>Kirim melalui modem/HP</td><td><?php echo service2('');?></td></tr>
<tr><td></td><td><br><input type="submit" name="submit1" value="Send SMS Non Masking" class='tombolku'> <input type="submit" name="submit2" value="Send SMS Masking" class='tombolku'></td></tr>
</table>
</form>
<?php
}
?></p>
				</div>
			</div>
			</div>
			</div>
			
		<div style="clear: both;">&nbsp;</div>
		</div>
		
		<div id="sidebar">
		<ul>
				<li>
					<h2>Sub menu</h2>
					<ul>
					    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=single">Single SMS</a></li>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=broadcast">Broadcast SMS via Import File</a></li>
					</ul>
					<h2>Auto Reply SMS</h2>
					<ul>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=autoreply">Long Keyword Auto Reply SMS</a></li>
						<li><a href="<?php echo $_SERVER['PHP_SELF']?>?op=autoreply2">Short Keyword Auto Reply SMS</a></li>
						<?php
						if (isset($_SESSION['login']))
						{
						echo '<li><a href="indeks.php?op=logout">Logout</a></li>';
						}
						?>
					</ul>
				</li>
				
				
					
		</ul>
		<p>&nbsp;</p>
			<img src="images/sms.jpg">
		</div>
	
<?php
}
else exit;
include "footer.php";
?>