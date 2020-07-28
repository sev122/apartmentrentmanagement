<?php 
require('fpdf.php');

include '../database.php';
include '../unit-process.php';


//paper size (ex. A4)
//default marging (10 mm)
//writable horizontal: 219-(10*2)=189mm

class PDF extends FPDF{
	function Header(){
		$this->Image('../img/e-logo.png',17,17,17);
		$this->SetFont('Arial', 'B', 15);
		$this->Cell(195,10,"E  L  L  A  P  A  R  T  M  E  N  T",0,1,'C');

		$this->SetFont('Arial', '', 10);
		$this->Cell(195,5,'Pasig City, Metro Manila, Philippines',0,1,'C');
		$this->Cell(195,5,'Cellphone No: (+63) 945-###-4634',0,1,'C');
		$this->Cell(195,5,'Telephone No: (02) ####-5244',0,1,'C');
	}
	function Footer(){

		date_default_timezone_set("Asia/Manila");
		$this->SetFont('Courier','', 10);
		$this->Cell(155,5,' Date Printed:', 0,0,'R');
		$this->Cell(40,5,date('Y-m-d l'),0,1,'C');
	}
}

$pdf = new PDF('P', 'mm', 'letter');

$pdf -> AddPage();

// font family, font weight, font size
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(195,8,'',0,1,'C');
// cell(wd,ht, text, border (0 or 1), end line (0 or 1), [align(L,C or R)])
$pdf->Cell(195,6,"T  E  N  A  N  T  '  S     B  I  L  L",1,1,'C');

$pdf->SetFont('Arial','B', 11);
$pdf->Cell(32.5,8,'NAME:', 1,0,'C');

$pdf->SetFont('Arial','', 11);
$pdf->Cell(97.5,8,$firstname ." ". $lastname, 1,0,'C');

$pdf->SetFont('Arial','B', 11);
$pdf->Cell(32.5,8,'UNIT NO:', 1,0,'C');

$pdf->SetFont('Arial','', 11);
$pdf->Cell(32.5,8,$unit_no, 1,1,'C');
$pdf->Cell(195,4,'',1,1);//space

$pdf->SetFont('Arial','B', 10);
$pdf->Cell(32.5,8,'UTILITY', 1,0,'C');
$pdf->Cell(32.5,8,'Total Amount Due', 1,0,'C');
$pdf->Cell(32.5,8,'Total kWh', 1,0,'C');
$pdf->Cell(32.5,8,'Current Reading', 1,0,'C');
$pdf->Cell(32.5,8,'Previous Reading', 1,0,'C');
$pdf->Cell(32.5,8,'Sub Total',1,1,'C');

$pdf->SetFont('Arial','', 10);
//electric
$pdf->Cell(32.5,8,'Electricity', 1,0,'C');
$pdf->Cell(32.5,8,number_format($eTotalAmountDue,2), 1,0,'C');
$pdf->Cell(32.5,8,$totalkwh, 1,0,'C');
$pdf->Cell(32.5,8,$unitkwh, 1,0,'C');
$pdf->Cell(32.5,8,$prevkwh, 1,0,'C');
$pdf->Cell(32.5,8,number_format($electricTotal ,2),1,1,'C');
//water
$pdf->Cell(32.5,8,'Water', 1,0,'C');
$pdf->Cell(32.5,8,number_format($wTotalAmountDue ,2), 1,0,'C');
$pdf->Cell(32.5,8,$totalm3, 1,0,'C');
$pdf->Cell(32.5,8,$unitm3, 1,0,'C');
$pdf->Cell(32.5,8,$prevm3, 1,0,'C');
$pdf->Cell(32.5,8,number_format($waterTotal ,2),1,1,'C');
//rental
$pdf->Cell(32.5,8,'Rental', 1,0,'C');
if ($deposit == '') {
	$pdf->Cell(130,8,'1 Month', 1,0,'C');
}
else{
	$pdf->Cell(130,8,'1 month advance, 1 month deposit', 1,0,'C');
}
$pdf->Cell(32.5,8,number_format($rentalTotal ,2),1,1,'C');
//space
$pdf->Cell(195,4,'', 1,1,'C');
//notes label
$pdf->SetFont('Arial','', 10);
$pdf->Cell(130,8,'Notes:', 0,0);
//total
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(32.5,10,' TOTAL', 1,0,'C');
$pdf->Cell(32.5,10,number_format($totalBill ,2),1,1,'C');
//notes box
$pdf->Cell(120,20,$notes, 1,0,'C');
//due date
$pdf->SetFont('Arial','', 10);
$pdf->Cell(10,8,'', 0,0);
if ($dueDate == '') {
	$pdf->Cell(32.5,8,'Meter Reading Date', 1,0,'C');
	$pdf->Cell(32.5,8,$readingDate,1,1,'C');
}
else{
	$pdf->Cell(32.5,8,'Due Date', 1,0,'C');
	$pdf->Cell(32.5,8,$dueDate,1,1,'C');
}

//space
$pdf->Cell(32.5,8,'',0,1);

$pdf->Output();

 ?>
