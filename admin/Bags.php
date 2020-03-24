<?php
require_once('../assets/dbConnection.php');
?>


<div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> All Bags</h3>
                    </div>
                    <div class="panel-body">
                      
                        <div class="filter">
                            <input type="text" placeholder="Filter Bags">
                        </div>
                        <div style="overflow:auto">
                        <!-- Table -->
                        <table class="table table-hover">
                            <thead class='thead'>
                            <tr>
                                <td></td>
                                <td>Post Date</td>
                                <td>Item #</td>
                                <td>Description</td>
                                <td>Price</td>
                                <td>Qty</td>
                                <td>Available</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <?php
                            $sql="SELECT * FROM items GROUP BY itemNo";
                            $query=mysqli_query($db_conx, $sql);
                            if(mysqli_num_rows($query)<1){
                                echo'<div class="text-center" style="padding:20px; color:black;">-- You have not made any bag post yet --</div>';
                                exit();
                            }
                            while($row=mysqli_fetch_array($query)){
                                $aDate = $row['dateAdded'];
                                $itemNo = $row['itemNo'];
                                $desc = $row['descr'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $img = $row['img1'];
                                $avail = $row['avail'];

                                if($avail=='0'){
                                    $i = 'ok';
                                }else{
                                    $i = 'remove';
                                }
                            ?>

                            <tr class="bag">
                                <td><img src="stockIMGs/<?php echo $img?>" width=50px height=50px></td>
                                <td><?php echo $aDate?></td>
                                <td><?php echo $itemNo?></td>
                                <td><?php echo $desc?></td>
                                <td><?php echo $price?></td>
                                <td><?php echo $qty?></td>
                                <td><span class="glyphicon glyphicon-<?php echo $i;?>"></span></td>
                                <td><span data-item="<?php echo $itemNo;?>" id="removeItem" class="glyphicon glyphicon-trash btn btn-danger"></span></td>
                            </tr>

                            <?php
                            }
                            ?>
                            
                        </table>
                    </div>
                    </div>
                  </div>