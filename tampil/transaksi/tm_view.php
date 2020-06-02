<?php
include "../librari/inc.koneksidb.php";
include "header_tm.php";
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
$username = $_REQUEST['username'];
$kd_tm = $_REQUEST['kd_tm'];
$nama_tm = $_REQUEST['nama_tm'];

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
     if (isset($_POST['tm'.$i]))
     {
       $tm = $_POST['tm'.$i];
       $kd_tm = $_POST['kd_tm'.$i];
	   $operator = $_POST['operator'.$i];
	   $keterangan_tm = $_POST['keterangan_tm'.$i];
       $query = "UPDATE tm SET operator='$operator',keterangan_tm='$keterangan_tm' WHERE kd_kunjungan='$tm' AND kd_tm='$kd_tm'";
       mysql_query($query);
     }
   }
}
}
if (isset($_GET['action'])) {
if ($_GET['action'] == "selesai")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['tm'.$i]))
     {
       $tm = $_POST['tm'.$i];
       $kd_tm = $_POST['kd_tm'.$i];
	   $status_tm = $_POST['status_tm'.$i];
       $query = "UPDATE tm SET status_tm='Selesai' WHERE kd_kunjungan='$tm' AND kd_tm='$kd_tm'";
       mysql_query($query);
	   include "transaksi_tindakan.php";
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
<title>TINDAKAN</title>
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
<form name="myform" method="post" action="tm_hapus.php?kd_kunjungan=<?php echo $kd_kunjungan;?>">
<table align="left" width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="3%" bgcolor="#D9E8F3"><div align="center">
    <input type="checkbox" name="pilih" onClick="pilihan()" /></div>    </td>
    <td width="23%" bgcolor="#D9E8F3"><div align="center">Nama Tindakan </div></td>
    <td width="6%" bgcolor="#D9E8F3"><div align="center">Qty</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Harga</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Sub Total</div></td>
	<td width="12%" bgcolor="#D9E8F3"><div align="center">Operator</div></td>
	<td width="6%" bgcolor="#D9E8F3"><div align="center">Keterangan</div></td>
    <td width="6%" bgcolor="#D9E8F3"><div align="center">Status</div></td>
 </tr>

<?php
// query untuk mencari file berdasarkan kategori

$query = "SELECT * FROM tm WHERE kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$i = 0;
$harga_total =0;
while ($data = mysql_fetch_array($hasil))
{
$harga_tm = $data['harga_tm'];
$sub_total = $harga_tm * $data['qty_tm'];
$harga_total = $harga_total + $sub_total;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center">
    <input type="checkbox" name="tm<?php echo $i;?>" value="<?php echo $data['kd_kunjungan'];?>"/>
    <input type="hidden" name="nama_tm<?php echo $i;?>" value="<?php echo $data['nama_tm'];?>" />
	<input type="hidden" name="kd_tm<?php echo $i;?>" value="<?php echo $data['kd_tm'];?>" />  </td>
    <td class="style1"><?php echo $data['nama_tm'];?></td>
    <td class="style1"><?php echo $data['qty_tm'];?></td>
    <td class="style1"><?php echo $data['harga_tm'];?></td>
    <td class="style1"><?php echo $sub_total;?></td>
    <td class="style1"><select name="operator<?php echo $i;?>" id="operator<?php echo $i;?>">
      <option value="" selected>[Pilih...]</option>
      <?php
	  $operator = $data['operator'];
	$sql = "SELECT * FROM user";
    $qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data2 =mysql_fetch_array($qry)) {
	if ($data2[username]==$operator) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data2[username]' $cek>".$data2['username']."</option>";
	}
	?>
    </select></td>
	<td class="style1"><select name="keterangan_tm<?php echo $i;?>" id="keterangan_tm<?php echo $i;?>">
      <?php 
        if ($data['keterangan_tm']=="") echo "<option value='' selected>[Pilih]</option>";
        else echo "<option value=''>{Pilih]</option>";
    	if ($data['keterangan_tm']=="Paket") echo "<option value='Paket' selected>Paket</option>";
        else echo "<option value='Paket'>Paket</option>";
        ?>
    </select></td>
    <td class="style1"><?php echo $data['status_tm'];?>
    <?php $i++;?></td>
  </tr>
  <?php
}
?>
<tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF"></td>
      <td bgcolor="#FFFFFF" colspan="4">Terbilang : 
	  <?php if (isset($harga_total)) {
	  echo terbilang($harga_total);
	  }
	  ?>
	   rupiah</td>
      <td colspan="3"><?php if (isset($harga_total)) { echo $harga_total; } ?></td>
    </tr>
<tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF"></td>
    <td bgcolor="#FFFFFF" colspan="4"><input type="hidden" name="n" value="<?php echo $i;?>"/>
	  <a href="tm_search.php?kd_kunjungan=<?php echo $kd_kunjungan;?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><input type="submit" value="Input" name="submit"></a>
      <input type="submit" name="submit" value="Update" onClick="myform.action='<?php $_SERVER['PHP_SELF']; ?>?action=update&kd_kunjungan=<?php echo $kd_kunjungan;?>'; return true;" title="Update tindakan">
      <input type="submit" name="submit" value="Selesai" onClick="myform.action='transaksi_selesai.php?action=selesai&kd_kunjungan=<?php echo $kd_kunjungan;?>'; return true;" title="Update tindakan">
    <td colspan="3"></td>
    </tr>
</table>
</div>
</body>
</html>