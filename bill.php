<?php 
include 'database.php';
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == 'admin') {
		$logged_account = $_SESSION['username'];
	}
	else{
		header("Location: tenant-dashboard-page.php");
	}
}
else{
	header("Location: index.php");
}
include 'unit-process.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta lang="en">
	<meta name="viewport" content="width=device-width, initial scale=1">
	<link rel="icon" type="text/css" href="img/e-logo.png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/design.css">
	<title>Billing</title>
	<style type="text/css">
		.child-bill{
			list-style: none;
			line-height: 2em;
		}
		.toggle-bill{
			color: #333;
		}
		.toggle-bill:hover{
			text-decoration: none;
			color: #157552;
		}
		.emphasize{
			font-size: 28px;
			color: #b00;
		}
		.remove-top-border{
			border-top: none;
			border-bottom: none;
		}

		.highlight-bill{
			background-color: #ddd;
		}
	</style>
</head>
<body>

<div class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" id="websiteName" href="admin-dashboard-page.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px">EllApartment</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="admin-dashboard-page.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
			<li><a href="admin-accounts-page.php"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
			<li><a class="active" href="bill.php"><span class="glyphicon glyphicon-credit-card"></span> Billing</a></li>
			<li><a href="records-page.php"><span class="glyphicon glyphicon-file"></span>Records</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="">Welcome <?php echo $logged_account;?></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</div>
<div class="container">
	<?php if (isset($_SESSION['alert_success'])):?>
	<div class="alert alert-success alert-dismissible show" role="alert">
		<strong>SUCCESS! </strong>
		<?php

		echo $_SESSION['alert_success'];
		unset ($_SESSION['alert_success']);
		?>
		<button type="button" data-dismiss="alert" class="close" aria-label="Close">&times;</button>
	</div>
	<?php endif ?>
	<?php if (isset($_SESSION['alert_danger'])):?>
	<div class="alert alert-danger alert-dismissible show" role="alert">
		<strong>FAILED! </strong>
		<?php

		echo $_SESSION['alert_danger'];
		unset ($_SESSION['alert_danger']);
		?>
		<button type="button" data-dismiss="alert" class="close" aria-label="Close">&times;</button>
	</div>
	<?php endif ?>
	<br>
	<div class="row">
		<div class="container">
			<form action="bill.php" method="POST">
				<div class="container col-lg-6 col-xs-12 border-mint">
					<table class="table">
						<thead>
							<tr>
								<th colspan="3"><h4 class="text-center title">BILLING FORM</h4></th>
							</tr>
						</thead>
						<tbody>
							<tr class="highlight-bill">
								<th class="form-group col-lg-1 col-xs-2">
									<input type="checkbox" id="electricCheckBox" onclick="activateElec()">
								</th>
								<th><span class="glyphicon glyphicon-flash"></span> ELECTRIC BILL</th>
								<th></th>
							</tr>
							<tr>
								<th></th>
								<th>
									<label class="control-label" for="eTotalAmountDue">Total Amount Due: </label>
								</th>
								<td>
									<input class="form-control" type="number" min="0.00" max="100000.00" step="0.01" name="eTotalAmountDue" id="eTotalAmountDue"  onkeyup="changeDueDateLabel()" value="<?php echo $eTotalAmountDue; ?>" disabled>
								</td>
							</tr>
							<tr>
								<th style="border-top: none;"></th>
								<th style="border-top: none;">
									<label class="control-label" for="totalkwh">Total kWh &lpar;Kilowatt hours&rpar;: </label>
								</th>
								<td style="border-top: none;">
									<input class="form-control" type="number" min="0.00" max="100000.00" step="0.01" name="totalkwh" id="totalkwh"  onkeyup="changeDueDateLabel()" value="<?php echo $totalkwh; ?>" disabled>
								</td>
							</tr>
							<tr>
								<th style="border-top: none;"></th>
								<th style="border-top: none;">
									<label class="control-label" for="unitkwh">Unit kWh &lpar;Kilowatt hours&rpar;: </label>
								</th>
								<td style="border-top: none;">
									<input class="form-control" type="number" min="0.00" max="100000.00" step="0.01" name="unitkwh" id="unitkwh" placeholder="Reading"  onkeyup="changeDueDateLabel()"  value="<?php echo $unitkwh; ?>"required disabled>
								<br>
								</td>
							</tr>
							<tr class="highlight-bill">
								<th class="form-group col-lg-1 col-xs-2">
									<input type="checkbox"  id="waterCheckBox" onclick="activateWater()">
								</th>
								<th><span class="glyphicon glyphicon-tint"></span> WATER BILL</th>
								<th></th>
							</tr>
							<tr>
								<th></th>
								<th>
									<label class="control-label" for="wTotalAmountDue">Total Amount Due: </label>
								</th>
								<td>
									<input class="form-control" type="number" min="0.00" max="100000.00" step="0.01" name="wTotalAmountDue" id="wTotalAmountDue"  onkeyup="changeDueDateLabel()" value="<?php echo $wTotalAmountDue; ?>" disabled>
								</td>
							</tr>
							<tr>
								<th style="border-top: none;"></th>
								<th style="border-top: none;">
									<label class="control-label" for="totalm3">Total m3 &lpar;Cubic Meter&rpar;: </label>
								</th>
								<td style="border-top: none;">
									<input class="form-control" type="number" min="0.00" max="100000.00" step="0.01" name="totalm3" id="totalm3"  onkeyup="changeDueDateLabel()" value="<?php echo $totalm3; ?>" disabled>
								</td>
							</tr>
							<tr>
								<th style="border-top: none;"></th>
								<th style="border-top: none;">
									<label class="control-label" for="unitm3">Unit m3 &lpar;Cubic Meter&rpar;: </label>
								</th>
								<td style="border-top: none;">
									<input class="form-control" type="number" min="0.00" max="100000.00" step="0.01" name="unitm3" id="unitm3"  placeholder="Reading"  onkeyup="changeDueDateLabel()" value="<?php echo $unitm3; ?>" required disabled><br>
								</td>
							</tr>
							<tr class="highlight-bill">
								<th class="form-group col-lg-1 col-xs-2">
									<input type="checkbox"  id="rentalCheckBox" onclick="activateRental()">
								</th>
								<th><span class="glyphicon glyphicon-home"></span> RENTAL BILL</th>
								<th></th>
							</tr>
							<tr>
								<th></th>
								<th>
									<label class="control-label" for="monthsOfRental">Months of rental: </label>
								</th>
								<td>
									<input class="form-control" type="number" min="0" max="12" step="1" name="monthsOfRental" id="monthsOfRental" required disabled>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
				<div class="container col-lg-6 col-xs-12">
					<div class="jumbotron">
						<table class="table">
							<thead>
								<tr>
									<th class="title text-center" colspan="2"><h4 class="title">TENANT'S BILL</h4></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="">Name: </th>
									<td id="nameForBilling"><?php echo $firstname." ".$lastname ;?></td>
								</tr>
								<tr>
									<th style="border-top:none;">Unit No: </th>
									<td style="border-top:none;" id="noUnitForBilling">
										<select class="form-control" id="inUnitNo" name="unitNo" value="<?php echo $unit_no; ?>" required>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">My Home</option>
										</select>
									</td>
								</tr>
								<tr>
									<th class="text-uppercase ">
										<a href="#electric" data-toggle="collapse" class="toggle-bill">Electric Bill Total: </a>
									</th>
									<td id="electricTotal"><?php echo "PHP " . number_format($electricTotal,2);?></td>
								</tr>
								<tr class="collapse" id="electric">
									<th>
										<li class="child-bill" id = "etad">Total Amount Due: </li>
										<li class="child-bill" id = "tk">Total kWh: </li>
										<li class="child-bill">Current Reading: </li>
										<li class="child-bill" id = "pk">Prev Reading: </li>
									</th>
									<td>
										<li class="child-bill" id = "etadi"> <?php echo "PHP " . number_format($eTotalAmountDue,2); ?></li>
										<li class="child-bill" id = "tki"> <?php echo $totalkwh; ?></li>
										<li class="child-bill"> <?php echo $unitkwh; ?></li>
										<li class="child-bill" id = "pki"> <?php echo $prevkwh; ?></li>
									</td>
								</tr>
								<tr>
									<th class="text-uppercase ">
										<a href="#water" data-toggle="collapse" class="toggle-bill">Water Bill Total:</a>
									</th>
									<td class="" id="waterTotal"><?php echo "PHP " . number_format($waterTotal,2);?></td>
								</tr>
								<tr class="collapse" id="water">
									<th>
										<li class="child-bill" id = "wtad">Total Amount Due: </li>
										<li class="child-bill" id = "tm">Total m3: </li>
										<li class="child-bill">Current Reading: </li>
										<li class="child-bill" id = "pm">Prev Reading: </li>
									</th>
									<td>
										<li class="child-bill" id = "wtadi"> <?php echo "PHP " . number_format($wTotalAmountDue,2); ?></li>
										<li class="child-bill" id = "tmi"> <?php echo $totalm3; ?></li>
										<li class="child-bill"> <?php echo $unitm3; ?></li>
										<li class="child-bill" id = "rmi"> <?php echo $prevm3; ?></li>
									</td>
								</tr>
								<tr>
									<th class="text-uppercase"><a href="#rental" data-toggle="collapse" class="toggle-bill">Rental Bill:</a></th>
									<td class="" id="rentalFee"><?php echo "PHP " . number_format($rentalTotal,2);?></td>
								</tr>
								<tr class="collapse" id="rental">
									<th>
										<li class="child-bill">1 Month Rental: </li>
									</th>
									<td>
										<li class="child-bill"><?php echo "PHP " . number_format($rentalTotal,2); ?></li>
									</td>
								</tr>
								<tr>
									<th class="text-uppercase emphasize">TOTAL:</th>
									<td class="emphasize" id="totalBill"><?php echo "PHP " . number_format($totalBill,2);?></td>
								</tr>
								<tr>
									<th class="text-uppercase">Notes: </th>
									<td>
										<textarea class="form-control" name="notes" cols="20" rows="3"><?php echo $notes ; ?></textarea>
									</td>
								</tr>
								<tr>
									<th class="text-uppercase" id="dueDate">Due Date:</th>
									<td class=""><input class="form-control" type="date" name="dueDate" value="<?php echo $dueDate; ?>" required></td>
								</tr>
							</tbody>
						</table>
						<div class="col-lg-12 col-xs-12">
							<div class="form-group pull-right">
							<?php if ($edit_bill_state == false): ?>
								<input type="submit" name="billSaveBtn" value="Post" class="btn btn-mint">
							<?php else : ?>
								<input type="submit" name="billUpdateBtn" value="Update" class="btn btn-mint">
							<?php endif; ?>
								<input type="reset" name="clearBtn" value="Clear" class="btn btn-danger">
							</div>
							<a href="pdf/receipt.php?printLastSaved" class="hyperlinks" title="Print last created invoice"><span class="glyphicon glyphicon-print"></span> Print</a>
							
						</div><br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">

	function activateElec(){
		if(document.getElementById('electricCheckBox').checked == true){
			document.getElementById('eTotalAmountDue').disabled = false;
			document.getElementById('totalkwh').disabled = false;
			document.getElementById('unitkwh').disabled = false;
		}
		else{
			document.getElementById('eTotalAmountDue').disabled = true;
			document.getElementById('totalkwh').disabled = true;
			document.getElementById('unitkwh').disabled = true;
		}
			
	}

	function activateWater(){
		if(document.getElementById('waterCheckBox').checked == true){
			document.getElementById('wTotalAmountDue').disabled = false;
			document.getElementById('totalm3').disabled = false;
			document.getElementById('unitm3').disabled = false;
		}
		else{
			document.getElementById('wTotalAmountDue').disabled = true;
			document.getElementById('totalm3').disabled = true;
			document.getElementById('unitm3').disabled = true;
		}
			
	}

	function activateRental(){
		if(document.getElementById('rentalCheckBox').checked == true){
			document.getElementById('monthsOfRental').disabled = false;
		}
		else{
			document.getElementById('monthsOfRental').disabled = true;
		}
			
	}

	function changeDueDateLabel(){
		var etad = document.getElementById('eTotalAmountDue').value;
		var tk = document.getElementById('totalkwh').value;
		var uk = document.getElementById('unitkwh').value;
		var wtad = document.getElementById('wTotalAmountDue').value;
		var tm = document.getElementById('totalm3').value;
		var um = document.getElementById('unitm3').value;
		var nm = document.getElementById('monthsOfRental').value;
		if (etad == "" && tk == "" && uk != "" && wtad == "" && tm == "" && um != "" || nm != '') {
			document.getElementById('dueDate').innerHTML = "Meter Reading Date: ";
			document.getElementById('etad').style.display = "none";
			document.getElementById('tk').style.display = "none";
			document.getElementById('pk').style.display = "none";
			document.getElementById('wtad').style.display = "none";
			document.getElementById('tm').style.display = "none";
			document.getElementById('pm').style.display = "none";
			document.getElementById('etadi').style.display = "none";
			document.getElementById('tki').style.display = "none";
			document.getElementById('pki').style.display = "none";
			document.getElementById('wtadi').style.display = "none";
			document.getElementById('tmi').style.display = "none";
			document.getElementById('pmi').style.display = "none";
		}
		else{
			document.getElementById('dueDate').innerHTML = "Due Date: ";
		}
	}
</script>

</body>
</html>