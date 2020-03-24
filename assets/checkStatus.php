<?php
session_start();
include_once("dbConnection.php");
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start(), be careful.
// Initialize some vars
$user_ok = false;
$joolsman_ok = false;
$log_id = "";
$log_ph = "";
$log_p = "";

// User Verify function
function evalLoggedUser($db_conx,$id,$ph,$p){
	$sql = "SELECT ip FROM clients WHERE id='$id' AND phone='$ph' AND password='$p' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
    $numrows = mysqli_num_rows($query);
	if($numrows > 0){
	    return true;
	}
}

if(isset($_SESSION["id"]) && isset($_SESSION["ph"]) && isset($_SESSION["p"])) {
	$log_id = preg_replace('#[^0-9]#', '', $_SESSION['id']);
	$log_ph = preg_replace('#[^a-z0-9@._-]#i', '', $_SESSION['ph']);
	$log_p = preg_replace('#[^a-z0-9]#i', '', $_SESSION['p']);
	// Verify the user
	$user_ok = evalLoggedUser($db_conx,$log_id,$log_ph,$log_p);
} else if(isset($_COOKIE["id"]) && isset($_COOKIE["ph"]) && isset($_COOKIE["p"])){
	$_SESSION['id'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
    $_SESSION['ph'] = preg_replace('#[^a-z0-9@._-]#i', '', $_COOKIE['ph']);
    $_SESSION['p'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['p']);
	$log_id = $_SESSION['id'];
	$log_ph = $_SESSION['ph'];
	$log_p = $_SESSION['p'];
	// Verify the user
	$user_ok = evalLoggedUser($db_conx,$log_id,$log_ph,$log_p);
	if($user_ok == true){
		// Update their lastlogin datetime field
		$sql = "UPDATE clients SET lastlogin=now() WHERE id='$log_id' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
    }
}

?>