<?php
include("connection/connect.php"); 
session_start();


$catID=$_GET["c_id"];
$proID=$_GET["p_id"];
$userID=$_SESSION["user_id"];
$quantity=$_POST["quantity"];
$price=$_GET["price"];

$sel= "SELECT * FROM cart WHERE d_id='$proID' AND u_id='$userID' AND c_id='$catID' AND cart_status=1";
if ($res = mysqli_query($db, $sel)) {
    if (mysqli_num_rows($res) > 0) {	
        while ($row = mysqli_fetch_array($res)) {
            $cartID=$row["cart_id"];
            $prequantity=$row["quantity"];
        }
    }
}
$newquantity=$prequantity+$quantity;





$sel2= "SELECT * FROM cart WHERE d_id='$proID' AND u_id='$userID' AND c_id='$catID' AND cart_status=1";
if ($res2 = mysqli_query($db, $sel2)) {
    if (mysqli_num_rows($res2) == 1)
    {

        $updata="UPDATE cart SET quantity='$newquantity' WHERE cart_id=$cartID";
mysqli_query($db, $updata); 

header("location:dishes.php?c_id=$catID");

    }
    else
    {
        $ins="INSERT INTO cart VALUES(NULL,'$proID','$userID','$catID','$quantity','$price',1)";
mysqli_query($db, $ins); 
header("location:dishes.php?c_id=$catID");

    }
}







?>