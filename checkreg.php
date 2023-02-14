<?php 
session_start();
include("connection/connect.php"); 
 if(isset($_POST['login']))
 {
    $email = mysqli_real_escape_string($con,$_POST['email']);  
    $password = mysqli_real_escape_string($con,$_POST['password']);
 
      
      
        //to prevent from mysqli injection
        /*  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      */
        $sql = "SELECT * FROM users WHERE email='$email' && password='".md5($password)."'"; 
        $result = mysqli_query($con, $sql); 

        /*$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  */

        if(mysqli_num_rows($result)>0)
        {

            $row = mysqli_fetch_array($result);
            $_SESSION['id']=$row['id'];
            
            //$_SESSION['message']="You are Logged In Successfully";
                if($row['user_type'] == "admin")
                {
                   session_start();
                   $_SESSION["admin_id"] = $row['admin_id']; 
                   $_SESSION["username"] = $row['username']; 
                   $_SESSION["username"] = $row['username']; 
                    header("Location:admin/index.php");
                   
                }
                elseif($row['user_type'] == "Staff"){
                    session_start();
                    $_SESSION["st_id"] = $row['st_id']; 
                    $_SESSION["username"] = $row['username']; 
                    header("Location:patient.php");
                    
                }
                
                else
                {
                    session_start();
                    header("Location:login.php");
                    
                }
          
        }    
        else
        {
            $_SESSION['message']="Invalid Email or Password";
            header("Location: login.php");
         
        }

 }
?>