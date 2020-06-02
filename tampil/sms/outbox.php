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
    document.getElementById("sms").innerHTML = xmlhttp.responseText;
    }
  }
  
  xmlhttp.open("GET","run.php",true);
  xmlhttp.send();
  setTimeout("ajax()", 1000);
  }  
  </script>
</head>
<body onLoad="ajax()">
<h2>SMS OUTBOX</h2>
<div id="sms">
</div>

</body>
</html>
