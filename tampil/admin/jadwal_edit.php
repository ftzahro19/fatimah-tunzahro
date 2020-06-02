<?php 
include "../librari/inc.koneksidb.php";
include_once "../librari/inc.session.php";
$kdubah = $_GET['kdubah'];
$sql = "SELECT * FROM user,jadwal_praktek WHERE user.username=jadwal_praktek.kd_dokter AND kd_dokter='$kdubah'";
$qry = mysql_query($sql);
$data=mysql_fetch_array($qry);
?>
<html>
<head>
<title>UPDATE JADWAL PRAKTEK</title>
<script type="text/javascript">

  function pilihan()
  {
     // membaca jumlah komponen dalam form bernama 'myform'
     var jumKomponen = document.myform.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.myform[0].checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.myform[i].type == "checkbox") document.myform[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.myform[0].checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.myform[i].type == "checkbox") document.myform[i].checked = false;
            }
        }
  }

  </script>
<style type="text/css">
<!--
.style1 {font-size: 16px}
-->
</style>
</head>
<body>
<form action="jadwal_edit_sim.php" method="post" name="myform" target="_self">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<input type="hidden" name="kd_dokter" value="<?php echo $data['kd_dokter'];?>">
<tr align="left"> 
  <th colspan="5" scope="col">UPDATE JADWAL PRAKTEK [<?php echo $data['nama'];?>] </th>
</tr>
<tr bgcolor="#FFFFFF">
  <td width="4%">&nbsp;</td> 
  <td width="17%"><div align="center">HARI</div></td>
  <td width="20%"><div align="center">JAM MULAI </div></td>
  <td width="24%"><div align="center">JAM SELESAI </div></td>
  <td width="35%"><div align="center">KETERANGAN</div></td>
</tr>
<?php
$sql1 = "SELECT * FROM jadwal_praktek WHERE kd_dokter='$kdubah'";
$qry1 = mysql_query($sql1);
$i = 0;
while ($data1=mysql_fetch_array($qry1)){?>
<tr bgcolor="#FFFFFF">
  <td><input type="checkbox" name="no<?php echo $i;?>" value="<?php echo $data1['no'];?>"></td> 
  <td><?php echo $data1['hari'];?></td>
  <td><input name="jam_mulai<?php echo $i;?>" type="text" value="<?php echo $data1['jam_mulai'];?>" size="3"></td>
  <td><input name="jam_selesai<?php echo $i;?>" type="text" value="<?php echo $data1['jam_selesai'];?>" size="3"></td>
  <td><?php
	if ($data1['keterangan']=="Aktif") {
	$cek_a = "checked";
	$cek_b = "";
	}
	else {
	$cek_a = "";
	$cek_b = "checked";
	}
	?>
    <input name="keterangan<?php echo $i;?>" type="radio" value="Aktif" <?php echo $cek_a;?>>
    Aktif
    <input name="keterangan<?php echo $i;?>" type="radio" value="Non Aktif" <?php echo $cek_b;?>>
    Non Aktif <span class="style1">
    <?php $i++;?>
    </span></td>
</tr>
<?php
}
?>
<tr bgcolor="#FFFFFF">
  <td>&nbsp;</td> 
  <td colspan="4"> 
	<input type="hidden" name="n" value="<?php echo $i;?>"/>
	<input name="Submit" type="submit" value="Update">  </td>
  </tr>
</table>
</form>
</body>
</html>
