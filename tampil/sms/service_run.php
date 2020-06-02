<html>
<head>
<!-- For ease i'm just using a JQuery version hosted by JQuery- you can download any version and link to it locally -->
<script src="jquery-latest.js"></script>
<script>
 $(document).ready(function() {
 	 $("#servicecontainer").load("service.php");
   var refreshId = setInterval(function() {
      $("#servicecontainer").load('service.php?randval='+ Math.random());
   }, 1000);
   $.ajaxSetup({ cache: false });
});
</script>
</head>
<body>
<H3>STATUS</H3>
<div id="servicecontainer">
</div>
</body>