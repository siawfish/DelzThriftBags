<?php
if(!$_POST) exit();

require_once('../../assets/dbConnection.php');

if(isset($_POST['itemNo'])){
    $itemNo = $_POST['itemNo'];

    if($itemNo == ''){
        echo "Sorry an error occured!";
        exit();
    } else if(!is_numeric($itemNo)){
        echo "Sorry an error occured!";
        exit();
    } else {
        $sql = "DELETE FROM items WHERE itemNo='$itemNo'";
        $query = mysqli_query($db_conx, $sql);
        if($query){
            echo "Bag deleted successfully";
            exit();
        } else {
            echo "Couldn't delete bag, Lets Gerald know";
            exit();
        }
    }
}


?>