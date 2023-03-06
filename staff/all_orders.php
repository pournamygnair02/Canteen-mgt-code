<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
<?php include_once('header.php');?>

            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        
                       
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All user Orders</h4>
                             
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Customer name</th>		
                                                <th>Dish Name</th>
                                                <th>Quantity</th>
                                                <th>price</th>	
												<th>status</th>		
                                                <th>Pickup Time</th>												
												<th>Reg-Date</th>
												<th>Action</th>
												 
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
											
											<?php
												$sql="SELECT users.*, users_orders.o_id,users_orders.u_id,users_orders.d_id,users_orders.quantity AS orderquantity, users_orders.status AS orderstatus,users_orders.pick_time AS orderpicktime,dishes.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id INNER JOIN dishes ON dishes.d_id=users_orders.d_id order by users_orders.o_id desc ";
												$query=mysqli_query($db,$sql);
												
													if(!mysqli_num_rows($query) > 0 )
														{
															echo '<td colspan="8"><center>No Orders-Data!</center></td>';
														}
													else
														{				
																	while($rows=mysqli_fetch_array($query))
																		{
																																							
																				?>
																				<?php
																					echo ' <tr>
																					           <td>'.$rows['username'].'</td>
																								<td>'.$rows['title'].'</td>
																								<td>'.$rows['quantity'].'</td>
																								<td>₹'.$rows['price'].'</td>';
                                                                                                
																								?>
																								
                                                                                                <?php 
                                                                                                    $status=$rows['orderstatus'];
                                                                                                    if($status=="1")
                                                                                                    {
                                                                                                    ?>
                                                                                                    <td> <button type="button" class="btn btn-primary"> <i class="fa fa-spinner fa-pulse"></i> <span></span>Pending</button></td> 
                                                                                                <?php 
                                                                                                    }
                                                                                                    if($status=="2")
                                                                                                    { ?>
                                                                                                    <td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span> <span></span>Preparing!</button></td> 
                                                                                                    <?php
                                                                                                        }
                                                                                                        if($status=="3")
                                                                                                        { ?>
                                                                                                        <td> <button type="button" class="btn btn-success" style="background-color: green;border:2px solid green"><span class="fa fa-shopping-bag"  aria-hidden="true" ></span> <span></span>Prepared</button></td> 
                                                                                                        <?php
                                                                                                            }
                                                                                                    if($status=="4")
                                                                                                        {
                                                                                                    ?>
                                                                                                    <td> <button type="button" class="btn btn-success"> <i class="fa fa-check-circle"></i> <span></span>Ready tp pick</button></td> 

                                                                                                    <?php 
                                                                                                    } 
                                                                                                    ?>
                                                                                                    <?php
                                                                                                    if($status=="5")
                                                                                                        {
                                                                                                    ?>
                                                                                                    <td> <button type="button" class="btn btn-danger"> <i class="fa fa-times-circle"></i> <span></span>Rejected</button></td> 
                                                                                                    <?php 
                                                                                                    } 
                                                                                                    ?>
                                                                                                    <?php
                                                                                                    if($status=="6")
                                                                                                    {
                                                                                                    ?>
                                                                                                    <td>  <button type="button" class="btn btn-info"> <i class="fa fa-check"></i> <span></span>Accepted</button></td> 
                                                                                                    <?php 
                                                                                                    }
                                                                                                     
                                                                                                    ?>
                                                                            
																						<?php	
                                                                                    		echo '	<td>'.$rows['orderpicktime'].'</td>';																				
																							echo '	<td>'.$rows['date'].'</td>';

																							?>
																									 <td>
																									 <!-- <a href="delete_orders.php?order_del=<?php echo $rows['o_id'];?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>  -->
																								<?php
																								echo '<a href="view_order.php?user_upd='.$rows['o_id'].'" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
																									</td>
																									</tr>';
																					 
																						
																						
																		}	
														}
												
											
											?>
                                             
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						 </div>
                      
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
			
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>


    <?php include_once('footer.php');?>