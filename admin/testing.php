<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
 <?php include_once('header.php');?>
 <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">All Users</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">All Users</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
            <head>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
<script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([

 ['Gender','Number'],
 <?php 
      $query = "SELECT users_orders.quantity AS number, dishes.title from dishes INNER JOIN users_orders WHERE dishes.d_id=users_orders.d_id GROUP BY users_orders.d_id";

       $exec = mysqli_query($db,$query);
       while($row = mysqli_fetch_array($exec)){

       echo "['".$row['title']."',".$row['number']."],";
       }
       ?> 
 
 ]);

 var options = {
 title: 'Sales analysis ',
  pieHole: 0,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };
 var chart = new google.visualization.BarChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }
  
</script>
</head>  
<div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>
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
			
			
			
			
            <!-- footer -->
<?php include_once('footer.php');?>

<script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js">
</script>