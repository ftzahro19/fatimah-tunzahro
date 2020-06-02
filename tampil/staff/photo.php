<?php 
include "tab_staff.php"; 
?>
<html>
<head>
<title>DAFTAR STAFF</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>

</head>
<body id=tab2>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1">
    <tr>
      <td colspan="6" bgcolor="#CCCCCC"><div align="left"><strong>DAFTAR STAFF</strong></div></td>
    </tr>
<?php 
	$username = $_SESSION['klinik'];
	$sql = "SELECT * FROM user WHERE username='$username'";
	$qry = mysql_query($sql);
 
	while ($data = mysql_fetch_array($qry)) {
  ?>
    <tr bgcolor="#FFFFFF">
   <tr bgcolor="#FFFFFF">
    <td width="3%"><a href="../staff/gambar/<? echo $data['photo'];?>" rel="facebox">
<?php
	$username = $data['username'];
	$photo = $data['photo'];
        if ($data[photo]=="") {
	echo "<img src='../staff/gambar/nopic.jpg' width='54' height='54' />";
	}
	else {
	echo "<img src='../staff/gambar/".$data['photo']."' width='54' height='54' />";
	}
	?></td>
<td><? echo "".$data['username']."</br>".$data['nama']."</br>".$data['unit']."";?></td>

    </tr>

    <tr>
      <td colspan="6" bgcolor="#FFFFFF"><div align="left"><a href="staff_edit.php?username=<? echo $data['username']; ?>" class="style1">Update</a></div></td>
    </tr>
<?php
}
?>
  </table>
</body>
</html>
