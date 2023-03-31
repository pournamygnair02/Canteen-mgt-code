<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
<style>
    th,td
    {
        padding-left:30px;
        padding-right:40px;
        padding-top:30px;
        padding-bottom:30px;
        color:black;
        font-weight:bold;

    }
    </style>
<?php include_once('header.php');?> 

            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        
                       
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Leave Status</h4>
                             
                                <div class="table-responsive m-t-40">
                                <table border="2">
                                     
                                            <tr>
                                             
                                                <th>Sending Date</th>		
                                                <th>Leave Type</th>
                                                <th>Reason For Leave</th>
                                                <th>From Date</th>	
												<th>To Date</th>												
												 <th>Status</th>
												 
                                            </tr>
                                    
                                           
											
											<?php
                                            session_start();
                                            $val=$_SESSION['st_id'];
                                            //echo $val;
                                            $i=0;
	$sql="select * from leavetable where st_id='$val'";
												$query=mysqli_query($db,$sql);
		while($row=mysqli_fetch_array($query))
																	{
                                                                        $i++;
                                                                       ?>	
                                                                       <tr>
                                                                       <td><?php echo $i ;?></td>
                                                                        <td><?php echo $row['senddate'];?></td>
                                                                        <td><?php echo $row['ltype'];?></td>
                                                                        <td><?php echo $row['lreason'];?></td>
                                                                        <td><?php echo $row['fdate'];?></td>
                                                                        <td><?php echo $row['tdate'];?></td>
                                                                        <td><?php echo $row['status'];?></td>
                                                                    </tr>
                                                         <?php       
													}																							
											?>                                                                                                                      
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