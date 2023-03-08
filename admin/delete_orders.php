<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
$O_ID=$_GET['order_del'];
?>
<script>alert(<?php echo $O_ID;?>)</script>

<?php
// sending query
mysqli_query($db,"DELETE FROM contact_us WHERE id = '$O_ID'");
header("location:all_contact.php");  

?>
