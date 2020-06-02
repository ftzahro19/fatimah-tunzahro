<?php

// koneksi ke mysql
include "koneksi.php";
include "function3.php";

// auto resend SMS error

if ($autoresend == "1")
{

   $query = "SELECT count(*) AS juml FROM outbox";
   $hasil = mysql_query($query);
   $data  = mysql_fetch_array($hasil);

   if ($data['juml'] == 0)
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
   }
}

// mencatat tanggal sekarang

date_default_timezone_set("Asia/Jakarta");
$tgl = date("Y-m-d H:i:s", mktime(date("H")+$deltaJam, date("i"), date("s"), date("m"), date("d"), date("Y")));

// ---------------------- PROSEDUR AUTO RECEIVED TO INBOX START ------------------------------


$spam = Array();

$query = "SELECT * FROM sms_spam";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
   array_push($spam, $data['sender']);
}

$query = "DELETE FROM sms_temp WHERE DATEDIFF(NOW(), tanggal) >= 7";
mysql_query($query);

$query = "DELETE FROM inbox WHERE DATEDIFF(NOW(), ReceivingDateTime) >= 7";
mysql_query($query);

$query = "SELECT * FROM inbox WHERE (UDH = '' OR UDH LIKE '%01') AND processed = 'false'";
$hasil = mysql_query($query);

while ($data = mysql_fetch_array($hasil))
{
   $noTelp = $data['SenderNumber'];
   $noTelp2 = str_replace('+', '', $noTelp);
   if (in_array($noTelp2, $spam))
   {
      //$query3 = "DELETE FROM inbox WHERE SenderNumber LIKE '%$noTelp2%'";
	  //mysql_query($query3);
   }
}

$query = "SELECT * FROM inbox WHERE processed = 'false'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	$noTelp = $data['SenderNumber'];
	$text = $data['TextDecoded'];
	$id = $data['ID'];
	$query2 = "SELECT * FROM sms_autoreply";
	$hasil2 = mysql_query($query2);
	if (mysql_num_rows($hasil2) > 0)
	{
	while ($data2 = mysql_fetch_array($hasil2))
	{
		$key = $data2['keyword'];
		$reply = $data2['reply'];
		if (str_replace(" ", "", strtoupper($text)) == str_replace(" ", "", strtoupper($key)))
		{
			send($noTelp, $reply, '', '-1');
			$query3 = "DELETE FROM inbox WHERE ID = '$id'";
			mysql_query($query3);
		}
	}
	}
}

$query = "SELECT * FROM inbox WHERE (UDH = '' OR UDH LIKE '%01') AND processed = 'false'";
$hasil = mysql_query($query);

while ($data = mysql_fetch_array($hasil))
{
   $sum = 0;
   $noTelp = $data['SenderNumber'];
   $idmodem = $data['RecipientID'];
   
   if ($data['UDH'] != '')
   {
        
      $chop = substr($data['UDH'], 0, 8);
	  $n = (int) substr($data['UDH'], 8, 2);
	  $text = "";
	  for ($i=1; $i<=$n; $i++)
	  {
	     $udh = $chop.sprintf("%02s", $n).sprintf("%02s", $i);
		 $query3 = "SELECT * FROM inbox WHERE udh = '$udh' AND SenderNumber = '$noTelp' AND processed = 'false'";
		 $hasil3 = mysql_query($query3);
		 if (mysql_num_rows($hasil3) > 0) $sum++;
	  }
	  
	  if ($sum == $n)
	  {
	  	  for ($i=1; $i<=$n; $i++)
	      {
	         $udh = $chop.sprintf("%02s", $n).sprintf("%02s", $i);
		     $query3 = "SELECT * FROM inbox WHERE udh = '$udh' AND SenderNumber = '$noTelp' AND processed = 'false'";
		     $hasil3 = mysql_query($query3);
		     $data3 = mysql_fetch_array($hasil3);
			 $text .= $data3['TextDecoded'];
			 $id = $data3['ID'];
			 $query3 = "DELETE FROM inbox WHERE ID = '$id'";
			 mysql_query($query3);
	      }
	 
		  $notelp = $data['SenderNumber'];
		  $time = $data['ReceivingDateTime'];
		  $text = str_replace("'", "", $text);
		  
		  if (substr_count($text, '#') > 0)
		  {
				if ($keywordSave == 1) insertInbox($text, $notelp, $tgl, '', $idmodem);
				proses($text, $notelp, $idmodem);
		  }
		  else
			{
				if (substr($notelp, 0, 1) == '0')
				{
					$notelp[0] = "X";
					$notelp = str_replace("X", "+62", $notelp);
				}
				else $notelp = $notelp;
				$idfolder = lookupfolder($text);
				insertInbox($text, $notelp, $tgl, $idfolder, $idmodem);
			}
		  
	  }	  
   }
   else 
   {
      $id = $data['ID'];
	  $notelp = $data['SenderNumber'];
	  $time = $data['ReceivingDateTime'];	  
      $text = str_replace("'", "", $data['TextDecoded']);
	  if (substr_count($text, '#') > 0)
	  {
		 if ($keywordSave == 1) insertInbox($text, $notelp, $tgl, '', $idmodem);
		 proses($text, $notelp, $idmodem);
	  }
	  else
		{
			if (substr($notelp, 0, 1) == '0')
			{
				$notelp[0] = "X";
				$notelp = str_replace("X", "+62", $notelp);
			}
			else $notelp = $notelp;
			
			$idfolder = lookupfolder($text);
			
			insertInbox($text, $notelp, $tgl, $idfolder, $idmodem);
		}

  	  $query2 = "DELETE FROM inbox WHERE ID = '$id'";
      mysql_query($query2);
	
   }		
}

// ---------------------- PROSEDUR AUTO RESPONDER START ------------------------------

$query = "SELECT * FROM sms_phonebook";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
   $notelp = $data['noTelp'];
   $tglJoin = $data['dateJoin'];
   $nama = $data['nama'];
   
   $query2 = "SELECT * FROM sms_autoresponder";
   $hasil2 = mysql_query($query2);
   while ($data2 = mysql_fetch_array($hasil2))
   {
	   $interval = $data2['interv'];
	   $id = $data2['id'];
	   $sender = $data2['sender'];
	   
	   $query3 = "SELECT datediff('$tgl', '$tglJoin') as selisih";
	   $hasil3 = mysql_query($query3);
	   $data3 = mysql_fetch_array($hasil3);
	   
	   if ($data3['selisih'] >= $interval)
	   {
	      $query4 = "SELECT status FROM sms_autolist WHERE phoneNumber = '$notelp' AND id = '$id'";
		  $hasil4 = mysql_query($query4);
		  $data4  = mysql_fetch_array($hasil4);
		  if ($data4['status'] == '0')
		  {
  		     $msg = $data2['msg'];
		     $msg2 = str_replace('[nama]', $nama, $msg);
			 
			 $jam = date("H:i", mktime(date("H")+$deltaJam, date("i"), date("s"), date("m"), date("d"), date("Y")));
			 if ($jam >= '06:00')
			 {
				send($notelp, $msg2, '', '-1');
				$query4 = "DELETE FROM sms_autolist WHERE phoneNumber = '$notelp' AND id = '$id'";
				mysql_query($query4);
			 }
			 
          }			 
	   }
   }
   
}

// ---------------------- PROSEDUR ON SCHEDULED SMS START-------------------------

// mencari message yang publish date nya tanggal sekarang dan statusnya masih = 0 (belum dikirim)
$query = "SELECT * FROM sms_message WHERE pubdate <= '$tgl' AND status = 0";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

if (mysql_num_rows($hasil) > 0)
{
// jika ada message yang publish datenya tgl sekarang dan statusnya 0 maka dikirim

// membaca isi dan id message
$pesan = $data['message'];
$group = $data['idgroup'];
$sender = $data['sender'];
$id = $data['id'];

// mengubah status message menjadi 1 (telah dikirim)
$query = "DELETE FROM sms_message WHERE id = '$id'";
$hasil = mysql_query($query);

// membaca seluruh no. telp dari tabel sms_phonebook

if ($group == 0) $query = "SELECT * FROM sms_phonebook";
else $query = "SELECT * FROM sms_phonebook WHERE idgroup LIKE '%|$group|%'";

$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
      // proses pengiriman pesan SMS ke semua no. telp
      $notelp = $data['noTelp'];	  
      $pesan2 = str_replace('[nama]', $data['nama'], $pesan);

	  
	  send($notelp, $pesan2, $sender, '-1');
}
}

// ---------------------- PROSEDUR ON SCHEDULED SMS FINISH-------------------------

// --------------------- PROSEDUR SMS ULTAH ----------------------------

$query = "SELECT * FROM sms_option WHERE `option` = 'sms_birthday_on'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);

if ($data['value'] == 1)
{
	$jam = date("H:i", mktime(date("H")+$deltaJam, date("i"), date("s"), date("m"), date("d"), date("Y")));
	$query2 = "SELECT * FROM sms_option WHERE `option` = 'sms_birthday_time'";
	$hasil2 = mysql_query($query2);
	$data2  = mysql_fetch_array($hasil2);
	if ($jam >= $data2['value'])
	{
		$nowdate = date("Y-m-d", mktime(date("H")+$deltaJam, date("i"), date("s"), date("m"), date("d"), date("Y")));
		$nowdate2 = date("m-d", mktime(date("H")+$deltaJam, date("i"), date("s"), date("m"), date("d"), date("Y")));
		$query3 = "SELECT * FROM sms_phonebook WHERE datebirth LIKE '%$nowdate2'";
		$hasil3 = mysql_query($query3);
		while ($data3 = mysql_fetch_array($hasil3))
		{
			$notelp = $data3['noTelp'];
			$query4 = "INSERT INTO sms_birthday VALUES ('$notelp', '$nowdate')";
			$hasil4 = mysql_query($query4);
			if ($hasil4)
			{
				$query5 = "SELECT * FROM sms_option WHERE `option` = 'sms_birthday_template'";
				$hasil5 = mysql_query($query5);
				$data5  = mysql_fetch_array($hasil5);
				send($notelp, $data5['value'], $defaultSender, '-1');
			}
		}
	}
}


// -------------------------------------------------------------------------------------------

// ----------------------------------------------------------


// ----------------------------------------------------------

$query = "DELETE FROM sms_birthday WHERE DATEDIFF(NOW(), tglkirim) >= 30";
mysql_query($query);

$query = "DELETE FROM sms_temp WHERE DATEDIFF(NOW(), tglkirim) >= 30";
mysql_query($query);

$query = "DELETE FROM sentitems WHERE DATEDIFF(NOW(), SendingDateTime) >= 30";
mysql_query($query);

?>