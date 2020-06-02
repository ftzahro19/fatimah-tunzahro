<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
//cek apakah user sudah login
if(!isset($_SESSION['klinik'])){
    die("Anda belum login");//jika belum login jangan lanjut..
}
?>
<html>
<head>
<title>Tambah User</title>
</head>
<body>
<form  enctype="multipart/form-data" action="ubah_password_sim.php" method="post" name="form1" target="_self">
  <table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">Ubah Password</th>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Username</td>
  <td><input name="username" type="hidden" size="20" maxlength="20" value="<?php echo "".$_SESSION['klinik']."";?>"><?php echo "".$_SESSION['klinik']."";?></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Password Lama </td>
  <td width="67%"><input name="password" type="password" size="20" maxlength="20"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Password Baru </td>
  <td><input name="password2" type="password" size="20" maxlength="20"></td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Password Baru </td>
  <td width="67%"><input name="password3" type="password" size="20" maxlength="20"></td>
</tr>

<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Ubah">  </td>
</tr>
</table>
</form>
</body>
</html>
