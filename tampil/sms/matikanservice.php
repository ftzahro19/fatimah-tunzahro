<?php

include "koneksi.php";

$query = "UPDATE sms_option SET value = '0' WHERE `option` = 'sms_on'"; 
mysql_query($query);

for($i=1; $i<=100; $i++)
   {
		if (is_file('smsdrc'.$i))
		{
			passthru("gammu-smsd -n phone".$i." -k");
			$handle1 = @fopen("logsmsdrc".$i, "w");
			fclose($handle1);
		}	
   }

?>