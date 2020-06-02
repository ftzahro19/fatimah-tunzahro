<?php
define('FPDF_FONTPATH', 'fpdf/font/');
require('code39.php');

$pdf=new PDF_Code39();
$pdf->AddPage();
$pdf->Code39(10, 30, 'Muhammad Rifqi');
$pdf->Output();
?>
