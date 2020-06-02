<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$no = $_REQUEST['no'];
$sql1 = "SELECT * FROM obat_faktur,obat_stock WHERE obat_faktur.no_faktur=obat_stock.no_faktur AND no='$no'";
$qry1 = mysql_query($sql1, $koneksi) 
	 or die ("SQL Error".mysql_error());
$data1=mysql_fetch_array($qry1);

$query_rsData = "SELECT * FROM obat_db";
$rsData = mysql_query($query_rsData, $koneksi) or die(mysql_error());
$row_rsData = mysql_fetch_assoc($rsData);
$totalRows_rsData = mysql_num_rows($rsData);
?>
<html>
<head>
<title>TAMBAH STOCK OBAT</title>
<link rel="stylesheet" type="text/css" href="base.css" />
<link rel="stylesheet" type="text/css" href="blue.css" />
<link href="<?php echo $url;?>media/css/autocomplete.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $url;?>media/jquery/themes/base/jquery.ui.all.css">
 <script src="<?php echo $url;?>media/jquery/jquery-1.9.1.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.core.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.widget.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.position.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.menu.js"></script>
 <script src="<?php echo $url;?>media/jquery/ui/jquery.ui.autocomplete.js"></script>
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
<script>
 $(function() {
 var availableTags = [
 <?php do { ?>
"<?php echo $row_rsData['kd_obat']; ?> <?php echo $row_rsData['nama_obat']; ?>",
<?php } while($row_rsData = mysql_fetch_assoc($rsData)); ?>
 ];
 $( "#kd_obat" ).autocomplete({
 source: availableTags
 });
 });
 </script>
</head>
<body id="tab2">
</hr>
  <table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
  <form name="form1" method="post" action="obat_detail_edit_sim.php">
      <tr bgcolor="#FFFFFF">
     	<td colspan="2" bgcolor="#D9E8F3">UPDATE PENAMBAHAN STOCK OBAT 
   	      <input type="hidden" name="user" value="<?php echo "".$_SESSION['klinik']."";?>"></td>
   	</tr>
  
      <tr bgcolor="#FFFFFF">
        <td bgcolor="#FFFFFF">Nomor Faktur </td>
        <td align="left" bgcolor="#FFFFFF"><input type="hidden" name="no" value="<?php echo $data1['no'];?>">
		<input type="text" name="faktur" value="<?php echo $data1['faktur'];?>" disabled="disabled"></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td bgcolor="#FFFFFF">Nama Obat </td>
        <td align="left" bgcolor="#FFFFFF"><input type="text" name="kd_obat" id="kd_obat" value="<?php echo $data1['kd_obat'];?>"></td>
      </tr>
    <tr bgcolor="#FFFFFF">
   	  <td width="30%" bgcolor="#FFFFFF">Jumlah</td>
      	<td width="70%" align="left" bgcolor="#FFFFFF"><input type="text" name="jumlah" value="<?php echo $data1['jumlah'];?>"></td>
	</tr>
    <tr bgcolor="#FFFFFF">
   	  <td width="30%" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Update"></td>
      	<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
	  </form>
</table>
</body>
</html></br></br>
