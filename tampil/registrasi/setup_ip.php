<?php 
include "../librari/inc.koneksidb.php";

$sql="DROP TABLE IF EXISTS reg_rj";
mysql_query($sql);
$sql="CREATE TABLE reg_rj (
   kd_kunjungan varchar(12) NOT NULL,
   unit varchar(30) NOT NULL,
   tgl_reg varchar(100) NOT NULL,
   jam_reg varchar(100) NOT NULL,
   userID varchar(100)NOT NULL,
   spesialis varchar(66) NOT NULL,
   batal varchar(5) DEFAULT 'No' NOT NULL,
   selesai varchar(5) DEFAULT 'No' NOT NULL,
   PRIMARY KEY (kd_kunjungan)) TYPE=MyISAM;";

?>
