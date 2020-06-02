<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "data_pasien.php";
$prn = $_GET['prn'];
$kd_kunjungan = $_GET['kd_kunjungan'];
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);


$sql1 = "SELECT * FROM reg WHERE reg.tindak_lanjut!='Rawat' AND selesai!='Selesai'";
$qry1 = mysql_query($sql1, $koneksi) 
		 or die ("SQL Error".mysql_error());
$juml1 = mysql_num_rows($qry1);

$sql2 = "SELECT * FROM data_pasien,reg,klinikdb WHERE data_pasien.prn=reg.prn AND reg.klinik=klinikdb.kd_klinik AND reg.selesai!='Selesai'";
$qry2 = mysql_query($sql2, $koneksi) 
		 or die ("SQL Error".mysql_error());
$juml2 = mysql_num_rows($qry2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/css/tab.css" />
<style type="text/css">
<!--
.style3 {color: #FF0000}
-->
</style>
</head>
<body>
<ul id="tabnav">
<li class="tab1"><a href="transaksi_list2_rj.php" title="Catatan" target="mainFrame">Rawat Jalan <span class="style3"><?php if($juml1==0) { echo "";} else{ echo $juml1;}?></span></a></li>
<li class="tab2"><a href="transaksi_list2_ri.php" title="Resep" target="mainFrame">Rawat Inap <span class="style3"><?php if($juml2==0) { echo "";} else{ echo $juml2;}?></span></a></li>
</ul>
</body>
</html>
