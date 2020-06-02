<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";

// query untuk mencari file berdasarkan kategori
	
$query = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.selesai='Aktif' AND reg.batal='Tidak' ORDER BY kd_kunjungan LIMIT 1";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/css/tab.css" />
</head>
<body>
<ul id="tabnav">
<li class="tab1"><a href="baru_edit.php?prn=<?php echo $data['prn'];?>" title="Update database pasien" target="mainFrame">Update</a></li>
<li class="tab2"><a href="asuransi.php?prn=<?php echo $data['prn'];?>" title="Asuransi" target="mainFrame">Asuransi</a></li>
</ul>
<?php
}
?>
</body>
</html>
