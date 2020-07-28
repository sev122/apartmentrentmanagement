<?php 
session_start();
/*if (session_destroy()) {
		header("Location: index.php");
}*/
if (!isset($_SESSION['username'])) {
	header("Location: index.php");
} else {
	session_destroy();
	session_unset();
	header("Location: index.php");
}
 ?>