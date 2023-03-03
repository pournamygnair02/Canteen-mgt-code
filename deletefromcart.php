<?php
include("connection/connect.php");
session_start();


$u_id=$_SESSION["user_id"];
$d_id=$_GET["d_id"];
$catID=$_GET["c_id"];


$del="DELETE FROM cart WHERE d_id='$d_id'";
mysqli_query($db, $del);
header("location:dishes.php?c_id=$catID");


?>