<?php 
include 'database.php';
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'tenant') {
		$logged_account = $_SESSION['username'];
	}
	else{
		header("Location: index.php");
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
	<title><?php echo $firstname . " " . $lastname ;?></title>
	<style type="text/css">
		.bckgrnd-gray{
			background-color: #ddd;
		}
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
			<li><a class="active" href="admin-accounts-page.php" id="accounts"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
			<li><a href="bill.php" id="bill"><span class="glyphicon glyphicon-credit-card"></span> Billing</a></li>
			<li><a href="records-page.php" id="hideRecords"><span class="glyphicon glyphicon-file"></span>Records</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="">Welcome <?php echo $logged_account;?></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</div>
<div class="container">
	<div class="row">
		<legend id="pages"><a class="hyperlinks" href="admin-accounts-page.php" id="accountLink"> Accounts</a> <span class="glyphicon glyphicon-chevron-right"></span><a class="hyperlinks" href="profile-page.php?viewAccount=<?php echo $id;?>"> <?php echo $firstname . " " . $lastname ;?></a></legend>
		<div class="col-lg-12 col-xs-12 table-responsive">
			<h3 class="title text-center">INFORMATION</h3>
			<ul class="menu panel-menu">
				<li><a href="" role="button" data-toggle="modal" data-target="#editAccount"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a></li>
			</ul>
			<div class="modal fade" role="dialog" id="editAccount">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button><h3>Edit Profile</h3>
						</div>
						<form action="profile-page.php" method="POST">
						<div class="modal-body">
							<h3>Personal Information</h3>
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<div class="form-group">
								<label class="control-label" for="firstname">Firstname:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="firstname" value="<?php echo $firstname ;?>" placeholder = "ex. Juan" maxlength = "50" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="lastname">Lastname:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder = "ex. Dela Cruz" maxlength = "50" required>
							</div>
							<div class="form-group col-lg-6 col-xs-6">
								<label class="control-label" for="gender">Gender:</label><span class="required"> *</span><br>
								<input type="radio" name="gender" value="Male" required><label> Male</label>
								<input type="radio" name="gender" value="Female"><label> Female</label>
							</div>
							<div class="form-group col-lg-6 col-xs-6">
								<label class="control-label" for="bday">Birthday:</label>
								<input class="form-control" type="date" name="bday" value="<?php echo $bday; ?>">
							</div>
							<div class="form-group">
								<label class="control-label" for="hometown">Hometown:</label>
								<input class="form-control" type="text" name="hometown" value="<?php echo $hometown; ?>" placeholder = "ex. Lipa, Batangas" maxlength = "250">
							</div>
							<div class="form-group">
								<label class="control-label" for="cpNumber">Cellphone Number:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="cpNumber" value="<?php echo $cpNumber; ?>" placeholder = "ex. 09151112222" maxlength = "11" pattern="[0]{1}[9]{1}[0-9]{9}" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="work">Work:</label>
								<input class="form-control" type="text" name="work" value="<?php echo $work; ?>" placeholder = "ex. ER Nurse" maxlength = "250">
							</div>
							<div class="form-group">
								<label class="control-label" for="workplace">Workplace:</label>
								<input class="form-control" type="text" name="workplace" value="<?php echo $workplace; ?>" placeholder = "ex. The Medical City" maxlength = "250">
							</div>
							<hr>
							<h3>Account</h3>
							<div class="form-group">
								<label class="control-label" for="username">Username:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="username" value="<?php echo $username; ?>" placeholder = "ex. juan.delacruz" maxlength = "150" pattern=".{4,}" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="email">Email:</label><span class="required"> *</span>
								<input class="form-control" type="email" name="email" value="<?php echo $email; ?>" placeholder = "ex. juan.delacruz@gmail.com" maxlength = "150" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="password">Password:</label><span class="required"> *</span>
								<input class="form-control" id="password1" type="password" name="password" value="<?php echo $password; ?>" placeholder = "Min of 8 characters" maxlength = "150" pattern=".{8,}" required>
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
									<select class="form-control" id="inUnitNo" name="unitNo" value="<?php echo $unit_no; ?>">
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
								<input class="form-control" type="text" name="eName" value="<?php echo $eName ;?>" placeholder = "ex. Juanita Dela Cruz" maxlength = "150" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="eCpNumber">Cellphone Number:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="eCpNumber" value="<?php echo $eCpNumber; ?>" placeholder = "ex. 09151112222" maxlength = "11" pattern="[0]{1}[9]{1}[0-9]{9}" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="relationship">Relationship:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="relationship" value="<?php echo $relationship ;?>" placeholder = "ex. Mother" maxlength = "50" required>
							</div>
						</div>
						<div class="modal-footer">
							<input type="submit" name="accntUpdateBtn" value="Update" class="btn btn-mint">
							<input type="reset" name="clearBtn" class="btn btn-danger" value="Clear">	
						</div>
					</form>
					</div>
				</div>
			</div>
			<table class="table table-bordered w-auto">
				<tr><th class="col-lg-12 col-xs-12 text-center bckgrnd-gray" colspan="6"><h5 class="title" >Personal</h5></th></tr>
				<tr>
					<th>First Name:</th>
					<td colspan="2"><?php echo $firstname;?></td>
					<th>Last Name:</th>
					<td colspan="2"><?php echo $lastname;?></td>
				</tr>
				<tr>
					<th>Gender:</th>
					<td colspan="2"><?php echo $gender;?></td>
					<th>Birthday:</th>
					<td colspan="2"><?php echo $bday;?></td>
				</tr>
				<tr>
					<th>Hometown:</th>
					<td colspan="2"><?php echo $hometown;?></td>
					<th>Contact No:</th>
					<td colspan="2"><?php echo $cpNumber;?></td>
				</tr>
				<tr>
					<th>Work:</th>
					<td colspan="2"><?php echo $work;?></td>
					<th>Workplace:</th>
					<td colspan="2"><?php echo $workplace;?></td>
				</tr>
				<tr><th class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center bckgrnd-gray" colspan="6"><h5 class="title" >Account</h5></th></tr>
				<tr>
					<th>Username:</th>
					<td colspan="2"><?php echo $username;?></td>
					<th>Email:</th>
					<td colspan="2"><?php echo $email;?></td>
				</tr>
				<tr>
					<th rowspan="2">Password:</th>
					<td rowspan="2" colspan="2"><?php echo $password;?></td>
					<th>Role:</th>
					<td colspan="2"><?php echo $role;?></td>
				</tr>
				<tr>
					<th>Unit No:</th>
					<td colspan="2"><?php echo $unit_no;?></td>
				</tr>
				<tr><th class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center bckgrnd-gray" colspan="6"><h5 class="title" >Emergency Contact</h5></th></tr>
				<tr>
					<th>Name:</th>
					<td colspan="2"><?php echo $eName;?></td>
					<th>Contact No:</th>
					<td colspan="2"><?php echo $eCpNumber;?></td>
				</tr>
				<tr>
					<th>Relationship:</th>
					<td colspan="4"><?php echo $relationship;?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	 window.onload = function hide_content(){
	 	if (<?php echo $_SESSION['role'] == 'tenant'; ?>) {
	 		document.getElementById('hideRecords').style.display = 'none';
			document.getElementById('hideRecords').href = '';
			document.getElementById('accounts').innerHTML = '<span class ="glyphicon glyphicon-user"></span> Profile';
			document.getElementById('accounts').href = 'profile-page.php?viewAccount=<?php echo $_SESSION['user_id'];  ?>';
			document.getElementById('bill').innerHTML = '<span class ="glyphicon glyphicon-credit-card"></span> Bills';
			document.getElementById('bill').href = 'account-page.php?tenantBills=<?php echo $_SESSION['unit_no'];  ?>';
			document.getElementById('accountLink').href = 'profile-page.php?viewAccount=<?php echo $_SESSION['user_id'];  ?>';
	 	}
			
	}

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
</script>


</body>
</html>