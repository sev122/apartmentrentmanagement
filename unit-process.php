<?php 
error_reporting(0);
$id = 0;
$edit_bill_state = false;
$eTotalAmountDue = $_POST['eTotalAmountDue'];
$totalkwh = $_POST['totalkwh'];
$unitkwh = $_POST['unitkwh'];
$wTotalAmountDue = $_POST['wTotalAmountDue'];
$totalm3 = $_POST['totalm3'];
$unitm3 = $_POST['unitm3'];
$unit_no = $_POST['unitNo'];
$monthsOfRental = $_POST['monthsOfRental'];
$notes = $_POST['notes'];
$dueDate = $_POST['dueDate'];
$electricTotal = $waterTotal = $rentalTotal = $totalBill = 0;

if (isset($_POST['billSaveBtn'])) {

	$selectInfoandExec = mysqli_query($connect, "SELECT * FROM accounts WHERE unit_no = '$unit_no'");
	$unitInfo = mysqli_fetch_assoc($selectInfoandExec);
	$firstname = $unitInfo['firstname'];
	$lastname = $unitInfo['lastname'];
	$rentalFee = 8000;
	if ($eTotalAmountDue == "" && $totalkwh == "" && $unitkwh != "" && $wTotalAmountDue == "" && $totalm3 == "" && $unitm3 != "" && $monthsOfRental != "") {
		$deposit = 1;
		$rentalTotal = ($deposit * $rentalFee) + ($monthsOfRental * $rentalFee);
		$totalBill = 0 + $rentalTotal;
		$saveBill = "INSERT INTO bills (firstname, lastname, unit_no, unitkwh,														 unitm3, deposit, rentalTotal, totalBill, notes, readingDate)															VALUES ('$firstname', '$lastname', '$unit_no', '$unitkwh',													 '$unitm3', '$deposit', '$rentalTotal', '$totalBill', '$notes', '$dueDate')";

		if (mysqli_query($connect, $saveBill)) {
			header("refresh:0.5s, url=bill.php");

			$_SESSION['alert_success'] = "Meter reading to unit ". $unit_no ." has been saved!";
		}
		else{
			header("refresh:0.5s, url=bill.php");
			$_SESSION['alert_danger'] = "Can't save meter reading to database!";
		}

	}

	elseif($eTotalAmountDue != "" && $totalkwh != "" && $unitkwh != "" && $wTotalAmountDue != "" && $totalm3 != "" && $unitm3 != "" && $monthsOfRental != ""){
		
		$selectLastReading= "SELECT * FROM bills WHERE (unit_no = '$unit_no' AND  firstname = '$firstname' AND  lastname = '$lastname') ORDER BY id DESC LIMIT 1";
		$getLastRec = mysqli_query($connect, $selectLastReading);
		$lastReading = mysqli_fetch_assoc($getLastRec);
		$prevkwh = $lastReading['unitkwh'];
		$prevm3 = $lastReading['unitm3'];
		//elec
		$eTotalAmountDueAns = $eTotalAmountDue / $totalkwh;
		$kwh = $unitkwh - $prevkwh;
		$electricTotal = round($eTotalAmountDueAns * $kwh, 2);
		//water
		$wTotalAmountDueAns = $wTotalAmountDue / $totalm3;
		$m3 = $unitm3 - $prevm3;
		$waterTotal = round($wTotalAmountDueAns * $m3, 2);
		//rental
		
		$rentalTotal = $rentalFee * $monthsOfRental;
		//total
		$totalBill = $electricTotal + $waterTotal + $rentalTotal;

		$saveBill = "INSERT INTO bills (firstname, lastname, unit_no, 																		eTotalAmountDue, totalkwh, unitkwh, prevkwh, 																wTotalAmountDue, totalm3, unitm3, prevm3, 																	electricTotal, waterTotal, rentalTotal, 																	totalBill, notes, dueDate) VALUES ('$firstname', '$lastname', '$unit_no', 									'$eTotalAmountDue', '$totalkwh', '$unitkwh', '$prevkwh', 													'$wTotalAmountDue', '$totalm3', '$unitm3', '$prevm3', 														'$electricTotal', '$waterTotal', '$rentalTotal',															 '$totalBill', '$notes', '$dueDate')";

		if (mysqli_query($connect, $saveBill)) {
			header("refresh:0.5s, url=bill.php");
			$_SESSION['alert_success'] = "The invoice for unit ".$unit_no." has been saved!";
		}
		else{
			header("refresh:0.5s, url=bill.php");
			$_SESSION['alert_danger'] = "Can't save invoice to database!";
		}

	}
	else{
		header("refresh:0.5s, url=bill.php");
		$_SESSION['alert_danger'] = "Please fill up the form.";	
	}
	
}

if (isset($_POST['billUpdateBtn'])) {

	$selectInfoandExec = mysqli_query($connect, "SELECT * FROM accounts WHERE unit_no = '$unit_no'");
	$unitInfo = mysqli_fetch_assoc($selectInfoandExec);
	$firstname = $unitInfo['firstname'];
	$lastname = $unitInfo['lastname'];
	$id = $_SESSION['id'];
	$rentalFee = 8000;
	if ($eTotalAmountDue == "" && $totalkwh == "" && $unitkwh != "" && $wTotalAmountDue == "" && $totalm3 == "" && $unitm3 != "" && $monthsOfRental != "") {
		$deposit = 1;
		$rentalTotal = ($deposit * $rentalFee) + ($monthsOfRental * $rentalFee);
		$totalBill = 0 + $rentalTotal;
		$updateBill = "UPDATE bills SET firstname = '$firstname', lastname = '$lastname', unit_no = '$unit_no', unitkwh = '$unitkwh', unitm3 = '$unitm3', deposit = '$deposit', rentalTotal = '$rentalTotal', totalBill = '$totalBill', notes = '$notes', readingDate = '$dueDate' WHERE id = $id";
		
		if (mysqli_query($connect, $updateBill)) {
			header("refresh:0.5s, url=bill.php");
			$_SESSION['alert_success'] = "Meter reading to unit ". $unit_no ." has been saved!";
		}
		else{
			header("refresh:0.5s, url=bill.php");
			$_SESSION['alert_danger'] = "Can't save meter reading to database!";
		}

	}

	elseif($eTotalAmountDue != "" && $totalkwh != "" && $unitkwh != "" && $wTotalAmountDue != "" && $totalm3 != "" && $unitm3 != "" && $monthsOfRental != ""){
		$id_ = $id - 1;
		$selectLastReading= "SELECT * FROM bills WHERE (unit_no = '$unit_no' AND  firstname = '$firstname' AND  lastname = '$lastname') ORDER BY id = $id_ DESC LIMIT 1";
		$getLastRec = mysqli_query($connect, $selectLastReading);
		$lastReading = mysqli_fetch_assoc($getLastRec);
		$prevkwh = $lastReading['unitkwh'];
		$prevm3 = $lastReading['unitm3'];
		//elec
		$eTotalAmountDueAns = $eTotalAmountDue / $totalkwh;
		$kwh = $unitkwh - $prevkwh;
		$electricTotal = round($eTotalAmountDueAns * $kwh, 2);
		//water
		$wTotalAmountDueAns = $wTotalAmountDue / $totalm3;
		$m3 = $unitm3 - $prevm3;
		$waterTotal = round($wTotalAmountDueAns * $m3, 2);
		//rental
		
		$rentalTotal = $rentalFee * $monthsOfRental;
		//total
		$totalBill = $electricTotal + $waterTotal + $rentalTotal;

		$updateBill = "UPDATE bills SET firstname = '$firstname', lastname = '$lastname', 										unit_no = '$unit_no', eTotalAmountDue = '$eTotalAmountDue', 										totalkwh = '$totalkwh', unitkwh = '$unitkwh', prevkwh = '$prevkwh', 								wTotalAmountDue = '$wTotalAmountDue', totalm3 = '$totalm3', 										unitm3 = '$unitm3', prevm3 = '$prevm3', electricTotal = '$electricTotal', 							waterTotal = '$waterTotal', rentalTotal = '$rentalTotal', totalBill = '$totalBill', 				notes = '$notes', dueDate = '$dueDate' WHERE id = $id";

		if (mysqli_query($connect, $updateBill)) {
			header("refresh:0.5s, url=bill.php");
			$_SESSION['alert_success'] = "The invoice for unit ".$unit_no." has been saved!";
		}
		else{
			header("refresh:0.5s, url=bill.php");
			$_SESSION['alert_danger'] = "Can't save invoice to database!";
		}

	}
	else{
		header("refresh:0.5s, url=bill.php");
		$_SESSION['alert_danger'] = "Please fill up the form.";	
	}
	
}

//edit
if (isset($_GET['editBill'])) {
	$edit_bill_state = true;
	$id = $_GET['editBill'];
	$_SESSION['id'] = $id;
	$selectId = mysqli_query($connect, "SELECT * FROM bills WHERE id = $id");
	$getBill = mysqli_fetch_assoc($selectId);
	$id = $getBill['id'];
	$firstname = $getBill['firstname'];
	$lastname = $getBill['lastname'];
	$unit_no = $getBill['unit_no'];
	$eTotalAmountDue = $getBill['eTotalAmountDue'];
	$totalkwh = $getBill['totalkwh'];
	$unitkwh = $getBill['unitkwh'];
	$electricTotal = $getBill['electricTotal'];
	$wTotalAmountDue = $getBill['wTotalAmountDue'];
	$totalm3 = $getBill['totalm3'];
	$unitm3 = $getBill['unitm3'];
	$waterTotal = $getBill['waterTotal'];
	$monthsOfRental = $getBill['monthsOfRental'];
	$rentalTotal = $getBill['rentalTotal'];
	$totalBill = $getBill['totalBill'];
	$notes = $getBill['notes'];
	$dueDate = $getBill['dueDate'];
	$readingDate = $getBill['readingDate'];
	$status = $getBill['status'];
	
}

if (isset($_GET['viewBill'])) {
	$id = $_GET['viewBill'];
	$selectId = mysqli_query($connect, "SELECT * FROM bills WHERE id = $id");
	$getBill = mysqli_fetch_assoc($selectId);
	$id = $getBill['id'];
	$firstname = $getBill['firstname'];
	$lastname = $getBill['lastname'];
	$unit_no = $getBill['unit_no'];
	$eTotalAmountDue = $getBill['eTotalAmountDue'];
	$totalkwh = $getBill['totalkwh'];
	$unitkwh = $getBill['unitkwh'];
	$prevkwh = $getBill['prevkwh'];
	$electricTotal = $getBill['electricTotal'];
	$wTotalAmountDue = $getBill['wTotalAmountDue'];
	$totalm3 = $getBill['totalm3'];
	$unitm3 = $getBill['unitm3'];
	$prevm3 = $getBill['prevm3'];
	$waterTotal = $getBill['waterTotal'];
	$monthsOfRental = $getBill['monthsOfRental'];
	$rentalTotal = $getBill['rentalTotal'];
	$totalBill = $getBill['totalBill'];
	$notes = $getBill['notes'];
	$dueDate = $getBill['dueDate'];
	$readingDate = $getBill['readingDate'];
	$status = $getBill['status'];
	
}

if (isset($_POST['deleteBill'])) {
	$id=$_POST['delete_id'];
	if (mysqli_query($connect,"DELETE FROM bills WHERE id=$id")) {
		header("refresh:0.5s, url=records-page.php");
		$_SESSION['alert_success'] = "Invoice has been deleted successfully!";
	}
	else{
		header("refresh:0.5s, url=records-page.php");
		$_SESSION['alert_danger'] = "Deleting invoice failed!";
	}
}

if (isset($_GET['printBill'])) {
	$id = $_GET['printBill'];
	$selectId = mysqli_query($connect, "SELECT * FROM bills WHERE id = $id");
	$getBill = mysqli_fetch_assoc($selectId);
	$id = $getBill['id'];
	$firstname = $getBill['firstname'];
	$lastname = $getBill['lastname'];
	$unit_no = $getBill['unit_no'];
	$eTotalAmountDue = $getBill['eTotalAmountDue'];
	$totalkwh = $getBill['totalkwh'];
	$unitkwh = $getBill['unitkwh'];
	$prevkwh = $getBill['prevkwh'];
	$electricTotal = $getBill['electricTotal'];
	$wTotalAmountDue = $getBill['wTotalAmountDue'];
	$totalm3 = $getBill['totalm3'];
	$unitm3 = $getBill['unitm3'];
	$prevm3 = $getBill['prevm3'];
	$waterTotal = $getBill['waterTotal'];
	$deposit = $getBill['deposit'];
	$rentalTotal = $getBill['rentalTotal'];
	$totalBill = $getBill['totalBill'];
	$notes = $getBill['notes'];
	$dueDate = $getBill['dueDate'];
	$readingDate = $getBill['readingDate'];
	$status = $getBill['status'];
	
}

if (isset($_GET['printLastSaved'])) {
	$id = $_GET['printLastSaved'];
	$selectLastSave= "SELECT * FROM bills ORDER BY id DESC LIMIT 1";
	$getLastSave = mysqli_query($connect, $selectLastSave);
	$lastSave = mysqli_fetch_assoc($getLastSave);
	$firstname = $lastSave['firstname'];
	$lastname = $lastSave['lastname'];
	$unit_no = $lastSave['unit_no'];
	$eTotalAmountDue = $lastSave['eTotalAmountDue'];
	$totalkwh = $lastSave['totalkwh'];
	$unitkwh = $lastSave['unitkwh'];
	$prevkwh = $lastSave['prevkwh'];
	$wTotalAmountDue = $lastSave['wTotalAmountDue'];
	$totalm3 = $lastSave['totalm3'];
	$unitm3 = $lastSave['unitm3'];
	$prevm3 = $lastSave['prevm3'];
	$deposit = $lastSave['deposit'];
	$electricTotal = $lastSave['electricTotal'];
	$waterTotal = $lastSave['waterTotal'];
	$rentalTotal = $lastSave['rentalTotal'];
	$totalBill = $lastSave['totalBill'];
	$notes = $lastSave['notes'];
	$dueDate = $lastSave['dueDate'];
	$readingDate = $lastSave['readingDate'];
}

$searchValue = $_POST['searchValue'];
if (isset($_POST['search'])) {
	if ($searchValue != '') {
		$searchdb = "SELECT * FROM bills WHERE firstname LIKE  '%$searchValue%' OR 																lastname LIKE  '%$searchValue%' OR 																			unit_no  LIKE '%$searchValue%' OR 																			eTotalAmountDue  LIKE '%$searchValue%' OR 																	totalkwh  LIKE '%$searchValue%' OR 																			unitkwh  LIKE '%$searchValue%' OR 																			wTotalAmountDue LIKE  '%$searchValue%' OR 																	totalm3  LIKE '%$searchValue%' OR 																			unitm3  LIKE '%$searchValue%' OR 																			electricTotal  LIKE '%$searchValue%' OR 																	waterTotal  LIKE '%$searchValue%' OR 																		rentalTotal LIKE  '%$searchValue%' OR 																		totalBill LIKE  '%$searchValue%' OR 																		notes LIKE  '%$searchValue%' OR 																			dueDate  LIKE '%$searchValue%' OR 																			readingDate LIKE  '%$searchValue%' OR 																		status  LIKE '%$searchValue%' ";
		$selectBillsRec = mysqli_query($connect, $searchdb);
	}

	else if($searchValue == ''){
		$selectBillsRec = mysqli_query($connect, "SELECT * FROM bills");
	}

	else{
		echo "<script>alert($searchValue.' could not found!');</script>";
	}

}
else{
	if ($searchValue == '') {
		$selectBillsRec = mysqli_query($connect, "SELECT * FROM bills");
	}
	
}

if (isset($_GET['tenantBills'])) {
	$unit_no = $_GET['tenantBills'];
	$selectId = mysqli_query($connect, "SELECT * FROM bills WHERE unit_no = $unit_no");
	$getBill = mysqli_fetch_assoc($selectId);
	$id = $getBill['id'];
	$firstname = $getBill['firstname'];
	$lastname = $getBill['lastname'];
	$unit_no = $getBill['unit_no'];

	$selectTentantsBills = mysqli_query($connect, "SELECT * FROM bills WHERE (firstname = '$firstname' && lastname = '$lastname' && unit_no = '$unit_no') ");

}

 ?>