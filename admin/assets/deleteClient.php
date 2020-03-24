<?php
if(!$_POST) exit();

if(isset($_POST['cid']) && isset($_POST['p'])){
    require_once('../../assets/dbConnection.php');

    $cid = $_POST['cid'];
    $p = mysqli_real_escape_string($db_conx, $_POST['p']);

    if(!is_numeric($cid) || strlen($p) == ""){
        // Log this issue into a text file and email details to yourself
            echo "activation string type/length issues";
            exit(); 
        }

    $sql = "SELECT password FROM clients WHERE id='$cid'";
    $query = mysqli_query($db_conx, $sql);
    if(mysqli_num_rows($query)<1){
        echo "hmm! client can not be found in system";
        exit();
    }
    while($row=mysqli_fetch_array($query)){
        $pass = $row[0];
    }
    if($pass == $p){
        $sql = "DELETE FROM clients WHERE id='$cid'";
        $query = mysqli_query($db_conx, $sql);
        if($query){
            echo "Client has been deleted successfully";
            exit();
        } else {
            echo "Client could not be deleted";
            exit();
        }
    } else {
        echo "Something went horribly wrong, let Gerald Know";
        exit();
    }
}
?>