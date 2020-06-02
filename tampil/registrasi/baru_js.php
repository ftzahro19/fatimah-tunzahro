<html>
<head>
  <script type="text/javascript">
  
  function ajax() 
  {
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
     xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("baru").innerHTML = xmlhttp.responseText;
    }
  }
  
  xmlhttp.open("GET","baru.php",true);
  xmlhttp.send();
  setTimeout("ajax()", 60000);
  }  
  </script>
</head>

<body onLoad="ajax()">
<div id="baru">
</div>
</body>
</html>
