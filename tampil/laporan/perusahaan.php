<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
?>
<html>
<head>
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/steel/steel.css" />
<title>LAPORAN PASIEN PERUSAHAAN</title></head>
<body id=tab1>
<form method="post" action="proses_perusahaan.php">
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
    <td colspan="2">LAPORAN PASIEN PERUSAHAAN</td>
  </tr>
  <tr>
	<td width="20%" bgcolor="#FFFFFF">Nama Perusahaan</td>
	<td width="80%" bgcolor="#FFFFFF">
      <select name="kd_asuransi" id="kd_asuransi">
		<?php
		$sql1 = "SELECT * FROM asuransi_db";
		$qry1 = mysql_query($sql1, $koneksi) or die ("gagal Query");
		while ($data1 =mysql_fetch_array($qry1)) {
		echo "<option value='$data1[kd_asuransi]' $cek>".$data1['nama_asuransi']."</option>";
		}
		?>
      </select>
	</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Tanggal</td>
    <td bgcolor="#FFFFFF">
      <input name="bydate1" type="text" id="bydate1" size="8">
    	<image id="f_btn1" src="<?php echo $url;?>media/kalendar/calendar.jpg" width="16" height="15" border="0"></image>
		<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("f_btn1", "bydate1", "%Y-%m-%d");
     //]]></script> 
		sd	
		<input name="bydate2" type="text" id="bydate2" size="8">
		<image id="f_btn2" src="<?php echo $url;?>media/kalendar/calendar.jpg" width="16" height="15" border="0"></image>
		<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("f_btn2", "bydate2", "%Y-%m-%d");
     //]]></script> </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF">
      <div align="left">
        <input align="center" type="submit" name="submit" value="Search">
        </div></td></tr>  
</table>
</form>
</body>
</html>

