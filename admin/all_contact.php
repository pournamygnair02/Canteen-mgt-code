<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
<?php include_once('header.php');?> 
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style>.progress {
  height: 20px;
  border-radius: 10px;
  width:60%;
  margin-left:20%px;
  background-color: lightgray;
  overflow: hidden;
}

.progress-bar {
  height: 100%;
  transition: width 0.5s ease;
}</style>
</head>

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Feedback</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Feedback</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        
                       
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">User Feedback</h4>
                                <?php
 $sql = "SELECT message from contact_us";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    // Output data of each row
    $texts = array();
    while($row = $result->fetch_assoc()) {
        $texts[] = $row["message"];
    }
    $url = 'http://127.0.0.1:5000/sentiment';
    $data = json_encode(array('texts' => $texts));
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => $data,
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $overall_sentiment = json_decode($result, true)['sentiment'];
$neg=100 - ($overall_sentiment * 100);
} else {
    echo "No comments found";
}
?>


&nbsp;<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo abs($overall_sentiment) * 100; ?>%; background-color:orange;">
  </div>
</div>
<span>&nbsp;Positive &nbsp;<?php  echo abs($overall_sentiment) * 100;?> %</span>
&nbsp;<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $neg; ?>%; background-color:blue;">
  </div>
  </div>
  <span>&nbsp;Negative&nbsp;<?php  echo $neg;?> %</span>
    <br><br><br>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SR.No</th>
                                                <th> Name</th>		
                                                <th>Email</th>
                                                <th>Message</th>
												<th>Action</th>
												 
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
											
											<?php
												$sql="SELECT * from contact_us order by id desc";
												$query=mysqli_query($db,$sql);
												
													if(!mysqli_num_rows($query) > 0 )
													{
															echo '<td colspan="8"><center>No Orders-Data!</center></td>';
													}
													else
													{			
                                                        $i=1;
																	while($rows=mysqli_fetch_array($query))
																	{
                                                                        																
											?>
																				<?php
																				  echo ' <tr>
                                                                                                <td>'.$i.'</td>
																					           <td>'.$rows['name'].'</td>
																								<td>'.$rows['email'].'</td>
																								<td>'.$rows['message'].'</td>';
																								
																				?>
																								
																								    <td>
																									     <a href="delete_orders.php?order_del=<?php echo $rows['o_id'];?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																								
																			
																									</td>
																		                     </tr>';	
                                                                        $i++;
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