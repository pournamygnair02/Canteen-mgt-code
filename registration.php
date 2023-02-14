<!DOCTYPE html>
<html lang="en">
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
session_start(); 
error_reporting(0); 
include("connection/connect.php"); 
$msg = "";
if(isset($_POST['submit'] )) 
{
   $username=mysqli_real_escape_string($db,$_POST['username']);
   $email=mysqli_real_escape_string($db,$_POST['email']);
   $phone=mysqli_real_escape_string($db,$_POST['phone']);
   $password=mysqli_real_escape_string($db,md5($_POST['cpassword']));
   $cpassword=mysqli_real_escape_string($db,md5($_POST['cpassword']));
   $code=mysqli_real_escape_string($db, md5(rand()));

   $check_email = mysqli_query($db, "SELECT email FROM users WHERE email = '".$_POST['email']."' ");
	if(mysqli_num_rows( $check_email)>0)
      {
        $msg = "<div class='alert alert-danger'> This email address already exists</div>";
      }
	else
   {
      if($password === $cpassword)
      {
	$mql = "INSERT INTO users (username,email,phone,password,code) VALUES('$username','$email','$phone','$password','$code')";
	$result = mysqli_query($db, $mql);
   if ($result)
   {
      echo "<div style='display: none;'>";
      //Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);
      try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'pournamykrishna02@gmail.com';                     //SMTP username
          $mail->Password   = 'azyvyzjvqwqfldsh';                               //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

          //Recipients
          $mail->setFrom('pournamykrishna02@gmail.com');
          $mail->addAddress($email);

          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'no reply';            
          $mail->Body    = 'Here is the verification link <b><a href="http://localhost/backup/login.php?verification='.$code.'">Click Here</a></b>';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          $msg="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      echo "</div>";
       echo("<div class='alert alert-info'>We've send a verification link on your email address.</div>");
} 
  else {
      $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
       }

} else {
  $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
}
   }
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Registration</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="jquery-3.2.1.min.js"></script> 
      <script src="validation.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body style="background-color:#e9e9e9; padding-left:225px;padding-top:115px;">
     
         <div class="page-wrapper">
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8" style="width: 80% !important;">
                        <div class="widget" style="background-color: white !important;">
                           <div class="widget-body">                          
							       <form action="" id="registration_form" method="post">
                              <div class="row">
                                   <div class="form-group col-sm-12">
                                       <h3 style="color: #f30;">
                                       <center>Register Here</center></h3>
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
							<div class="form-group col-sm-6">
                                 
                                       <input class="form-control" type="text" name="username" id="form_fname" placeholder="Username" Required> 
                                       <span class="error_form" id="fname_error_message" style="color:red; font-size :13px; "></span>
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                       <!-- <label for="exampleInputEmail1">Email address</label> -->
                                       <input type="text" class="form-control" name="email" id="form_email"  placeholder="Email"aria-describedby="emailHelp" Required>
                                       <span class="error_form" id="email_error_message" style="color:red; font-size :13px; "></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <!-- <label for="exampleInputEmail1">Phone number</label> -->
                                       <input class="form-control" type="text" name="phone" id="form_phone" Required placeholder="Phone"> 
                                      
                                       <span class="error_form" id="phone_error_message" style="color:red; font-size :13px; "></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <!-- <label for="exampleInputPassword1">Password</label> -->
                                       <input type="password" class="form-control" name="password" id="form_password" Required   placeholder="Password">
                                       <span class="error_form" id="password_error_message" style="color:red; font-size :13px; "></span> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <!-- <label for="exampleInputPassword1">Repeat password</label> -->
                                       <input type="password" class="form-control" name="cpassword" id="form_retype_password" Required placeholder="Repeat Password"> 
                                       <span class="error_form" id="retype_password_error_message" style="color:red; font-size :13px; "></span>
                                    </div>  
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                    <div class="col-sm-4">
                                    <p>
                Already having an account? <a href="login.php">Login Here!</a>
            </p>
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