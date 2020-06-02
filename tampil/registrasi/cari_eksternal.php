<html>
<head>
<script src="../src/js/jscal2.js"></script>
    <script src="../src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/gold/gold.css" />
<title>PENDAFTARAN EKSTERNAL</title></head>
<body>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="proses_cari_eksternal.php">
<tr bgcolor="#CCCCCC"> 
    <td colspan="2" align="left"><strong>PENDAFTARAN EKSTERNAL</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="150" align="left">PRN</td>
    <td>
      <input name="prn" type="text" id="prn" maxlength="8" size="10">   </td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama</td>
    <td><input name="nama" type="text" id="nama"></td>
    </tr>
  
  <tr bgcolor="#FFFFFF">
    <td align="left">Tanggal Lahir </td>
    <td><input name="tgl_lahir" type="text" id="tgl_lahir" size="10">
	<image id="f_btn1" src="../src/calendar.jpg" width="16" height="15" border="0"></image>
		<script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("f_btn1", "tgl_lahir", "%Y-%m-%d");
     //]]></script>	</td>
    </tr>
  
<tr>
    <td bgcolor="#FFFFFF" colspan="2" align="left"><input type="submit" name="Submit" value="Cari..."></td>
  </tr>
  </form>
</table>
</body>
</html>
