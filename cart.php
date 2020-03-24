<?php
require_once('assets/checkStatus.php');

if(!$user_ok){
    header("location: index.php");
}

if($user_ok){
    $sql = "SELECT fName FROM clients WHERE id='$log_id'";
    $query = mysqli_query($db_conx, $sql);
    while($row = mysqli_fetch_array($query)){
        $fname = $row[0];
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
    <title>Delz Thriftbags | Cart</title>

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
                    <!-- <li><a href="product-details.php">Product</a></li> -->
                    <li class="active"><a href="cart.php">Cart</a></li>
                    <!-- <li><a href="checkout.php">Checkout</a></li> -->
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
            <a href="assets/logout.php" class="btn amado-btn active"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
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
                <a href="cart.php" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span>( <?php echo $count;?> )</span></a>
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

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2><?php echo $fname?>'s Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="max-width:20%;">Name</th>
                                        <th style="max-width:20%;">Price</th>
                                        <th style="max-width:20%;">Quantity</th>
                                        <th style="max-width:15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM cart WHERE clientID='$log_id' AND paid='0'";
                                    $query = mysqli_query($db_conx, $sql);
                                    if(!$query){
                                        echo "cart query failed";
                                    } 
                                    $count = mysqli_num_rows($query);
                                    if($count < 1){
                                        echo "<div style='color:red; text-align:center;'>You have not added any items to your cart yet</div>";
                                    }
                                    while($row = mysqli_fetch_array($query)){
                                        $itemNo = $row['itemNo'];
                                        $qty = $row['qty'];

                                        $sql1 = "SELECT * FROM items WHERE itemNo='$itemNo' AND avail='0' LIMIT 1";
                                        $query1 = mysqli_query($db_conx, $sql1);
                                        if(!$query1){
                                            echo "item query failed";
                                        }
                                        while($row1 = mysqli_fetch_array($query1)){
                                            $desc = $row1['descr'];
                                            $price = $row1['price'];
                                            $img = $row1['img1'];
                                         
                                    ?>

                                                <tr>
                                                
                                                <td class="cart_product_img">
                                                    <a href="#"><img src="admin/stockIMGs/<?php echo $img;?>" alt="Product"></a>
                                                </td>
                                                <td class="cart_product_desc" style="max-width:20%;">
                                                    <h5 style="color:grey;"><?php echo $desc;?></h5>
                                                </td>
                                                <td class="price" style="max-width:20%;" data-client="<?php echo $log_id;?>" data-item="<?php echo $itemNo;?>" data-price="<?php echo $price;?>" data-qty="<?php echo $qty;?>" data-total="<?php echo $qty*$price;?>">
                                                    <span>&cent;<?php echo $price?></span>
                                                </td>
                                                <td class="qty" style="max-width:20%;">
                                                    <div class="qty-btn d-flex">
                                                        <div class="quantity">
                                                            <span><?php echo $qty;?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="max-width:15%;">
                                                    <div class="">
                                                        <div data-item="<?php echo $itemNo;?>" class="remove">
                                                            <span>&times;</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                </tr>


                                            <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span id="subTotal"></span></li>
                                <li><span>delivery:</span> <span>&cent;20.00</span></li>
                                <li><span>total:</span> <span id="totalAmt"></span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                            <div class='row' style="margin-bottom:15px;">
                                <div class="col-md-3" style="margin-right:0px; padding-right:0px;"><img src="img/core-img/mtnmomo.svg" width="100%" height="100%" /></div><div class="col-md-9" style="padding-top:10px"><span style="font-size:12px; font-weight:1px;">Powered by MTN MOMO. Send from all networks</span></div>
                            </div>
                                <a href="#" id="checkout" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
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

    <div id="checkoutModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                
                <div class="modal-body">
                    <div class="formBox">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 style="color:pink; text-align:center;">Almost there <?php echo $fname;?>!<br/><span style="font-size:15px; color:grey;">Follow the steps below to make payment</span></h3>
                                    </div>
                                </div>

                                <div id="ins" class="row">
                                    <div class="col-sm-12">
                                        <p style="color:grey; font-size:12px; background-color:#333; padding:5px; border-radius:8px;">Send the total amount: <span style="color:#999900;">&cent;</span><strong style="color:#999900;" id='totalAmt'></strong> to the MTN Number <strong style="color:#999900;">0541040442</strong> (Princilla Agbovi Kpetigo)<br/>
                                        Then enter the Transaction ID into the input field Below.
                                    </p>
                                    </div>
                                </div>

                                <div id="checkoutFeed" style="padding:20px;"></div>

                                <form class="checkoutForm">

                                <div class="row">
                                <div class="col-sm-12">
                                    <div class="inputBox">
                                        <div class="inputText">Transaction ID</div>
                                        <input type="text" id="transID" class="input">
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button id="redeem" class="btn amado-btn">Redeem Payment</button>
                                </div>
                            </div>
                            </form>
                    </div>
                </div>
                
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    <script>
    $(document).ready(function(){

        $(".input").focus(function() {
                $(this).parent().addClass("focus");
        });
    
        var TotalValue = 0;
        
        $('.price').each(function(){
            var price = $(this).attr("data-price")
            var qty = $(this).attr("data-qty")
            TotalValue +=parseInt(price*qty)
        });
        $('#subTotal').html("&cent;"+TotalValue+".00")

        var totalAmt = TotalValue + 20
        $('#totalAmt').html("&cent;"+totalAmt+".00")

        $('.remove').click(function(){
                var itemNo = $(this).attr("data-item")
                $.post('assets/cartremove.php',{
                    itemNo:itemNo
                },function(data){
                    location.reload(true);
                })
        })

        $('.formBox #totalAmt').text(totalAmt+".00");

        $('.cart-summary').on('click', '#checkout', function(){
            var itemNoArr = [];
            var qtyArr = [];
            var priceArr = [];
            var clientID = $('.price').attr("data-client")

            $('.price').each(function(){
                var itemNo = $(this).attr("data-item")
                var Qty = $(this).attr("data-qty")
                var price = $(this).attr("data-price")
                itemNoArr.push(itemNo)
                qtyArr.push(Qty)
                priceArr.push(price)
            });

            if(itemNoArr == ""){
                alert("You have no items in your cart.")
                return false;
            }

            $.post('assets/checkout.php', {
                itemNoArr:itemNoArr,
                qtyArr:qtyArr,
                priceArr:priceArr,
                clientID:clientID
            }, function(data){
                if(data.match('Error')){
                    alert(data)
                    setTimeout(function(){ 
                        window.location.reload(); 
                    }, 2000);
                    return false;
                }
                $('#checkoutModal').modal('show')
                })
            })

        $('.checkoutForm').on('click', '#redeem', function(e){
            e.preventDefault(); 
            var transID = $('#transID').val()
            var itemNoArr = [];
            var qtyArr = [];
            var priceArr = [];
            var subTotalArr = [];
            var clientID = $('.price').attr("data-client")

            if(transID ==""){
                $('#transID').css("border-bottom-color","red")
                $('#transID').focus()
                return false;
            }

            $('.price').each(function(){
                var itemNo = $(this).attr("data-item")
                var Qty = $(this).attr("data-qty")
                var price = $(this).attr("data-price")
                var total = $(this).attr("data-total")
                itemNoArr.push(itemNo)
                qtyArr.push(Qty)
                priceArr.push(price)
                subTotalArr.push(total)
            });

            $.post('assets/checkout.php', {
                itemNoArr:itemNoArr,
                transID:transID,
                qtyArr:qtyArr,
                priceArr:priceArr,
                subTotalArr:subTotalArr,
                clientID:clientID,
                totalAmt:totalAmt
            }, function(data){
                $('#checkoutFeed').html(data);
                $('#checkoutFeed').show();
                if(data.match('success')){
                    $('.checkoutForm').slideUp('slow'); 
                    $('#ins').remove();
                    $('#checkoutFeed').show();
                    setTimeout(function(){ 
                        window.location.reload(); 
                     }, 4000);
                }
            })
        })

        $("#checkoutModal").on('hide.bs.modal', function () {
        //actions you want to perform after modal is closed.
            // alert("Magic goes here")
            var itemNoArr = [];
            var qtyArr = [];
            var clientID = $('.price').attr("data-client")

            $('.price').each(function(){
                var itemNo = $(this).attr("data-item")
                var Qty = $(this).attr("data-qty")
                itemNoArr.push(itemNo)
                qtyArr.push(Qty)
            })

            $.post('assets/reverseCheckout.php', {
                itemNoArr:itemNoArr,
                qtyArr:qtyArr,
                clientID:clientID
            }, function(data){
                window.location.reload()
            })

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