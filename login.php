<!DOCTYPE html>
<html lang="en" >

<head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <meta charset="UTF-8">
  <title>login</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/login.css">
     <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
	<style type="text/css">
	   #buttn{
			color:#fff;
			background-color: #ff3300;
		}
    .error_form
{
top: 12px;
color: rgb(216, 15, 15);
    font-size: 15px;
font-weight:bold;
    font-family: Helvetica;
}
	</style>
</head>

<body>
<?php
include("connection/connect.php"); 
$msg="";
if(isset($_SESSION["email"]))
   {
      header("Location:./");
   }

   if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
        $query = mysqli_query($db, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
        
        if ($query) {
            echo("<div class='alert alert-info'>Account verification has been successfully completed.</div>");
        }
    } 
}
error_reporting(0); 
session_start(); 
if(isset($_POST['submit']))  
{
	$email = $_POST['email'];  
	$password = $_POST['password'];
	
	$loginquery ="SELECT * FROM users WHERE email='$email' && password='".md5($password)."'"; //selecting matching records
	$result=mysqli_query($db, $loginquery); //executing
	$row=mysqli_fetch_array($result);
	if($result->num_rows > 0)
        {
          foreach($result as $data)
          {
            $email=$data['email'];
            $password=$data['password'];
         
            $code=$data['code'];
          } 
          if(empty($data['code']))
          {
			$_SESSION["user_id"] = $row['u_id']; 
		  $_SESSION["username"] = $row['username']; 
          $_SESSION['email'] = $email;
		  echo "<script>alert('You are successfully Logged in');</script>";
		  header("refresh:1;url=menu.php"); 
		  }
          else {
             echo("<div class='alert alert-info'>First verify your account and try again. or your access is deneied</div>");
        }
    
	
                                
	 }
	
	 }

?>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <!-- <h1>Login Form</h1> -->
</div>
<!-- Form Module-->
<div class="module form-module" style="margin-left:12cm;padding:40px">
  <div class="toggle">
   
  </div>
  <div class="form">
    <h2>Login to your account</h2>
	  <span style="color:red;"><?php echo $message; ?></span> 
   <span style="color:green;"><?php echo $success; ?></span>
   <form action="" method="post">
      <input type="text" placeholder="Useremail"  name="email" Required/>
      <input type="password" placeholder="Password" name="password" Required/>
      <!-- <span class="error_form" id="captcha_message"></span>
      <div class="g-recaptcha"  data-sitekey="6LcgNeEjAAAAAFvAGLmkWh0hEhcRXPNGhW6CVNZW"></div> -->
      <br>
      <br>
      <input type="submit" id="buttn" name="submit" value="Login" />
      <a  href="forgot.php" style="color:#f30; margin-left: 6rem;"> forgot password?</a>
      <br><br>
<!-- <div class="g-recaptcha"  data-sitekey="6LcgNeEjAAAAAFvAGLmkWh0hEhcRXPNGhW6CVNZW"></div> -->
    </form>
  </div>
  <div class="cta">Not registered?<a href="registration.php" style="color:#f30;"> Create an account</a></div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
 
  $(document).on('click','#buttn',function()
  {  $("#captcha_message").hide();
 var response = grecaptcha.getResponse();
 if(response.length == 0)
 {
 $("#captcha_message").html("Please verify you are not a robot");
               $("#captcha_message").show();
 return false;
 }
 else{
 $("#captcha_message").hide();
 return true;
 }
  });
 
 
</script>
</body>
</html>
