<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once('product-action.php');
$item_total=$_GET["subtotal"];
// error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else
{	
    $u_id=$_SESSION["user_id"];
    $sel= "select tbl1.quantity AS cartQuantity,tbl1.c_id,tbl1.cart_id,tbl1.d_id,tbl2.*,tbl3.* from cart AS tbl1 INNER JOIN res_category AS tbl2 ON tbl1.c_id=tbl2.c_id INNER JOIN dishes AS tbl3 ON tbl1.d_id=tbl3.d_id where u_id=$u_id and cart_status=1 GROUP BY tbl3.title ";
    if ($res = mysqli_query($db, $sel)) {
        if (mysqli_num_rows($res) > 0) {	
            while ($row = mysqli_fetch_array($res)) {

            }
        }
    }

    date_default_timezone_set("asia/kolkata");
   				
           		
              											
				if (isset($_POST['submit']))
				{	
                 
                    if(!empty($_POST['pickTime']))
                    {	
                        if(substr($_POST['pickTime'],0,2) < date("G"))
                        {              
                                $error = "Pick-Up Time Not Valid!";	                       
                        }
                        elseif(substr($_POST['pickTime'],0,2) == date("G"))
                        {                                     
                            if(substr($_POST['pickTime'],3,2) < date("i") + 20)
                            {                          
                                $error = "Please Select Time After 20  Minutes";	
                            }
                            else
                            {                          
                                $SQL="insert into users_orders(u_id,title,quantity,price,pick_time) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$_SESSION["total"]."','".$_POST['pickTime']."')";
                                mysqli_query($db,$SQL);	
                                unset($_SESSION["cart_item"]);
                                $success = "Thankyou! Your Order Placed successfully! <p>You will be redirected to Order Page in <span id='counter'>5</span> second(s).</p>
                                <script type='text/javascript'>
                                function countdown() {
                                    var i = document.getElementById('counter');
                                    if (parseInt(i.innerHTML)<=0) {
                                        location.href = 'your_orders.php';
                                    }
                                    i.innerHTML = parseInt(i.innerHTML)1;
                                }
                                setInterval(function(){ countdown(); },1000);
                                </script>'";	                              	
                             }	
                        }        
                        else
                        {                          
                                $SQL="insert into users_orders(u_id,title,quantity,price,pick_time) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$_SESSION["total"]."','".$_POST['pickTime']."')";
                                mysqli_query($db,$SQL);	
                                unset($_SESSION["cart_item"]);
                                $success = "Thank You!! Order Placed successfully! <p>You will be redirected to order page  in <span id='counter'>5</span> second(s).</p>
														<script type='text/javascript'>
														function countdown() {
															var i = document.getElementById('counter');
															if (parseInt(i.innerHTML)<=0) {
																location.href = 'your_orders.php';
															}
															i.innerHTML = parseInt(i.innerHTML)-1;
														}
														setInterval(function(){ countdown(); },1000);
														</script>'";  
                                                        $sql="select o_id from users_orders where u_id ='".$_SESSION["user_id"]."'";
                                                        $result=$db->query($sql);
                                                        if($result->num_rows>0){
                                                            while($row = $result->fetch_assoc()){
                                                                $o_id=$row['o_id'];
                                                            }
                                                        }
                                                        $sql="select * from users_orders, dishes where users_orders.title ='".$item["title"]."' and users_orders.title=dishes.title";
                                                        $result=$db->query($sql);
                                                        if($result->num_rows>0){
                                                            while($row = $result->fetch_assoc()){
                                                                $d_id=$row['d_id'];
                                                            }
                                                        }

                                                        $sql = "INSERT INTO order_details (o_id, d_id, quantity, price, total) VALUES ($o_id, '$d_id','".$item["quantity"]."', '".$_SESSION["total"]."', '".$_SESSION["total"]."')";
                                                        $result = mysqli_query($db, $sql);
                                        
                                                        if ($result) {
                                                            // reduce Total_quantity from product table
                                                            $sql = "UPDATE dishes SET quantity = quantity -'".$item["quantity"]."'  WHERE d_id = $d_id";
                                                            $result = mysqli_query($db, $sql);
                                                        }                        
                         }	
                          
                    }
                    else
                    {
                        $error = "Pick-Up Time Must be Fillup!";
                    }       
                							    																											
                }
            
        
        // $sql="SELECT  * FROM users_orders ORDER BY o_id DESC LIMIT 1";
        // $query=mysqli_query($db,$sql);
        // while($row=mysqli_fetch_array($query))  
        // {
        //     $_SESSION['o_id']=$row['o_id'];
        // }                                                    
       

        // $_SESSION[$_SESSION['o_id'].'order']=	$_SESSION["cart_item"];	

        // if(!empty($_POST['pickTime']) ||substr($_POST['pickTime'],0,2) >  date("h"))
        // {	
        //     $SQL2="insert into tbl_picktime(u_id,pick_time,total) values('".$_SESSION["user_id"]."','".$_POST['pickTime']."','".$item_total."')";
        //      mysqli_query($db,$SQL2);
        //      		
             										
        // }      
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Checkout</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style-starter.css">

 </head>
    <?php include_once('header.php'); ?>

        <section class="w3l-breadcrumb">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><span class="fa fa-arrow-right mx-2" aria-hidden="true"></span> Checkout</li>
                </ul>
            </div>
        </section>	
         <div class="container">
			 <span style="color:green;"> <?php echo $success; ?></span>
             <span style="color:red;"> <?php echo $error; ?></span>				
         </div>
            <div class="container m-t-30">
			<form action="ordersummary.php" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="ordersummary.php">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> 
                                        </div>
                                        <div class="cart-totals-fields">
                                          <table class="table">
											<tbody>                                          												 				   
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td>₹<input type="text" value="<?php echo $item_total; ?>" name="amount" style="border:none"></td>
                                                    </tr> 
                                                    
                                                    <tr>
                                                        <td>Pick-Up Time</td>
                                                        <?php
                                                    $min_time = strtotime('08:00:00');
                                                    $max_time = strtotime('18:00:00');

                                                    // Get the current time
                                                    $current_time = time();

                                                    // Check if the current time is within the minimum and maximum times
                                                    if ($current_time < $min_time || $current_time > $max_time) {
                                                        echo "<p>Sorry, we are closed.</p>";
                                                    } else {
                                                        echo "<p>Welcome, we are open!</p>";
                                                        ?>
                                                        <td><input type="time"  id="pickTime" name="pickTime" max="12:00" min="07:00" required></td>
                                                        <?php
                                                    }
                                                    ?>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color">₹<input type="text" value="<?php echo $item_total; ?>" name="tamount" style="border:none"></td>
                                                    </tr>
                                                </tbody>				
                                            </table>
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                               
                                            </li>
                                            <!-- <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod"  type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Online Payment <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                            </li> -->
                                        </ul>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure you want to confirm this order?');" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>
                                    </div>
									</form>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
            </div>





           
<!--gateway end-->

<style>
    .razorpay-payment-button{
        background-color: #0DCAF0;
        color: white;
        font-size: 18px;padding: 8px 10px;font-weight: bold;
        border-radius: 12px; border: none;text-align: center; 
    }
</style>
            <!-- <section class="app-section">
                <div class="app-wrap">
                    <div class="container">
                        <div class="row text-img-block text-xs-left">
                            <div class="container">
                                <div class="col-xs-12 col-sm-6  right-image text-center">
                                    <figure> <img src="images/app.png" alt="Right Image"> </figure>
                                </div>
                                <div class="col-xs-12 col-sm-6 left-text">
                                    <h3>The Best Food Delivery App</h3>
                                    <p>Now you can make food happen pretty much wherever you are thanks to the free easy-to-use Food Delivery &amp; Takeout App.</p>
                                    <div class="social-btns">
                                        <a href="#" class="app-btn apple-button clearfix">
                                            <div class="pull-left"><i class="fa fa-apple"></i> </div>
                                            <div class="pull-right"> <span class="text">Available on the</span> <span class="text-2">App Store</span> </div>
                                        </a>
                                        <a href="#" class="app-btn android-button clearfix">
                                            <div class="pull-left"><i class="fa fa-android"></i> </div>
                                            <div class="pull-right"> <span class="text">Available on the</span> <span class="text-2">Play store</span> </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            
            <?php include_once('footer.php');?>

            <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
         </div>

     <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script src="jquery.toaster.js"></script>
    <script>

        
   const pressEnter = (event) => {
      if (event.key === "Enter") 
      {
         event.preventDefault();
      }
   };
   document.getElementById("pickTime").addEventListener("keydown",
   pressEnter);
</script>

  <!-- move top -->
  <button onclick="topFunction()" id="movetop" title="Go to top">
  	&#10548;
  </button>
  <script>
  	// When the user scrolls down 20px from the top of the document, show the button
  	window.onscroll = function () {
  		scrollFunction()
  	};

  	function scrollFunction() {
  		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
  			document.getElementById("movetop").style.display = "block";
  		} else {
  			document.getElementById("movetop").style.display = "none";
  		}
  	}

  	// When the user clicks on the button, scroll to the top of the document
  	function topFunction() {
  		document.body.scrollTop = 0;
  		document.documentElement.scrollTop = 0;
  	}
  </script>
  <!-- /move top -->
  </section>


  <!--/MENU-JS-->
  <script>
  	$(window).on("scroll", function () {
  		var scroll = $(window).scrollTop();

  		if (scroll >= 80) {
  			$("#site-header").addClass("nav-fixed");
  		} else {
  			$("#site-header").removeClass("nav-fixed");
  		}
  	});
  </script>

<?php
}
?>
