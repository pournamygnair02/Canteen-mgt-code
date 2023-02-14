<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");//if logout is crt then redirect to login
  }
?>
<?php

$msg = "";
if(isset($_POST['submit'] )) 
{
   $user_regno=mysqli_real_escape_string($db,$_POST['user_regno']);
   $username=mysqli_real_escape_string($db,$_POST['username']);
   $lastname=mysqli_real_escape_string($db,$_POST['lastname']);
   $email=mysqli_real_escape_string($db,$_POST['email']);
   $address=mysqli_real_escape_string($db,$_POST['address']);
   $phone=mysqli_real_escape_string($db,$_POST['phone']);
   
  $mql="UPDATE `users` SET `user_regno`='$user_regno', `username`='$username',`lastname`='$lastname',`email`='$email',`phone`='$phone',`address`='$address' WHERE u_id={$_SESSION['user_id']}";
	$result = mysqli_query($db, $mql);
   if ($result)
   {
      echo "<script>alert('Updated');</script>";
      //Create an instance; passing `true` enables exceptions
     
}
}
?>
 <!-- Bootstrap core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> 
  
  
  
  
  <head>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

 <style>
    img {
            border: 2px solid #555 !important;
            height: 80px;
            width: 700px;
    }
</style>
<?php include_once('header.php'); ?>

<link rel="stylesheet" href="assets/css/style-starter.css"> </head>
<body style="background-color:#e9e9e9; padding-left:225px;padding-top:115px;">
     
         <div class="page-wrapper">
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8" style="width: 80% !important;">
                        <div class="widget" style="background-color: white !important;">
                           <div class="widget-body">                          
							       <form action="#" id="registration_form" method="post">
                              <div class="row">
                                   <div class="form-group col-sm-12">
                                       <h3 style="color: #f30;">
                                       <center>My Profile</center></h3>
                                       <br><?php echo $msg; ?>
                                   </div>
                                   <div class="container">
                                       <ul>
                                          <li>
                                             <a href="#" class="active">
                                                <span style="color:red;"><?php echo $message; ?></span>
                                                <span style="color:green;"><?php echo $success; ?></span>
                                             </a>
                                          </li> 
                                       </ul>
                                 </div>
                                 <?php
                                         $sql ="select * from users where u_id=".$_SESSION["user_id"];
										 $rest=mysqli_query($db, $sql); 
										 $rows=mysqli_fetch_array($rest);                                                     
                                    ?>

<div class="form-group col-sm-12">
                                       <!-- <label for="exampleInputEmail1">Last Name</label> -->
                                       <input type="text" class="form-control" name="user_regno" id="form_email"   value="<?php echo $rows['user_regno'];?>" placeholder="Register No." Required>
                                       <span class="error_form" id="email_error_message" style="color:red; font-size :13px; "></span>
                                    </div>
							<div class="form-group col-sm-12">
                                 
                                       <input class="form-control" type="text" name="username" id="form_fname"  value="<?php echo $rows['username'];?>" placeholder="Username" Required> 
                                       <span class="error_form" id="fname_error_message" style="color:red; font-size :13px; "></span>
                                    </div>

                                 
                        

                                    <div class="form-group col-sm-12">
                                       <!-- <label for="exampleInputEmail1">Last Name</label> -->
                                       <input type="text" class="form-control" name="lastname" id="form_email"   value="<?php echo $rows['lastname'];?>" placeholder="lastname"aria-describedby="emailHelp" Required>
                                       <span class="error_form" id="email_error_message" style="color:red; font-size :13px; "></span>
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <!-- <label for="exampleInputEmail1">Email address</label> -->
                                       <input type="text" class="form-control" name="email" id="form_email"  value="<?php echo $rows['email'];?>"  placeholder="Email"aria-describedby="emailHelp" Required>
                                       <span class="error_form" id="email_error_message" style="color:red; font-size :13px; "></span>
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <!-- <label for="exampleInputEmail1">Phone number</label> -->
                                       <input class="form-control" type="text" name="phone" id="form_phone"  value="<?php echo $rows['phone'];?>"  Required placeholder="Phone"> 
                                      
                                       <span class="error_form" id="phone_error_message" style="color:red; font-size :13px; "></span>
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <!-- <label for="exampleInputEmail1">Address</label> -->
                                       <input class="form-control" type="text" name="address" id="form_phone"  value="<?php echo $rows['address'];?>" Required placeholder="Address"> 
                                      
                                       <span class="error_form" id="phone_error_message" style="color:red; font-size :13px; "></span>
                                    </div>
                             
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Edit Profile" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                    <div class="col-sm-4">
                                    
                                    </div>
                                 </div>
                              </form> 
						          </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                  </div>
               </div>
            </section> 
         </div>
         <!-- end:page wrapper -->
      
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
</body>

</html>