<?php
include "../librari/inc.koneksidb.php";
$prn	= $_REQUEST['prn'];
$sql 	= "SELECT * FROM data_pasien WHERE prn='$prn'";
$qry 	= mysql_query($sql);
$data 	= mysql_fetch_array($qry); 
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
.style1 {font-size: 16px}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#D9E8F3">
  <tr bgcolor="#D9E8F3"> 
    <td colspan="2" align="left"><strong>Data Pasien</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="25%" align="left"><strong>PRN</strong></td>
    <td>
      <input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['prn']; ?>    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Nama</strong></td>
    <td><?php echo $data['nama']; ?> (<?php echo $data['karyawan']; ?>)</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Tanggal Lahir </strong></td>
    <td><?php echo $data['tgl_lahir']; ?></td>
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
?>    </td>
  </tr>
</table>
</body>
</html>
