<?php
if(!$_POST) exit;

require_once("dbConnection.php");

$ph = $_POST['ph'];
$pass = $_POST['pass'];

if($ph == ""|| $pass == ""){
    echo "<div class='error'>You need to complete the form to continue</div>";
    exit();
}else if(!is_numeric($ph)){
    echo "<div class='error'>You can't have a letters in your number</div>";
    exit();
}else if(strlen($ph)!==10){
    echo "<div class='error'>Enter a valid Phone #. eg: 0577000000</div>";
    exit();
}else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass)) {
    echo '<div class="error">Incorrect password</div>';
    exit();
}

    // GET USER IP ADDRESS
    //whether ip is from share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
    {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else
    {
    $ip = $_SERVER['REMOTE_ADDR'];
    }


$sql = "SELECT * FROM clients WHERE phone ='$ph' LIMIT 1";
$query = mysqli_query($db_conx, $sql);

if(!$query){
    echo '<div class="error">Something went wrong. Please contact support</div>';
    exit();
}

$count = mysqli_num_rows($query);

if($count < 1){
    echo '<div class="error">Client not found. You are sure you signed up?</div>';
    exit();
} else {
    //encrypt password
    $epass = md5($pass);

    while($row = mysqli_fetch_array($query)){
        $id = $row['id'];
        $fname = $row['fName'];
        $ph = $row['phone'];
        $dbpass = $row['password'];
        $activation = $row['activated'];
    }

    // if($activation == '0'){
    //     echo '<div class="error">You did not activate your account yet. Check either your Inbox/Spam/Junk for activation link or contact support</div>';
    //     exit();
    // }

    if($dbpass !== $epass){
        echo '<div class="error">Your password is incorrect, Try again</div>';
        exit();
    } else {
            // CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['id'] = $id;
			$_SESSION['ph'] = $ph;
			$_SESSION['p'] = $dbpass;
			setcookie("id", $id, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("ph", $ph, strtotime( '+30 days' ), "/", "", "", TRUE);
    		setcookie("p", $dbpass, strtotime( '+30 days' ), "/", "", "", TRUE); 
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			$sql = "UPDATE clients SET ip='$ip', lastlogin=now() WHERE phone='$ph' LIMIT 1";
            $query = mysqli_query($db_conx, $sql);
    		// Success message
            echo "<div id='success' style='text-align:center; color: grey; font-size:larger;'>";
            echo "<h4 style='color:grey;'>Hello <strong>$fname</strong> Happy Thrifting!</h4>";
            echo "</div>";
            exit();
    }

}


?>