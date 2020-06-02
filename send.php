<?php

function send($notelp, $msgReply, $phone, $type)
{
   include "koneksi.php";
   include "config.php";

   if ($replyonsamemodem == '0') $phone = '';	
  
   $tanggal = date("Y-m-d");
   
   $query = "SELECT * FROM sms_option WHERE `option` = 'sms_header'";
   $hasil = mysql_query($query);
   $data  = mysql_fetch_array($hasil);
   $header = $data['value'];
   
   $query = "SELECT * FROM sms_option WHERE `option` = 'sms_footer'";
   $hasil = mysql_query($query);
   $data  = mysql_fetch_array($hasil);
   $footer = $data['value'];
   
   $query = "SELECT nama FROM sms_phonebook WHERE noTelp = '$notelp'";
   $hasil = mysql_query($query);
   $data  = mysql_fetch_array($hasil);
   $nama = $data['nama'];
   
   $query = "SELECT alamat FROM sms_phonebook WHERE noTelp = '$notelp'";
   $hasil = mysql_query($query);
   $data  = mysql_fetch_array($hasil);
   $alamat = $data['alamat'];
   
   if ($header == '') $msgReply1 = $msgReply;
   else $msgReply1 = $header.'
'.$msgReply;
   
   if ($footer == '') $msgReply2 = $msgReply1;
   else $msgReply2 = $msgReply1.'
'.$footer;
   
   $msgReply = $msgReply2;
   
   preg_match_all("|\[(.*)\]|U", $msgReply, $result, PREG_PATTERN_ORDER);
   
   foreach($result[1] as $key => $nilai)
   {
   		$msgReply = str_replace('['.$nilai.']', '['.strtoupper($nilai).']', $msgReply);
   }
      
    $msgReply = str_replace('[NAMA]', $nama, $msgReply);
	$msgReply = str_replace('[ALAMAT]', $alamat, $msgReply);
	
	$msgReply = $msgReply . "";
		
    if (get_magic_quotes_gpc() == 0)
	{
		 $msgReply = str_replace("'","\'",$msgReply);
		 $msgReply = str_replace('\"','\"',$msgReply);
    }
	
	if (substr($notelp, 0, 1) == '0')
	{
		$notelp[0] = "X";
		$notelp = str_replace("X", "+62", $notelp);
	}
	else $notelp = $notelp;
     
 	  $query = "INSERT INTO sms_temp (textdecoded, tanggal) VALUES ('$msgReply', '$tanggal')";
	  mysql_query($query);

	  $query = "SELECT MAX(id) AS maxid FROM sms_temp";
	  $hasil = mysql_query($query);
      $data  = mysql_fetch_array($hasil);
      $maxid = $data['maxid'];	  
	  
      $query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID, SenderID, Class, Coding) VALUES ('$notelp', '$msgReply', '$maxid', '$phone', '$type', 'Default_No_Compression')";
      mysql_query($query);	  	  
 
}

function send2($notelp, $msgReply, $phone, $type, $creatorid)
{
   include "koneksi.php";
     
   $query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID, SenderID, Class) VALUES ('$notelp', '$msgReply', '$creatorid', '$phone', '$type')";
   mysql_query($query) or die(mysql_error());	    
}


function sendmasking($notelp, $msgReply)
{
   include "config.php";
   //include "function.php";

   $query = "SELECT nama FROM sms_phonebook WHERE noTelp = '$notelp'";
   $hasil = mysql_query($query);
   $data  = mysql_fetch_array($hasil);
   $nama = $data['nama'];
   
   preg_match_all("|\[(.*)\]|U", $msgReply, $result, PREG_PATTERN_ORDER);
   
   foreach($result[1] as $key => $nilai)
   {
   		$msgReply = str_replace('['.$nilai.']', '['.strtoupper($nilai).']', $msgReply);
   }
      
   $msgReply = str_replace('[NAMA]', $nama, $msgReply);

	
   $notelp = str_replace("+62", "62", $notelp);

   $msgReply = cekkarakter($msgReply);
   
   $url = "http://sms.rosihanari.net:8080/web2sms/api/sendSMS.aspx?username=".$usermasking."&mobile=".$notelp."&message=".urlencode($msgReply)."&auth=".md5($usermasking.$passmasking.$notelp);
   $grab = getURL($url);
   $status = substr($grab, 0, 4);
   if ($status == '1701') $status = "OK";
   else if ($status == '1702') $status = "Username/Password SMS Masking Tidak Valid";
   else if ($status == '1703') $status = "Gangguan Server SMS Masking";
   else if ($status == '1708') $status = "Kredit SMS Masking Tidak Memenuhi";
   echo "Status Kirim SMS Masking ke ".$notelp.": <b>".$status."</b><br>Isi SMS: <br>".$msgReply."<br><br>";
   
}



?>