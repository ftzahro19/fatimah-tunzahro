<?php 
include "../librari/inc.koneksidb.php";

$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien WHERE kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<html>
<head>
  <script src="../src/js/jscal2.js"></script>
    <script src="../src/js/lang/en.js"></script>
<script type="text/javascript">
    targetElement = null;
    function makeSelection2(form1, id) {
      if(!form1 || !id)
        return;
      targetElement = form1.elements[id];
      var handle = window.open('dpjp.php','Fullscreen', 'width=400, height=300, resizable=no, scrollbars=no');
    }
    function makeSelection(form1, id) {
      if(!form1 || !id)
        return;
      targetElement = form1.elements[id];
      var handle = window.open('modul.php','Fullscreen', 'width=400, height=300, resizable=no, scrollbars=no');
    }
    </script>
    <link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../src/css/steel/steel.css" />
<title>Pendaftaran pasien</title></head>
<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="6" align="left"><strong>Pasien Baru</strong></td>
  </tr>
  <form name="form1" method="post" action="pasien_edit_sim.php">
  <tr bgcolor="#FFFFFF">
    <td width="168" align="left">PRN</td>
    <td colspan="3">
      <input name="kd_kunjungan" type="hidden" id="kd_kunjungan" maxlength="8" size="10" value="<? echo $data['kd_kunjungan']; ?>">
      <input name="prn" type="text" id="prn" maxlength="8" size="10" value="<? echo $data['prn']; ?>">   </td>
    <td width="168">Tanggal</td>
    <td width="306" colspan="3"><input name="tanggal" type="text" id="tanggal" value="<? echo $data['tanggal'];?>" size="8">  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Nama</td>
    <td width="168"><input name="nama" type="text" id="nama" value="<? echo $data['nama']; ?>"></td>
    <td width="20">
    <?php 
    if ($data['karyawan']=="Ya") echo "<input type='checkbox' name='karyawan' value='Ya' checked>";
    else echo "<input type='checkbox' name='karyawan' value='Ya'>";
    ?>    </td>
    <td width="104">Karyawan</td>
    <td>Jam</td>
    <td colspan="3"><input name="jam" type="text" id="jam" size="8" value="<? echo $data['jam'];?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Tanggal Lahir </td>
    <td colspan="3"><input name="tgl_lahir" type="text" id="tgl_lahir" size="10" value="<? echo $data['tgl_lahir']; ?>">
	<image id="f_btn1" src="calendar.jpg" width="16" height="15" border="0"></image>
		<script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("f_btn1", "tgl_lahir", "%Y-%m-%d");
     //]]></script>	</td>
    <td>Ruangan</td>
    <td width="306" colspan="3"><select name="ruang" id="ruang">
      <?php 
        if ($data['ruang']=="") echo "<option value='' selected>----------------------</option>";
        else echo "<option value=''>----------------------</option>";
	  if ($data['ruang']=="UPI") echo "<option value='UPI' selected>UPI</option>";
        else echo "<option value='UPI'>UPI</option>";
	  if ($data['ruang']=="NICU") echo "<option value='NICU' selected>NICU</option>";
        else echo "<option value='NICU'>NICU</option>";
	  if ($data['ruang']=="OK") echo "<option value='OK' selected>OK</option>";
        else echo "<option value='OK'>OK</option>";
	  if ($data['ruang']=="Intermediet") echo "<option value='Intermediet' selected>Intermediet</option>";
        else echo "<option value='Intermediet'>Intermediet</option>";
        if ($data['ruang']=="Shorea") echo "<option value='Shorea' selected>Shorea</option>";
        else echo "<option value='Shorea'>Shorea</option>";
        if ($data['ruang']=="Pinus") echo "<option value='Pinus' selected>Pinus</option>";
        else echo "<option value='Pinus'>Pinus</option>";
        if ($data['ruang']=="Cantleya") echo "<option value='Cantleya' selected>Cantleya</option>";
        else echo "<option value='Cantleya'>Cantleya</option>";
	  if ($data['ruang']=="Eucaliptus") echo "<option value='Eucaliptus' selected>Eucaliptus</option>";
        else echo "<option value='Eucaliptus'>Eucaliptus</option>";
	  if ($data['ruang']=="Acacia") echo "<option value='Acacia' selected>Acacia</option>";
        else echo "<option value='Acacia'>Acacia</option>";        
?>
    </select></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">Jenis Kelamin </td>
    <td colspan="3">
      <?php
	if ($data['sex']=="L") {
	$cek_l = "checked";
	$cek_p = "";
	}
	else {
	$cek_l = "";
	$cek_p = "checked";
	}
	?>
      <input name="sex" type="radio" value="L" <? echo $cek_l;?>>
      Laki-laki
      <input name="sex" type="radio" value="P" <? echo $cek_p;?>>
      Perempuan</td>
    <td>No Kamar</td>
    <td colspan="3">
      <input name="kamar" type="text" id="kamar" value="<? echo $data['kamar'];?>" size="13"></td>
    </tr>
<tr bgcolor="#FFFFFF">
    <td align="left">No HP</td>
    <td colspan="3"><input name="noHP" type="text" id="noHP" value="<? echo $data['noHP'];?>">      </td>
    <td>Kelas</td>
    <td colspan="3"><select name="kelas" id="kelas">
      <?php 
        if ($data['kelas']=="") echo "<option value='' selected>----------------------</option>";
        else echo "<option value=''>----------------------</option>";
	  if ($data['kelas']=="P Suite") echo "<option value='P Suite' selected>P Suite</option>";
        else echo "<option value='P Suite'>P Suite</option>";
        if ($data['kelas']=="Suite") echo "<option value='Suite' selected>Suite</option>";
        else echo "<option value='Suite'>Suite</option>";
        if ($data['kelas']=="VIP") echo "<option value='VIP' selected>VIP</option>";
        else echo "<option value='VIP'>VIP</option>";
        if ($data['kelas']=="Standar Plus") echo "<option value='Standar Plus' selected>Standar Plus</option>";
        else echo "<option value='Standar Plus'>Standar Plus</option>";
	  if ($data['kelas']=="Standar") echo "<option value='Standar' selected>Standar</option>";
        else echo "<option value='Standar'>Standar</option>";
	  if ($data['kelas']=="Basic") echo "<option value='Basic' selected>Basic</option>";
        else echo "<option value='Basic'>Basic</option>";        
?>
    </select></td>
    </tr>
<tr bgcolor="#FFFFFF">
  <td align="left">Alamat</td>
  <td colspan="3"><input name="alamat" type="text" id="alamat" value="<? echo $data['alamat'];?>"></td>
  <td>DPJP</td>
  <td colspan="3"><input name="dpjp" type="text" id="dpjp" value="<? echo $data['dpjp'];?>">
    <input name="button" type="button" onClick="makeSelection2(this.form, 'dpjp');" value="Pilih"></td>
</tr>
<tr bgcolor="#FFFFFF">
    <td align="left">Diagnosa medis </td>
    <td colspan="3"><input name="diagnosa_msk" type="text" id="diagnosa_msk" value="<? echo $data['diagnosa_msk'];?>"></td>
    <td>Ka. Modul</td>
    <td colspan="3">
      <input name="modul" type="text" id="modul"  value="<? echo $data['modul'];?>"><input type="button" value="Pilih" onClick="makeSelection(this.form, 'modul');"></td>
    </tr>
  <tr> 
    <td colspan="6" bgcolor="#CCCCCC"><input type="submit" name="Submit" value="Update"></td>
  </tr>
   </form>
</table>
</body>
</html>

