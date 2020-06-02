<?php
include "tab_asuransi.php";
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";

$kd_asuransi = $_GET['kd_asuransi'];
$sql = "SELECT * FROM asuransi_db WHERE kd_asuransi='$kd_asuransi'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<title>PENDAFTARAN PASIEN BARU</title>
</head>
<body id="tab1">
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="asuransi_edit_sim.php"  onsubmit="return form1_onsubmit()" >
<tr bgcolor="#CCCCCC">
    <td colspan="4" align="left"><strong>DATA ASURANSI </strong><b></b></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td width="20%">Nama asuransi*</td>
    <td width="30%"><input name="kd_asuransi" type="hidden" id="kd_asuransi" value="<?php echo $data['kd_asuransi'];?>">
      <input name="nama_asuransi" type="text" id="nama_asuransi" value="<?php echo $data['nama_asuransi'];?>">      </td>
    <td width="20%">Telpon*</td>
    <td width="30%"><input name="telp" type="text" id="telp" value="<?php echo $data['telp'];?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Alamat 1* </td>
    <td><input name="alamat1" type="text" id="alamat1" value="<?php echo $data['alamat1'];?>"></td>
    <td>Fax</td>
    <td><input name="fax" type="text" id="fax" value="<?php echo $data['fax'];?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Alamat 2 </td>
    <td><input name="alamat2" type="text" id="alamat2" value="<?php echo $data['alamat2'];?>"></td>
    <td>Email</td>
    <td><input name="email" type="text" id="email" value="<?php echo $data['email'];?>"></td>
  </tr>
    <tr>
    <td bgcolor="#FFFFFF" align="left">Diskon/Mark up </td>
    <td colspan="3" align="left" bgcolor="#FFFFFF"><input name="charge" type="text" id="charge" value="<?php echo $data['charge'];?>" maxlength="4" size="3">
    %</td>
    </tr>
<tr>
    <td bgcolor="#FFFFFF" colspan="4" align="left"><input type="submit" name="Submit" value="Update"></td>
  </tr>
   </form>
</table>
</body>
</html>
