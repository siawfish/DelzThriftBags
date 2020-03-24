<?php

require_once('../assets/dbConnection.php');

$cSql = "SELECT * FROM clients";
$cQuery = mysqli_query($db_conx, $cSql);
$clientCount = mysqli_num_rows($cQuery);

$items = [];

$iSql = "SELECT qty FROM items WHERE avail='0' GROUP BY itemNo";
$iQuery= mysqli_query($db_conx, $iSql);
while($row = mysqli_fetch_array($iQuery)){
    $items[] = $row[0];
};

$price = [];

$sSql = "SELECT subtotal FROM sales WHERE confirmed='1'";
$sQuery = mysqli_query($db_conx, $sSql);
while($row=mysqli_fetch_array($sQuery)){
    $price[] = $row[0];
}

$cSql = "SELECT * FROM cart WHERE paid='0'";
$cQuery= mysqli_query($db_conx, $cSql);
$cartCount = mysqli_num_rows($cQuery);

?>
    
    <div class="container-fluid" style="padding-bottom:10px;">
    <div id='cardRow' class='row'>
        <ul class="cardsList">
        
           <li class="col-md-3 noPad" data-page="Clients">

            <div class="card">
                <div class="col-xs-6">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <div class="figures">
                            <span><?php echo $clientCount?></span>
                        </div>
                    </div>
                <div class="col-xs-6">
                    <span class="title">Clients</span>
                </div>
            </div>

            </li>

            
           <li class="col-md-3 noPad"  data-page="Bags">

            <div class="card">
                <div class="col-xs-6">
                    <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                        <div class="figures">
                            <span><?php echo array_sum($items)?></span>
                        </div>
                    </div>
                <div class="col-xs-6">
                    <span class="title">Bags</span>
                </div>
            </div>


            </li>


           <li class="col-md-3 noPad" data-page="Sales">

            <div class="card">
                <div class="col-xs-6">
                    <span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>
                        <div class="figures">
                            <span><?php echo '&cent;'.array_sum($price)?></span>
                        </div>
                    </div>
                <div class="col-xs-6">
                    <span class="title">Sales</span>
                </div>
            </div>


            </li>


           <li class="col-md-3 noPad" data-page="Cart">

            <div class="card">
                <div class="col-xs-6">
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                        <div class="figures">
                            <span><?php echo $cartCount?></span>
                        </div>
                    </div>
                <div class="col-xs-6">
                    <span class="title">Cart</span>
                </div>
            </div>

            </li>


           </ul>
           </div>
    </div>
<div id="dashContent">
    <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> Pending Transactions</h3>
                    </div>
                    <div class="panel-body">
                      
                        <div class="filter">
                            <input type="text" placeholder="Filter Transactions">
                        </div>
                        <div class="pending" style="overflow:auto">
                        <!-- Table -->
                        <table class="table table-hover">
                            <thead class='thead'>
                            <tr>
                                <td>Date</td>
                                <td>TransID</td>
                                <td>Sender</td>
                                <td>Amount</td>
                                <td>Units</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * FROM sales WHERE confirmed='0' GROUP BY 'transID'";
                            $query = mysqli_query($db_conx, $sql);
                            if(mysqli_num_rows($query)<1){
                                echo "<div class='text-center' style='padding:20px; color:black;'>-- No pending transactions --</div>";
                                exit();
                            }
                            while($row=mysqli_fetch_array($query)){
                                $pdate = $row['pdate'];
                                $transID = $row['transID'];
                                $clientID = $row['clientID'];
                            ?>
                            <tr>
                                <td><?php echo $pdate?></td>
                                <td><?php echo $transID?></td>
                                <?php
                                $cSql = "SELECT fName, lName FROM clients WHERE id='$clientID' LIMIT 1";
                                $cQuery = mysqli_query($db_conx, $cSql);
                                while($cRow=mysqli_fetch_array($cQuery)){
                                    $fname = $cRow[0];
                                    $lname = $cRow[1];
                                }
                                ?>
                                <td><?php echo $fname.' '.$lname?></td>
                                <?php
                                $aSql = "SELECT subtotal FROM sales WHERE confirmed='0' AND transID='$transID'";
                                $aQuery = mysqli_query($db_conx, $aSql);
                                while($aRow=mysqli_fetch_array($aQuery)){
                                    $subTotalArr[] = $aRow[0];
                                }
                                ?>
                                <td>&cent;<?php echo array_sum($subTotalArr)+20;?></td>
                                <?php
                                $qSql = "SELECT qty FROM sales WHERE confirmed='0' AND transID='$transID'";
                                $qQuery = mysqli_query($db_conx, $qSql);
                                while($qRow=mysqli_fetch_array($qQuery)){
                                    $qtyArr[] = $qRow[0];
                                }
                                ?>
                                <td><?php echo array_sum($qtyArr);?></td>
                                <td><span id='Yes' data-cid='<?php echo $clientID?>' data-tid='<?php echo $transID?>' class="glyphicon glyphicon-check btn btn-primary"></span> <span id='No' data-cid='<?php echo $clientID?>' data-tid='<?php echo $transID?>'  class="glyphicon glyphicon-trash btn btn-danger"></span></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </table>
                    </div>
                    </div>
                    </div>
                  </div>
