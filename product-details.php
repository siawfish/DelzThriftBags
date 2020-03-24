<?php
require_once("assets/checkStatus.php");

if(isset($_GET['i'])){
    $itemNo = $_GET['i'];

    if(!is_numeric($itemNo)){
        header("location: shop.php"); 
        exit();
    }

    $sql = "SELECT * FROM items WHERE itemNo= '$itemNo' GROUP BY itemNo";
    $bag = mysqli_query($db_conx, $sql);
    if(!$bag){
        echo "Query failed";
        exit();
    }
    if(mysqli_num_rows($bag) < 1){
        echo "You're doing something wrong...We're watching";
    }
    while($row= mysqli_fetch_array($bag)){
        $itemNo = $row['itemNo'];
        $cate = $row['category'];
        $brand = $row['brand'];
        $price = $row['price'];
        $qty = $row['qty'];
        $desc = $row['descr'];
        $availability = $row['avail'];

        $iSQL = "SELECT img1 FROM items WHERE itemNo = '$itemNo'";
        $imgsQuery = mysqli_query($db_conx, $iSQL);
        $imgsCount = mysqli_num_rows($imgsQuery);
        if(!$imgsQuery){
            echo "Fetching images acting up";
            exit();
        }
        if($imgsCount < 1){
            echo 'no images oh';
            exit();
        }
        while($row= mysqli_fetch_array($imgsQuery)){
            $img[] = $row[0];
        };
    }
} else {
    header("location: shop.php");
    exit();
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
    <title>Delz Thriftbags | Product Details</title>

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
                    <li><a href="shop.php">Shop</a></li>
                    <li class="active"><a href="product-details.php">Product</a></li>
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

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                                <li class="breadcrumb-item"><a href="#"><?php echo $cate;?></a></li>
                                <li class="breadcrumb-item"><a href="#"><?php echo $brand;?></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <?php
                                        for($i=0; $i < $imgsCount; $i++){
                                            ?>

                                                <li class="list<?php echo $i;?>" data-img="<?php echo $i;?>" data-target="#product_details_slider" data-slide-to="<?php echo $i;?>" style="background-image: url(admin/stockIMGs/<?php echo $img[$i];?>)"></li>

                                            <?php
                                        }
                                    ?>
                                </ol>
                                
                                <div class="carousel-inner">

                                <?php
                                        for($i=0; $i < $imgsCount; $i++){
                                            ?>
                                            <div class="carousel-item" id="<?php echo $i;?>">
                                                <a class="gallery_img" href="admin/stockIMGs/<?php echo $img[$i];?>">
                                                    <img class="d-block w-100" src="admin/stockIMGs/<?php echo $img[$i];?>" alt="<?php echo $i;?> slide">
                                                </a>
                                            </div>

                                        <?php
                                            }
                                        ?>
                                </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">&cent;<?php echo $price;?></p>
                                <a href="product-details.php">
                                    <h6><?php echo $desc;?></h6>
                                </a>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="review">
                                        <a href="#">Write A Review</a>
                                    </div>
                                </div>
                                <?php if($availability == "0"){
                                    echo '<!-- Avaiable -->
                                    <p class="avaibility" style="padding-bottom:20px"><i class="fa fa-circle"></i> In Stock</p>';
                                } else {
                                    echo '<!-- Avaiable -->
                                    <p style="padding-bottom:20px"><i class="fa fa-circle"></i> Out of Stock</p>';
                                }
                                    
                                ?>  
                            </div>

                            <!-- <div class="short_overview my-5">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem mollitia impedit iste asperiores nisi reprehenderit consequatur, autem, nostrum pariatur enim?</p>
                            </div> -->

                            <!-- Add to Cart Form -->
                            <form id="addToCartForm" class="cart clearfix">
                                <div class="cart-btn d-flex mb-50">
                                    <p>Qty</p>
                                    <div class="quantity">
                                        <!-- <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span> -->
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="<?php echo $qty;?>" name="quantity" value="1">
                                        <!-- <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span> -->
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $price;?>" id="price"/>
                                <input type="hidden" value="<?php echo $itemNo;?>" id="itemNo"/>
                                <input type="hidden" value="<?php echo $log_id;?>" id="clientID"/>
                                <div id="addtocartFeed" style="padding:15px;"></div>
                                <button type="submit" name="addtocart" id="addtocart" class="btn amado-btn">Add to cart</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->
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
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
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
                                        <?php
                                        if($user_ok){
                                            echo'<li class="nav-item">
                                            <a class="nav-link" href="cart.php">Cart</a>
                                        </li>';
                                        }
                                        ?>
                                        
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
    $(".carousel-indicators").on("click", "li", function(){
            $(this).addClass("active").siblings().removeClass("active");
            var counter = $(this).attr("data-img");
            $("#"+counter).addClass("active").siblings().removeClass("active");        
    });

    $(".list0").click();

    $('#addToCartForm').on("click", "#addtocart", function(e){
        e.preventDefault();
        var itemNo = $('#itemNo').val()
        var clientID = $('#clientID').val()
        var price = $('#price').val()
        var qty = $('#qty').val()

        if(clientID==""){
            alert("You'll need to signin to add to cart");
            $( "#addtocart" ).prop( "disabled", true );
            return false;
        }

        $.post("assets/addtocart.php", {
            itemNo:itemNo,
            clientID:clientID,
            price:price,
            qty:qty
        }, function(data){
            $('#addtocartFeed').html(data)
            $('#addtocartFeed').fadeIn('slow')
            setTimeout(function(){ 
                $('#addtocartFeed').fadeOut('slow')
             }, 3000);
            if(data.match('success') !== null) window.location.reload();
        })
    })

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
            }, 3000);
            
        }
        });
});

    </script>

    
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