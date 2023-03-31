<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(!empty($_GET['staff_del']))
{
    // print_r($_GET['staff_del']);die;

    mysqli_query($db,"DELETE FROM staff WHERE st_id = '".$_GET['staff_del']."'");
    $error =   '<div class="alert alert-danger alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Recored Deleted</strong>
						</div>';
   // header("location:staff.php");
}
if(isset($_POST['submit']))          
{										  				
		if(empty($_POST['username'])||empty($_POST['role'])||empty($_POST['password']))
		{	
			$error =   '<div class="alert alert-danger alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>All fields Must be Fillup!</strong>
						</div>';															
		}
	    else
	   {
            $check_cat= mysqli_query($db, "SELECT username FROM staff where username = '".$_POST['username']."' ");
           
            if(mysqli_num_rows($check_cat) > 0)
            {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>UserName already exist!</strong>
                        </div>';
            }
            else
            {			           				
                            // print_r($fnew);die;																																						                                 
					$sql = "INSERT INTO staff(username,role,password) VALUE('".$_POST['username']."','".$_POST['role']."','".md5($_POST['password'])."')";  // store the submited data ino the database :images
					mysqli_query($db, $sql); 	  
					$success = '<div class="alert alert-success alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<strong>New Staff Member Added Successfully.</strong>
										</div>';               				
             }                     	   
	   }
}
?>
<?php include_once('header.php');?>
<style>
    th,td
    {
        padding-left:20px;
        padding-right:20px;
        padding-top:30px;
        padding-bottom:30px;
        color:black;
        font-weight:bold;

    }
    </style>
<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Staff</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Staff</li>
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <div class="container-fluid"> 
                <!-- Start Page Content -->                 							
                <?php 
                       echo $error;
                       echo $success;
                 ?>											
					<div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Leave Applications</h4>
                            </div>
                            <div class="card-body">
                             
                            </div>
                        </div>
                     </div>		

                     <div class="col-12"> 
                        <div class="card" >
                            <div class="card-body" >
                           
                                <div class="table-responsive m-t-40">
                                    <table border="2">
                                      
                                    <tr>
                                                <th>Name</th>
                                                <th>Sending Date</th>		
                                                <th>Leave Type</th>
                                                <th>Reason For Leave</th>
                                                <th>From Date</th>	
												<th>To Date</th>												
												 <th>Status</th>
                                                 <th>ACTION</th>
												 
                                            </tr>
                                    
                                           
											
											<?php
                                            session_start();
                                            $val=$_SESSION['st_id'];
                                            //echo $val;
	$sql="select tbl1.*,tbl2.* from staff as tbl1 inner join leavetable as tbl2 on tbl1.st_id=tbl2.st_id ";
												$query=mysqli_query($db,$sql);
		while($row=mysqli_fetch_array($query))
																	{
                                                                       ?>	
                                                                       <tr>
                                                                        <td><?php echo $row['username'];?></td>
                                                                        <td><?php echo $row['senddate'];?></td>
                                                                        <td><?php echo $row['ltype'];?></td>
                                                                        <td><?php echo $row['lreason'];?></td>
                                                                        <td><?php echo $row['fdate'];?></td>
                                                                        <td><?php echo $row['tdate'];?></td>
                                                                        <td><?php echo $row['status'];?></td>
                                                                        <?php
                                                                        if($row['status']=="pending")
                                                                        {
                                                                            ?>
                                                                            <td>
    <a href="approve.php?id=<?php echo $row['lid'];?>"><i class="fa fa-check" style="color:green; font-size:18px;"></i>&nbsp&nbsp
    <a href="reject.php?id=<?php echo $row['lid'];?>"><i class="fa fa-trash-o" style="color:red; font-size:18px;"></i>
    <?php       
                                                                        }
                                                                        ?>
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