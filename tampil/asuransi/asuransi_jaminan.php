<?php
include "tab_asuransi.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
$kd_asuransi = $_GET['kd_asuransi'];
if (isset($_GET['action'])) {
if ($_GET['action'] == "add")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['a'.$i]))
     {
       $kd_asuransi = $_POST['kd_asuransi'];
	   $besaran_jaminan = $_POST['besaran_jaminan'];
	   $a = $_POST['a'.$i];
	   $nama_jaminan = $_POST['nama_jaminan'.$i];
       $query = "INSERT INTO asuransi_plan  VALUES('$kd_asuransi','$a','$nama_jaminan','$besaran_jaminan')";
       mysql_query($query);
     }
   }
}
if ($_GET['action'] == "hapus")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['a'.$i]))
     {
       $kd_asuransi = $_POST['kd_asuransi'];
	   $a = $_POST['a'.$i];
       $query = "DELETE FROM asuransi_plan WHERE kd_asuransi='$kd_asuransi' AND kd_jaminan='$a'";
       mysql_query($query);
     }
   }
}
}
?>
<html>
<head>
<title>MENU USER</title>
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
function pilihan2()
  {
     // membaca jumlah komponen dalam form bernama 'myform'
     var jumKomponen = document.myform2.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.myform2[0].checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.myform2[i].type == "checkbox") document.myform2[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.myform2[0].checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.myform2[i].type == "checkbox") document.myform2[i].checked = false;
            }
        }
  }
  </script>
</head>
<body id="tab3">
<table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
<form name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?action=add&kd_asuransi=<?php echo $kd_asuransi;?>">
<?php
$kd_asuransi =$_GET['kd_asuransi'];
$sql = "SELECT * FROM asuransi_db WHERE kd_asuransi='$kd_asuransi'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry);

?>

  <tr>
    <td width="50%" height="21"><div align="center">JAMINAN</div></td>
    </tr>

  <tr bgcolor="#ffffff">
    <td valign="top">	
      
	<input type="checkbox" name="pilih" onClick="pilihan()" />Pilih semua</br>
	<input type="hidden" value="<?php echo $data['kd_asuransi'];?>" name="kd_asuransi" />
      <?php
$sql1 = "SELECT * FROM obat_db";
$qry1 = mysql_query($sql1,$koneksi);
$i = 1;
while ($data1=mysql_fetch_array($qry1)){;
?>
	
      <input type="checkbox" value="<?php echo $data1['kd_obat'];?>" name="a<?php echo $i;?>" />
      <input type="hidden" value="<?php echo $data1['nama_obat'];?>" name="nama_jaminan<?php echo $i;?>" />
      <?php echo $data1['kd_obat'];?> <?php echo $data1['nama_obat'];?></br>
      <?php $i++;?>
<?php	  
}

$sql2 = "SELECT * FROM tm_db";
$qry2 = mysql_query($sql2,$koneksi);
while ($data2=mysql_fetch_array($qry2)){;
?>
      <input type="checkbox" value="<?php echo $data2['kd_tm'];?>" name="a<?php echo $i;?>" />
      <input type="hidden" value="<?php echo $data2['nama_tm'];?>" name="nama_jaminan<?php echo $i;?>" />
      <?php echo $data2['kd_tm'];?> <?php echo $data2['nama_tm'];?></br>
      <?php $i++;?>
<?php	  
}
?>
      <input type="hidden" name="n" value="<?php echo $i;?>"/></td>
    </tr>
  <tr bgcolor="#ffffff">  
    <td valign="top"><input type="submit" value="add" name="submit">
    </a></td>
    </tr>
  </form>
	
	<form name="myform2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?action=add&kd_asuransi=<?php echo $kd_asuransi;?>">
<?php
$kd_asuransi =$_GET['kd_asuransi'];
$sql = "SELECT * FROM asuransi_db WHERE kd_asuransi='$kd_asuransi'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry);
?>
<h3>Nama Asuransi : <?php echo $data['nama_asuransi'];?></h3>
  <tr>
    <td width="50%" height="21"><div align="center">JAMINAN PASIEN </div></td>
  </tr>

  <tr bgcolor="#ffffff">
    <td valign="top">
	
		<input type="checkbox" name="pilih" onClick="pilihan2()" />Pilih semua</br>	
	
	<?php
$sql3 = "SELECT * FROM asuransi_plan WHERE kd_asuransi='$kd_asuransi'";
$qry3 = mysql_query($sql3,$koneksi)
       or die ("SQL Error".mysql_error());
	   $i = 0;
while ($data3=mysql_fetch_array($qry3)){;
?>
      <input type="checkbox" value="<?php echo $data3['kd_jaminan'];?>" name="a<?php echo $i;?>" />
	  <?php echo $data3['kd_jaminan'];?>
      <input type="hidden" value="<?php echo $data3['nama_jaminan'];?>" name="nama_jaminan<?php echo $i;?>" />
      <?php echo $data3['nama_jaminan'];?>
      <?php $i++;?></br>
      <?php	  
}
?></td>
  </tr>
  <tr bgcolor="#ffffff">  
    <td valign="top">
	<input type="submit" name="submit" value="Hapus" onClick="myform2.action='asuransi_jaminan.php?action=hapus&kd_asuransi=<?php echo $kd_asuransi;?>'; return true;"></td>
  </tr>
</form>
</table>

<p>&nbsp;</p>
</body>
</html>
