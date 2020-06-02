<?php
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "../librari/terbilang.php";
include "tab_order_poli.php";
$kd_kunjungan = $_REQUEST['kd_kunjungan'];

if ($_GET['action'] == "del")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];
   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['kd_lab'.$i]))
     {
       $kd_lab = $_POST['kd_lab'.$i];
       $nama_lab = $_POST['nama_lab'.$i];
       $query = "DELETE FROM lab WHERE id='$kd_lab'";
       mysql_query($query);
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
<title>LABORATORIUM</title>
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
<a href="lab.php?kd_kunjungan=<?php echo $kd_kunjungan;?>" onClick="NewWindow(this.href,'name','800','400','yes');return false"><b>+ Order Lab </b>
</a>
<form name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?kd_kunjungan=<?php echo $kd_kunjungan;?>&action=del">
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#DBEAF5">
 <tr bgcolor="#FFFFFF">
    <td width="3%" bgcolor="#D9E8F3"><div align="center">
    <input type="checkbox" name="pilih" onClick="pilihan()" /></div>
    </td>
    <td width="23%" bgcolor="#D9E8F3"><div align="center">Nama lab</div></td>
    <td width="22%" bgcolor="#D9E8F3"><div align="center">Harga</div></td>
    <td width="22%" bgcolor="#D9E8F3"><div align="center">Hasil</div></td>
    <td width="20%" bgcolor="#D9E8F3"><div align="center">Status</div></td>
 </tr>

<?php
// query untuk mencari file berdasarkan kategori
$query = "SELECT * FROM lab WHERE kd_kunjungan='$kd_kunjungan'";
$hasil = mysql_query($query);
$i = 0;
while ($data = mysql_fetch_array($hasil))
{
$harga_lab = $data['harga_lab'];
$harga_total = $harga_total + $harga_lab;
?>
  <tr onMouseOver="this.bgColor='lightyellow'" onMouseOut="this.bgColor='#ffffff'" bgcolor="#ffffff">
    <td class="style1" align="center">
    <input type="checkbox" name="kd_lab<?php echo $i;?>" value="<?php echo $data['id'];?>" />
    <input type="hidden" name="nama_lab<?php echo $i;?>" value="<?php echo $data['nama_lab'];?>" />
    </td>
    <td class="style1"><?php echo $data['nama_lab'];?></td>
    <td class="style1"><?php echo $data['harga_lab'];?></td>
    <td class="style1"><?php echo $data['hasil'];?></td>   
    <td class="style1"><?php echo $data['status'];?><?php $i++;?></td>
  </tr>
  <?php
}
?>
<tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF"></td>
      <td bgcolor="#FFFFFF">Sub Total :</td>
      <td colspan="3">Rp. <?php echo $harga_total;?>,- Terbilang : <?php echo terbilang($harga_total);?> rupiah</td>
    </tr>
<tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF"></td>
      <td bgcolor="#FFFFFF" colspan="4"><input type="hidden" name="n" value="<?php echo $i;?>"/>
      <input type="submit" value="Hapus" name="submit"> <input type="reset" value="Batal" name="reset">
</tr>
</table>
</div>
</body>
</html>


