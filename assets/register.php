<?php
require_once('dbConnection.php');

if(isset($_POST['email'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $ph = $_POST['phone'];
    $loc = $_POST['loc'];

    function isEmail($e) {
        return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$e ));
    }

    if($fname == ""|| $lname == ""|| $email == ""|| $pass == ""|| $ph == ""|| $loc == ""){
        echo "<div class='error'>You are please required to complete the form</div>";
        exit();
    }else if(is_numeric($fname)|| is_numeric($lname)){
        echo "<div class='error'>You can't have a number in your name</div>";
        exit();
    }else if(!is_numeric($ph)){
        echo "<div class='error'>You can't have a letters in your number</div>";
        exit();
    }else if(strlen($ph)!==10){
        echo "<div class='error'>Enter a valid Phone #. eg: 0577000000</div>";
        exit();
    }else if(!isEmail($email)) {
        echo '<div class="error">You have enter an invalid e-mail address, try again.</div>';
        exit();
    }else if(!preg_match('/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/', $fname)){
        echo '<div class="error">Enter a valid first name.</div>';
        exit();
    }else if(strlen($fname) < 3){
        echo '<div class="error">Enter a valid last name</div>';
        exit();
    }else if(!preg_match('/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/', $lname)){
        echo '<div class="error">Enter a valid last name.</div>';
        exit();
    }else if(strlen($lname) < 3){
        echo '<div class="error">Enter a valid last name</div>';
        exit();
    }else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass)) {
        echo '<div class="error">Password must contain at least one number and one uppercase or lowercase letter, and between 8-12 characters long</div>';
        exit();
    }

    $query = "select * from clients where email='".$email."'";
    $result = mysqli_query($db_conx,$query);

    if(mysqli_fetch_assoc($result)) {
        echo '<div class="error">Email is already signed up.</div>';
        exit();
    }

    $moquery = "select * from clients where phone='".$ph."'";
    $moresult = mysqli_query($db_conx,$moquery);

    if(mysqli_fetch_assoc($moresult)) {
        echo '<div class="error">Phone is already signed up.</div>';
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

    //encrypt password
    $epass = md5($pass);

    //collecting data to database
    $sql= "INSERT INTO clients (fName, lName, phone, email, password, location, ip, signup, lastlogin, notescheck) 
    VALUES ('$fname', '$lname', '$ph', '$email', '$epass', '$loc', '$ip', now(), now(), now())";

    if(!mysqli_query($db_conx, $sql)) {
        echo '<div class="error">Sorry an error occurred, Try again.</div>';
        exit();
        }

    //$address = "HERE your email address";
    $address = "mcamanor@gmail.com";

    // Below the subject of the email
    $e_subject = 'You\'ve got a new client by name' . $fname. ''.$lname. '.';

    // You can change this if you feel that you need to.
    $e_body = "You have been contacted by $fname with registration info is as follows." . PHP_EOL . PHP_EOL;
    $e_content = "Name: $fname\nLocation: $loc\nPhone number: $ph\nEmail address: $email" . PHP_EOL . PHP_EOL;
    $e_reply = "You can contact $fname via email, $email or via Mobile phone $ph";

    $msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

    $headers = "From: $email" . PHP_EOL;
    $headers .= "Reply-To: $email" . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
    $headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

    $user = "$email";
    $usersubject = "Welcome to Delz Thriftbags";
    $usermessage = '<div style="background-color:#242424; text-align:center; padding:10%; width: fit-content;"><div style="padding: 20px; border: 1px solid pink; width: 600px; border-radius: 8px; "><div style="margin:80px 20px 20px 20px;">
    <a><img src="wwww.joolsmen.com/img/core-img/logo.png"/></a>
    </div><div style="padding:20px";><h1 style="color:pink;">THANK YOU <strong>'.$fname.'</strong><br/><small style="color:grey;">For signing up to delzthriftbags.com</small></h1></div><p style="color:grey; font-size: large;">
    To complete your registration, kindly click on the button below.<br/><br/><br/><a href="assets/activation.php?ph='.$ph.'&p='.$epass.'" style="border: 3px solid pink; background-color: pink; color: #242424; text-decoration: none; margin: 20px; padding: 12px 30px 12px 30px; border-radius:50px;">
    Activate Here</a><p style="margin-top: 50px;"><small style="color: pink;">Thrift the sophisticated way!</small></p><p style="font-size: medium; margin: 50px; color: grey;">If you did not sign up to Delzthriftbags, kindly ignore email.<br/>Contact 0541040442 for support.</p></div></div>';
    $userheaders = "From: signup@delzthriftbags.com\n";
    $userheaders .= "MIME-Version: 1.0\n";
    $userheaders .= "Content-type: text/html; charset=iso-8859-1\n";

    mail($address, $e_subject, $msg, $headers);

    if(mail($user,$usersubject,$usermessage,$userheaders)) {

        // Success message
        echo "<div id='success' style='padding:60px 30px; text-align:center; color: pink;'>";
        echo "<h4>Email Sent!</h4><br>";
        echo "Thank you <strong>$fname</strong>,<br> your registration has been submitted. Kindly check email inbox/spam/junk mail to confirm registration";
        echo "</div>";
        exit();

    }else {
        echo '<div class="error">Sorry something went wrong. Kindly contact support</div>';
        exit();
    }
}
?>