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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/css/tab.css" />
</head>
<body>
<ul id="tabnav">
<li class="tab1"><a href="../rawatinap/catatanmedis_form.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Catatan" target="mainFrame">Catatan</a></li>
<li class="tab5"><a href="../rawatinap/lab_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Resep" target="mainFrame">Laboratorium</a></li>
<li class="tab6"><a href="../rawatinap/rad_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Resep" target="mainFrame">Radiologi</a></li>
<li class="tab2"><a href="../rawatinap/resep_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Resep" target="mainFrame">Resep</a></li>
<li class="tab3"><a href="../rawatinap/tm_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Tindakan" target="mainFrame">Tindakan</a></li>
<li class="tab7"><a href="../rawatinap/resume_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Resume" target="mainFrame">Resume</a></li>
<li class="tab4"><a href="emr.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>&prn=<?php echo $data['prn'];?>" title="Riwayat Berobat" target="mainFrame">Riwayat Berobat</a></li>
<li class="tab8"><a href="../rawatinap/predischarge.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Persiapan Pulang" target="mainFrame">Persiapan Pulang</a></li>
</ul>
</body>
</html>
