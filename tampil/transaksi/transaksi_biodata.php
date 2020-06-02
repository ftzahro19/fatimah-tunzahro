<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";


$kd_kunjungan 	= $_GET['kd_kunjungan'];

$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

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
    <td width="25%"><?php echo $data['prn']; ?> </td>
    <td width="25%"><strong>Visit Number </strong></td>
    <td width="25%"><input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan']; ?>">
    <?php echo $data['kd_kunjungan'];?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Name</strong></td>
    <td><?php echo $data['nama']; ?></td>
    <td ><strong>Invoice Nomor</strong></td>
    <td><?php
	$nomor = kdauto("transaksi_no","");
	$tahun = date('Y');
 	$bulan = date('m');
	$romawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
	echo "$nomor/INV/$romawi[$bulan]/$tahun";
	echo "
	<input name='kd_transaksi' type='hidden' id='kd_transaksi' maxlength='8' size='16' value='$nomor/INV/$romawi[$bulan]/$tahun'>";
	?>	</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Date of birth  </strong></td>
    <td><?php echo $data['tgl_lahir']; ?></td>
    <td><strong>Invoice Date </strong></td>
    <td><?php echo $data['tgl_reg'];?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Sex / Age </strong></td>
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
    <td>    </td>
  </tr>
</table>
</body>
</html> 
