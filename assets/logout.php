<?php
session_start();
// Set Session data to an empty array
$_SESSION = array();
// Expire their cookie files
if(isset($_COOKIE["id"]) && isset($_COOKIE["ph"]) && isset($_COOKIE["p"])) {
	setcookie("id", '', strtotime( '-5 days' ), '/');
    setcookie("ph", '', strtotime( '-5 days' ), '/');
	setcookie("p", '', strtotime( '-5 days' ), '/');
}
// Destroy the session variables
session_destroy();
// Double check to see if their sessions exists
if(!isset($_SESSION['ud'])){
	header("location: ../index.php");
} else {
	echo "an error occured, try again";
	exit();
} 
?>