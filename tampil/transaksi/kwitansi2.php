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
$this->Image('../../media/image/logoidi.png',8,4,20,20,'','http://www.renpra.com');
$this->Image('../../media/image/Salinan.png',100,4,40,10,'','http://www.renpra.com');
// setting properti font
$kd_kunjungan 	= $_GET['kd_kunjungan'];
$sql = "SELECT * FROM data_pasien,reg,transaksi WHERE data_pasien.prn=reg.prn AND reg.kd_kunjungan=transaksi.kd_kunjungan AND transaksi.kd_kunjungan='$kd_kunjungan'";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

$this->SetFillColor(255,255,255);
$this->SetTextColor(0);
$this->SetFont('Arial','',10);

$this->Cell(30,4,'Date',0,0,'L');
$this->Cell(5,4,':',0,0,'L');
$this->Cell(50,4,$data['tanggal_trx'],0,0,'L');
$this->Cell(30,4,'No. MR',0,0,'L');
$this->Cell(5,4,':',0,0,'L');
$this->MultiCell(45,4,$data['prn'],0,1,'L');

$this->Cell(30,4,'Nama',0,0,'L');
$this->Cell(5,4,':',0,0,'L');
$this->Cell(50,4,$data['nama'],0,0,'L');
$this->Cell(30,4,'No. HP',0,0,'L');
$this->Cell(5,4,':',0,0,'L');
$this->Cell(50,4,$data['hp1'],0,1,'L');

$this->Cell(0,4,'Page '.$this->PageNo().' of
{nb}',0,1,'R');

	}

// membuat footer
function Footer()
{
//Position at 1.5 cm from bottom
$this->SetY(-5);
//Arial italic 8
$this->SetFont('Arial','I',8);
$sql = "SELECT * FROM data_klinik";
$qry = mysql_query($sql);
$data = mysql_fetch_array($qry); 

//Page number
$this->Cell(45,4,$data['nama_klinik'],0,0,'L');
$this->Cell(45,4,$data['alamat1'],0,0,'L');
$this->Cell(10,4,'TELP',0,0,'L');
$this->Cell(2,4,':',0,0,'L');
$this->Cell(20,4,$data['telpon1'],0,0,'L');
$this->Cell(2,4,',',0,0,'L');
$this->Cell(18,4,$data['telpon2'],0,0,'L');
$this->Cell(2,4,',',0,0,'L');
$this->Cell(25,4,$data['email'],0,1,'L');
}

	function tabel_jasa()
	{
		//Queri untuk Menampilkan data
		$kd_kunjungan 	= $_GET['kd_kunjungan'];
		$query2 ="SELECT * FROM transaksi WHERE kd_kunjungan='$kd_kunjungan' AND grup_item='Consultation and procedur'";
		$hasil2 = mysql_query($query2) or die("Query gagal");

		//Column titles
		$header=array('Description','Units','3rd Party','Amount');
		
		//Colors, line width and bold font
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0);
		
		//Header
		$w=array(130,20,20,20);
		for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],6,$header[$i],'BT',0,'C',true);
		$this->Ln();
		
		//Data
		$fill=false;
		while($data2=mysql_fetch_array($hasil2))
		{
			$harga_asuransi2 = $data2['asuransi'];
			$harga_pribadi2 = $data2['pribadi'];
			$sub_total_asuransi2 = $sub_total_asuransi2 + $harga_asuransi2;
			$sub_total_pribadi2 = $sub_total_pribadi2 + $harga_pribadi2;
			$this->Cell($w[0],4,$data2['nama_item'],0,0,'L',$fill);
			$this->Cell($w[1],4,$data2['qty_item'],0,0,'C',$fill);
			$this->Cell($w[2],4,$data2['asuransi'],0,0,'C',$fill);
			$this->Cell($w[3],4,$data2['pribadi'],0,1,'R',$fill);
			$fill=!$fill;
		}
	}
	
	//Colored table
	function tabel_resep()
	{
		$kd_kunjungan 	= $_GET['kd_kunjungan'];
		//Queri untuk Menampilkan data
		$query1 ="SELECT * FROM transaksi WHERE kd_kunjungan='$kd_kunjungan' AND grup_item='Drug and retail'";
		$hasil1 = mysql_query($query1) or die("Query gagal");
		
		//Header
		$w=array(130,20,20,20);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],4,$header[$i],1,0,'C',true);
		
		while($data1=mysql_fetch_array($hasil1))
		{
			$harga_asuransi1 = $data1['asuransi'];
			$harga_pribadi1 = $data1['pribadi']; 
			$sub_total_asuransi1 = $sub_total_asuransi1 + $harga_asuransi1;	
			$sub_total_pribadi1 = $sub_total_pribadi1 + $harga_pribadi1;	
			$this->Cell($w[0],4,$data1['nama_item'],'0',0,'L',$fill);
			$this->Cell($w[1],4,$data1['qty_item'],'0',0,'C',$fill);
			$this->Cell($w[2],4,$data1['asuransi'],'0',0,'C',$fill);
			$this->Cell($w[3],4,$data1['pribadi'],'0',0,'R',$fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Ln(10);
	}

	function tabel_hitung() {
		$kd_kunjungan 	= $_GET['kd_kunjungan'];
		$query3 ="SELECT SUM(asuransi),SUM(pribadi) FROM transaksi WHERE kd_kunjungan='$kd_kunjungan'";
		$hasil3 = mysql_query($query3) or die("Query gagal");
		$data3=mysql_fetch_array($hasil3);
		$asuransi= $data3['SUM(asuransi)'];
		$pribadi= $data3['SUM(pribadi)'];

$this->Cell(150,4,'Pembayaran oleh asuransi','T',0,'L');
$this->Cell(20,4,'Rp.','T',0,'R');
$this->Cell(0,4,angka($asuransi),'T',1,'R');
$this->Cell(150,4,'Pembayaran oleh pribadi','B',0,'L');
$this->Cell(20,4,'Rp.','B',0,'R');
$this->Cell(0,4,angka($pribadi),'B',1,'R');
$this->Ln(10);
$this->Cell(100,4,'',0,0,'C');
$this->Cell(100,4,'Cashier',0,1,'C');
}
}

$pdf=new PDF('L','mm','A5');
$pdf->SetMargins(10,10,10); 
$pdf->AliasNbPages();
$pdf->AddPage();

//memanggil fungsi table
$pdf->tabel_jasa();
$pdf->tabel_resep();
$pdf->tabel_hitung();
$pdf->Output();
?>