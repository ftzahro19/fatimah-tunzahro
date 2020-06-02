<?php
include "../librari/inc.koneksidb.php";
include "tab_order_poli.php";
include "../librari/terbilang.php";
include "../librari/fungsi_indotgl.php";
$kd_kunjungan = $_GET['kd_kunjungan'];
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
     if (isset($_POST['tm'.$i]))
     {
       $tm = $_POST['tm'.$i];
       $nama_tm = $_POST['nama_tm'.$i];
       $query = "DELETE FROM tm WHERE id='$tm'";
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
<body id="tab6">
<a href="tm.php?kd_kunjungan=<?php echo $kd_kunjungan;?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><b>+ Tambah Tindakan </b></a>
<form name="myform" method="post" action="tm_view.php?kd_kunjungan=<?php echo $kd_kunjungan;?>&action=del">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
 <tr bgcolor="#FFFFFF">
    <td width="2%" bgcolor="#D9E8F3"><div align="center">
    <input type="checkbox" name="pilih" onClick="pilihan()" /></div>    </td>
    <td width="9%" bgcolor="#D9E8F3"><div align="center">Tanggal</div></td>
    <td width="9%" bgcolor="#D9E8F3"><div align="center">Jam Order </div></td>
    <td width="24%" bgcolor="#D9E8F3"><div align="center">Nama Tindakan </div></td>
    <td width="3%" bgcolor="#D9E8F3"><div align="center">Qty</div></td>
    <td width="15%" bgcolor="#D9E8F3"><div align="center">Harga</div></td>
    <td width="15%" bgcolor="#D9E8F3"><div align="center">Sub Total</div></td>
	<td width="14%" bgcolor="#D9E8F3"><div align="center">Keterangan</div></td>
	<td width="9%" bgcolor="#D9E8F3"><div align="center">Status</div></td>
 </tr>

<?php
// query untuk mencari file berdasarkan kategori

$query = "SELECT * FROM tm WHERE kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$i = 0;
$harga_total =0;
while ($data = mysql_fetch_array($hasil))
{
$tanggal = tgl_indo($data['tanggal_tm']);
$harga_tm = $data['harga_tm'];
$sub_total = $harga_tm * $data['qty_tm'];
$harga_total = $harga_total + $sub_total;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center">
    <input type="checkbox" name="tm<?php echo $i;?>" value="<?php echo $data['id'];?>"/>    </td>
    <td class="style1"><?php echo $tanggal;?></td>
    <td class="style1"><?php echo $data['jam_tm'];?></td>
    <td class="style1"><?php echo $data['nama_tm'];?></td>
    <td class="style1"><?php echo $data['qty_tm'];?></td>
    <td class="style1"><?php echo $data['harga_tm'];?></td>
    <td class="style1"><?php echo $sub_total;?></td>
    <td class="style1"><?php echo $data['keterangan_tm'];?></td>
	<td class="style1"><?php echo $data['status_tm'];?><?php $i++;?></td>
  </tr>
  <?php
}
?>
  <tr bgcolor="#FFFFFF">
    <td rowspan="3" bgcolor="#FFFFFF"></td>
    <td colspan="2" bgcolor="#FFFFFF">Sub Total </td>
    <td colspan="6" bgcolor="#FFFFFF">Rp. <?php if (isset($harga_total)) { echo $harga_total; } ?>,-</td>
  </tr>
  <tr bgcolor="#FFFFFF">
      <td colspan="2" bgcolor="#FFFFFF">Terbilang</td>
      <td colspan="6" bgcolor="#FFFFFF"><?php if (isset($harga_total)) {
	  echo terbilang($harga_total);
	  }
	  ?>
rupiah</td>
    </tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan="8"><input type="hidden" name="n" value="<?php echo $i;?>"/>
      <input type="submit" value="Hapus" name="submit">
      <input type="reset" value="Batal" name="reset">
    </tr>
</table>
</div>
</body>
</html>
