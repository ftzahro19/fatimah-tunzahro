<?php 
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "tab_baru_edit.php";
	
# Baca variabel Form (If Register Global ON)
$prn		= $_REQUEST['prn'];
$nama		= $_REQUEST['nama'];
$t4_lahir	= $_REQUEST['t4_lahir'];
$tgl_lahir      = $_REQUEST['tgl_lahir'];
$jenis_kelamin  = $_REQUEST['jenis_kelamin']; 
$tanggal	= $_REQUEST['tanggal'];
$jam		= $_REQUEST['jam'];
$alamat		= $_REQUEST['alamat'];
$rt		= $_REQUEST['rt'];
$kel		= $_REQUEST['kel'];
$kec		= $_REQUEST['kec'];
$kab		= $_REQUEST['kab'];
$prov		= $_REQUEST['prov'];
$telp_rumah	= $_REQUEST['telp_rumah'];
$telp_kantor	= $_REQUEST['telp_kantor'];
$hp1		= $_REQUEST['hp1'];
$hp2		= $_REQUEST['hp2'];
$hp3		= $_REQUEST['hp3'];
$nama_pj	= $_REQUEST['nama_pj'];
$alamat_pj	= $_REQUEST['alamat_pj'];
$hub		= $_REQUEST['hub'];
$telp_rumah_pj	= $_REQUEST['telp_rumah_pj'];
$telp_kantor_pj	= $_REQUEST['telp_kantor_pj'];
$hp_pj		= $_REQUEST['hp_pj'];

 
	$sql  = " UPDATE data_pasien SET 		
		nama		='$nama',
		t4_lahir	='$t4_lahir',
		tgl_lahir	='$tgl_lahir',
		jenis_kelamin	='$jenis_kelamin',
		tanggal		='$tanggal',
		jam		='$jam',
		alamat		='$alamat',
		rt		='$rt',
		kel		='$kel',
		kec		='$kec',
		kab		='$kab',
		prov		='$prov',
		telp_rumah	='$telp_rumah',
		telp_kantor	='$telp_kantor',
		hp1		='$hp1',
		hp2		='$hp2',
		hp3		='$hp3',
		nama_pj		='$nama_pj',
		alamat_pj	='$alamat_pj',
		hub		='$hub',
		telp_rumah_pj	='$telp_rumah_pj',
		telp_kantor_pj	='$telp_kantor_pj',
		hp_pj		='$hp_pj',
		batal		='No'
		WHERE prn='$prn' ";
	mysql_query($sql, $koneksi) 
		  or die ("Maaf, data belum berhasil di-update !");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
        $prn = $_GET['prn'];
	$sql = "SELECT * FROM data_pasien WHERE prn='$prn'";
	$qry = mysql_query($sql, $koneksi) 
		 or die ("SQL Error".mysql_error());
	while ($data=mysql_fetch_array($qry)) {
  ?>
<meta http-equiv="refresh" content="0;url=baru_edit.php?prn=<?php echo "".$data['prn']."";?>" />
<?php
}
?>
<title>Data pasien berhasil disimpan !</title>
</head>
<body id="tab1">
<h3 align="center">Sedang menyimpan...</h3>
<h3 align="center"><img src="<?php echo $url;?>media/image/facebook.gif"/></h3>
</div>
</body>
</html>
