<html>
<head>
<script type="text/javascript">
function autorunservice()
{
         if (window.XMLHttpRequest)
		 {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttpservice=new XMLHttpRequest();
		 }
		 else
		 {// code for IE6, IE5
			xmlhttpservice =new ActiveXObject("Microsoft.XMLHTTP");
		 }
		 
		 xmlhttpservice.onreadystatechange=function()
		 {
			
		 }
		 
		 xmlhttpservice.open("GET","ajaxservice.php");
		 xmlhttpservice.send();
		 setTimeout("autorunservice()", 10000);
}  
  
</script>
  
</head>
<body onload="autorunservice();">

<?php
include "config.php";
include "koneksi.php";

if ($autostart == "1")
{
   $query = "UPDATE sms_option SET value = '1' WHERE `option` = 'sms_on'"; 
   mysql_query($query);
      
   for($i=1; $i<=100; $i++)
   {
		if (is_file('smsdrc'.$i))
		{
			exec($path."gammu-smsd -c smsdrc".$i." -n phone".$i." -s");
		}	
   }
}

?>
</body>
</html>