<?php 
include "../librari/inc.koneksidb.php";
include "tab_dokter.php";

$kd_kunjungan = $_REQUEST['kd_kunjungan'];
if ($kd_kunjungan !="") {
   $sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
?>
<html>
<head>
<script src="../src/js/jscal2.js"></script>
    <script src="../src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/gold/gold.css" />
<title>CARI OBAT</title>
</head>
<body id="tab3">
<form method="post" action="cari_lab.php?kd_kunjungan=<?php echo$data['kd_kunjungan'];?>">
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="20%" bgcolor="#FFFFFF">Golongan Lab</td>
  <td width="80%" bgcolor="#FFFFFF">
      <select name="gol_lab" id="gol_lab">
 	<option value="">---------------------</option>
<?php
$query = "SELECT gol_lab FROM lab_db GROUP BY gol_lab";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
?>
        <option value="<?php echo $data['gol_lab'];?>"><?php echo $data['gol_lab'];?></option>
<?php
}
?>
      </select>*</td>
  </tr>

  <tr>
    <td bgcolor="#FFFFFF">Nama Lab</td>
    <td bgcolor="#FFFFFF">
      <input name="nama_lab" type="text" id="nama_lab" size="16">
    </td>
  </tr>
  

  <tr>

    <td colspan="2" bgcolor="#FFFFFF">

      <div align="left">

        <input align="center" type="submit" name="submit" value="Search">
        </div></td></tr>  
</table>

</form>
</body>
</html>
<?php include "lab_view.php";?>
