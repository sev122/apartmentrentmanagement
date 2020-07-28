<?php 
include 'database.php';
include 'registration-process.php';
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
	<title>Register</title>
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
			<a class="navbar-brand" id="websiteName" href="index.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px">EllApartment</a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
		</ul>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
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
			<div class="well" id="RegistrationForm">
				<h3 class="text-center title">Register</h3>
				<form action="registration-page.php" method="POST">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="firstname">Firstname:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="firstname" placeholder="ex. Juan" maxlength="50" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="lastname">Lastname:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="lastname" placeholder="ex. Dela Cruz" maxlength="50" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="email">Email:</label><span class="required"> *</span>
								<input class="form-control" type="email" name="email" placeholder="ex. sample@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="150" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="username">Username:</label><span class="required"> *</span>
								<input class="form-control" type="text" name="username" placeholder="ex. JuanDelaCruz" maxlength="150" pattern=".{4,}" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="password">Password:</label><span class="required"> *</span>
								<input class="form-control" id="password1" type="password" name="password" placeholder="Min. of 8 characters" maxlength="50" pattern=".{8,}" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="cPassword">Confirm Password:</label><span class="required"> *</span>
								<input class="form-control"  id="password2" type="password" onkeyup="matchPassword()" name="cPassword" placeholder="Min. of 8 characters" maxlength="50" pattern=".{8,}" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="cpNumber">Cellphone Number:</label><span class="required"> *</span>
								<input class="form-control" type="tel" name="cpNumber" placeholder="ex. 09152221111" maxlength="11" pattern="[0]{1}[9]{1}[0-9]{9}" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label" for="bday">Birthday:</label>
								<input class="form-control" type="date" name="bday">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label">Gender:</label>
								<div class="radio">
									<label for="gender" class="radio"><input type="radio" name="gender" value="male"> Male</label>
								</div>
								<div class="radio">
									<label for="gender" class="radio"><input type="radio" name="gender" value="female"> Female</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label class="control-label">Role:</label><span class="required"> *</span>
							<div class="form-group">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="radio">
										<label for="role" class="radio"><input id="radioAdmin" onclick="adminRadioBtn()" type="radio" name="role" value="admin" required> Admin</label>
									</div>
									<div class="form-group">
										<input class="form-control" id="inPincode" onkeyup="matchPin()" type="password" name="adminPincode" maxlength="4" title="Hint: Lola Rosa's Bday (mmdd)" placeholder="PIN: ####">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="radio">
										<label for="role" class="radio"><input id="radioTenant" onclick="tenantRadioBtn()" type="radio" name="role" value="tenant"> Tenant</label>
									</div>
									<div class="form-group">
										<select class="form-control" id="inUnitNo" name="unitNo">
											<option value="disable selected hidden">Unit No.</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<input type="submit" id="registerBtn" name="registerBtn" class="btn btn-mint" value="Submit">
					<input type="reset" name="clearBtn" class="btn btn-dark" value="Clear">
				</form>
			</div>
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
</script>

</body>
</html>