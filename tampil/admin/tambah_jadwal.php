<?php
include_once "../librari/inc.session.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
?>
<html>
<head>
<title>JADWAL DINAS BARU</title></head>
<body>
<form action="jadwal_sim.php" method="post" name="form1" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="2" scope="col">JADWAL DINAS BARU</th>
</tr>
<tr bgcolor="#FFFFFF">
  <td width="29%"><strong>Nama dokter </strong></td>
  <td colspan="3"><select name="dokter" id="dokter">
    <option value="" selected>[Pilih dokter]</option>
    <?php
	$sql1 = "SELECT * FROM user WHERE status='Aktif' AND (unit=2 OR unit=1)";
    $qry1 = @mysql_query($sql1, $koneksi) or die ("gagal Query");
	while ($data1 =mysql_fetch_array($qry1)) {
	echo "<option value='$data1[username]'>".$data1['nama']."</option>";
	}
	?>
  </select></td>
  </tr>

<tr bgcolor="#FFFFFF">
  <td>Hari</td>
  <td><select name="hari">
    <option value="">[Pilih hari]</option>
    <option value="Senin">Senin</option>
    <option value="Selasa">Selasa</option>
    <option value="Rabu">Rabu</option>
    <option value="Kamis">Kamis</option>
    <option value="Jumat">Jumat</option>
    <option value="Sabtu">Sabtu</option>
    <option value="Minggu">Minggu</option>
  </select>
  </td>
  </tr>
<tr bgcolor="#FFFFFF">
  <td>Jam Mulai </td>
  <td width="71%"><input type="text" name="jam_mulai" placeholder="10:00" size="3"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Jam Selesai </td>
  <td><input type="text" name="jam_selesai" placeholder="10:00" size="3"></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td>Keterangan</td>
  <td><input name="keterangan" type="radio" value="Aktif">Aktif
      <input name="keterangan" type="radio" value="Non Aktif">Non Aktif 
  </td>
</tr>


<tr bgcolor="#FFFFFF"> 
  <td><input name="Submit" type="submit" value="Simpan"></td>
  <td>&nbsp;</td>
</tr>
</table>
</form>
</body>
</html>
