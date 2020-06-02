<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.kodeauto.php";
include "../librari/inc.session.php";
include "biodata.php";
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
$username = $_REQUEST['username'];
$aturan = $_REQUEST['aturan'];
$nama_obat = $_REQUEST['nama_obat'];
if ($kd_kunjungan !="") {
   $sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
if (isset($_GET['action'])) {
if ($_GET['action'] == "update")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['rx'.$i]))
     {
       $rx = $_POST['rx'.$i];
       $nama_obat = $_POST['nama_obat'.$i];
	   $aturan = $_POST['aturan'.$i];
	   $qty = $_POST['qty'.$i];
	   $rute = $_POST['rute'.$i];
	   $username = $_POST['username'.$i];
       $query = "UPDATE resep SET aturan='$aturan',qty='$qty', rute='$rute', farmasi='$username' WHERE kd_kunjungan='$rx' AND nama_obat='$nama_obat'";
       mysql_query($query);
     }
   }
}
if ($_GET['action'] == "selesai")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['rx'.$i]))
     {
       $rx = $_POST['rx'.$i];
       $nama_obat = $_POST['nama_obat'.$i];
	   $username = $_POST['username'.$i];
       $query = "UPDATE resep SET status='Selesai', farmasi='$username' WHERE kd_kunjungan='$rx' AND nama_obat='$nama_obat'";
       mysql_query($query);
     }
   }
echo "<script>
opener.location.reload(true);".
"self.close()".
"</script>";
"Selesai!";
exit();
}
if ($_GET['action'] == "del")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['rx'.$i]))
     {
       $rx = $_POST['rx'.$i];
       $nama_obat = $_POST['nama_obat'.$i];
	   $username = $_POST['username'.$i];
       $query = "UPDATE resep SET status='Batal', farmasi='$username' WHERE kd_kunjungan='$rx' AND nama_obat='$nama_obat' AND status!='Selesai'";
       mysql_query($query);
     }
   }
}
}
?>
<html>
<head>
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
<title>RESEP</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"><style type="text/css">
<!--
a:link {
	color: #000080;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
.style1 {font-size: 16px}
-->
</style>
</head>
<body>
<form name="myform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>?action=del&kd_kunjungan=<?php echo $kd_kunjungan;?>">
<table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="3%" bgcolor="#D9E8F3"><div align="center">
    <input type="checkbox" name="pilih" onClick="pilihan()" /></div>    </td>
    <td width="23%" bgcolor="#D9E8F3"><div align="center">Nama Obat</div></td>
    <td width="6%" bgcolor="#D9E8F3"><div align="center">Qty</div></td>
    <td width="12%" bgcolor="#D9E8F3"><div align="center">Aturan</div></td>
    <td width="14%" bgcolor="#D9E8F3"><div align="center">Rute</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Harga</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">SubTotal</div></td>
 </tr>

<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan' AND status!='Batal'";
$hasil = mysql_query($query);
$i = 1;
while ($data = mysql_fetch_array($hasil))
{
$harga = $data['harga'];
$sub_total = $harga * $data['qty']; 
$harga_total = $harga_total + $sub_total;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center">
    <input type="checkbox" name="rx<?php echo $i;?>" value="<?php echo $data['kd_kunjungan'];?>"/>
	<input type="hidden" name="username<?php echo $i;?>" value="<?php echo $_SESSION['klinik'];?>"/>
    <input type="hidden" name="nama_obat<?php echo $i;?>" value="<?php echo $data['nama_obat'];?>" />
    </td>
    <td class="style1"><?php echo $data['nama_obat'];?></br> 
<?php
$kd_obat = $data['kd_obat'];
$query2 = "SELECT * FROM obat_formula WHERE kd_obat='$kd_obat'";
$hasil2 = mysql_query($query2);
while ($data2 = mysql_fetch_array($hasil2))
{
	echo " -".$data2['nama_bahan'].", ".$data2['keterangan']."</br>";
}
?>
	</td>
    <td class="style1"><input type="text" name="qty<?php echo $i;?>" value="<?php echo $data['qty'];?>" size="4"></td>
    <td class="style1"><input type="text" name="aturan<?php echo $i;?>" value="<?php echo $data['aturan'];?>"></td>
    <td class="style1"><input type="text" name="rute<?php echo $i;?>" value="<?php echo $data['rute'];?>"></td>
    <td class="style1"><?php echo "Rp. ";?><?php echo angka($data['harga']);?></td>
    <td class="style1"><?php echo "Rp. ";?><?php echo angka($sub_total);?><?php $i++;?></td>
  </tr>
  <?php
}
?>
<tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF"></td>
      <td bgcolor="#FFFFFF" colspan="5">Terbilang : <?php echo terbilang($harga_total);?> rupiah</td>
      <td><?php echo "Rp. ";?> <?php echo angka($harga_total);?></td>
    </tr>
<tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF"></td>
    <td bgcolor="#FFFFFF" colspan="5"><input type="hidden" name="n" value="<?php echo $i;?>"/>
	    <a href="resep_tambah.php?kd_kunjungan=<?php echo $kd_kunjungan;?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><b>+ Tambah Resep </b>
</a>
      <input type="submit" name="submit" value="Update" onClick="myform.action='<?php $_SERVER['PHP_SELF']; ?>?action=update&kd_kunjungan=<?php echo $kd_kunjungan;?>'; return true;" title="Ubah Resep">
      <input type="submit" name="submit" value="Selesai" onClick="myform.action='<?php $_SERVER['PHP_SELF']; ?>?action=selesai&kd_kunjungan=<?php echo $kd_kunjungan;?>'; return true;" title="Resep Selesai">
    <td><input type="submit" value="Batalkan Resep" name="submit"></td>
    </tr>
</table>
</div>
</body>
</html>
