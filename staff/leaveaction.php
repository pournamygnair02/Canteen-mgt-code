<?php
include("../connection/connect.php");
$id=$_POST['id'];
$n=$_POST['name'];
$lt=$_POST['ltype'];
$fd=$_POST['fdte'];
$ld=$_POST['tdte'];
$lr=$_POST['lreason'];
$dte=date('Y-m-d');
$sql=mysqli_query($db,"insert into leavetable(st_id,name,ltype,fdate,tdate,lreason,senddate,status)values('$id','$n','$lt','$fd','$ld','$lr','$dte','pending')");
header('location:dashboard.php');
?>