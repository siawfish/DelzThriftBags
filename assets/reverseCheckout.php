<?php
if(!$_POST) exit();

require_once('dbConnection.php');

$itemNoArr = $_POST['itemNoArr'];
$qtyArr = $_POST['qtyArr'];
$clientID = $_POST['clientID'];

function reverse($clientID,$itemNo,$qty,$db_conx){
    $sql = "SELECT qty, avail FROM items WHERE ownerID='$clientID' AND itemNo='$itemNo' LIMIT 1";
    $query = mysqli_query($db_conx,$sql);
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
            $sql = "UPDATE items SET qty='$restore', ownerID=0 WHERE itemNo='$itemNo'AND avail='$avail'";
            $query = mysqli_query($db_conx, $sql);
        }
     return true;
}

for($i=0; $i<count($itemNoArr); $i++){
    $itemNo = $itemNoArr[$i];
    $qty  = $qtyArr[$i];

    if(!reverse($clientID,$itemNo,$qty,$db_conx)){
        echo "error!";
    } else {
        echo "success!";
    }

}
?>