<?php
include("connection/connect.php");
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