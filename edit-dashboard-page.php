<?php 
include 'database.php';
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == 'admin') {
		$logged_account = $_SESSION['username'];
	}
	else{
		header("Location: tenant-dashboard.php");
	}
}
else{
	header("Location: index.php");
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
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Pacifico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/design.css">
	<link rel="stylesheet" type="text/css" href="css/records.css">
	<title>Edit Dashboard</title>
</head>
<body>

<div class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" id="websiteName" href="admin-dashboard-page.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px">EllApartment</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a class="active" href="admin-dashboard-page.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
			<li><a href="admin-accounts-page.php"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
			<li><a href="bill.php"><span class="glyphicon glyphicon-credit-card"></span> Billing</a></li>
			<li><a href="records-page.php"><span class="glyphicon glyphicon-file"></span>Records</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="">Welcome <?php echo $logged_account;?></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div class="container-fluid">
				<legend id="pages"><a class="hyperlinks" href="admin-dashboard-page.php"> Dashboard</a> <span class="glyphicon glyphicon-chevron-right"></span><a class="hyperlinks" href="edit-dashboard-page.php"> Edit Dashboard</a></legend>
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
			</div>
			<ul class="menu panel-menu">
				<li><a href="#articleForm" role="button"><span class="glyphicon glyphicon-plus"></span> Add Article</a></li>
			</ul>
			<br><br>
			<div class="container border-mint">
				<div class="row">
					<h3 class="title text-center">ARTICLES</h3><hr>
					<?php while ($row = mysqli_fetch_assoc($selectArt)) { ?>
					<div class="col-lg-4 col-xs-12 ">
						<div class="thumbnail">
							<img style="height: 200px;" src="webcontents/<?php echo $row['artImgs']; ?>">
							<div class="caption">
								<h3 class="title">
									<?php 
									if (strlen($row['artTitle'])> 30) {
										echo substr($row['artTitle'], 0, 30)."...";
									}
									else{
										echo $row['artTitle'];
									}
									?> </h3>
								<h5><?php echo substr($row['artBody'], 0,70) ;?>...</h5>
								<div class="btn-group">
									<a class="btn btn-dark" href="article-page.php?viewArticle=<?php echo $row['id'];?>"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a class="btn btn-mint" href="edit-dashboard-page.php?editArticle=<?php echo $row['id']; ?>#articleForm"><span class="glyphicon glyphicon-edit"></span></a>
									<button class="btn btn-danger modalDelArtBtn" id="<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span></button>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<br>
			<div class="container border-dark">
				<div class="row">
					<div class="col-lg-12 col-xs-12" id="articleForm">
						<h3 class="title text-center">EDIT</h3><hr>
						<form action="edit-dashboard-page.php" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-4 col-xs-12">
									<div class="form-group thumbnail">
										<input type="hidden" name="id" value="<?php echo $id; ?>">
										<label class="control-label" for="articleImg">Image: </label>
										<input type="file" name="articleImg" accept="image/png image/jpeg" value="<?php echo $artImg; ?>" required>
									</div>
								</div>
								<div class="col-lg-4 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="articleTitle">Title: </label>
										<input class="form-control" type="text" name="articleTitle" value="<?php echo $artTitle; ?>" required>
									</div>
								</div>
								<div class="col-lg-4 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="articleLink">Link: </label>
										<input class="form-control" type="url" name="articleLink" value="<?php echo $artLink; ?>" required>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="articleBody">Body: </label><br>
										<textarea class="form-control" name="articleBody" cols="158" rows="20" required><?php echo $artBody; ?></textarea>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12">
									<div class="form-group pull-right">
										<?php if ($edit_state == false): ?>
										<input type="submit" name="artSaveBtn" value="Save" class="btn btn-mint">
										<?php else: ?>
										<input type="submit" name="artUpdateBtn" value="Update" class="btn btn-mint">
										<?php endif ?>
										<input type="reset" name="artResetBtn" value="Clear" class="btn btn-danger">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modalDelArt" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="edit-dashboard-page.php" method="POST">
				<div class="modal-header">
					<button role="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h3 class="modal-title" id="exampleModalLabel">Delete Article</h3>
				</div>
				<div class="modal-body">
					<input type="hidden" name="delete_id" id="delete_id">
					<p>Are you sure you want to delete this article?</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button"data-dismiss="modal">No</button>
					<button class="btn btn-mint" type="submit" name="deleteArticle">Yes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('.modalDelArtBtn').on('click', function(){
			$('#modalDelArt').modal('show');
			
			$div = $(this).closest('div');
			var data = $div.children(".modalDelArtBtn").map(function(){
				return $(this).attr("id");
			}).get();

			console.log(data);
			$('#delete_id').val(data[0]);
		});
	});

</script>

</body>
</html>