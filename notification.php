<html>
<head>
<title>PESAN MASUK !</title>

<script>

var howLong = 60000;

t = null;
function closeMe(){
t = setTimeout("self.close()",howLong);
}

document.write('<embed src="tone.mp3" hidden="true" autostart="true" width=0 height=0>');

</script>
</head>
<body onLoad="closeMe(); self.focus()" bgcolor="#000000">

<div align="center">
<h2 style="color: #dddddd">NOTIFIKASI !!!</h2>
<hr>
<h1 style="color: #ffffff">Pesan masuk.... </h1>
</div>

</body>
</html>