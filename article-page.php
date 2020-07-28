<?php 
include 'database.php';
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'tenant' ) {
		$logged_account = $_SESSION['username'];
	}
	else{
		header("Location: login.php");
	}
}
else{
	header("Location: login.php");
}
include 'edit-dashboard-process.php';
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
	<title><?php echo $artTitle; ?></title>
	<style type="text/css">
		.border-top-none{
			border-top: none;
		}
		.article-link{
			color: black;
		}
		.article-date{
			font-family: arial, Helvetica, sans-serif
		}
		.article-body{
		  white-space: pre-wrap;font-size: 16px;
		}
		@media only screen and (max-width: 600px) {
			.article-headline{
				font-size: 2em;
			}
			table, tbody, th, td, tr { 
				display: block;

			}
			
		}
	</style>
</head>
<body>

<div class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" id="websiteName" href="index.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px">EllApartment</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a class="active" href=""><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
			<li><a href="admin-accounts-page.php" id="accounts"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
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
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="container-fluid">
				<legend id="pages"><a class="hyperlinks" href="admin-dashboard-page.php"> Dashboard</a> <span class="glyphicon glyphicon-chevron-right"></span><a class="hyperlinks" href="edit-dashboard-page.php" id="hideEdit"> Edit Dashboard</a><span class="glyphicon glyphicon-chevron-right" id="hideArrow"></span><a class="hyperlinks" href="article-page.php?viewArticle=<?php echo $id;?>"> <?php echo $artTitle;?></a></legend>
			</div>
			<div class="container">
				<div class="row">
					<article >
						<div class="col-lg-5 col-xs-12">
							<a href="webcontents/<?php echo $artImg;?>"><img id="artImg" class="thumbnail img-responsive" src="webcontents/<?php echo $artImg;?>"></a>
						</div>
						<div class="col-lg-7 col-xs-12">
							<table class="table">
								<tr>
									<th colspan="2" style="border-top:none;">
										<h1 class="title text-uppercase article-headline"><?php echo $artTitle;?></h1><br>
									</th>
								</tr>
								<tr>
									<th>Posted on: </th>
									<td><p><?php echo $date_uploaded;?></p></td>
								</tr>
								<tr>
									<th>Reference: </th>
									<td><a href="<?php echo $artLink;?>"><?php echo substr($artLink, 0,45) ."...";?></a></p></td>
								</tr>
							</table>
						</div>
						<div class="col-lg-12 col-xs-12">
							<hr>
							<p class="article-body"><?php echo $artBody;?></p>
							<br>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	 window.onload = function hide_content(){
	 	if (<?php echo $_SESSION['role'] == 'tenant'; ?>) {
	 		document.getElementById('hideEdit').style.display = 'none';
	 		document.getElementById('hideArrow').style.display = 'none';
	 		document.getElementById('hideRecords').style.display = 'none';
			document.getElementById('hideRecords').href = '';
			document.getElementById('accounts').innerHTML = '<span class ="glyphicon glyphicon-user"></span> Profile';
			document.getElementById('accounts').href = 'profile-page.php?viewAccount=<?php echo $_SESSION['user_id'];  ?>';
			document.getElementById('bill').innerHTML = '<span class ="glyphicon glyphicon-credit-card"></span> Bills';
			document.getElementById('bill').href = 'account-page.php?tenantBills=<?php echo $_SESSION['unit_no'];  ?>';

	 	}
			
	}
</script>

</body>
</html>