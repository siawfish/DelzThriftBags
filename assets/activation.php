<?php
if (isset($_GET['ph']) && isset($_GET['p'])) {
	// Connect to database and sanitize incoming $_GET variables
	require_once("dbConnection.php");
	
    $ph = preg_replace('#[^0-9]#i', '', $_GET['ph']);
    $p = mysqli_real_escape_string($db_conx, $_GET['p']);
	
	// Evaluate the lengths of the incoming $_GET variable
	if(strlen($ph) < 10 || !is_numeric($ph) || strlen($p) == ""){
	// Log this issue into a text file and email details to yourself
		header("location: ../errorPage.php?msg=activation string type/length issues");
    	exit(); 
	}
	// Check their credentials against the database
	$sql = "SELECT * FROM clients WHERE phone='$ph' AND password='$p' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	$numrows = mysqli_num_rows($query);
	
	// Evaluate for a match in the system (0 = no match, 1 = match)
	if($numrows == 0){
	// Log this potential hack attempt to text file and email details to yourself
		header("location: ../errorPage.php?msg=Your credentials are not matching anything in our system");
    	exit();
	}
	// Match was found, you can activate them
	$sql = "UPDATE clients SET activated='1' WHERE phone='$ph' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	// Optional double check to see if activated in fact now = 1
	$sql = "SELECT * FROM clients WHERE phone='$ph' AND activated='1' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	$numrows = mysqli_num_rows($query);
	// Evaluate the double check
    if($numrows == 0){
	// Log this issue of no switch of activation field to 1
        header("location: ../errorPage.php?msg=activation failure");
    	exit();
    } else if($numrows == 1) {
	// Great everything went fine with activation!
        header("location: ../successPage.php");
    	exit();
    }
} else {
	// Log this issue of missing initial $_GET variables
	header("location: ../errorPage.php?msg=missing GET variables");
    exit(); 
}

?>