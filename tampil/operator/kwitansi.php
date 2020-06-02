<?php
include "../../config/config.php";
include "../librari/inc.koneksidb.php";
include "../librari/inc.session.php";
include "../librari/inc.kodeauto.php";
require '../fpdf/fpdf.php'; // file fpdf.php harus diincludekan

class PDF extends FPDF
{
	function Header()
	{
// setting properti font
$this->SetFont('Arial','I',10);
// menulis header
$this->Ln(5);
$this->SetFont('Arial','B',12);
$this->Cell(180,10,'KWITANSI',0,1,'C');
// membuat jarak terhadap cell sebelumnya
$this->Image('../../media/image/logo_kareo.png',8,6,20,20,'','http://www.ppni.org');
// setting properti font
$kd_kunjungan 	= $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg,transaksi WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan=transaksi.kd_kunjungan AND transaksi.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

$this->SetFillColor(255,255,255);
$this->SetTextColor(0);
$this->SetFont('Arial','',10);

$this->Cell(30,6,'Date',0,0,'L');
$this->Cell(5,6,':',0,0,'L');
$this->Cell(50,6,$data['tanggal_trx'],0,0,'L');
$this->Cell(30,6,'No. MR',0,0,'L');
$this->Cell(5,6,':',0,0,'L');
$this->MultiCell(50,6,$data['prn'],0,1,'L');

$this->Cell(30,6,'Nama',0,0,'L');
$this->Cell(5,6,':',0,0,'L');
$this->Cell(50,6,$data['nama'],0,0,'L');
$this->Cell(30,6,'No. HP',0,0,'L');
$this->Cell(5,6,':',0,0,'L');
$this->Cell(50,6,$data['hp1'],0,1,'L');

// membuat space kosong antara header dengan teks konten
$this->Ln(5);
	}

// membuat footer
function Footer()
{
//Position at 1.5 cm from bottom
$this->SetY(-15);
//Arial italic 8
$this->SetFont('Arial','I',8);
$sql = "SELECT * FROM data_klinik";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

//Page number
$this->Cell(45,4,$data['nama_klinik'],0,0,'L');
$this->Cell(45,4,$data['alamat1'],0,0,'L');
$this->Cell(2,4,':',0,0,'L');
$this->Cell(20,4,$data['telpon1'],0,0,'L');
$this->Cell(2,4,',',0,0,'L');
$this->Cell(18,4,$data['telpon2'],0,0,'L');
$this->Cell(2,4,',',0,0,'L');
$this->Cell(25,4,$data['email'],0,1,'L');
}

	//Colored table
	function tabel_transaksi()
	{
		$kd_kunjungan 	= $_GET['kd_kunjungan'];
		//Queri untuk Menampilkan data
		$query1 ="SELECT * FROM transaksi WHERE grup_item!='Drug and retail' AND kd_kunjungan='$kd_kunjungan'";
		$hasil1 = mysql_query($query1) or die("Query gagal");

		//Column titles
		$header=array('Description','Units','Amount');
		
		//Colors, line width and bold font
		$this->SetFillColor(224,0,33);
		$this->SetTextColor(255);

		$this->SetFont('','');
		
		//Title table
		//$this->Cell(20,30,'Title',1,0,'C');
		
		//Header
		$w=array(130,20,20);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],0,0,'C',true);
		$this->Ln();
		
		//Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		
		//Data
		$fill=false;
		
		while($data1=mysql_fetch_array($hasil1))
		{
			$harga_pribadi1 = $data1['pribadi']; 
			$sub_total_pribadi1 = $sub_total_pribadi1 + $harga_pribadi1;	
			$this->Cell($w[0],7,$data1['nama_item'],'0',0,'L',$fill);
			$this->Cell($w[1],7,$data1['qty_item'],'0',0,'C',$fill);
			$this->Cell($w[2],7,$data1['pribadi'],'0',0,'R',$fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w),10,'','T');
		$this->Ln(1);
		$this->Cell(130,6,'Total :',0,0,'L');
		$this->Cell(20,6,'',0,0,'C');
		$this->Cell(20,6,angka($sub_total_pribadi1),0,1,'R');
		$this->Ln(10);
	}
}

$pdf=new PDF('L','mm','A5');
$pdf->SetMargins(10,10,10); 
$pdf->AliasNbPages();
$pdf->AddPage();

//memanggil fungsi table
$pdf->tabel_transaksi();
$pdf->Output();
?>

