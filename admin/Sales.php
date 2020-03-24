<?php
require_once('../assets/dbConnection.php')
?>

<div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title"><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span> Sales</h3>
                    </div>
                    <div class="panel-body">
                      
                        <div class="filter">
                            <input type="text" placeholder="Filter Sales">
                        </div>
                        <div style="overflow:auto">
                        <!-- Table -->
                        <table class="table table-hover">
                            <thead class='thead'>
                            <tr>
                                <td></td>
                                <td>Purchase Date</td>
                                <td>Item #</td>
                                <td>Description</td>
                                <td>Price</td>
                                <td>Qty</td>
                                <td>Buyer</td>
                            </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * FROM sales WHERE confirmed='1'";
                            $query = mysqli_query($db_conx, $sql);
                            if(mysqli_num_rows($query)<1){
                                echo'<div class="text-center" style="padding:20px; color:black;">-- No one has made a purchase yet --</div>';
                                exit();
                            }
                            while($row=mysqli_fetch_array($query)){
                                $pdate = $row['pdate'];
                                $qty = $row['qty'];
                                $price = $row['price'];
                                $itemNo = $row['itemNo'];
                                $clientID = $row['clientID'];
                            ?>
                            <tr>
                                <?php
                                $iSql = "SELECT img1, descr FROM items WHERE itemNo='$itemNo'";
                                $iQuery = mysqli_query($db_conx, $iSql);
                                while($iRow = mysqli_fetch_array($iQuery)){
                                    $img = $iRow[0];
                                    $desc = $iRow[1];
                                }
                                ?>
                                <td><img src="stockIMGs/<?php echo $img;?>" width=50px height=50px></td>
                                <td><?php echo $pdate;?></td>
                                <td><?php echo $itemNo;?></td>
                                <td><?php echo $desc;?></td>
                                <td><?php echo $price;?></td>
                                <td><?php echo $qty;?></td>
                                <?php
                                $cSql = "SELECT fName, lName FROM clients WHERE id='$clientID'";
                                $cQuery = mysqli_query($db_conx, $cSql);
                                while($cRow = mysqli_fetch_array($cQuery)){
                                    $fname = $cRow[0];
                                    $lname = $cRow[1];
                                }
                                ?>
                                <td><?php echo $fname.' '.$lname;?></td>
                            </tr>
                            <?php
                                }
                            ?>
                            
                        </table>
                    </div>
                    </div>
                  </div>