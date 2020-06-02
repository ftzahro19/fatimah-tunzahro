<?php
include_once "../librari/inc.session.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
?>
<html>
<head>
<title>Tambah Diagnosa</title>
</head>
<body>
<form action="diagnosa_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">TAMBAH DIAGNOSA MEDIS</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">Kode Diagnosa</td>
  <td width="67%">
	<input name="kd_diagnosa" type="text" size="22" maxlength="35" value="<?php echo kdauto("group_diagnosa","Dx"); ?>">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama Diagnosa</td>
  <td><input name="nama_diagnosa" type="text" size="70" maxlength="200">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Tambah">
  </td>
</tr>
</table>
</form>
</body>
</html>
