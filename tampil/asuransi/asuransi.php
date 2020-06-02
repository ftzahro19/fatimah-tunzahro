<?php 
include 'koneksi.php';
include 'tab_asuransi.php';
?>
<!doctype html>
<html>
	<head>
		<title>Data Kecamatan</title>
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	</head>
	<body>
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<tr>
			<td bgcolor="#FFFFFF" width="30%">Nama Perusahaan </td>
			<td bgcolor="#FFFFFF" width="3%">:</td>
			<td bgcolor="#FFFFFF" width="67%">&nbsp;</td>
  </tr>
  <tr>
			<td bgcolor="#FFFFFF">Alamat</td>
			<td bgcolor="#FFFFFF">:</td>
			<td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#FFFFFF">Provinsi</td>
			<td bgcolor="#FFFFFF">:</td>
			<td bgcolor="#FFFFFF">
				<script type="text/javascript" src="js/ajax_kota.js"></script>
				<select name="prop" id="prop" onChange="ajaxkota(this.value)">
					<option value="">Pilih Provinsi</option>
					<?php 
					$queryProvinsi=mysql_query("SELECT * FROM inf_lokasi where lokasi_kabupatenkota=0 and lokasi_kecamatan=0 and lokasi_kelurahan=0 order by lokasi_nama");
					while ($dataProvinsi=mysql_fetch_array($queryProvinsi)){
						echo '<option value="'.$dataProvinsi['lokasi_propinsi'].'">'.$dataProvinsi['lokasi_nama'].'</option>';
					}
					?>
				<select>
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td bgcolor="#FFFFFF">Kota/Kab</td>
			<td bgcolor="#FFFFFF">:</td>
			<td bgcolor="#FFFFFF">
				<select name="kota" id="kota" onchange="ajaxkec(this.value)">
					<option value="">Pilih Kota</option>
				</select>
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td bgcolor="#FFFFFF">Kecamatan</td>
			<td bgcolor="#FFFFFF">:</td>
			<td bgcolor="#FFFFFF">
				<select name="kec" id="kec" onChange="ajaxkel(this.value)">
					<option value="">Pilih Kecamatan</option>
				</select>
			</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF">Kelurahan/Desa</td>
			<td bgcolor="#FFFFFF">:</td>
			<td bgcolor="#FFFFFF">
				<select name="kel" id="kel">
					<option value="">Pilih Kelurahan/Desa</option>
				</select>
			</td>
		</tr>
		</table>
	</body>
</html>