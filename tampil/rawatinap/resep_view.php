<?php
include "../librari/inc.koneksidb.php";
include "tab_ranap.php";
include "../librari/terbilang.php";
include "../librari/fungsi_indotgl.php";
$kd_kunjungan = $_REQUEST['kd_kunjungan'];
if ($kd_kunjungan !="") {
   $sql = "SELECT * FROM reg WHERE kd_kunjungan='$kd_kunjungan'";
   $qry = mysql_query($sql,$koneksi)
      or die ("SQL Error".mysql_error());
   $data=mysql_fetch_array($qry);
}
if (isset($_GET['action'])) {
if ($_GET['action'] == "del")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['rx'.$i]))
     {
       $rx = $_POST['rx'.$i];
       $query = "DELETE FROM resep WHERE id='$rx' AND status='Order'";
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
     var jumKomponen = document.form1.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.form1[0].checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.form1[i].type == "checkbox") document.form1[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.form1[0].checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.form1[i].type == "checkbox") document.form1[i].checked = false;
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
<body id="tab2">
<a href="resep.php?kd_kunjungan=<?php echo $kd_kunjungan;?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><b>+ Tambah Resep </b>
</a>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?kd_kunjungan=<?php echo $kd_kunjungan;?>&action=del">
<table align="center" width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#FFFFFF">
    <td width="2%" bgcolor="#D9E8F3"><div align="center">
    <input type="checkbox" name="pilih" onClick="pilihan()" /></div>    </td>
    <td width="9%" bgcolor="#D9E8F3"><div align="center">Tanggal</div></td>
    <td width="8%" bgcolor="#D9E8F3"><div align="center">Jam Order</div></td>
    <td width="22%" bgcolor="#D9E8F3"><div align="center">Nama Obat</div></td>
    <td width="3%" bgcolor="#D9E8F3"><div align="center">Qty</div></td>
    <td width="13%" bgcolor="#D9E8F3"><div align="center">Aturan</div></td>
    <td width="11%" bgcolor="#D9E8F3"><div align="center">Rute</div></td>
    <td width="12%" bgcolor="#D9E8F3"><div align="center">Harga</div></td>
    <td width="13%" bgcolor="#D9E8F3"><div align="center">Sub Total</div></td>
	<td width="7%" bgcolor="#D9E8F3"><div align="center">Status</div></td>
 </tr>

<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM resep WHERE kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$i = 0;
$harga_total =0;
while ($data = mysql_fetch_array($hasil))
{
$tanggal = tgl_indo($data['tanggal_rx']);
$harga = $data['harga'];
$sub_total = $harga * $data['qty']; 
$harga_total = $harga_total + $sub_total;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center">
    <input type="checkbox" name="rx<?php echo $i;?>" value="<?php echo $data['id'];?>"/></td>
    <td class="style1"><?php echo $tanggal;?></td>
    <td class="style1"><?php echo $data['jam_rx'];?></td>
    <td class="style1"><?php echo $data['nama_obat'];?></td>
    <td class="style1"><input type="text" size="4" name="qty<?php echo $i;?>" value="<?php echo $data['qty'];?>"/></td>
    <td class="style1">
      <select name="aturan<?php echo $i;?>" id="aturan">
        <option value="" selected>[Pilih...]</option>
        <?php
	$aturan = $data['aturan'];
	$sql = "SELECT * FROM aturan";
    $qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data1 =mysql_fetch_array($qry)) {
	if ($data1[aturan]==$aturan) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data1[aturan]' $cek>".$data1['aturan']."</option>";
	}
	?>
      </select></td>
    <td class="style1">
      <select name="rute<?php echo $i;?>" id="rute">
        <option value="" selected>[Pilih...]</option>
        <?php
	$rute = $data['rute'];
	$sql = "SELECT * FROM rute";
      	$qry = @mysql_query($sql, $koneksi) or die ("gagal Query");
	while ($data2 =mysql_fetch_array($qry)) {
	if ($data2[rute]==$rute) {
	$cek="selected";
	}
	else {
	$cek="";
	}
	echo "<option value='$data2[rute]' $cek>".$data2['rute']."</option>";
	}
	?>
      </select></td>
    <td class="style1"><?php echo $data['harga'];?></td>
    <td class="style1"><?php echo $sub_total;?></td>
	<td class="style1"><?php echo $data['status'];?><?php $i++;?></td>
  </tr>
  <?php
}
?>
  <tr bgcolor="#FFFFFF">
    <td rowspan="3" bgcolor="#FFFFFF"></td>
    <td colspan="2" bgcolor="#FFFFFF">Sub Total </td>
    <td colspan="7" bgcolor="#FFFFFF">Rp. <?php echo $harga_total;?>,-</td>
  </tr>
  <tr bgcolor="#FFFFFF">
      <td colspan="2" bgcolor="#FFFFFF">Terbilang</td>
      <td colspan="7" bgcolor="#FFFFFF"><?php echo terbilang($harga_total);?> rupiah</td>
    </tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan="9"><input type="hidden" name="n" value="<?php echo $i;?>"/>
      <input type="submit" name="submit" value="Update" onClick="form1.action='resep_edit_sim.php?kd_kunjungan=<?php echo $kd_kunjungan;?>&action=update'; return true;">
      <input type="submit" value="Hapus" name="submit">    </tr>
</table>
</div>
</body>
</html>
