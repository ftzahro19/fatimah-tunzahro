<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
$prn 	= $_REQUEST['prn'];
$sql = "SELECT * FROM data_pasien WHERE prn='$prn'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 
?>
<!DOCTYPE html>
<html>
<head>
<style>
@media print {
input.noPrint { display: none; }
}
@page 
        {
            size: auto;   /* auto is the initial value */
        }

</style>
<style>
div.prn {
    margin: 2.7cm 4cm 1cm 6.5cm;
}
div.nama {
    margin: 1cm 4cm 3cm 4.4cm;
}
</style>
</head>
<body>
<div class="prn"><?php echo $data['prn'];?></div>
<div class="nama"><?php echo $data['nama'];?>
</span></div>
<input class="noPrint" type="button" value="Print" onClick="window.print()">
</body>
</html>