<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
<?php include_once('header.php');?>
<style type="text/css" rel="stylesheet">


.indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.datepicker-dropdown {
  z-index: 200 !important;
}
.panel-body {
  background: #e5e5e5;
  /* Old browsers */
  background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* FF3.6+ */
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
  /* Chrome,Safari4+ */
  background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Opera 12+ */
  background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* IE10+ */
  background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
  /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
  /* IE6-9 fallback on horizontal gradient */
  font: 600 15px "Open Sans", Arial, sans-serif;
}
label.control-label {
  font-weight: 600;
  color: #777;
}








table { 
	width: 650px; 
	border-collapse: collapse; 
	margin: auto;
	margin-top:50px;
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #004684; 
	color: white; 
	font-weight: bold; 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 14px;
	}



	</style>
</head>

<body>

<div style="margin-left:50px;">
 <form action="leaveaction.php" id="" method="post"> 
<table  >
		<?php
    include("../connection/connect.php");
    session_start();
    $val=$_SESSION['st_id'];
    $sql=mysqli_query($db,"select * from staff where st_id='$val'");
    while($row=mysqli_fetch_array($sql))
    {
?>
<input type="hidden" name="id" value="<?php echo $row['st_id'];?>">
        <tr><td>Name</td>
      <td ><input type="text" name="name" value="<?php echo $row['username'];?>" readonly></td>
      
    </tr>
    <?php
    }
    ?>
    
    <tr>
      <td  >&nbsp;</td>
      
    </tr>
    <tr>
      <td>Leave Type</td>
      <td><input type="text" name="ltype" required></td>
    </tr>
	
	<tr>
      <td>From Date</td>
      <td><input type="date" name="fdte" min="<?php echo date('Y-m-d');?>" style="width:180px; height:30px;"></td>
    </tr>
    <tr>
      <td>To Date</td>
      <td><input type="date" name="tdte" min="<?php echo date('Y-m-d');?>" style="width:180px; height:30px;"></td>
    </tr>
	<tr>
      <td>Submit Reason For leave days</td>
      <td><textarea name="lreason"></textarea></td>
    </tr>
	
    <tr>
  
      <td colspan="2">   
      <input name="Submit2" type="submit" class="btn btn-danger" value="SEND LEAVE REQUEST " onClick="" style="cursor: pointer;"  /></td>
    </tr>
   
    
 
 
</table>
 </form>
</div>

</body>
</html>
