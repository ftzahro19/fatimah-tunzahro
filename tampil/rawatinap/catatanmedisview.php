<?php 
include "../librari/inc.koneksidb.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Handover</title>

	<style type="text/css">
	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 0 0 0 0;
		padding: 6px 6px 6px 6px;
	}

	</style>
</head>
<body id=tab6>
 <?php
	$sql2 = "SELECT * FROM catatanmedis WHERE kd_kunjungan='$kd_kunjungan' ORDER BY kd_cm DESC";
      	$qry2 = @mysql_query($sql2, $koneksi) or die ("gagal Query");
	while ($data =mysql_fetch_array($qry2)) {
	?>
<div id="container">
	<div id="body"><code><a href="catatanmedis_edit.php?kd_cm=<?php echo $data['kd_cm'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['tgl_cm'];?> </a><a href="catatanmedis_edit.php?kd_cm=<?php echo $data['kd_cm'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','800','600%','yes');return false"><?php echo $data['shift'];?></a><a href="catatanmedis_edit.php?kd_cm=<?php echo $data['kd_cm'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','800','600%','yes');return false"> :</a><a href="catatanmedis_edit.php?kd_cm=<?php echo $data['kd_cm'];?>&kd_kunjungan=<?php echo $data['kd_kunjungan']; ?>" onClick="NewWindow(this.href,'name','800','600%','yes');return false"><?php echo $data['jam_cm'];?>
  Edit</a><br/> <?php echo $data['catatanmedis'];?></code>	</div>
</div></br>
<?php
}
?>
</body>
</html>
