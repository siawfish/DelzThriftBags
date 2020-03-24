<?php

if(!$_POST) exit();

require_once('dbConnection.php');

if(!isset($_POST['transID'])){
    $itemNoArr = $_POST['itemNoArr'];
    $qtyArr = $_POST['qtyArr'];
    $feed = 'true';
    $msg = '';

    for($i=0; $i<count($itemNoArr); $i++){
        $itemNo = $itemNoArr[$i];
        $qty = $qtyArr[$i];
        $clientID = $_POST['clientID'];
        if($itemNo==""){
            echo "Error! Sorry item array got nothing";
            exit();
        } else{
            if(is_numeric($itemNo)){
                $sql = "SELECT * FROM items WHERE itemNo='$itemNo' AND avail='0' LIMIT 1";
                $query = mysqli_query($db_conx, $sql);
                $count = mysqli_num_rows($query);

                if($count<1){
                    $feed = 'false';
                    $sql = "DELETE FROM cart WHERE itemNo='$itemNo'";
                    $query = mysqli_query($db_conx, $sql);
                    $msg= "Error! Too slow Item No $itemNo has been sold";
                }

                while($row = mysqli_fetch_array($query)){
                    $desc = $row['descr'];
                    $dbqty = $row['qty'];
                    $itemNo = $row['itemNo'];
                }   
                if($qty>$dbqty){
                    $feed = 'false';
                    $sql = "DELETE FROM cart WHERE itemNo='$itemNo'";
                    $query = mysqli_query($db_conx, $sql);
                    $msg= "Error! Sorry only $dbqty of $desc ($itemNo) is in stock";
                    }
            }else{
                echo "Error! Invalid item #!";
                exit();
            }

            if($feed == 'true'){
                $sql = "SELECT * FROM items WHERE itemNo='$itemNo' AND avail='0' LIMIT 1";
                $query = mysqli_query($db_conx, $sql);
                while($row = mysqli_fetch_array($query)){
                    $dbqty = $row['qty'];
                }
                if($qty<$dbqty){
                    $newQty = $dbqty-$qty;
                    $sql = "UPDATE items SET qty='$newQty', ownerID='$clientID' WHERE itemNo='$itemNo'";
                    $query = mysqli_query($db_conx, $sql);
                    echo 'sysago';
                }else{
                    $sql = "UPDATE items SET avail='1', ownerID='$clientID' WHERE itemNo='$itemNo'";
                    $query = mysqli_query($db_conx, $sql);
                    echo 'sysago';
                }
                
            } else if($feed == 'false'){
                echo $msg;
            }
        }
    }
}

if(isset($_POST['transID'])){
    $itemNoArr = $_POST['itemNoArr'];
    $qtyArr = $_POST['qtyArr'];
    $priceArr = $_POST['priceArr'];
    $subTotalArr = $_POST['subTotalArr'];
    $transID = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['transID']);
    $clientID = $_POST['clientID'];
    $totalAmt = $_POST['totalAmt'];

    $sql = "SELECT fName FROM clients WHERE id='$clientID' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
    if(!$query){
        echo "getting name query failed";
    }
    while($row = mysqli_fetch_array($query)){
        $name = $row[0];
    }

    $email = "mcamanor@gmail.com";
    $subject = "Confirm Purchase";
    $message = '<div style="background-color:#242424; text-align:center; color:grey; width: fit-content; padding:10%">
    <div style="border:1px solid pink; border-radius:8px; padding:20px;">
        <h1 style="padding-top:20px;">Hello <span style="color:pink;">Delz!</span></h1>
        <h3>'.$name.' claims to have sent <span style="font-size:18px; color:pink;">&cent;'.$totalAmt.' </span>to your momo number.</h3><h3 style="color:pink;">Transaction ID: '.$transID.'</h3>
        <div style="color:grey;">For the ('.count($itemNoArr).') items listed below</div>
        <div style="padding:20px;">
        <table style="text-align:center; padding:10px; width:100%; color:grey;">
        <tr>
        <td style="border-bottom:3px solid pink;width:20%; color:pink;"></td>
        <td style="border-bottom:3px solid pink;width:20%; color:pink;">Description</td>
        <td style="border-bottom:3px solid pink;width:20%; color:pink;">Price</td>
        <td style="border-bottom:3px solid pink;width:20%; color:pink;">Qty</td>
        <td style="border-bottom:3px solid pink;width:20%; color:pink;">Subtotal</td>
        </tr>';
            for($i=0;$i<count($itemNoArr);$i++){

                $itemNo = $itemNoArr[$i];
                $sql = "SELECT descr, img1 FROM items WHERE itemNo='$itemNo' AND ownerID='$clientID' LIMIT 1";
                $query = mysqli_query($db_conx, $sql);
                while($row = mysqli_fetch_array($query)){
                    $desc = $row[0];
                    $img = $row[1];
                }
                

            $message .='<tr>
                    <td style="width:20%; border-bottom:1px solid pink; color:grey;"><img src="joolsmen.com/admin/stockIMGs/'.$img.'" style="margin:10px;" width="50px" height="50px"></td>
                    <td style="border-bottom:1px solid pink;width:20%;color:grey;">'.$desc.'</td>
                    <td style="border-bottom:1px solid pink;width:20%;color:grey;">&cent;'.$priceArr[$i].'</td>
                    <td style="border-bottom:1px solid pink;width:20%;color:grey;">'.$qtyArr[$i].'</td>
                    <td style="border-bottom:1px solid pink;width:20%;color:grey;">'.$subTotalArr[$i].'</td>
                    </tr>';
                
                }
    $message .='</table>
        </div>';
    $message .='<div style="padding-bottom:25px;">
    <a href="joolsmen.com/assets/conCheckout.php?ans=Yes&cid='.$clientID.'&tid='.$transID.'" style="border: 3px solid pink; background-color: pink; color: #242424; text-decoration: none; padding: 12px 30px 12px 30px; border-radius:50px;">
    Yes, Confirm</a>
    <a href="joolsmen.com/assets/conCheckout.php?ans=No&cid='.$clientID.'&tid='.$transID.'" style="border: 3px solid pink; background-color: pink; color: #242424; text-decoration: none; padding: 12px 30px 12px 30px; border-radius:50px;">
        No, Decline</a></div>
    <div style="color:pink; padding:15px;">Including a delivery charge fee set at <span style="color:white;">&cent;20.00</span></div>
    </div>
    </div>';
    $headers = "From: checkout@delzthriftbags.com\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";

    if(mail($email,$subject,$message,$headers)){
        function checkout($transID, $itemNo, $clientID, $price, $qty, $db_conx){
            $sql = "UPDATE cart SET paid='1' WHERE itemNo='$itemNo' AND clientID='$clientID'";
            $query = mysqli_query($db_conx, $sql);
            $subTotal = $price * $qty;
            $sql = "INSERT INTO sales (transID, itemNo, clientID, price, qty, subtotal, pdate) VALUES ('$transID', '$itemNo', '$clientID', '$price', '$qty', '$subTotal', NOW())";
            $query1 = mysqli_query($db_conx, $sql);
            if($query && $query1){
                return true;
            }
        }
        for($i=0;$i<count($itemNoArr);$i++){
            $itemNo = $itemNoArr[$i];
            $qty = $qtyArr[$i];
            $price = $priceArr[$i];

            checkout($transID, $itemNo, $clientID, $price, $qty, $db_conx);
        }
        // Success message
        echo "<div id='success' style='padding:60px 30px; text-align:center; color: pink;'>";
        echo "<h4>Order Recieved!</h4><br>";
        echo "Thank you <strong>$name</strong>,<br> your order has been recieved. Kindly check email inbox/spam/junk mail for confirmation email.";
        echo "</div>";
        exit();

    } else {
        echo 'error sending mail';
        exit();
    }
}

?>