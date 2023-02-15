<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
?>   	
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
      $query = "SELECT count(order_details.d_id) AS number, dishes.title from dishes INNER JOIN order_details WHERE dishes.d_id=order_details.d_id GROUP BY order_details.d_id";

       $exec = mysqli_query($db,$query);
       while($row = mysqli_fetch_array($exec)){

       echo "['".$row['title']."',".$row['number']."],";
       }
       ?> 
 
 ]);

 var options = {
 title: 'Registered User Gender Breakdown',
  pieHole: 0,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }
  
</script>
</head>  
 
 
 <?php include_once('header.php');?>  
 <div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>
<!-- End Container fluid  -->
<?php include_once('footer.php');?>      