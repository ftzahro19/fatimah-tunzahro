<?php

require_once('AES.class.php');

function hostname()
{
	$host = exec("wmic bios get serialnumber", $result1);
	$hasil = $result1[1];
	
	if ($result1[1] == "")
	{
		$host = exec("wmic diskdrive get signature", $result2);
		$hasil = $result2[1];
	}
	
	if (($result2[1] == "") && ($result1[1] == "")) $hasil = "12345678";
		
	return substr($hasil, 0, 4);
}

function paramEncrypt($x)
{
   $Cipher = new AES();
   // kunci enkripsi (Anda bisa memodifikasi kuncinya)
   $key_128bit = '2b7e151628aed2a6abf7158809cf4f3c';

   // membagi panjang string yang akan dienkripsi dengan panjang 16 karakter
   $n = ceil(strlen($x)/16);
   $encrypt = "";

   for ($i=0; $i<=$n-1; $i++)
   {
      // mengenkripsi setiap 16 karakter
      $cryptext = $Cipher->encrypt($Cipher->stringToHex(substr($x, $i*16, 16)), $key_128bit);
	  // menggabung hasil enkripsi setiap 16 karakter menjadi satu string enkripsi utuh
      $encrypt .= $cryptext;   
   } 

   $hasil = substr($encrypt, 0, 32);
   
   $kode = '';
   
   for ($i=0; $i<=31; $i++)
   {
		if (($i % 4 == 0) && ($i > 0)) $kode = $kode . '-';
		$kode = $kode . $hasil[$i];
   }
   
   return $kode;
}

function paramDecrypt($x)
{
   $Cipher = new AES();
   // kunci dekripsi (kunci ini harus sama dengan kunci enkripsi)
   $key_128bit = '2b7e151628aed2a6abf7158809cf4f3c';

   // karena string hasil enkripsi memiliki panjang 32 karakter, maka untuk proses dekripsi ini panjang string dipotong2 dulu menjadi 32 karakter
      
   $n = ceil(strlen($x)/32);
   $decrypt = "";

   for ($i=0; $i<=$n-1; $i++)
   {
      // mendekrip setiap 32 karakter hasil enkripsi
      $result = $Cipher->decrypt(substr($x, $i*32, 32), $key_128bit);
	  // menggabung hasil dekripsi 32 karakter menjadi satu string dekripsi utuh
      $decrypt .= $Cipher->hexToString($result);
   }
   return $decrypt; 
}

?>