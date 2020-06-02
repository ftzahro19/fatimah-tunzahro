<?php
include_once "tampil/librari/inc.koneksidb.php";

$sql = "SELECT * FROM data_klinik";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<link rel="shortcut icon" href="media/image/icon.gif" type="image/x-icon">
<link type="text/css" rel="stylesheet" media="all" href="media/css/base.css" />
<link type="text/css" rel="stylesheet" media="all" href="media/css/blue.css" />
<title><?php echo $data['nama_klinik'];?></title>
<style type="text/css">
body { background-image: url('#'); background-repeat: no-repeat; background-position: right; background-attachment: scroll; }
</style>
</head>
<body>
<p align="center">
<?php
        if ($data['logo']=="") {
	echo "<img src='tampil/admin/gambar/no_pic.jpg' width='125' height='125' valign=top align='center'/>";
	}
	else {
	echo "<img src='tampil/admin/gambar/".$data['logo']."' width='110' height='120' valign=top align='center'/>";
	}
	?>
</p>
<p></p>
<p></p>
<div align="center">
</div>
<form action="LoginPeriksa.php" method="post" name="form1" target="_self">
<table align="center" valign=top id="login" cellpadding="3" cellspacing="2" border="0"  class="rounded">
<tr><td><label>Username</label><input type="text" name="TxtUser" id="username" style="width:100%" /></td></tr>
<tr><td><label>Password</label><input type="password" name="TxtPasswd" style="width:100%" /></td></tr>
<tr><td><div style="float: center" class="hidden"></div>
<div align="center"><input type="submit" id="submit" value="Login" /></div></td></tr>
</table>
</form>
<h1 align="center"><?php echo $data['nama_klinik'];?></h1>
</body>
</html>
