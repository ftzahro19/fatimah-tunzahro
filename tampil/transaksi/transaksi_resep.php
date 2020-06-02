<?php
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
<title>KWITANSI PEMBAYARAN</title>
<style type="text/css">
<!--
.style2 {font-size: 9px}
.style2 {font-size: 9px}
-->
</style>
</head>
<body>
<table width="99%" height="103" border="0" align="left" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="4%" bgcolor="#FFFFFF"></td>
    <td width="8%" bgcolor="#FFFFFF"></td>
    <td width="55%" bgcolor="#FFFFFF"><B>Drug and retail</B></td>
    <td width="7%" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="16%" bgcolor="#FFFFFF"></td>
    <td width="10%" bgcolor="#FFFFFF"></div></td>
  </tr>

<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
$harga = $data['harga'];
$sub_total2 = $harga * $data['qty']; 
$harga_total2 = $harga_total2 + $sub_total2;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td width="4%" class="style1"><?php echo $data['tanggal_rx'];?></td>
    <td width="8%" class="style1"><?php echo $data['kd_obat'];?></td>
    <td width="55%" class="style1"><?php echo $data['nama_obat'];?></td>
    <td width="7%" class="style1" align="center"><?php echo $data['qty'];?></td>
    <td width="16%" class="style1" align="right"><?php echo $data['harga'];?></td>
    <td width="10%" class="style1" align="right"><?php echo $data['harga'];?></td>
  </tr>
  <?php
}
?>
<tr bgcolor="#FFFFFF">
<td bgcolor="#FFFFFF" align="center"></td>
<td bgcolor="#FFFFFF" align="center"></td>
<td bgcolor="#FFFFFF" align="right"><b>Sub Total :</b></td>
<td bgcolor="#FFFFFF" align="center"></td>
<td bgcolor="#FFFFFF" align="right"><b>Rp. <?php echo $harga_total2;?></b></td>
<td bgcolor="#FFFFFF" align="right"><b>Rp. <?php echo $harga_total2;?></b></td>
 </tr>
</table>
</body>
</html> 

