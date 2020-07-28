<?php

$connect = new mysqli("localhost","root","", "ellapartment");

if (!$connect){
	die("Connection failed: ".mysqli_connect_error());
}
?>