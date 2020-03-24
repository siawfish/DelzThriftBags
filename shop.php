<?php
require_once('assets/checkStatus.php');
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
    <title>Delz Thriftbags | Shop</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>

</head>

<body style="background-color:white;">
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/core-img/logo.png"></a>
             </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.php"><img src="img/core-img/logo.png"></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="shop.php">Shop</a></li>
                    <!-- <li><a href="product-details.php">Product</a></li> -->
                    <!-- <li><a href="cart.php">Cart</a></li> -->
                    <!-- <li><a href="checkout.php">Checkout</a></li> -->
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
            <?php
            if($user_ok == false){
                echo '<a href="#" class="btn amado-btn mb-15" data-toggle="modal" data-target="#signinModal"><i class="fa fa-sign-in" aria-hidden="true"></i> SIGN IN</a>
                    <a href="#" class="btn amado-btn active" data-toggle="modal" data-target="#registerModal">SIGN UP</a>';
            } else {
                echo '<a href="assets/logout.php" class="btn amado-btn active"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>';
            }
            ?>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                                    <?php
                                    $sql = "SELECT * FROM cart WHERE clientID='$log_id' AND paid='0'";
                                    $query = mysqli_query($db_conx, $sql);
                                    if(!$query){
                                        echo "cart query failed";
                                    } else {
                                        $count = mysqli_num_rows($query);
                                    }
                                    ?>
                <?php
                if($user_ok){
                    echo'<a href="cart.php" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span>(' .$count. ')</span></a>';
                }
                ?>
                <!-- <a href="#" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> Favourite</a> -->
                <a href="#" class="search-nav"><img src="img/core-img/search.png" alt=""> Search</a>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Catagories</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <li class="active" data-cate="Hand Bags"><a href="#">Hand Bags</a></li>
                        <li data-cate="Side Bags"><a href="#">Side Bags</a></li>
                        <li data-cate="Laptop Bags"><a href="#">Laptop Bags</a></li>
                        <li data-cate="Purses"><a href="#">Purses</a></li>
                        <li data-cate="Backpacks"><a href="#">Backpacks</a></li>
                        
                    </ul>
                </div>
            </div>
            <!-- ##### Single Widget ##### -->
            <!-- <div class="widget color mb-50"> -->
                <!-- Widget Title -->
                <!-- <h6 class="widget-title mb-30">Color</h6>

                <div class="widget-desc">
                    <ul class="d-flex">
                        <li><a href="#" class="color1"></a></li>
                        <li><a href="#" class="color2"></a></li>
                        <li><a href="#" class="color3"></a></li>
                        <li><a href="#" class="color4"></a></li>
                        <li><a href="#" class="color5"></a></li>
                        <li><a href="#" class="color6"></a></li>
                        <li><a href="#" class="color7"></a></li>
                        <li><a href="#" class="color8"></a></li>
                    </ul>
                </div>
            </div> -->

            <!-- ##### Single Widget ##### -->
            <!-- <div class="widget price mb-50"> -->
                <!-- Widget Title -->
                <!-- <h6 class="widget-title mb-30">Price</h6>

                <div class="widget-desc">
                    <div class="slider-range">
                        <div data-min="10" data-max="1000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="10" data-value-max="1000" data-label-result="">
                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        </div>
                        <div class="range-price">$10 - $1000</div>
                    </div>
                </div>
            </div>-->
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products">
                                <!-- <p>Bags available/p> -->
                                <!-- <div class="view d-flex">
                                    <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                </div> -->
                            </div>
                            <!-- Sorting -->
                            <!-- <div class="product-sorting d-flex">
                                <div class="sort-by-date d-flex align-items-center mr-15">
                                    <p>Sort by</p>
                                    <form action="#" method="get">
                                        <select name="select" id="sortBydate">
                                            <option value="value">Date</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Popular</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="view-product d-flex align-items-center">
                                    <p>View</p>
                                    <form action="#" method="get">
                                        <select name="select" id="viewProduct">
                                            <option value="value">12</option>
                                            <option value="value">24</option>
                                            <option value="value">48</option>
                                            <option value="value">96</option>
                                        </select>
                                    </form>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                <div id="cateFeed"></div>
                </div>
                </div>

                <!-- <div class="row">
                    <div class="col-12">
                        Pagination
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                <li class="page-item active"><a class="page-link" href="#">01.</a></li>
                                <li class="page-item"><a class="page-link" href="#">02.</a></li>
                                <li class="page-item"><a class="page-link" href="#">03.</a></li>
                                <li class="page-item"><a class="page-link" href="#">04.</a></li>
                            </ul>
                        </nav>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <!-- <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center"> -->
                <!-- Newsletter Text -->
                <!-- <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div> -->
                <!-- Newsletter Form -->
                <!-- <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="logo mr-50">
                        <a href="index.php"><img src="img/core-img/logo.png"></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">Jools | Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop.php">Shop</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="product-details.php">Product</a>
                                        </li> -->
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="cart.php">Cart</a>
                                        </li> -->
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="checkout.php">Checkout</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->
     <!-- register modal -->
     <div id="registerModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="formBox">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1>SIGN UP<br/><span style="font-size:10px;">Thrift the sophisticated way!</span></h1>
                                </div>
                            </div>

                            <div id="feed" style="padding:20px;"></div>

                         <form class="signupForm">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="inputBox ">
                                        <div class="inputText">First Name</div>
                                        <input type="text" id="fname" name="" class="input">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="inputBox">
                                        <div class="inputText">Last Name</div>
                                        <input type="text" id="lname" name="" class="input">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="inputBox">
                                        <div class="inputText">Email</div>
                                        <input type="email" id="email" name="" class="input">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="inputBox">
                                        <div class="inputText">Password</div>
                                        <input type="password" id="password" name="" class="input">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="inputBox">
                                        <div class="inputText">Phone</div>
                                        <input type="tel" id="phone" name="" class="input">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="inputBox">
                                        <div class="inputText">Location</div>
                                        <input type="text" id="location" name="" class="input">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button id="submit" onclick="" class="btn amado-btn">Sign up</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="signinModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                
                <div class="modal-body">
                    <div class="formBox">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1>Welcome Back!<br/><span style="font-size:10px;">Thrift the sophisticated way!</span></h1>
                                    </div>
                                </div>

                                <div id="loginFeed" style="padding:20px;"></div>

                                <form class="signinForm">

                                <div class="row">
                                <div class="col-sm-12">
                                    <div class="inputBox">
                                        <div class="inputText">Phone</div>
                                        <input type="tel" id="lphone" name="" class="input">
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12">
                                    <div class="inputBox">
                                        <div class="inputText">Password</div>
                                        <input type="password" id="lpass" name="" class="input">
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button id="lsubmit" onclick="" class="btn amado-btn">Sign in</button>
                                </div>
                            </div>
                            </form>
                    </div>
                </div>
                
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

    <script>
    $(".catagories-menu").on("click", "ul li", function(){
            $(this).addClass("active").siblings().removeClass("active");
            var cate = $(this).attr("data-cate");
            $.post("cate.php",{cate:cate}, function(data){
                document.getElementById('cateFeed').innerHTML = data
                $('#cateFeed').show();
            });
    });
    $(".catagories-menu .active").click();

    $(".input").focus(function() {
                $(this).parent().addClass("focus");
            });

    $('.signupForm').on('click','#submit',function(e){

        e.preventDefault();

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var pass = $('#password').val();
        var loc = $('#location').val();
        var phone = $('#phone').val();

        $.post("assets/register.php", {
            fname:fname,
            lname:lname,
            email:email,
            pass:pass,
            loc:loc,
            phone:phone
        }, function(data){
            document.getElementById('feed').innerHTML = data
            $('#feed').show();
            if(data.match('success') !== null){
                $('.signupForm').slideUp('slow'); 
                setTimeout(function(){ 
                window.location.reload(); 
                }, 3000);
            }
        });
        });


        $('.signinForm').on('click','#lsubmit',function(e){

        e.preventDefault();

        var ph = $('#lphone').val();
        var pass = $('#lpass').val();

        $.post("assets/signin.php", {
        ph:ph,
        pass:pass
        }, function(data){
        document.getElementById('loginFeed').innerHTML = data
        $('#loginFeed').show();
        if(data.match('success') !== null){
            $('.signinForm').slideUp('slow'); 
            setTimeout(function(){ 
                window.location.reload(); 
            }, 2000);
            
        }
        });
});
    </script>

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