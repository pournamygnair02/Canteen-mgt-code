<?php


    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

   
    
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    include("connection/connect.php");
    $msg="";
    if(isset($_POST['submit']))
    {
        $email =$_POST['email'];
        $email=filter_var($email,FILTER_SANITIZE_EMAIL);
        $code = mysqli_real_escape_string($db, md5(rand()));
        if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE email='{$email}'")) > 0) 
        {
            $query = mysqli_query($db, "UPDATE users SET code='{$code}'  WHERE email='{$email}'");
            if($query){
                echo "<div style='display: none;'>";
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'canteenn456@gmail.com';                     // SMTP username
                    $mail->Password   = 'vkkgwcndufxbncxs';                               // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_STARTTLS; encouraged
                    $mail->Port       = 465;                                    // TCP port to connect to, use 587 for `PHPMailer::ENCRYPTION_STARTTLS` above
                
                    //Recipients
                    $mail->setFrom('canteenn456@gmail.com', 'Admin');
                    $mail->addAddress($email);     // Add a recipient
                
                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Password Reset';
                    $mail->Body    = 'To reset your password click <a href="http://localhost/backup/change_password.php?reset='.$code.'">Click Here</a></b>';
            
                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                echo "</div>";        
                $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>$email - This email address do not found.</div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!--Bootstrap CSS link-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    </head>
    <body>
    <form method="post" action="">
            <?php echo $msg; ?>
    <div class="container h-100">
    		<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Reset password</h1>
							<p class="lead">
								Enter your email to reset your password.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form>
										<div class="form-group">
											<label>Email</label>
											
                                            <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email">
                                           
										</div>
										<div class="text-center mt-3">
                                        <button name="submit" class="btn btn-lg btn-primary" type="submit">Reset password</button>
								
											<!-- <button type="submit" class="btn btn-lg btn-primary">Reset password</button> -->
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
    
    </body>
</html>