<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";

$no_faktur = $_REQUEST['no_faktur'];
$sql = "SELECT * FROM obat_faktur WHERE no_faktur='$no_faktur'";
$qry = mysql_query($sql, $koneksi) 
	 or die ("SQL Error".mysql_error());
$data=mysql_fetch_array($qry);
?>
<html>
<head>
<title>TAMBAH FAKTUR</title>
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo "".$url."";?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "".$url."";?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "".$url."";?>media/kalendar/css/steel/steel.css" />
<style type="text/css">
<!--
a:link {
	color: #000080;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
.style1 {font-size: 16px}
-->
</style>
</head>
<body id="tab2">
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
  <form name="form1" method="post" action="obat_faktur_edit_sim.php">
      <tr bgcolor="#FFFFFF">
     	<td colspan="2" bgcolor="#D9E8F3">UPDATE FAKTUR  
          <input type="hidden" name="user" value="<?php echo "".$_SESSION['klinik']."";?>"></td>
   	</tr>
  <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF">Tanggal</td>
    <td width="70%" bgcolor="#FFFFFF"><input type="hidden" name="no_faktur" value="<?php echo $data['no_faktur'];?>">
    <input name="tanggal" type="text" id="tanggal" size="10" value="<?php echo $data['tanggal'];?>">
	<image id="f_btn1" src="<?php echo $url;?>media/kalendar/calendar.jpg" width="16" height="15" border="0"></image>
		<script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("f_btn1", "tanggal", "%Y-%m-%d");
     //]]></script></td>
  </tr>
  <tr bgcolor="#FFFFFF">
   	  <td width="30%" bgcolor="#FFFFFF">Nomor Faktur </td>
      	<td align="left" bgcolor="#FFFFFF"><input type="text" name="faktur" value="<?php echo $data['faktur'];?>"></td>
	</tr>
    <tr bgcolor="#FFFFFF">
   	  <td width="30%" bgcolor="#FFFFFF">
   	  <input type="checkbox" name="keterangan" value="Closed" checked="checked">
   	  Closed
   	  <input type="submit" name="Submit" value="Update"></td>
      	<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
	  </form>
</table>
</body>
</html></br></br>
