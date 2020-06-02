<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";

$kdubah = $_GET['kdubah'];
$sql = "SELECT * FROM rujukan_db WHERE kd_perujuk='$kdubah'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
<title>PENDAFTARAN PASIEN BARU</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <form name="form1" method="post" action="rujukan_edit_sim.php"  onsubmit="return form1_onsubmit()" >
<tr bgcolor="#CCCCCC">
    <td colspan="4" align="left"><strong>DATA PERUJUK </strong><b></b></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td width="20%">Nama Perujuk*</td>
    <td width="30%"><input name="kd_perujuk" type="hidden" id="kd_perujuk" value="<?php echo $data['kd_perujuk'];?>">
      <select name="jenis_perujuk" id="jenis_perujuk">
        <?php 
        if ($data['jenis_perujuk']=="") echo "<option value='' selected>[Pilih...]</option>";
        else echo "<option value=''>[Pilih...]</option>";
        if ($data['jenis_perujuk']=="DR") echo "<option value='DR' selected>Dokter Praktek</option>";
        else echo "<option value='DR'>Dokter Praktek</option>";
 		if ($data['jenis_perujuk']=="KL") echo "<option value='KL' selected>Klinik</option>";
        else echo "<option value='KL'>Klinik</option>";
        if ($data['jenis_perujuk']=="RS") echo "<option value='RS' selected>Rumah Sakit</option>";
        else echo "<option value='RS'>Rumah Sakit</option>";
        ?>
      </select>
      <input name="nama_perujuk" type="text" id="nama_perujuk" value="<?php echo $data['nama_perujuk'];?>">      </td>
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
    <td bgcolor="#FFFFFF" align="left">Fee Rujukan </td>
    <td colspan="3" align="left" bgcolor="#FFFFFF"><input name="fee" type="text" id="fee" value="<?php echo $data['fee'];?>" maxlength="4" size="3">
      %</td>
    </tr>
  <tr>
    <td bgcolor="#FFFFFF" colspan="4" align="left"><input type="submit" name="Submit" value="Update"></td>
  </tr>
   </form>
</table>
</body>
</html>
