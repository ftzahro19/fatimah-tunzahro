<?php 
include "../librari/inc.koneksidb.php"; 
$nama = $data['nama'];
?>
<html>
<head>
<script type="text/javascript">
 function count()
  {
   document.formku.counter.value = document.formku.sms.value.length;
  }
</script>
<title>KIRIM SMS</title></head>
<body onLoad="ajax()">
  <table align="center" width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="formku" method="post" action="send.php">
    <tr onMouseOver="this.bgColor='lightblue'" onMouseOut="this.bgColor='#efefef'" bgcolor="#D9E8F3">
      <td colspan="2"><div align="center"><strong>KIRIM SMS </strong></div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="25%">Nomor HP </td>
      <td width="75%"><input type="text" name="nohp"></td>
    </tr>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>Isi SMS </td>
      <td><textarea cols="60" rows="3" name="sms" onKeyUp="count()"></textarea></td>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>&nbsp;</td>
      <td><input type="text" readonly name="counter" size="3" value="0" /></td>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>Format</td>
      <td><input type="radio" name="format" value="normal">Normal
  <input type="radio" name="format" value="flash">Flash </td>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>&nbsp;</td>
      <td height="26" colspan="4"><input type="submit" name="submit" value="Kirim"></td>
	  </tr>
	  </form>
	</table>
</body>
</html>