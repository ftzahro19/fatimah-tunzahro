<?php
// jalankan perintah cek pulsa via gammu
exec("c:\xampp\klinik\tampil\sms -c c:\xampp\klinik\tampil\sms *123#", $hasil);

// proses filter hasil output
for ($i=0; $i<=count($hasil)-1; $i++)
{
   if (substr_count($hasil[$i], 'Service reply') > 0) $index = $i;
}

// menampilkan sisa pulsa
echo $hasil[$index];

?>
