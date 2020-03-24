<?php

require_once("assets/dbConnection.php");

if(isset($_POST['cate'])){
    $cate = $_POST['cate'];
    $sql = "SELECT * FROM items WHERE category= '$cate' AND avail= '0' GROUP BY itemNo";
    $cateQuery = mysqli_query($db_conx, $sql);
    $cateCount = mysqli_num_rows($cateQuery);
    if(!$cateQuery){
        echo "Category query acting icky!";
    }
    if($cateCount <1){
        echo "<div style='color:red; padding:50px; text-align;center; font-size:15px;'>Sorry nothing available at the moment under this category.<br/>Please check back later.</div>";
    }
    while($row = mysqli_fetch_array($cateQuery)){
        $itemNo = $row['itemNo'];
        $price = $row['price'];
        $desc = $row['descr'];

        $iSQL = "SELECT img1 FROM items WHERE itemNo = '$itemNo'";
        $imgsQuery = mysqli_query($db_conx, $iSQL);
        $imgsCount = mysqli_num_rows($imgsQuery);
        if(!$imgsQuery){
            echo "Fetching images acting up";
        }
        while($row= mysqli_fetch_array($imgsQuery)){
            $img[] = $row[0];
        };
        ?>

        <!-- Single Product Area -->
        
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div data-item='<?php echo $itemNo?>' class="product-img">
                                <img src="admin/stockIMGs/<?php echo $img[0]?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="admin/stockIMGs/<?php echo $img[1]?>" alt="">
                            </div>

                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">&cent;<?php echo $price;?></p>
                                    <a href="product-details.php?i=<?php echo $itemNo?>">
                                        <h6><?php echo $desc; ?></h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="cart">
                                        <a href="cart.php" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="img/core-img/cart.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>


        <?php
    }
}
?>
                    