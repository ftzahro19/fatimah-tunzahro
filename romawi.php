<?php
$no = 2512;
$tahun = 2012;
$bulan = 8;
$romawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
$surat = 2;
$tipesurat = array('AA','AB','AC','AD');

echo sprintf( '%03d/%s/%s/%04d' , $no , $tipesurat[$surat] , $romawi[$bulan] , $tahun );
?>