 <?php  
 $dbHost = "localhost";  
 $dbUser = "root";  
 $dbPass = "12345678";  
 $dbName = 'klinikdb';  

 // membuat koneksi mysql  
 $conn = mysql_connect($dbHost, $dbUser, $dbPass, $dbName);  

 // mengecek koneksi mysql  
 if (!$conn) die("Koneksi Gagal: " . mysql_error());  
 else echo "Koneksi MySQL Berhasil ...<br/>";  
 
 // membuat koneksi database   
 $dbSelected = mysql_select_db($dbName, $conn);    

 // mengecek koneksi database  
 if (!$dbSelected) die ('Koneksi Gatabase Gagal: ' . mysql_error());  
 else echo "Koneksi Database Berhasil ...<br/>";  
  
 // membuat tabel pada database MySQLDB  
 $sql1 = "CREATE TABLE IF NOT EXISTS `obat_faktur` (
  `no_faktur` varchar(6) NOT NULL,
  `faktur` varchar(6) NOT NULL,
  `tanggal` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1";  

 $sql2 = "CREATE TABLE IF NOT EXISTS `obat_stock` (
  `no` int(6) NOT NULL,
  `no_faktur` varchar(6) NOT NULL,
  `kd_obat` varchar(6) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1";  

$sql3 = "INSERT INTO `klinikdb`.`menu_sub` (`kd_sub_menu`, `kd_menu`, `nama_sub_menu`, `link`) VALUES ('submenu0406', 'menu04', 'Pengaturan Stock Obat', '../../tampil/admin/obat_faktur_view.php')";

$sql4 = "INSERT INTO `klinikdb`.`menu_sub` (`kd_sub_menu`, `kd_menu`, `nama_sub_menu`, `link`) VALUES ('submenu0407', 'menu04', 'Lihat Stock Obat', '../../tampil/admin/obat_stock_view.php')";

 if (mysql_query($sql1)) {  
   echo "Database berhasil diupdate! Silahkan login <a href='http://localhost/klinik'>DISINI</a></br>";  
 } else {  
   echo "Tabel gagal dibuat: " . mysql_error($conn);  
 }  
  if (mysql_query($sql2)) {  
   echo "Database berhasil diupdate! Silahkan login <a href='http://localhost/klinik'>DISINI</a>";  
 } else {  
   echo "Tabel gagal dibuat: " . mysql_error($conn);  
 }  
   if (mysql_query($sql3)) {  
   echo "Database berhasil diupdate! Silahkan login <a href='http://localhost/klinik'>DISINI</a>";  
 } else {  
   echo "Tabel gagal dibuat: " . mysql_error($conn);  
 }  
   if (mysql_query($sql4)) {  
   echo "Database berhasil diupdate! Silahkan login <a href='http://localhost/klinik'>DISINI</a>";  
 } else {  
   echo "Tabel gagal dibuat: " . mysql_error($conn);  
 }  

 // menutup koneksi mysql  
 mysql_close($conn);  
 ?>  




