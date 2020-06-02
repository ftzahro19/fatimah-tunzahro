<?php 
include "../librari/inc.koneksidb.php";

$kd_obat = $_GET['kd_obat'];
$sql = "SELECT * FROM obat_db WHERE kd_obat='$kd_obat'";
$qry = mysql_query($sql,$koneksi)
       or die ("SQL Error".mysql_error());
$data=mysql_fetch_array($qry);

if (isset($_GET['action'])) {
if ($_GET['action'] == "update")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['kd_formula'.$i]))
     {
       $kd_formula = $_POST['kd_formula'.$i];
       $nama_bahan = $_POST['nama_bahan'.$i];
	   $keterangan = $_POST['keterangan'.$i];
       $query = "UPDATE obat_formula SET nama_bahan='$nama_bahan', keterangan='$keterangan' WHERE kd_formula='$kd_formula'";
       mysql_query($query);
     }
   }
}
if ($_GET['action'] == "del")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['kd_formula'.$i]))
     {
       $kd_formula = $_POST['kd_formula'.$i];
       $nama_bahan = $_POST['nama_bahan'.$i];
	   $keterangan = $_POST['keterangan'.$i];
       $query = "DELETE FROM obat_formula WHERE kd_formula='$kd_formula'";
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
<title>Update Formula Obat</title>
</head>
<body>
<form name="myform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>?action=del&kd_obat=<?php echo $kd_obat;?>">
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
<tr align="left"> 
  <th colspan="4" scope="col">NAMA FORMULA OBAT : <?php echo $data['nama_obat']; ?></th>
</tr>
<tr bgcolor="#FFFFFF">
  <td colspan="4"><a href="tambah_formula_obat.php?kd_obat=<?php echo $kd_obat;?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><b>+ Tambah </b>
</a></td>
  </tr>
  <tr bgcolor="#FFFFFF">
  <td><input type="checkbox" name="pilih" onClick="pilihan()" /></td>
  <td width="8%">Kode Obat </td>
  <td width="15%">Nama Bahan </td>
  <td width="74%">Keterangan</td>
</tr>
<?php
$sql2 = "SELECT * FROM obat_formula WHERE kd_obat='$kd_obat'";
$qry2 = mysql_query($sql2);
$i = 1;
while ($data2 = mysql_fetch_array($qry2)) {
?>
<tr bgcolor="#FFFFFF"> 
  <td width="3%"><input type="checkbox" name="kd_formula<?php echo $i;?>" value="<?php echo $data2['kd_formula']; ?>"></td>
  <td><label>
    <input type="text" name="kd_obat<?php echo $i;?>" value="<?php echo $data2['kd_obat']; ?>" size="6" disabled="disabled">
  </label></td>
  <td><input type="text" name="nama_bahan<?php echo $i;?>" value="<?php echo $data2['nama_bahan']; ?>"></td>
  <td><input type="text" name="keterangan<?php echo $i;?>" value="<?php echo $data2['keterangan']; ?>"><?php $i++;?></td>
</tr>
<?php
}
?>
<tr bgcolor="#FFFFFF"> 
  <td>&nbsp;</td>
  <td colspan="3">
  <input type="hidden" name="n" value="<?php echo $i;?>"/>
  <input type="submit" name="submit" value="Update" onClick="myform.action='<?php $_SERVER['PHP_SELF']; ?>?action=update&kd_obat=<?php echo $data['kd_obat'];?>'; return true;" title="Update nama bahan">
    <input type="submit" value="Hapus" name="submit"></td>
</tr>
</table>
</form>
</body>
</html>
