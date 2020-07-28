<?php 
include 'database.php';
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == 'admin') {	
		header("Location: admin-dashboard-page.php");
	}
	if ($_SESSION['role'] == 'tenant') {
		header("Location: tenant-dashboard-page.php");
	}
	else{
		header("Location: login.php");	
	}
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
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Century">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/design.css">
	<title>Dashboard</title>
	<style type="text/css">
		.carousel-caption{
			background-color: rgba(10, 10, 10, 0.5);
			text-shadow: 3px 2px #333;
		}
	</style>
</head>
<body>
<div class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" id="websiteName" href="index.php"><img class="pull-left" id="elogo" src="img/e-logo.png" width="40px" height="40px"> EllApartment</a>
		</div>
		<div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="registration-page.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="carousel slide" id="carouselSlide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselSlide" data-slide-to="0" class="active"></li>
				<?php 
				$getIds = mysqli_query($connect, "SELECT id FROM webcontents ORDER BY id desc LIMIT 2");
				while ($showIds = mysqli_fetch_assoc($getIds)) {
				 ?>
				<li data-target="#carouselSlide" data-slide-to="<?php echo $showIds['id']; ?>"></li>
			<?php } ?>
			</ol>
			<div class="carousel-inner">
				<?php 
					$selectMainArt = mysqli_query($connect,"SELECT * FROM webcontents WHERE artTitle = 'EllApartment'"); 
					$mainArt = mysqli_fetch_assoc($selectMainArt);
					?>
				<div class="item active" id="<?php echo $row['id'] ?>">
					<div class="slide1" style="background-image: url('webcontents/<?php echo $mainArt['artImgs']; ?>');">
						<div class="carousel-caption">
							<h3 class="carousel-caption-header"><?php echo $mainArt['artTitle']; ?></h3>
							<p><a href="#<?php echo $mainArt['id']; ?>" class="btn btn-mint">View</a></p>
						</div>
					</div>
				</div>
				<?php while ($row = mysqli_fetch_assoc($selectLast3Art)) { ?>
				<div class="item">
					<div class="slide2" style="background-image: url('webcontents/<?php echo $row['artImgs']; ?>');">
						<div class="carousel-caption">
							<h3 class="carousel-caption-header"><?php echo $row['artTitle']; ?></h3>
							<p><a href="#<?php echo $row['id'] ?>" class="btn btn-mint">View</a></p>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<a href="#carouselSlide" class="left carousel-control" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
			<a href="#carouselSlide" class="right carousel-control" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
		<div class="navbar">
		</div>
		<div class="container">
			<div class="row">
				<?php while ($row = mysqli_fetch_assoc($selectArt)) { ?>
				<div class="col-lg-4 col-xs-12">
					<div class="thumbnail"  id="<?php echo $row['id'] ?>">
						<a href="webcontents/<?php echo $row['artImgs']; ?>"><img style="height: 200px;" src="webcontents/<?php echo $row['artImgs']; ?>"></a>
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
							<p><?php echo substr($row['artBody'], 0,70) ;?>...</p>
							<p><?php echo $row['date_uploaded']; ?></p>
							<a href="article-page.php?viewArticle=<?php echo $row['id']; ?>" class="btn btn-mint" role="button">Read</a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>