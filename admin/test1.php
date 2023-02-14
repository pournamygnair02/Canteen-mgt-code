
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	if(!empty($_POST["submit"])) 
     {
		$loginquery ="SELECT * FROM admin WHERE email='$email' && password='".md5($password)."'";
		$result=mysqli_query($db, $loginquery);
		if($result->num_rows>0)
    {
      foreach($result as $data)
      {
        $_SESSION["adm_id"] = $row['adm_id'];
        
        $roll=$data['role'];
       // echo $roll;
       
       
       //echo $roll;
        /*if($roll=='admin')
      {
        header("refresh:1;url=staff.php");

      }*/
      }

    }
    if($roll=='admin')
    {
        
        //echo $roll;
        header("refresh:1;url:dashboard.php");
    }
    else
    {
        echo "Pour";
    }
      
}


    
    }
    ?>