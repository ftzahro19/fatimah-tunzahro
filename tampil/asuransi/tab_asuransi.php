<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";

// query untuk mencari file berdasarkan kategori
$kd_asuransi = $_GET['kd_asuransi'];
$query = "SELECT * FROM asuransi_db WHERE kd_asuransi='$kd_asuransi'";
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
<li class="tab1"><a href="asuransi_edit.php?kd_asuransi=<?php echo $data['kd_asuransi'];?>" title="Update data asuransi" target="mainFrame">Update Data </a></li>
<li class="tab2"><a href="asuransi_limit.php?kd_asuransi=<?php echo $data['kd_asuransi'];?>" title="Limit asuransi" target="mainFrame">Limit Asuransi </a></li>
<li class="tab3"><a href="asuransi_jaminan.php?kd_asuransi=<?php echo $data['kd_asuransi'];?>" title="Detail jaminan asuransi" target="mainFrame">Jaminan</a></li>
</ul>
<?php
}
?>
</body>
</html>
