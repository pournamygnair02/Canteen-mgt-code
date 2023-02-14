<?php
$msg="";
include("connection/connect.php"); 

    if(isset($_GET['reset'])) { 

        $verifyQuery = mysqli_query($db,"SELECT * FROM users WHERE code = '{$_GET['reset']}'");

        if(mysqli_num_rows($verifyQuery)>0) {
            if(isset($_POST['change'])) {
                $email = $_POST['email'];
                $email=filter_var($email,FILTER_SANITIZE_EMAIL);
                $password =md5($_POST['password']);
                $log="SELECT * FROM `users` WHERE email='{$email}'";
                $r_log=mysqli_query($db,$log);

                if(mysqli_num_rows($r_log)==0)
                {
                    $msg = "<div class='alert alert-danger'>".$email." - This email address not registered.</div>";

                }
                else {   
                    $changeQuery = mysqli_query($db,"UPDATE users SET password='{$password}', code=''  WHERE code='{$_GET['reset']}'");
                /* echo $changeQuery; */
                if($changeQuery) {

                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Succesfully Updated');
                    window.location.href=' login.php';
                    </script>");
                    /* header("Location: login.php"); */
                }
            }

            } 
            
        }
        else {
            $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
        } 
    }
    else {
        header("Location: forgot.php");
    }  
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="jquery-3.2.1.min.js"></script> 
    <link rel="stylesheet" href="registerstyle.css">  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
</head>
<body>
    <br>
    <br>
    <br>
    <?php echo $msg; ?>
    <div class="container p-3 border border-5 rounded-3"  style="width: 50%">
        <h1 class="display-6 text-center p-2 bg-light">
            Change Password
        </h1>
        <br>
        <form action="" method="post" id="signup">

            <div class="form-field">
                <label for="email">Email:</label><br>
                <input class="form-control form-control-lg" type="text" name="email" id="form_email" autocomplete="off" required>
                <span class="error_form" id="email_error_message" style="color:red; font-size :13px; "></span>
                <small></small>
            </div>

            <div class="form-field">
                <label for="password">Password:</label>
                <br>
                <input class="form-control form-control-lg" type="password" name="password" id="form_password" autocomplete="off"  required>
                <span class="error_form" id="password_error_message" style="color:red; font-size :13px; "></span> 
                <small></small>
            </div>

            <div class="form-field">
                <label for="c-password">Confirm Password:</label><br>
                <input class="form-control form-control-lg" type="password" name="cpassword" id="form_retype_password" autocomplete="off" required>
                <span class="error_form" id="retype_password_error_message" style="color:red; font-size :13px; "></span>
                <small></small>
            </div><br>

            <div class="form-field">
                <input type="submit" class="btn btn-lg btn-primary" value="Submit" name="change" class="btn btn-info">
            </div>
            
        </form>
    </div>
    <script src="validation.js"></script>
</body>
</html>