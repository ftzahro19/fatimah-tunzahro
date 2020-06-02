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
<title>GOLONGAN OBAT</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="gol_obat_sim.php?kd_gol_obat=<?=$kd_gol_obat;?>">
<tr bgcolor="#CCCCCC"> 
    <td colspan="4" align="left"><strong>GOLONGAN OBAT</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="208" align="left">Kode Golongan</td>
    <td width="244" colspan="3">
      <input name="kd_gol_obat" type="text" id="kd_gol_obat" maxlength="8" size="10" value="<? echo kdauto("gol_obat","GOL"); ?>">   </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama Golongan</td>
    <td colspan="3"><input name="gol_obat" type="text" id="gol_obat" value="<? echo $data['gol_obat'] ;?>"></td>
    </tr>
    <td bgcolor="#FFFFFF" colspan="5" align="left"><input type="submit" name="Submit" value="Simpan"></td>
  </tr>
   </form>
</table>
</body>
</html>
