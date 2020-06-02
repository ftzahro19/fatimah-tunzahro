<?php 
include "../librari/inc.koneksidb.php"; 
include_once "../librari/inc.session.php";
?>
<html>
<head>
<title>DAFTAR SPESIALIS</title>
  <script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body>
  <table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td colspan="9" bgcolor="#CCCCCC"><div align="left"><strong>JADWAL PRAKTEK </strong></div></td>
    </tr>
	
    <tr bgcolor="#FFFFFF">
      <td width="20%" bgcolor="#D9E8F3"><div align="center">NAMA</div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center">SENIN</div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center">SELASA</div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center">RABU</div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center">KAMIS</div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center">JUMAT</div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center">SABTU</div></td>
      <td width="7%" bgcolor="#D9E8F3"><div align="center">MINGGU</div></td>
      <td width="10%" bgcolor="#D9E8F3"><div align="center"></div></td>
    </tr>

<?php 
	$sql = "SELECT * FROM jadwal_praktek,user WHERE jadwal_praktek.kd_dokter=user.username AND username='$_SESSION[klinik]' AND user.status='Aktif' GROUP BY kd_dokter";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
	$kd_dokter = $data['kd_dokter']; 
  ?>
    <tr bgcolor="#FFFFFF" valign="top">
      <td><?php echo $data['nama'];?></td>
      <td><div align="center">
        <?php 
	  		$sql1 = "SELECT * FROM jadwal_praktek WHERE hari='Senin' AND kd_dokter='$kd_dokter' AND keterangan='Aktif'";
			$qry1 = mysql_query($sql1, $koneksi) 
		 		or die ("SQL Error".mysql_error());
			while($data1=mysql_fetch_array($qry1)){
			echo $data1['jam_mulai'];
			echo "-";
			echo $data1['jam_selesai'];
			echo "</br>";
			}
			?>
      </div></td>
      <td><div align="center">
        <?php 
	  		$sql1 = "SELECT * FROM jadwal_praktek WHERE hari='Selasa' AND kd_dokter='$kd_dokter' AND keterangan='Aktif'";
			$qry1 = mysql_query($sql1, $koneksi) 
		 		or die ("SQL Error".mysql_error());
			while($data1=mysql_fetch_array($qry1)){
			echo $data1['jam_mulai'];
			echo "-";
			echo $data1['jam_selesai'];
			echo "</br>";
			}
			?>
      </div></td>
      <td><div align="center">
        <?php 
	  		$sql1 = "SELECT * FROM jadwal_praktek WHERE hari='Rabu' AND kd_dokter='$kd_dokter' AND keterangan='Aktif'";
			$qry1 = mysql_query($sql1, $koneksi) 
		 		or die ("SQL Error".mysql_error());
			while($data1=mysql_fetch_array($qry1)){
			echo $data1['jam_mulai'];
			echo "-";
			echo $data1['jam_selesai'];
			echo "</br>";
			}
			?>
      </div></td>
      <td><div align="center">
        <?php 
	  		$sql1 = "SELECT * FROM jadwal_praktek WHERE hari='Kamis' AND kd_dokter='$kd_dokter' AND keterangan='Aktif'";
			$qry1 = mysql_query($sql1, $koneksi) 
		 		or die ("SQL Error".mysql_error());
			while($data1=mysql_fetch_array($qry1)){
			echo $data1['jam_mulai'];
			echo "-";
			echo $data1['jam_selesai'];
			echo "</br>";
			}
			?>
      </div></td>
      <td><div align="center">
        <?php 
	  		$sql1 = "SELECT * FROM jadwal_praktek WHERE hari='Jumat' AND kd_dokter='$kd_dokter' AND keterangan='Aktif'";
			$qry1 = mysql_query($sql1, $koneksi) 
		 		or die ("SQL Error".mysql_error());
			while($data1=mysql_fetch_array($qry1)){
			echo $data1['jam_mulai'];
			echo "-";
			echo $data1['jam_selesai'];
			echo "</br>";
			}
			?>
      </div></td>
      <td><div align="center">
        <?php 
	  		$sql1 = "SELECT * FROM jadwal_praktek WHERE hari='Sabtu' AND kd_dokter='$kd_dokter' AND keterangan='Aktif'";
			$qry1 = mysql_query($sql1, $koneksi) 
		 		or die ("SQL Error".mysql_error());
			while($data1=mysql_fetch_array($qry1)){
			echo $data1['jam_mulai'];
			echo "-";
			echo $data1['jam_selesai'];
			echo "</br>";
			}
			?>
      </div></td>
      <td><div align="center">
        <?php 
	  		$sql1 = "SELECT * FROM jadwal_praktek WHERE hari='Minggu' AND kd_dokter='$kd_dokter' AND keterangan='Aktif'";
			$qry1 = mysql_query($sql1, $koneksi) 
		 		or die ("SQL Error".mysql_error());
			while($data1=mysql_fetch_array($qry1)){
			echo $data1['jam_mulai'];
			echo "-";
			echo $data1['jam_selesai'];
			echo "</br>";
			}
			?>
      </div></td>
      <td><div align="center"><a href="../admin/jadwal_edit.php?kdubah=<?php echo $data['kd_dokter']; ?>" onClick="NewWindow(this.href,'name','800','400','yes');return false">Edit</a> 
      | <a href="../admin/jadwal_hapus.php?kdhapus=<?php echo $data['kd_dokter']; ?>" class="style1">Hapus</a></div></td>
      <?php
}
?>
    </tr>
  </table>
</body>
</html>
