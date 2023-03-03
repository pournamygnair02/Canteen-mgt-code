<?php
include("connection/connect.php");
session_start();
$date=date("Y-m-d");

$u_id=$_SESSION["user_id"];
$pickuptime=$_POST["pickuptime"];
 $sql="SELECT tbl1.c_id,tbl1.d_id,tbl1.cart_status,tbl1.quantity AS cartquantity,tbl2.*,tbl3.* from cart AS tbl1 INNER JOIN dishes AS tbl2 ON tbl1.d_id=tbl2.d_id INNER JOIN res_category AS tbl3 ON tbl3.c_id=tbl1.c_id WHERE cart_status=1 AND u_id=$u_id";
 $result=$db-> query($sql);
 if ($result-> num_rows > 0)
 {
 while ($row=$result-> fetch_assoc()) 
 {
    $catID=$row["c_id"];
    $dishID=$row["d_id"];
    $quantity=$row["cartquantity"];
    $price=$row["price"];
    
$ins="INSERT INTO users_orders VALUES (NULL,'$u_id','$catID','$dishID','$quantity','$price','1','$pickuptime','$date')";
mysqli_query($db, $ins);



 }
}
?>

<?php
$del="UPDATE CART SET cart_status=0 AND u_id='$u_id'";
mysqli_query($db, $del);



header("location:your_orders.php");


?>