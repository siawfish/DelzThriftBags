<?php
require_once("../../assets/dbConnection.php");

if (isset($_POST['desc'])){
    $desc = $_POST['desc'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $cate = $_POST['cate'];
    $qty = $_POST['qty'];

    function itemNo($length) {
        $result = '';
    
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
    
        return $result;
    }

    $itemNo = itemNo(6);

    if($desc == "" || $brand == "" || $price == "" || $cate == "" || $qty == "" || $_FILES["upIMG"] == ""){
        echo "<div class='error'>Complete the form Delali</div>";
        exit();
    }else if($cate == "select"){
        echo "<div class='error'>Delali what category is this?</div>";
        exit();
    }else if(!is_numeric($price)){
        echo "<div class='error'>Delali you put letter for price</div>";
        exit();
    }else if(!is_numeric($qty)){
        echo "<div class='error'>Delali you put letter for quantity</div>";
        exit();
    }

    if(isset($_FILES['upIMG'])){
        $name_array = $_FILES['upIMG']['name'];
        $tmp_name_array = $_FILES['upIMG']['tmp_name'];
        $type_array = $_FILES['upIMG']['type'];
        $size_array = $_FILES['upIMG']['size'];
        $error_array = $_FILES['upIMG']['error'];

        // if (!file_exists("../stockIMGs/$itemNo")) {
		// 	$imgFold = mkdir("../stockIMGs/$itemNo", 0755);
        // }
        if(count($tmp_name_array)>4){
            echo "<div class='error'>Not more than 4 images, remember?</div>";
            exit();
        }
        for($i = 0; $i < count($tmp_name_array); $i++){
            $image =$tmp_name_array[$i];
            $name = basename($name_array[$i]);
            if(move_uploaded_file($image, "../stockIMGs/".$name)){
                $error = false;
                $val = $name_array[$i];
                $sql = "INSERT INTO items (itemNo, category, brand, descr, price, qty, img1, dateAdded) VALUES ('$itemNo', '$cate', '$brand', '$desc', '$price', '$qty', '$val', NOW())";
                if(mysqli_query($db_conx, $sql)){
                    $error = false;
                } else {
                    $error = true;
                    echo "<div class='error'>Sorry Delali something wrong happened, Let Gerald know</div>";
                }   
        }else {
            $error = true;
            echo "<div class='error'>Move file function broke</div>";
            exit();
        }
            
            }
        }

        if($error == false){
            echo "<div class='success'>";
            echo "<div class='success'>Successful bag post</div><br/>";
            echo "<div style='color:grey;'>Item No. - $itemNo</div><br/>";
            echo "<small style='color:pink;'>Goodluck</small>";
            echo "</div>";
        } else {
            echo "<div class='error'>Bag post unsuccessful</div>";
            exit();
        }


}
?>