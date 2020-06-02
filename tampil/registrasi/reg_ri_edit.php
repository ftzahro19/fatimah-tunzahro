<?php 
include "../librari/inc.koneksidb.php";
$prn = $_GET['prn'];
$kd_kunjungan = $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,pasien_rawat WHERE data_pasien.prn=pasien_rawat.prn AND pasien_rawat.kd_kunjungan='$kd_kunjungan'";
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
<title>PROSES PULANG PASIEN RAWAT INAP</title></head>
<body>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="4" align="left"><strong>PROSES PULANG PASIEN RAWAT INAP</strong></td>
  </tr>
  <form name="form1" method="post" action="ri_pulang_sim.php">
<tr bgcolor="#FFFFFF">
    <td width="20%">Tanggal Masuk</td>
    <td width="25%"><input name="tgl_masuk" type="hidden" id="tgl_masuk" value="<? echo $data['tgl_masuk']; ?>">
      <input name="tgl_masuk" type="text" size="12" value="<? echo $data['tgl_masuk']; ?>" disabled="disabled">
      </td>
    <td width="20%">Jam Masuk</td>
    <td width="25%"><input name="jam_masuk" type="text" id="jam_masuk" size="12" value="<? echo $data['jam_masuk']; ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
    <td width="20%">Tanggal Keluar</td>
    <td width="25%"><input name="tgl_keluar" type="hidden" id="tgl_keluar" value="<? echo "".date('Y-m-d') ;?>">
      <input name="tgl_keluar" type="text" size="12" value="<? echo "".date('d-m-Y') ;?>" disabled="disabled">

      </td>
    <td width="20%">Jam Keluar</td>
    <td width="25%"><input name="jam_keluar" type="text" id="jam_keluar" size="12" value="<? echo "".date('H:i') ;?>"></td>
</tr>
  <tr bgcolor="#FFFFFF">
    <td width="20%">Ruangan</td>
    <td width="25%">
      <input name="kd_kunjungan" type="hidden" id="kd_kunjungan" maxlength="12" size="10" value="<? echo $data['kd_kunjungan']; ?>">
      <input name="prn" type="hidden" id="prn" maxlength="8" size="10" value="<? echo $data['prn']; ?>">
<select name="ruang" id="ruang">
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
    <td width="20%">Kamar</td>
    <td width="25%"><input name="kamar" type="text" id="tanggal" value="<? echo $data['kamar'];?>" size="8">  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Kelas</td>
    <td><select name="kelas" id="kelas">
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
    <td>Bed</td>
    <td><input name="bed" type="text" id="bed" size="8" value="<? echo $data['bed'];?>"></td>
  </tr>
    </tr>
<tr bgcolor="#FFFFFF">
  <td>DPJP</td>
  <td><input name="dpjp" type="text" id="dpjp" value="<? echo $data['dpjp'];?>"></td>
  <td>Modul</td>
  <td><input name="modul" type="text" id="modul"  value="<? echo $data['modul'];?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
    <td align="left">Diagnosa Masuk</td>
    <td><input name="diagnosa_masuk" type="text" id="diagnosa_masuk" value="<? echo $data['diagnosa_masuk'];?>"></td>
	<td align="left">Diagnosa Keluar</td>
    <td><input name="diagnosa_keluar" type="text" id="diagnosa_keluar" value="<? echo $data['diagnosa_keluar'];?>"></td>
</tr>
<tr> 
    <td colspan="4" bgcolor="#CCCCCC"><input type="submit" name="Submit" value="Discharge"></td>
</tr>
</form>
</table>
</body>
</html>

