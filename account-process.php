<?php 
error_reporting(0);
$id = 0;
$firstname = $lastname = $gender = $bday = $hometown = $cpNumber = $work = $workplace = $username = $email = $password = $cPassword = $role = $pincode = $unit_no = $eName = $eCpNumber = $relationship = "";
$edit_state = false;

if(isset($_POST['registerBtn'])){
	$firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
	$gender = mysqli_real_escape_string($connect, $_POST['gender']);
	$bday = mysqli_real_escape_string($connect, $_POST['bday']);
	$hometown = mysqli_real_escape_string($connect, $_POST['hometown']);
	$cpNumber = mysqli_real_escape_string($connect, $_POST['cpNumber']);
	$work = mysqli_real_escape_string($connect, $_POST['work']);
	$workplace = mysqli_real_escape_string($connect, $_POST['workplace']);

	$username = mysqli_real_escape_string($connect, $_POST['username']);
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$password = mysqli_real_escape_string($connect, $_POST['password']);
	$cPassword = mysqli_real_escape_string($connect, $_POST['cPassword']);
	$role = mysqli_real_escape_string($connect, $_POST['role']);
	$pincode = mysqli_real_escape_string($connect, $_POST['pincode']);
	$unit_no = mysqli_real_escape_string($connect, $_POST['unitNo']);

	$eName = mysqli_real_escape_string($connect, $_POST['eName']);
	$eCpNumber = mysqli_real_escape_string($connect, $_POST['eCpNumber']);
	$relationship = mysqli_real_escape_string($connect, $_POST['relationship']);

	$selectEmailAndUser = "SELECT * FROM accounts WHERE (email = '$email' OR username = '$username')/**/";
	$existingEmailAndUser = mysqli_query($connect, $selectEmailAndUser);
	if (mysqli_num_rows($existingEmailAndUser) > 0) {
		$_SESSION['alert_danger'] = "Email/Username already taken";
	}
	else{
		if($password == $cPassword){

			if ($pincode == '0624') {
				$regForm = "INSERT INTO accounts (firstname, lastname, gender, bday, hometown, contact_no, work, workplace, username, email, password, role, unit_no, eName, eContact, relationship/**/) VALUES ('$firstname', '$lastname', '$gender', '$bday', '$hometown', '$cpNumber', '$work', '$workplace', '$username', '$email', '$password', '$role', '$unit_no', '$eName', '$eCpNumber', '$relationship'/**/)";
				mysqli_query($connect, $regForm);
				$_SESSION['alert_success']="Account created successfully";
				header('refresh: 0.5s, url=admin-accounts-page.php');
				
			}

			elseif ($pincode != '0624') {
				for ($i=0; $i <= 6 ; $i++) { 
					if ($unit_no == $i) {
						$selectUnitNo = "SELECT * FROM accounts WHERE unit_no = '$unit_no'/**/";
						$existingUnitNo = mysqli_query($connect, $selectUnitNo);
						if (mysqli_num_rows($existingUnitNo) > 0) {
							$_SESSION['alert_danger'] = "Unit ". $unit_no . " is occupied!";
						}
						else{
							$regForm = "INSERT INTO accounts (firstname, lastname, gender, bday, hometown, contact_no, work, workplace, username, email, password, role, unit_no, eName, eContact, relationship/**/) VALUES ('$firstname', '$lastname', '$gender', '$bday', '$hometown', '$cpNumber', '$work', '$workplace', '$username', '$email', '$password', '$role', '$unit_no', '$eName', '$eCpNumber', '$relationship'/**/)";
							mysqli_query($connect, $regForm);
							$_SESSION['alert_success']="Account created successfully";
							header('refresh: 0.5s, url=admin-accounts-page.php');
						}
					}
				}
			}

			else {
				$_SESSION['alert_danger']="Wrong PIN/Unit No.";
			}
		}

		else{
			$_SESSION['alert_danger']="Password do not match";
		}
	}	
}

if (isset($_POST['accntUpdateBtn'])) {
	$firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
	$gender = mysqli_real_escape_string($connect, $_POST['gender']);
	$bday = mysqli_real_escape_string($connect, $_POST['bday']);
	$hometown = mysqli_real_escape_string($connect, $_POST['hometown']);
	$cpNumber = mysqli_real_escape_string($connect, $_POST['cpNumber']);
	$work = mysqli_real_escape_string($connect, $_POST['work']);
	$workplace = mysqli_real_escape_string($connect, $_POST['workplace']);


	$username = mysqli_real_escape_string($connect, $_POST['username']);
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$password = mysqli_real_escape_string($connect, $_POST['password']);
	$role = mysqli_real_escape_string($connect, $_POST['role']);
	$unit_no = mysqli_real_escape_string($connect, $_POST['unitNo']);


	$eName = mysqli_real_escape_string($connect, $_POST['eName']);
	$eCpNumber = mysqli_real_escape_string($connect, $_POST['eCpNumber']);
	$relationship = mysqli_real_escape_string($connect, $_POST['relationship']);

	$id = $_POST['id'];
	$updateInfo = "UPDATE accounts SET firstname = '$firstname', lastname = '$lastname', gender = '$gender', bday = '$bday', hometown = '$hometown', contact_no = '$cpNumber', work = '$work', workplace = '$workplace', username = '$username', email = '$email', password = '$password', role = '$role', unit_no = '$unit_no', eName = '$eName', eContact = '$eCpNumber', relationship = '$relationship' /**/ WHERE id = $id";
	if(mysqli_query($connect, $updateInfo)){
		header("refresh:0.5s, url = admin-accounts-page.php");
		$_SESSION['alert_success'] = "Profile informartion has been changed successfully!";
	}
	else{
		header("refresh:0.5s, url = admin-accounts-page.php");
		$_SESSION['alert_danger'] = "Updating profile information failed!";
	}
}

$selectAccountInfo = mysqli_query($connect, "SELECT * FROM accounts");

if (isset($_GET['editAccount'])) {
	$id=$_GET['id'];
	$edit_state = true;
	$selectAccountInfoById = mysqli_query($connect,"SELECT * FROM accounts WHERE id=$id");
	$getRecord = mysqli_fetch_array($selectAccountInfoById);
	$id = $getRecord['id'];
	$firstname = $getRecord['firstname'];
	$lastname = $getRecord['lastname'];
	$gender = $getRecord['gender'];
	$bday = $getRecord['bday'];
	$hometown = $getRecord['hometown'];
	$cpNumber = $getRecord['contact_no'];
	$work = $getRecord['work'];
	$workplace = $getRecord['workplace'];

	$username = $getRecord['username'];
	$email = $getRecord['email'];
	$password = $getRecord['password'];
	$role = $getRecord['role'];
	$unit_no = $getRecord['unit_no'];

	$eName = $getRecord['eName'];
	$eCpNumber = $getRecord['eContact'];
	$relationship = $getRecord['relationship'];

}

if (isset($_GET['viewAccount'])) {
	$id=$_GET['viewAccount'];
	$selectAccountInfoById = mysqli_query($connect,"SELECT * FROM accounts WHERE id=$id");
	$getRecord = mysqli_fetch_array($selectAccountInfoById);
	$id = $getRecord['id'];
	$firstname = $getRecord['firstname'];
	$lastname = $getRecord['lastname'];
	$gender = $getRecord['gender'];
	$bday = $getRecord['bday'];
	$hometown = $getRecord['hometown'];
	$cpNumber = $getRecord['contact_no'];
	$work = $getRecord['work'];
	$workplace = $getRecord['workplace'];

	$username = $getRecord['username'];
	$email = $getRecord['email'];
	$password = $getRecord['password'];
	$role = $getRecord['role'];
	$unit_no = $getRecord['unit_no'];

	$eName = $getRecord['eName'];
	$eCpNumber = $getRecord['eContact'];
	$relationship = $getRecord['relationship'];

}

if (isset($_POST['deleteAccount'])) {
	$id=$_POST['delete_id'];
	if (mysqli_query($connect,"DELETE FROM accounts WHERE id=$id")) {
		header("refresh:0.5s, url=admin-accounts-page.php");
		$_SESSION['alert_success'] = "Account has been deleted successfully!";
	}
	else{
		header("refresh:0.5s, url=admin-accounts-page.php");
		$_SESSION['alert_danger'] = "Deleting account failed!";
	}
}
?>