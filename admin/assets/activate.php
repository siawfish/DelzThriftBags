<?php
if(!$_POST) exit();

if (isset($_POST['ph']) && isset($_POST['p'])) {

	// Connect to database and sanitize incoming $_GET variables
	require_once("../../assets/dbConnection.php");
	
    $ph = preg_replace('#[^0-9]#i', '', $_POST['ph']);
    $p = mysqli_real_escape_string($db_conx, $_POST['p']);
	
	// Evaluate the lengths of the incoming $_GET variable
	if(strlen($ph) < 9 || !is_numeric($ph) || strlen($p) == ""){
	// Log this issue into a text file and email details to yourself
		echo "activation string type/length issues";
    	exit(); 
	}
	// Check their credentials against the database
	$sql = "SELECT * FROM clients WHERE phone='$ph' AND password='$p' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	$numrows = mysqli_num_rows($query);
	
	// Evaluate for a match in the system (0 = no match, 1 = match)
	if($numrows == 0){
	// Log this potential hack attempt to text file and email details to yourself
		echo "Credentials are not matching anything in our system";
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
        echo "Activation failure";
    	exit();
    } else if($numrows == 1) {
	// Great everything went fine with activation!
        echo "Activated Successfully";
    	exit();
    }
} else {
	// Log this issue of missing initial $_GET variables
	echo "Missing post variables";
    exit(); 
}

?>