<?php
require_once("dbConnection.php");

$tbl_clients = "CREATE TABLE IF NOT EXISTS clients (
    id INT(11) NOT NULL AUTO_INCREMENT,
    fName VARCHAR(50) NOT NULL,
    lName VARCHAR(50) NOT NULL,
    phone INT(10) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    location VARCHAR(255) NULL,
    ip VARCHAR(255) NULL,
    userlevel ENUM('a','b','c','d') NOT NULL DEFAULT 'a',
    signup DATETIME NOT NULL,
    lastlogin DATETIME NOT NULL,
    notescheck DATETIME NOT NULL,
    activated ENUM('0','1') NOT NULL DEFAULT '0',
    adminAcc ENUM('0','1') NOT NULL DEFAULT '0',
    PRIMARY KEY (id),
    UNIQUE KEY email (phone)
   )";

$query = mysqli_query($db_conx, $tbl_clients);
if ($query === TRUE) {
echo "<h3>Clients table created OK :) </h3>"; 
} else {
echo "<h3>Clients table NOT created :( </h3>"; 
}
////////////////////////////////////

$tbl_items = "CREATE TABLE IF NOT EXISTS items (
    id INT(11) NOT NULL AUTO_INCREMENT,
    itemNo INT(25) NOT NULL,
    category VARCHAR(50) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    descr VARCHAR(225) NOT NULL,
    price INT(20) NOT NULL,
    qty INT(20) NULL,
    img1 VARCHAR(225) NULL,
    avail ENUM('0','1') NOT NULL DEFAULT '0',
    ownerID INT(11) NULL,
    dateAdded DATETIME NOT NULL,
    PRIMARY KEY (id)
)";

$query = mysqli_query($db_conx, $tbl_items);
if ($query === TRUE) {
echo "<h3>Items table created OK :) </h3>"; 
} else {
echo "<h3>Items table NOT created :( </h3>"; 
}
////////////////////////////////////

$tbl_cart = "CREATE TABLE IF NOT EXISTS cart (
    id INT(11) NOT NULL AUTO_INCREMENT,
    itemNo INT(25) NOT NULL,
    clientID INT(11) NOT NULL,
    price INT(25) NOT NULL,
    qty INT(11) NOT NULL,
    addedDate DATETIME NOT NULL,
    paid ENUM('0','1') NOT NULL DEFAULT '0',
    PRIMARY KEY (id)
)";

$query = mysqli_query($db_conx, $tbl_cart);
if ($query === TRUE) {
echo "<h3>Cart table created OK :) </h3>"; 
} else {
echo "<h3>Cart table NOT created :( </h3>"; 
}
////////////////////////////////////

$tbl_sales = "CREATE TABLE IF NOT EXISTS sales (
    id INT(11) NOT NULL AUTO_INCREMENT,
    transID VARCHAR(15) NOT NULL,
    itemNo INT(25) NOT NULL,
    clientID INT(11) NOT NULL,
    price INT(25) NOT NULL,
    qty INT(11) NOT NULL,
    subtotal INT(25) NOT NULL,
    pdate DATETIME NOT NULL,
    confirmed ENUM('0','1') NOT NULL DEFAULT '0',
    PRIMARY KEY (id)
)";

$query = mysqli_query($db_conx, $tbl_sales);
if ($query === TRUE) {
echo "<h3>Sales table created OK :) </h3>"; 
} else {
echo "<h3>Sales table NOT created :( </h3>"; 
}
////////////////////////////////////

$tbl_wallet = "CREATE TABLE IF NOT EXISTS wallet (
    id INT(11) NOT NULL AUTO_INCREMENT,
    itemNo INT(25) NOT NULL,
    clientID INT(11) NOT NULL,
    amount INT(25) NOT NULL,
    total INT(225) NOT NULL,
    refunded ENUM('0','1') NOT NULL DEFAULT '0',
    PRIMARY KEY (id)
)";

$query = mysqli_query($db_conx, $tbl_wallet);
if ($query === TRUE) {
echo "<h3>Wallet table created OK :) </h3>"; 
} else {
echo "<h3>Wallet table NOT created :( </h3>"; 
}
////////////////////////////////////


?>
