<?php
if(!$_POST) exit();

require_once("checkStatus.php");

$itemNo = $_POST['itemNo'];
$clientID = $_POST['clientID'];
$price = $_POST['price'];
$qty = $_POST['qty'];

if($clientID !== $log_id){
    echo "<div class='error'>Something went terribly wrong. Try logging out and back in</div>";
    exit();
} else if($clientID == ''){
    echo "<div class='error'>You'll Need to signin to add to cart</div>";
    exit();
    } else{
        $sql = "SELECT * FROM items WHERE itemNo='$itemNo' AND price='$price' AND avail='0' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        if(!$query){
            echo "<div class='error'>Item query failed.</div>";
            exit();
        }else{
            $count = mysqli_num_rows($query);
            if($count < 1){
                echo "<div class='error'>Sorry! too slow, no longer available</div>";
                exit();
            } else {
                $sql = "SELECT * FROM cart WHERE itemNo='$itemNo' AND clientID='$clientID' AND paid='0'";
                $query = mysqli_query($db_conx, $sql);
                if(!$query){
                    echo "<div class='error'>Already in cart query failed.</div>";
                    exit();
                }else{
                    $count = mysqli_num_rows($query);
                    if($count < 1){
                        $sql = "INSERT INTO cart (itemNo, clientID, price, qty, addedDate) VALUES ('$itemNo', '$clientID', '$price', '$qty', NOW())";
                        $query = mysqli_query($db_conx, $sql);
                        if(!$query){
                            echo "<div class='error'>Cart insert query failed.</div>";
                            exit();
                        }else{
                            echo "<div class='success' style='color:green;'>Item addeded to cart</div>";
                            exit();
                        }
                    }else{
                        echo "<div class='error' style='color:grey;'>Item already in cart</div>";
                        exit();
                    }
                }
            }
    }
}
?>