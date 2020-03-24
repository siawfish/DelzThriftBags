<?php
require_once('../assets/dbConnection.php');
?>

<div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Clients List</h3>
                    </div>
                    <div class="panel-body">
                      
                        <div class="filter">
                            <input type="text" placeholder="Filter Clients">
                        </div>
                        <div style="overflow:auto">
                        <!-- Table -->
                        <table class="table table-hover">
                            <thead class='thead'>
                            <tr>
                                <td>Signup Date</td>
                                <td>Name</td>
                                <td>Phone</td>
                                <td>Email</td>
                                <td>Location</td>
                                <td>Activation</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * FROM clients";
                            $query= mysqli_query($db_conx, $sql);
                            if(mysqli_num_rows($query)<1){
                                echo'<div class="text-center" style="padding:20px; color:black;">-- No one has signed up yet --</div>';
                                exit();
                            }
                            while($row=mysqli_fetch_array($query)){
                                $clientID = $row['id'];
                                $fname = $row['fName'];
                                $lname = $row['lName'];
                                $phone = $row['phone'];
                                $email = $row['email'];
                                $epass = $row['password'];
                                $loc = $row['location'];
                                $signup = $row['signup'];
                                $activated = $row['activated'];

                                if($activated=='1'){
                                    $i = 'ok';
                                }else{
                                    $i = 'remove';
                                }
                            ?>
                           
                            <tr class="client">

                                <td><?php echo $signup?></td>

                                <td><?php echo $fname.' '.$lname?></td>

                                <td><?php echo $phone?></td>

                                <td><?php echo $email?></td>

                                <td><?php echo $loc?></td>

                                <td><span class="glyphicon glyphicon-<?php echo $i?>"></span></td>
                                <td>
                                    <?php 
                                    if($activated=='0'){
                                        echo'<span data-ph="'.$phone.'" data-p="'.$epass.'" id="activate" class="glyphicon glyphicon-check btn btn-primary"></span>';
                                        }
                                    ?>
                                     <span data-cid="<?php echo $clientID?>" data-p="<?php echo $epass?>" id="deleteClient" class="glyphicon glyphicon-trash btn btn-danger"></span>
                                    </td>
                            </tr>

                            <?php
                             }
                             ?>
                        </table>
                    </div>
                    </div>
                  </div>