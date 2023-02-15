<?php
include("../connection/connect.php");
$id=$_GET['id'];
$sql=mysqli_query($db,"update leavetable set status='Approved' where lid='$id'");
header('location:viewleave.php');
?>