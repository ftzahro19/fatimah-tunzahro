<html>
<head>
<script src="../src/js/jscal2.js"></script>
    <script src="../src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/gold/gold.css" />
<title>PENDAFTARAN PASIEN BARU</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="proses_cari.php">
<tr bgcolor="#CCCCCC"> 
    <td colspan="2" align="left"><strong>Data Pasien</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="208" align="left">PRN</td>
    <td colspan="2">
      <input name="prn" type="text" id="prn" maxlength="8" size="10" value="<? echo $data['prn']; ?>">   </td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama</td>
    <td colspan="2"><input name="nama" type="text" id="nama" value="<? echo $data['nama'] ;?>"></td>
    </tr>
  
  <tr bgcolor="#FFFFFF">
    <td align="left">Tanggal Lahir </td>
    <td colspan="2"><input name="tgl_lahir" type="text" id="tgl_lahir" size="10" value="<? echo $data['tgl_lahir'] ;?>">
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
    <td bgcolor="#FFFFFF" colspan="3" align="left"><input type="submit" name="Submit" value="Cari..."></td>
  </tr>
  </form>
</table>
</body>
</html>
