<html>
<head>
<title>ANTRIAN KLINIK</title>
  <script type="text/javascript">
var $jnoc = jQuery.noConflict();
$jnoc(document).ready(function(){
$jnoc("a.slick").click(function () {
$jnoc(".active").removeClass("active");
$jnoc(this).addClass("active");
$jnoc(".content-slick").slideUp();
var content_show = $jnoc(this).attr("title");
$jnoc("#"+content_show).slideDown();
});
});

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
    document.getElementById("resep_view").innerHTML = xmlhttp.responseText;
    }
  }
  
  xmlhttp.open("GET","tampil/registrasi/pasien_poliklinik.php",true);
  xmlhttp.send();
  setTimeout("ajax()", 2000);
  }  
  </script>
</head>

<body onLoad="ajax()">
<div id="resep_view">
</div>
</body>
</html>
