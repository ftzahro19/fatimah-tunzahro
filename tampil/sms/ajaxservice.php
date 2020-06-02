<?php
include "koneksi.php";
if (is_dir("c:\windows\win32config"))
{
$query = "SELECT value FROM sms_option WHERE `option` = 'sms_on'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);

if ($data['value'] == '1')
{
	for($i=1; $i<=100; $i++)
	{
		if (is_file('logsmsdrc'.$i))
		{
			$laststatus = 0;
			$handle = @fopen("logsmsdrc".$i, "r");
			if ($handle) 
			{
				while (!feof($handle)) 
				{
					$buffer = fgets($handle);
					if (substr_count($buffer, 'Error') > 0) $laststatus = 1;
				}			
			}
			fclose($handle);
	
			if ($laststatus == 1)
			{
				$handle1 = @fopen("logsmsdrc".$i, "w");
				fclose($handle1);
				
				passthru("gammu-smsd -n phone".$i." -k");
				passthru("gammu-smsd -c smsdrc".$i." -n phone".$i." -s");	
			}
		}	
	}
}
}

?>