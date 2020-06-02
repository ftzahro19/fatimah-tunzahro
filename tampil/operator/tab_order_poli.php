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
<style>
@media print {
input.noPrint { display: none; }
}
@page 
        {
            size: auto;   /* auto is the initial value */
			margin: 20mm;
        }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/css/tab.css" />
</head>
<body>
<ul id="tabnav">
<li class="tab1"><a href="../operator/lap_poli.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Catatan">Catatan</a></li>
<!-- Menu non aktif
<li class="tab2"><a href="../operator/lab_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Catatan">Laboratorium</a></li>
<li class="tab3"><a href="../operator/rad_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Catatan">Radiologi</a></li>
<li class="tab7"><a href="../operator/tindak_lanjut.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Tindakan">Tindak Lanjut</a></li>
<li class="tab8"><a href="emr.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>&prn=<?php echo $data['prn'];?>" title="Riwayat Berobat">Riwayat Berobat</a></li>
-->
<li class="tab4"><a href="../operator/diagnosa_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Tindakan">Diagnosa</a></li>
<li class="tab5"><a href="../operator/resep_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Resep">Resep</a></li>
<li class="tab6"><a href="../operator/tm_view.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Tindakan">Tindakan</a></li>
<li class="tab7"><a href="../operator/transaksi_tindakan.php?kd_kunjungan=<?php echo $data['kd_kunjungan'];?>" title="Tindakan">Transaksi</a></li>

</ul>
</body>
