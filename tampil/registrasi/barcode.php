<?php
mysql_connect("localhost","root","12345678");
mysql_select_db("klinik");
 
$sql=mysql_query("select * from data_pasien where prn='00000001'");
$data=mysql_fetch_array($sql);
 
$nama="$data[prn]";
 
define('FPDF_FONTPATH', 'fpdf/font/');
require('bar128.php');
 
 
$pdf = new PDF_Bar128();
 
$pdf->Open();
$pdf->addPage(L);
 
$pdf->setFont('Arial','',20);
 

$pdf->Bar128(100, 30, $nama);
 
//$pdf->Code39(100, 30, 'Test');
 
$pdf->Output();
 
?>