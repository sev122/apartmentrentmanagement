<?php
include 'database.php';
session_start();
if (isset($_POST['loginBtn'])) {
	$loginUserEmail = $_POST['useremail'];
	$loginPass = $_POST['loginPass'];

	$selectEmailUserPass = "SELECT * FROM accounts WHERE (email = '$loginUserEmail' OR username = '$loginUserEmail') AND password = '$loginPass'";
	$result = mysqli_query($connect, $selectEmailUserPass);
	if($row = mysqli_fetch_assoc($result)){
		if ($row['role'] == 'admin') {
			$_SESSION['username'] = $row['username'];
			$_SESSION['role'] = 'admin';
			header("Location: admin-dashboard-page.php");
		}else{
			$_SESSION['username'] = $row['username'];
			$_SESSION['role'] = 'tenant';
			$_SESSION['unit_no'] = $row['unit_no'];
			header("Location: tenant-dashboard-page.php");
		}
	}else{
		$_SESSION['loginMessage'] = "Incorrect email/username and password";
	}
}

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
	<title>Login</title>
</head>
<body>

<div class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" id="websiteName" href="index.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px">EllApartment</a>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
			<?php if (isset($_SESSION['danger'])):?>
			<div class="danger-box" id="danger">
				<?php
				echo $_SESSION['danger'];
				unset ($_SESSION['danger']);
				?>
			</div>
			<?php endif ?>
			<br>
			<div class="well" id="loginForm">
				<h3 class="text-center title">Log In</h3>
				<form action="login.php" method="POST">
					<div class="input-group">
						<span class="input-group-addon"><span class=" glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" name="useremail" placeholder="Enter Username or Email">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><span class=" glyphicon glyphicon-lock"></span></span>
						<input type="password" class="form-control" name="loginPass" placeholder="Enter Password">
					</div>
					<?php if (isset($_SESSION['loginMessage'])):?>
					<span class="text-danger pull-left" id="loginMessage">
						<?php
						echo $_SESSION['loginMessage'];
						unset ($_SESSION['loginMessage']);
						?>
					</span>
					<?php endif ?>
					<br>
					<br>
					<div class="form-group">
						<input type="submit" name="loginBtn" value="Log in" class="btn btn-mint pull-right">
						<a class="hyperlinks" href="registration-page.php">Create an account</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>