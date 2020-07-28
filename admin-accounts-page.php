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
include 'account-process.php';
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
	<link rel="stylesheet" type="text/css" href="css/records.css">
	<title>Accounts</title>
	<style type="text/css">
		.required{
			color: #B00;
			font-size: 16px;
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
			<li><a class="active" href="admin-accounts-page.php"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
			<li><a href="bill.php"><span class="glyphicon glyphicon-credit-card"></span> Billing</a></li>
			<li><a href="records-page.php"><span class="glyphicon glyphicon-file"></span>Records</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="">Welcome <?php echo $logged_account;?></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</div>
<div class="container-fluid">
	<div class="container">
		<div class="row">
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
			<ul class="menu panel-menu">
				<li><a href="" data-target="#modalForm" data-toggle="modal" role="button"><span class="glyphicon glyphicon-plus"></span> Add Account</a></li>
			</ul>
			<br>
			<div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12 border-mint" id="table">
				<h3 class="title text-center">ACCOUNTS</h3>
				<table class="table table-hover text-center" width="100%">
					<tr>
						<th class="text-center">No.</th>
						<th class="text-center">Name</th>
						<th class="text-center">Contact No.</th>
						<th class="text-center">Role</th>
						<th class="text-center">Unit No.</th>
						<th class="text-center"><span class="glyphicon glyphicon-option-horizontal"></span></th>
					</tr>
					<?php 
					$count = 1;
					while ($row=mysqli_fetch_assoc($selectAccountInfo)) { ?>
					<tr>
						<td><?php echo $count;?></td>
						<td><?php echo $row['firstname'] ." ". $row['lastname'];?></td>
						<td><?php echo $row['contact_no'];?></td>
						<td><?php echo $row['role'];?></td>
						<td><?php echo $row['unit_no'];?></td>
						<td id="<?php echo $row['id'];?>">
							<a type="button" class="btn btn-dark" href="profile-page.php?viewAccount=<?php echo $row['id'];?>"><span class="glyphicon glyphicon-eye-open"></span></a>
							<button class="btn btn-danger modalDelAccntBtn"><span class="glyphicon glyphicon-trash"></span></button>
						</td>
					</tr>
				<?php $count++ ;} ?>
				</table>
			</div>
		</div>
	</div>
</div>
<!----------------------------------- Modal Add -------------------------------->
<div class="modal fade" id="modalForm">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title text-uppercase">Add Account</h3>
			</div>
			<form action="admin-accounts-page.php" method="POST">
				<div class="modal-body">
					<h3>Personal Information</h3>
					<div class="form-group">
						<label class="control-label" for="firstname">Firstname:</label><span class="required"> *</span>
						<input class="form-control" type="text" name="firstname" id="firstname" placeholder = "ex. Juan" maxlength = "50" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="lastname">Lastname:</label><span class="required"> *</span>
						<input class="form-control" type="text" name="lastname" id="lastname" placeholder = "ex. Dela Cruz" maxlength = "50" required>
					</div>
					<div class="form-group col-lg-6 col-xs-6">
						<label class="control-label" for="gender">Gender:</label><span class="required"> *</span><br>
						<input type="radio" name="gender" id="gender" value="Male" required><label> Male</label>
						<input type="radio" name="gender" id="gender" value="Female"><label> Female</label>
					</div>
					<div class="form-group col-lg-6 col-xs-6">
						<label class="control-label" for="bday">Birthday:</label>
						<input class="form-control" type="date" name="bday" id="bday">
					</div>
					<div class="form-group">
						<label class="control-label" for="hometown">Hometown:</label>
						<input class="form-control" type="text" name="hometown" id="hometown" placeholder = "ex. Lipa, Batangas" maxlength = "250">
					</div>
					<div class="form-group">
						<label class="control-label" for="cpNumber">Cellphone Number:</label><span class="required"> *</span>
						<input class="form-control" type="text" name="cpNumber" id="cpNumber" placeholder = "ex. 09151112222" maxlength = "11" pattern="[0]{1}[9]{1}[0-9]{9}" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="work">Work:</label>
						<input class="form-control" type="text" name="work" id="work" placeholder = "ex. ER Nurse" maxlength = "250">
					</div>
					<div class="form-group">
						<label class="control-label" for="workplace">Workplace:</label>
						<input class="form-control" type="text" name="workplace" id="workplace" placeholder = "ex. The Medical City" maxlength = "250">
					</div>
					<hr>
					<h3>Account</h3>
					<div class="form-group">
						<label class="control-label" for="username">Username:</label><span class="required"> *</span>
						<input class="form-control" type="text" name="username" id="username" placeholder = "ex. juan.delacruz" maxlength = "150" pattern=".{4,}" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="email">Email:</label><span class="required"> *</span>
						<input class="form-control" type="email" name="email" id="email" placeholder = "ex. juan.delacruz@gmail.com" maxlength = "150" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="password">Password:</label><span class="required"> *</span>
						<input class="form-control" id="password1" type="password" name="password" placeholder = "Min of 8 characters" maxlength = "150" pattern=".{8,}" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="cPassword">Confirm Password:</label><span class="required"> *</span>
						<input class="form-control" id="password2" type="password" name="cPassword" placeholder = "Min of 8 characters" maxlength = "150" pattern=".{8,}" onkeyup="matchPassword()" required>
					</div>
					<div class="form-group">
						<label for="role ">Role:</label><span class="required"> *</span><br>
						<div class="form-group col-lg-6 col-xs-6">
							<input id="radioAdmin" type="radio" name="role" value="admin" onclick="adminRadioBtn()" required><label> Admin</label>
							<input class="form-control" id="inPincode" type="password" name="pincode" placeholder = "Pincode: ####" maxlength = "4" onkeyup="matchPin()" title="Hint: Lola Rosa's Bday (mmdd)">
						</div>
						<div class="form-group col-lg-6 col-xs-6">
							<input id="radioTenant" type="radio" name="role" value="tenant" onclick="tenantRadioBtn()"><label> Tenant</label>
							<select class="form-control" id="inUnitNo" name="unitNo">
								<option value="disable select hidden">Unit No. --</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
							</select>
						</div>
					</div>
					<hr>
					<h3>Emergency Contact</h3>
					<div class="form-group">
						<label class="control-label" for="eName">Name:</label><span class="required"> *</span>
						<input class="form-control" type="text" name="eName" id="eName" placeholder = "ex. Juanita Dela Cruz" maxlength = "150" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="eCpNumber">Cellphone Number:</label><span class="required"> *</span>
						<input class="form-control" type="text" name="eCpNumber" id="eCpNumber" placeholder = "ex. 09151112222" maxlength = "11" pattern="[0]{1}[9]{1}[0-9]{9}" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="relationship">Relationship:</label><span class="required"> *</span>
						<input class="form-control" type="text" name="relationship" id="relationship" placeholder = "ex. Mother" maxlength = "50" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-danger" >Clear</button>
				<?php if ($edit_state == false): ?>
					<button type="submit" name="registerBtn" class="btn btn-mint" >Create New Account</button>
				<?php else: ?>
					<button type="submit" name="accntUpdateBtn" class="btn btn-mint">Update Account</button>
				<?php endif ?>
				</div>
			</form>
		</div>
	</div>
	
</div>

</div>

<!----------------------------------- Modal Delete -------------------------------->
<div class="modal fade" id="modalDelAccnt" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="admin-accounts-page.php" method="POST">
				<div class="modal-header">
					<button role="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h3 class="modal-title" id="exampleModalLabel">Delete Account</h3>
				</div>
				<div class="modal-body">
					<input type="hidden" name="delete_id" id="delete_id">
					<p>Are you sure you want to delete this account?</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button"data-dismiss="modal">No</button>
					<button class="btn btn-mint" type="submit" name="deleteAccount">Yes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">

	function adminRadioBtn(){
		var adminVal = document.getElementById("radioAdmin").value;
		if (adminVal == 'admin') {
			document.getElementById("inUnitNo").disabled = true;
			document.getElementById("inPincode").disabled = false;
		}
	}

	function tenantRadioBtn(){
		var tenantVal = document.getElementById("radioTenant").value;
		if (tenantVal == 'tenant') {
			document.getElementById("inUnitNo").disabled = false;
			document.getElementById("inPincode").disabled = true;
		}
	}
	function matchPassword(){
		var pass1 = document.getElementById('password1').value;
		var pass2 = document.getElementById('password2').value;
		
		if(pass1 == pass2){
			document.getElementById('password1').style.background = '#cce8cc';
			document.getElementById('password2').style.background = '#cce8cc';
		}
		else{
			document.getElementById('password1').style.background = '#f2cccb';
			document.getElementById('password2').style.background = '#f2cccb';
		}
	}
	function matchPin(){
		var pincode = document.getElementById('inPincode').value;
		
		if(pincode == '0624'){
			document.getElementById('inPincode').style.background = '#cce8cc';
		}else{
			document.getElementById('inPincode').style.background = '#f2cccb';
		}
	}

	$(document).ready(function(){
		$('.modalDelAccntBtn').on('click', function(){
			$('#modalDelAccnt').modal('show');
			
			$tr = $(this).closest('tr')
			var data = $tr.children("td").map(function(){
				return $(this).attr("id");
			}).get();

			console.log(data);	
			$('#delete_id').val(data[0]);
		});
	});
</script>

</body>
</html>