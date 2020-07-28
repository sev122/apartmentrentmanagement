<?php 

$artImg = $artTitle = $artLink = $artBody = "";
$id = 0;
$edit_state = false;

if(isset($_POST['artSaveBtn'])){
	$artImg = time() . "_" . $_FILES['articleImg']['name'];
	$artTitle = mysqli_real_escape_string($connect, $_POST['articleTitle']);
	$artLink = mysqli_real_escape_string($connect, $_POST['articleLink']);
	$artBody = mysqli_real_escape_string($connect, $_POST['articleBody']);

	$storeImg = 'webcontents/' . $artImg;
	move_uploaded_file($_FILES['articleImg']['tmp_name'], $storeImg);
	$saveArticle = "INSERT INTO webcontents (artTitle, artLink, artBody, artImgs) VALUES ('$artTitle', '$artLink', '$artBody', '$artImg')";
	if (mysqli_query($connect, $saveArticle)) {
		header("refresh:0.5,url=edit-dashboard-page.php");
		$_SESSION['alert_success'] = "Article has been uploaded!";
	}
	else{
		$_SESSION['alert_danger'] = "Can't upload article to database!";
	}
}

$selectLast3Art = mysqli_query($connect, "SELECT * FROM webcontents ORDER BY id desc LIMIT 2");
$selectArt = mysqli_query($connect, "SELECT * FROM webcontents /*ORDER BY id LIMIT 3*/");

if (isset($_POST['artUpdateBtn'])) {
	$artImg = time() . "_" . $_FILES['articleImg']['name'];
	$artTitle = mysqli_real_escape_string($connect, $_POST['articleTitle']);
	$artLink = mysqli_real_escape_string($connect, $_POST['articleLink']);
	$artBody = mysqli_real_escape_string($connect, $_POST['articleBody']);

	$storeImg = 'webcontents/' . $artImg;
	move_uploaded_file($_FILES['articleImg']['tmp_name'], $storeImg);
	$id = $_POST['id'];
	
	$updateArticle = "UPDATE webcontents SET artTitle = '$artTitle', artLink = '$artLink', artBody = '$artBody', artImgs = '$artImg' WHERE id = $id";
		
	if (mysqli_query($connect, $updateArticle)) {
		header("refresh:0.5,url=edit-dashboard-page.php");
		$_SESSION['alert_success'] = "Article has been changed successfully!";
	}
	else{
		$_SESSION['alert_danger'] = "Updating failed!";
	}
}

if (isset($_GET['editArticle'])) {
	$id=$_GET['editArticle'];
	$edit_state = true;
	$selectArticleById = mysqli_query($connect,"SELECT * FROM webcontents WHERE id=$id");
	$getRecord = mysqli_fetch_array($selectArticleById);
	$id = $getRecord['id'];
	$artImg = $getRecord['artImgs'];
	$artTitle = $getRecord['artTitle'];
	$artLink = $getRecord['artLink'];
	$artBody = $getRecord['artBody'];
}

if (isset($_GET['viewArticle'])) {
	$id=$_GET['viewArticle'];
	$selectArticleById = mysqli_query($connect,"SELECT * FROM webcontents WHERE id=$id");
	$getRecord = mysqli_fetch_array($selectArticleById);
	$id = $getRecord['id'];
	$artImg = $getRecord['artImgs'];
	$artTitle = $getRecord['artTitle'];
	$artLink = $getRecord['artLink'];
	$artBody = $getRecord['artBody'];
	$date_uploaded = $getRecord['date_uploaded'];
}

if (isset($_POST['deleteArticle'])) {
	$id=$_POST['delete_id'];
	if (mysqli_query($connect,"DELETE FROM webcontents WHERE id=$id")) {
		header("refresh:0.5s, url=edit-dashboard-page.php");
		$_SESSION['alert_success'] = "Article has been deleted successfully!";
	}
	else{
		header("refresh:0.5s, url=edit-dashboard-page.php");
		$_SESSION['alert_danger'] = "Deleting article failed!";
	}
}

?>