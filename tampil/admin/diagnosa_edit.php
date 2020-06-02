<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$kdubah = $_GET['kdubah'];
$sql = "SELECT * FROM group_diagnosa WHERE id_diagnosa='$kdubah'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

?>
<html>
<head>
<title>UPDATE DIAGNOSA MEDIS</title>
</head>
<body>
<form action="diagnosa_edit_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">UPDATE DIAGNOSA MEDIS</th>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td width="33%">ID Diagnosa</td>
  <td width="67%">
	<input name="id_diagnosa" type="hidden" size="22" maxlength="35" value="<?php echo $data['id_diagnosa']; ?>">
        <input name="id_diagnosa" type="text" size="22" maxlength="35" value="<?php echo $data['id_diagnosa']; ?>" disabled="disabled">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>Nama Diagnosa</td>
  <td><input name="group_diagnosa" type="text" size="70" maxlength="200" value="<?php echo $data['group_diagnosa']; ?>">
  </td>
</tr>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td> 
	<input name="Submit" type="submit" value="Update">
  </td>
</tr>
</table>
</form>
</body>
</html>
