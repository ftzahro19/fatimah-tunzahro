<?php 
include "../librari/admin.session.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
?>
<html>
<head>
<script src="../src/js/jscal2.js"></script>
    <script src="../src/js/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/gold/gold.css" />
<title>DATABASE OBAT</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="obat_sim.php?kd_obat=<?=$kd_obat;?>">
<tr bgcolor="#CCCCCC"> 
    <td colspan="4" align="left"><strong>GOLONGAN OBAT</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="208" align="left">Kode Golongan</td>
    <td width="244" colspan="3">
      <input name="kd_obat" type="text" id="kd_obat" maxlength="8" size="10" value="<? echo kdauto("obat_db","DPO"); ?>">   </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama Golongan</td>
    <td colspan="3"><select name="kd_gol_obat" id="kd_gol_obat">
    <option value="" selected>[Pilih...]</option>
      <?php
	$sql = "SELECT * FROM gol_obat";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query".mysql_error());
	while ($data =mysql_fetch_array($qry)) {
	if ($data[kd_gol_obat]==$kd_gol_obat) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data[kd_gol_obat]' $cek>".$data['gol_obat']."</option>";
	}
	?>
    </select></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td width="208" align="left">Nama Obat</td>
    <td width="244" colspan="3">
      <input name="nama_obat" type="text" id="nama_obat" size="16" value="<? echo $data['nama_obat'] ;?>">   
    </td>
  </tr>
<tr bgcolor="#FFFFFF">
    <td width="208" align="left">Harga Beli</td>
    <td width="244" colspan="3">
      <input name="harga_beli" type="text" id="harga_beli" maxlength="12" size="10" value="<? echo $data['harga_beli'] ;?>">   
    </td>
  </tr>  
  </tr>  
<tr bgcolor="#FFFFFF">
    <td width="208" align="left">Qty</td>
    <td width="244" colspan="3">
      <input name="qty_obat" type="text" id="qty_obat" maxlength="12" size="10" value="<? echo $data['qty_obat'] ;?>">   
    </td>
  </tr>  
<tr bgcolor="#FFFFFF">
    <td width="208" align="left">Discount</td>
    <td width="244" colspan="3">
      <input name="discount" type="text" id="discount" maxlength="12" size="10" value="<? echo $data['discount'] ;?>">   
    </td>
  </tr>  
<tr>
    <td bgcolor="#FFFFFF" colspan="5" align="left"><input type="submit" name="Submit" value="Simpan"></td>
  </tr>
   </form>
</table>
</body>
</html>
