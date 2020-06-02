<h3>KIRIM SMS</h3>
<?php 
include "../librari/inc.koneksidb.php"; 
include "menu2.php"; 
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
<body onload="ajax()">
  <table align="center" width="59%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="formku" method="post" action="send.php">
    <tr onMouseOver="this.bgColor='lightblue'" onMouseOut="this.bgColor='#efefef'" bgcolor="#efefef">
      <td colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>KIRIM SMS </strong></div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="40%" bgcolor="#D9E8F3">Nomor HP </td>
      <td width="60%" bgcolor="#D9E8F3"><input type="text"  name="nohp" size="20"/></td>
    </tr>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>Isi SMS </td>
      <td><textarea cols="40" rows="6" name="sms" onKeyUp="count()"></textarea></td>
    </tr>
    <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
      <td>&nbsp;</td>
      <td><input type="text" readonly name="counter" size="3" value="0" /></td>
    </tr>
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
