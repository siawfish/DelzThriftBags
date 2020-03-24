<?php
if (isset($_GET['msg'])){
    $message = "";
    $msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
    if($msg == "activation_failure"){
        $message = '<h4 style="color: grey;">Activation Error</h4> <p style="color: red; font-size: 12px;">Sorry there seems to have been an issue activating your account at this time. We have already notified ourselves of this issue and we will contact you via email when we have identified the issue.</p>';
    } else {
        $message = $msg;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Delz Thriftbags | Error</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>

</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-9">

                    <div class="jumbotron" style="background-color: #000; margin-top: 20%; margin-left:0px;">
                            <h3 class="" style="color: pink">Oops!!! <span class="fa fa-close" aria-hidden="true"></span>
                            </h3>
                            <p class="lead" style="color: red; font-size:14px; width:300px;"><?php echo $message; ?></p>
                            <hr style="border:1px solid pink;">
                            <div style="color: grey; padding-bottom:15px; padding-top:15px;">Feel free to reach us on 0541040442 for assistance</div>
                            <p class="lead">
                              <a class="btn amado-btn" href="shop.php" role="button">Shop</a>
                            </p>
                    </div>

            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    

<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>