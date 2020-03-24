<?php
if(!$_POST) exit();

require_once('checkStatus.php');

$itemNo = $_POST['itemNo'];
if($itemNo !== "" & is_numeric($itemNo)){
    $sql = "DELETE FROM cart WHERE itemNo='$itemNo'";
    $query = mysqli_query($db_conx, $sql);
    if(!$query){
        echo "remove query failed";
        exit();
    }
}
?>