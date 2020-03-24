<?php

if(!$_GET) exit();

require_once('dbConnection.php');

$ans = $_GET['ans'];
$cid = $_GET['cid'];
$tid = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['tid']);

if($ans ==''){
    header("location: ../errorPage.php?msg=Invalid Answer$ans");
    exit(); 
} else if($cid==''){
    header("location: ../errorPage.php?msg=No UserID set");
    exit();
} else if(!is_numeric($cid)){
    header("location: ../errorPage.php?msg=Invalid UserID");
    exit();
} else if($tid==''){
    header("location: ../errorPage.php?msg=Invalid TransID");
    exit();
}


$cSql = "SELECT * FROM clients WHERE id='$cid' LIMIT 1";
$cQuery = mysqli_query($db_conx, $cSql);

while($cRow = mysqli_fetch_array($cQuery)){
    $name = $cRow['fName'];
    $loc = $cRow['location'];
    $phone = $cRow['phone'];
}

if($ans =='Yes'){
    $sql = "SELECT itemNo, price, qty FROM sales WHERE transID='$tid' AND clientID='$cid'";
    $query = mysqli_query($db_conx, $sql);
    while($row=mysqli_fetch_array($query)){
        $itemNoArr[] = $row[0];
        $priceArr[] = $row[1];
        $qtyArr[] = $row[2];
    }
    $sql = "UPDATE sales SET confirmed='1' WHERE transID='$tid' AND clientID='$cid'";
    $query = mysqli_query($db_conx, $sql);
    if(!$query){
        header("location: ../errorPage.php?msg=Could not update saled to confirmed");
        exit();
    }
    if($query){
        
        $email = "mcamanor@gmail.com";
        $subject = "Thank You $name!";
        $message = '<div style="background-color:#242424; color:grey; width:fit-content; padding:10%; text-align:center;">
        <div style="border:1px solid pink; padding:20px;">
        <div style="margin:20px;">
            <a href="delzthriftbags.com"><img src="joolsmen.com/img/core-img/logo.png"/></a>
        </div>
        <div>
        <h1>Thank You '.$name.'!<br/><small>Your Purchase Order has been confirmed</small></h1>
        </div>
        
            <div style="padding:20px;">
            <table style="text-align:center; padding:10px; width:100%; color:grey;">
                <tr>
                    <td style="border-bottom:3px solid pink;width:20%; color:pink; padding:10px;"></td>
                    <td style="border-bottom:3px solid pink;width:20%; color:pink; padding:10px;">Description</td>
                    <td style="border-bottom:3px solid pink;width:20%; color:pink; padding:10px;">Price</td>
                    <td style="border-bottom:3px solid pink;width:20%; color:pink; padding:10px;">Qty</td>
                </tr>';

                for($i=0;$i<count($itemNoArr);$i++){
                    $itemNo = $itemNoArr[$i];
                    $sql = "SELECT descr, price, qty, img1 FROM items WHERE itemNo='$itemNo' AND ownerID='$cid' LIMIT 1";
                    $query = mysqli_query($db_conx, $sql);
                    if(!$query){
                        $msg = "SElecting item details is fucked";
                    }
                    while($row = mysqli_fetch_array($query)){
                        $desc = $row[0];
                        $price = $row[1];
                        $qty = $row[2];
                        $img = $row[3];
                    
                    }
                    $message .='<tr>
                    <td style="width:20%; border-bottom:1px solid pink; color:grey;"><img src="joolsmen.com/admin/stockIMGs/'.$img.'" style="margin:10px;" width="50px" height="50px"></td>
                    <td style="width:20%; border-bottom:1px solid pink; color:grey;">'.$desc.'</td>
                    <td style="width:20%; border-bottom:1px solid pink; color:grey;">'.$price.'</td>
                    <td style="width:20%; border-bottom:1px solid pink; color:grey;">'.$qty.'</td>
                                </tr>';
                    

                }

            $message .='</table>
                            </div>
                        
                        <div>
                        <p>Item(s) will be dispatched to your location: '.$loc.' tomorrow. Dispatch will call your number: '.$phone.' for detailed directions.</p>
                        <p style="padding:10px;">If you wish to change delivery details, Kindly call 0541040442.</p>
                        </div>
                        </div>
                        </div>';
            $headers = "From: checkout@delzthriftbags.com\n";
            $headers .= "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\n";

            if(mail($email,$subject,$message,$headers)){
                header("location: ../conCheckoutSuccess.php");
                exit();
            }
        }
    

}

if($ans =='No'){
    

    $sql = "SELECT itemNo, qty FROM sales WHERE clientID='$cid' AND confirmed='0'";
    $query = mysqli_query($db_conx, $sql);
    if(!$query){
        echo"sales query fucked";
        exit();
    }
    while($row=mysqli_fetch_array($query)){
        $itemNoArr[] = $row[0];
        $qtyArr[] = $row[1];
    }

    function reverse($cid,$itemNo,$qty,$db_conx){
        $sql = "SELECT qty, avail FROM items WHERE ownerID='$cid' AND itemNo='$itemNo' LIMIT 1";
        $query = mysqli_query($db_conx,$sql);
        if(!$query){
            echo "item query acting ickky";
        }
        while($row=mysqli_fetch_array($query)){
            $dbqty = $row[0];
            $avail = $row[1];
        }
        
        if($avail!=='0'){
            $sql = "UPDATE items SET avail='0', ownerID=0 WHERE itemNo='$itemNo'";
            $query = mysqli_query($db_conx, $sql);
        }else 
            {
                $restore = $dbqty+$qty;
                $sql = "UPDATE items SET qty='$restore', ownerID=0 WHERE itemNo='$itemNo'";
                $query = mysqli_query($db_conx, $sql);
                if(!$query){
                    echo"retore query fucked";
                    exit();
                }
            }
         return true;
    }

    for($i=0; $i < count($itemNoArr);$i++){
        $itemNo = $itemNoArr[$i];
        $qty  = $qtyArr[$i];

        if(!reverse($cid,$itemNo,$qty,$db_conx)){
            echo "function not functioning";
            exit();
        }

    }

    $email = "mcamanor@gmail.com";
    $subject = "Sorry $name!";
    $message = '<div style="background-color:#242424; color:grey; width:fit-content; padding:10%; text-align:center;">
        <div style="border:1px solid pink; padding:20px;">
        <div style="margin:20px;">
        <a href="delzthriftbags.com"><img src="joolsmen.com/img/core-img/logo.png"/></a>
        </div>
        <div>
        <h1>Sorry '.$name.'!<br/><small>Your Purchase Order has been declined</small></h1>
        </div>
        
            <div style="padding:20px;">
            <table style="text-align:center; padding:10px; width:100%; color:grey;">
                <tr>
                    <td style="border-bottom:3px solid pink;width:20%; color:pink; padding:10px;"></td>
                    <td style="border-bottom:3px solid pink;width:20%; color:pink; padding:10px;">Description</td>
                    <td style="border-bottom:3px solid pink;width:20%; color:pink; padding:10px;">Price</td>
                    <td style="border-bottom:3px solid pink;width:20%; color:pink; padding:10px;">Qty</td>
                </tr>';
                for($i=0;$i<count($itemNoArr);$i++){
                    $itemNo = $itemNoArr[$i];
                    $sql = "SELECT descr, price, img1 FROM items WHERE itemNo='$itemNo' LIMIT 1";
                    $query = mysqli_query($db_conx, $sql);
                    while($row = mysqli_fetch_array($query)){
                        $desc = $row[0];
                        $price = $row[1];
                        $img = $row[2];
                    }
                    
                    $message .='<tr>
                    <td style="width:40%; border-bottom:1px solid pink; color:grey;"><img src="joolsmen.com/admin/stockIMGs/'.$img.'" style="margin:10px;" width="50px" height="50px"></td>
                    <td style="width:40%; border-bottom:1px solid pink; color:grey;">'.$desc.'</td>
                    <td style="width:20%; border-bottom:1px solid pink; color:grey;">'.$price.'</td>
                    <td style="width:20%; border-bottom:1px solid pink; color:grey;">'.$qtyArr[$i].'</td>
                                </tr>';
                    
                }
    $message .='</table>
                 </div>  
                 <div>
                <p style="color:red;">Purchase may have been declined for wrong Transaction ID or Payment failure or Item not being available.</p>
                <p style="padding:10px;">Kindly call 0541040442 for further information on decline and support.</p>
                </div>
                </div>
                </div>';
    $headers = "From: checkout@delzthriftbags.com\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";                                
                    
    if(mail($email,$subject,$message,$headers)){
        $sql = "DELETE FROM sales WHERE transID='$tid' AND clientID='$cid'";
        $query = mysqli_query($db_conx, $sql);
        $cSql = "UPDATE cart SET paid='0' WHERE clientID='$cid'";
        $cQuery = mysqli_query($db_conx, $cSql);
        header("location: ../conCheckoutFailure.php");
        exit();
    }
    
    
}


?>