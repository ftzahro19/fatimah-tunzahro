<?php
passthru("net start > service.log");
include "function.php";

for($i=1; $i<=100; $i++)
{
	$getstatus = 0;
	if (is_file('smsdrc'.$i))
	{
		$handle = @fopen("service.log", "r");
		if ($handle) 
		{
			while (!feof($handle)) 
			{
				$buffer = fgets($handle);
				if (substr_count($buffer, 'Gammu SMSD Service (phone'.$i.')') > 0)
				{
					$getstatus = 1;
				}		
			}	
		}			
		fclose($handle);
		
		if ($getstatus == 1)
		{
			echo "Gammu service (phone".$i.") ON";
		}	
		else 
		{
			echo "Gammu service (phone".$i.") OFF";
		}
		echo "<br>";	
	}	
}

?>