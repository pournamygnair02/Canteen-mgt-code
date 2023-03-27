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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    $texts = array();
    while ($row = $result->fetch_assoc()) {
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
    $result = json_decode($result, true);

    $positive = $result['positive'];
    $negative = $result['negative'];
    $neutral = $result['neutral'];
    $total = $positive + $negative + $neutral;

    $pos_percent = ($positive / $total) * 100;
    $neg_percent = ($negative / $total) * 100;
    $neu_percent = ($neutral / $total) * 100;
    $pos_accuracy = ($pos_percent > $neg_percent) ? $pos_percent : (100 - $neg_percent);
    $neg_accuracy = ($neg_percent > $pos_percent) ? $neg_percent : (100 - $pos_percent);
    $neutral_accuracy = ($neu_percent > ($pos_percent + $neg_percent)) ? $neu_percent : (100 - ($pos_percent + $neg_percent));

   } else {
    echo "No feedback data found in the database.";
    $pos_percent = 0;
    $neg_percent = 0;
    $neu_percent=0;
    $neu_percent = 0;
    $pos_accuracy = 0;
    $neg_accuracy = 0;
    $neu_accuracy = 0;
    $neutral_accuracy=0;
}

?>



    <br><br><br>
    <div class="content">
<div class="module">
<div class="module-head">
<div class="container-fluid">        
    <h1>Feedback Analysis </h1>
    <div class="chart-container">
        <canvas id="sentiment-chart"></canvas>
    </div>
    <div>
    <p>Positive Accuracy: <?php echo $pos_accuracy; ?>%</p>
    <p>Negative Accuracy: <?php echo $neg_accuracy; ?>%</p>
    <p>Neutral Accuracy: <?php echo $neutral_accuracy; ?>%</p>
</div>
</div>
</div>
</div>
</div>
    <script>
        var ctx = document.getElementById('sentiment-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Positive', 'Negative', 'Neutral'],
                datasets: [{
                    label: 'Sentiment Analysis percentage',
                    data: [<?php echo $pos_percent; ?>, <?php echo $neg_percent; ?>, <?php echo $neu_percent; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10,
                            max: 100
                        }
                    }
                }
            }
        });
    </script>
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
                                                                                $o_id=$rows['id'];
																				  echo ' <tr>
                                                                                                <td>'.$i.'</td>
																					           <td>'.$rows['name'].'</td>
																								<td>'.$rows['email'].'</td>
																								<td>'.$rows['message'].'</td>';
                                                                                                
																								
																			?>
																								
																								    <td>
																									     <a href="delete_orders.php?order_del=<?php echo $o_id?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																								
																			
																									</td>
																		                     </tr>	
                                                                       <?php
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