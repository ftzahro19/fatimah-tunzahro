<?php
include "../../config/config.php";
?>
<html>
<head>
<title>LAPORAN KUNJUNGAN</title>
<script type="text/javascript" src="<?php echo $url;?>media/js/jquery-1.4.js"></script>
<script type="text/javascript" src="<?php echo $url;?>media/js/jquery.fusioncharts.js"></script>
</head>
<body id=tab1>
  <table id="myHTMLTable" align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
    <tr bgcolor="#FFFFFF">
      <td width="16%" bgcolor="#D9E8F3">Item</td>
      <td width="16%" bgcolor="#D9E8F3">Nilai</td>
    </tr>
<?php
// koneksi ke mysql
include "../librari/inc.koneksidb.php";
?>
    <tr bgcolor="#FFFFFF">
      <td>Skil Meter</td>
      <td>80</td>
<?php
$query = "SELECT * FROM skill";
$hasil = mysql_query($query);

?>
     </tr>
  </table>
	<script type="text/javascript">
	$('#myHTMLTable').convertToFusionCharts({
		swfPath: "<?php echo $url;?>media/Charts/",
		type: "MSColumn3D",
		data: "#myHTMLTable",
		dataFormat: "HTMLTable"
	});
	</script>
</body>
</html>
