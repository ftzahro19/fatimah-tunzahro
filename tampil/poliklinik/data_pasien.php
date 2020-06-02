<?php
include "../librari/inc.koneksidb.php";
$kd_kunjungan 	= $_REQUEST['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
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
	color: #000000;
}
a:active {
	text-decoration: none;
}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#D9E8F3"> 
    <td colspan="4" align="left"><strong>DATA PASIEN </strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="25%" align="left"><strong>PRN</strong></td>
    <td width="25%">
      <input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['prn']; ?>    </td>
    <td width="25%"><strong>Tanggal</strong></td>
    <td width="25%"><?php echo $data['tgl_reg'];?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Nama</strong></td>
    <td><?php echo $data['nama']; ?> (<?php echo $data['karyawan']; ?>)</td>
    <td ><strong>Jam Datang </strong></td>
    <td><?php echo $data['jam_reg'];?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Tanggal Lahir </strong></td>
    <td><?php echo $data['tgl_lahir']; ?></td>
    <td><strong>Jenis Kunjungan </strong></td>
    <td><?php
	$prn = $data['prn'];
	$sql1 = "SELECT * FROM reg WHERE prn='$prn'";
      	$result1 = @mysql_query($sql1);
	$data1 = mysql_num_rows($result1);
	$hasil1 = mysql_fetch_array($result1);
	if ($data1<=1) {
	echo "Baru";
	}
	else
	{
    	echo "Lama";
	}
	?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Sex / Umur</strong></td>
    <td><?php echo $data['jenis_kelamin']; ?> / <?php
$tanggal = $data['tanggal'];
$tgl_lahir = $data['tgl_lahir'];
$query = "SELECT datediff('$tanggal', '$tgl_lahir')
          as selisih";

$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

$tahun = floor($data['selisih']/365);
$bulan = floor(($data['selisih'] - ($tahun * 365))/30);
$hari = $data['selisih'] - $bulan * 30 - $tahun * 365;
echo "".$tahun." Thn, ".$bulan." Bln";
?></td>
    <td></td>
    <td></td>
  </tr>
</table>
</body>
</html>
