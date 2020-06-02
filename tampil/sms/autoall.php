<html>
<head>
  <script type="text/javascript">
  
function ajax() 
  {
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
     xmlhttp=new XMLHttpRequest();
	 xmlhttp2=new XMLHttpRequest();
	 xmlhttp3=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
     xmlhttp =new ActiveXObject("Microsoft.XMLHTTP");
	 xmlhttp2 =new ActiveXObject("Microsoft.XMLHTTP");
 	 xmlhttp3 =new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	document.getElementById("ultah").innerHTML = xmlhttp2.responseText;
	}
  }
  
  xmlhttp2.onreadystatechange=function()
  {
  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
    {
	document.getElementById("replay").innerHTML = xmlhttp2.responseText;
    }
  }
  
  xmlhttp3.onreadystatechange=function()
  {
  if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
    {
	document.getElementById("forward").innerHTML = xmlhttp2.responseText;
	}
  }

  xmlhttp.open("GET","ultah.php");
  xmlhttp.send();
  xmlhttp2.open("GET","autoreplay.php");
  xmlhttp2.send();
  xmlhttp3.open("GET","autoforward.php");
  xmlhttp3.send();
  setTimeout("ajax()", 1000);
  }  
  </script>
</head>
<body onLoad="ajax()">
<div id="replay">
</div>
</body>
</html>