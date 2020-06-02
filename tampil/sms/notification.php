<html>
<head>
<script>
var howLong = 15000;
t = null;
function closeMe(){
t = setTimeout("self.close()",howLong);
}
document.write('<embed src="tone.mp3" hidden="true" autostart="true" width=0 height=0>');
</script>
</head>
<body onLoad="closeMe(); self.focus()" bgcolor="#000000">
<div align="center">
<h2 style="color: #dddddd">KLINIK</h2>
<hr>
<h1 style="color: #ffffff">SMS masuk...</h1>
<embed src="tone.mp3" width=0 height=0></embed>
</div>
</body>
</html>
