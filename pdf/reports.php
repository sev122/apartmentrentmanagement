<?php 
require('fpdf.php');

include '../database.php';
include '../account-process.php';
include '../reports-process.php';

//paper size (ex. A4)
//default marging (10 mm)
//writable horizontal: 219-(10*2)=189mm

class PDF extends FPDF{
	function Header(){
		$this->Image('../img/e-logo.png',15,15,15);
		$this->SetFont('Arial', 'B', 15);
		$this->Cell(0,10,"E  L  L  A  P  A  R  T  M  E  N  T",0,1,'C');

		$this->SetFont('Arial', '', 10);
		$this->Cell(0,5,'Pasig City, Metro Manila, Philippines',0,1,'C');
		$this->Cell(0,5,'Cellphone No: (+63) 945-###-4634',0,1,'C');
		$this->Cell(0,5,'Telephone No: (02) ####-5244',0,1,'C');
		$this->SetFont('Arial', 'B', 15);
		$this->Cell(195,8,'',0,1,'C');
		// cell(wd,ht, text, border (0 or 1), end line (0 or 1), [align(L,C or R)])
		$this->Cell(0,6,'B     I     L     L     S',1,1,'C');

		$this->SetFont('Arial','B', 9);
		$this->Cell(6.5,20,'No.', 1,0,'C');
		$this->Cell(20,20,'Name', 1,0,'C');
		$this->Cell(15,20,'Unit No.', 1,0,'C');
		$this->Cell(17,5,'Electric','TLR',0,'C');
		$this->Cell(15,10,'Total', 'TLR',0,'C');
		$this->Cell(15,10,'Unit', 'TLR',0,'C');
		$this->Cell(17,5,'Electric','TLR',0,'C');
		$this->Cell(17,5,'Water','TLR',0,'C');
		$this->Cell(15,20,'Total m3', 1,0,'C');
		$this->Cell(15,20,'Unit m3', 1,0,'C');
		$this->Cell(17,5,'Water', 'TLR',0,'C');
		$this->Cell(17,10,'Rental', 'TLR',0,'C');
		$this->Cell(17,10,'Total', 'TLR',0,'C');
		$this->Cell(22,20,'Notes', 1,0,'C');
		$this->Cell(20,20,'Due Date', 1,0,'C');
		$this->Cell(19,5,'Meter','TLR',0,'C');
		$this->Cell(12.5,20,'Status', 1,0,'C');
		$this->Cell(0,5,'',0,1);

		$this->Cell(6.5,5,'', 0,0,'C');
		$this->Cell(20,5,'', 0,0,'C');
		$this->Cell(15,5,'', 0,0,'C');
		$this->Cell(17,5,'Total','LR',0,'C');
		$this->Cell(15,10,'kWh', 'LR',0,'C');
		$this->Cell(15,10,'kWh', 'LR',0,'C');
		$this->Cell(17,5,'Total','LR',0,'C');
		$this->Cell(17,5,'Total','LR',0,'C');
		$this->Cell(15,5,'', 0,0,'C');
		$this->Cell(15,5,'', 0,0,'C');
		$this->Cell(17,5,'Total', 0,0,'C');
		$this->Cell(17,10,'Bill', 'LR',0,'C');
		$this->Cell(17,10,'Bill', 'LR',0,'C');
		$this->Cell(22,5,'', 0,0,'C');
		$this->Cell(20,5,'', 0,0,'C');
		$this->Cell(19,5,'Reading','LR',0,'C');
		$this->Cell(12.5,5,'', 0,0,'C');
		$this->Cell(0,5,'',0,1);

		$this->Cell(6.5,55,'', 0,0,'C');
		$this->Cell(20,55,'', 0,0,'C');
		$this->Cell(15,55,'', 0,0,'C');
		$this->Cell(17,5,'Amount','LR',0,'C');
		$this->Cell(15,5,'', 'LR',0,'C');
		$this->Cell(15,5,'', 'LR',0,'C');
		$this->Cell(17,5,'Bill','LR',0,'C');
		$this->Cell(17,5,'Amount','LR',0,'C');
		$this->Cell(15,5,'', 0,0,'C');
		$this->Cell(15,5,'', 0,0,'C');
		$this->Cell(17,5,'Bill', 0,0,'C');
		$this->Cell(17,5,'', 'LR',0,'C');
		$this->Cell(17,5,'', 'LR',0,'C');
		$this->Cell(22,5,'', 0,0,'C');
		$this->Cell(20,5,'', 0,0,'C');
		$this->Cell(19,5,'Date','LR',0,'C');
		$this->Cell(12.5,5,'', 0,0,'C');
		$this->Cell(0,5,'',0,1);

		$this->Cell(6.5,5,'', 0,0,'C');
		$this->Cell(20,5,'', 0,0,'C');
		$this->Cell(15,5,'', 0,0,'C');
		$this->Cell(17,5,'Due','LRB',0,'C');
		$this->Cell(15,5,'', 'LRB',0,'C');
		$this->Cell(15,5,'', 'LRB',0,'C');
		$this->Cell(17,5,'','LRB',0,'C');
		$this->Cell(17,5,'Due','LRB',0,'C');
		$this->Cell(15,5,'', 'LRB',0,'C');
		$this->Cell(15,5,'', 'LRB',0,'C');
		$this->Cell(17,5,'', 'LRB',0,'C');
		$this->Cell(17,5,'', 'LRB',0,'C');
		$this->Cell(17,5,'', 'LRB',0,'C');
		$this->Cell(22,5,'', 0,0,'C');
		$this->Cell(20,5,'', 0,0,'C');
		$this->Cell(19,5,'','LRB',0,'C');
		$this->Cell(12.5,5,'', 0,0,'C');
		$this->Cell(0,5,'',0,1);

	}
	function Footer(){
		//add table's bottom line
		$this->Cell(190,0,'','T',1,'',true);
		
		//Go to 1.5 = 15 cm from bottom
		$this->SetY(-20);
				
		$this->SetFont('Arial','',8);
		date_default_timezone_set("Asia/Manila");
		$this->SetFont('Courier','', 10);
		$this->Cell(130,5,' Date Printed: ', 0,0,'R');
		$this->Cell(0,5,date('Y-m-d l'),0,1,'L');
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,5,'Page '.$this->PageNo()." / {pages}",0,0,'C');

	}
}

$pdf = new PDF('L', 'mm', 'A4');

$pdf->AliasNbPages('{pages}');

$pdf -> AddPage();
$selectRecord = "SELECT * FROM bills";
$getRecords = mysqli_query($connect, $selectRecord);
$count = 1;
//$pdf->SetFillColor(200,200,200);
while($row = mysqli_fetch_assoc($getRecords)){
	$pdf->SetFont('Arial','', 9);
	$pdf->Cell(6.5,10,$count, 1,0,'C');
	if ($pdf->GetStringWidth($row['firstname']) > 10) {
		$pdf->SetFont('Arial','', 8);
		$pdf->Cell(20,5,$row['firstname'], 'TLR',0,'C');
	}
	else{
		$pdf->SetFont('Arial','', 9);
		$pdf->Cell(20,5,$row['firstname'], 'TLR',0,'C');
	}
	$pdf->SetFont('Arial','', 9);
	//$pdf->Cell(20,5,$row['firstname'], 'TLR',0,'C');
	$pdf->Cell(15,10,$row['unit_no'], 1,0,'C');
	$pdf->Cell(17,10,number_format($row['eTotalAmountDue'],2),1,0,'C');
	$pdf->Cell(15,10,$row['totalkwh'], 1,0,'C');
	$pdf->Cell(15,10,$row['unitkwh'], 1,0,'C');
	$pdf->Cell(17,10,number_format($row['electricTotal'],2), 1,0,'C',false);
	$pdf->Cell(17,10,number_format($row['wTotalAmountDue'],2), 1,0,'C');
	$pdf->Cell(15,10,$row['totalm3'],1,0,'C');
	$pdf->Cell(15,10,$row['unitm3'],1,0,'C');
	$pdf->Cell(17,10,number_format($row['waterTotal'],2), 1,0,'C',false);
	$pdf->Cell(17,10,number_format($row['rentalTotal'],2), 1,0,'C',false);
	$pdf->Cell(17,10,number_format($row['totalBill'],2), 1,0,'C',false);
	if ($pdf->GetStringWidth($row['notes']) > 10) {
		$pdf->Cell(22,10,substr($row['notes'], 0, 7).'...', 1,0,'C');
	}
	else{
		$pdf->Cell(22,10,substr($row['notes'], 0, 10), 1,0,'C');
	}
	$pdf->SetFont('Arial','', 9);
	//$pdf->Cell(22,10,substr($row['notes'], 0, 10), 1,0,'C');
	$pdf->Cell(20,10,$row['dueDate'], 1,0,'C');
	$pdf->Cell(19,10,$row['readingDate'],1,0,'C');
	$pdf->Cell(12.5,10,$row['status'], 1,0,'C');
	$pdf->Cell(0,5,'', 0,1);

	$pdf->Cell(6.5,5,'', 0,0);
	if ($pdf->GetStringWidth($row['lastname']) > 10) {
		$pdf->SetFont('Arial','', 8);
		$pdf->Cell(20,5,$row['lastname'], 'LRB',0,'C');
	}
	else{
		$pdf->SetFont('Arial','', 9);
		$pdf->Cell(20,5,$row['lastname'], 'LRB',0,'C');
	}
	//$pdf->Cell(20,5,$row['lastname'], 'LRB',0,'C');
	$pdf->Cell(0,5,'', 0,1);
	$count++;
}

$pdf->Output();

 ?>
