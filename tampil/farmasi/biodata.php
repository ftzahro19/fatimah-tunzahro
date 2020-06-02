<?php
include "tab_farmasi.php";
$kd_kunjungan 	= $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<script type="text/javascript" src="<?php echo $url;?>media/ckeditor/ckeditor.js"></script>
<script src="<?php echo $url;?>media/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="<?php echo $url;?>media/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $url;?>media/kalendar/js/jscal2.js"></script>
    <script src="<?php echo $url;?>media/kalendar/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url;?>media/kalendar/css/steel/steel.css" />
<title>KWITANSI PEMBAYARAN</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#D9E8F3">
  <tr bgcolor="#D9E8F3"> 
    <td colspan="3" align="left"><strong>KWITANSI</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="25%" align="left"><strong>PRN</strong></td>
    <td width="25%">
      <input name="kd_kunjungan" type="hidden" value="<?php echo $data['kd_kunjungan']; ?>"><?php echo $data['prn']; ?>    </td>
    <td width="25%"><strong>Visit Number </strong></td>
    <td width="25%"><?php echo $data['tgl_reg'];?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Nama</strong></td>
    <td><?php echo $data['nama']; ?></td>
    <td ><strong>Invoice Nomor</strong></td>
    <td><?php echo $data['jam_reg'];?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><strong>Tanggal Lahir </strong></td>
    <td><?php echo $data['tgl_lahir']; ?></td>
    <td><strong>Invoice Date </strong></td>
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
    <td>    </td>
  </tr>
</table>
</body>
</html> 
