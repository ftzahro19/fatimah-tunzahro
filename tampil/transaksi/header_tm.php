<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
include "../librari/inc.session.php";

$kd_kunjungan 	= $_GET['kd_kunjungan'];

$sql1 = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan='$kd_kunjungan'";
$qry1 = mysql_query($sql1);
$data1 = mysql_fetch_array($qry1); 

?>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>KWITANSI PEMBAYARAN</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#D9E8F3">
  <tr bgcolor="#D9E8F3"> 
    <td colspan="3" align="left"><strong>KWITANSI</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="25%" align="left"><strong>PRN</strong></td>
    <td width="25%"><?php echo $data1['prn']; ?> </td>
    <td width="25%"><strong>Visit Number </strong></td>
    <td width="25%"><input name="kd_kunjungan" type="hidden" value="<?php echo $data1['kd_kunjungan']; ?>">
    <?php echo $data1['kd_kunjungan'];?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Name</strong></td>
    <td><?php echo $data1['nama']; ?></td>
    <td ><strong>Visit Date</strong></td>
    <td><?php echo $data1['tgl_reg']; ?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Date of birth / Age </strong></td>
    <td><?php echo $data1['tgl_lahir']; ?> /
    <?php
$tanggal = $data1['tanggal'];
$tgl_lahir = $data1['tgl_lahir'];
$query = "SELECT datediff('$tanggal', '$tgl_lahir')
          as selisih";

$hasil = mysql_query($query);
$data2 = mysql_fetch_array($hasil);

$tahun = floor($data2['selisih']/365);
$bulan = floor(($data2['selisih'] - ($tahun * 365))/30);
$hari = $data['selisih'] - $bulan * 30 - $tahun * 365;
echo "".$tahun." Thn, ".$bulan." Bln";
?></td>
    <td><strong>Sex</strong></td>
    <td><?php echo $data1['jenis_kelamin']; ?></td>
  </tr>
</table>
</body>
</html> 
