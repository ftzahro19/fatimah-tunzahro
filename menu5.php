<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Chocolate Brown 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20090413

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title></title>
<script src="jquery-latest.js"></script>
<script>
 $(document).ready(function() {
 	 $("#servicecontainer").load("run5.php");
   var refreshId = setInterval(function() {
      $("#servicecontainer").load('run5.php?randval='+ Math.random());
   }, 1000);
   $.ajaxSetup({ cache: false });
});
</script>


</head>
<body>
<div id="servicecontainer">
</div>
</body>
</html>