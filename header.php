<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Canteen Management</title>

  <!-- Web-Fonts -->
  <link href="//fonts.googleapis.com/css?family=Spartan:400,500,600,700,900&display=swap" rel="stylesheet">
  <!-- //Web-Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Template CSS -->

</head>

<body>



<!--header-->
<div class="w3l-top-header">
  <header id="site-header" class="fixed-top">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark stroke">
        <a class="navbar-brand" href="index.php">
          <span class="fa fa-cutlery"></span> Canteen Management
        </a>
        <!-- if logo is image enable this   
      <a class="navbar-brand" href="#index.html">
          <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
      </a> -->
        <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
          <span class="navbar-toggler-icon fa icon-close fa-times"></span>
          </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item @@index-active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @@about-active">
              <a class="nav-link effect-3" href="about.php">About</a>
            </li>
            <!-- <li class="nav-item @@services-active">
              <a class="nav-link effect-3" href="services.php">Menu</a>
            </li> -->
            <li class="nav-item @@contact-active">
              <a class="nav-link effect-3" href="contact.php">Contact</a>
            </li>
           
            <?php
						if(empty($_SESSION["user_id"]))
							{
								echo'  <li class="nav-item dropdown @@blog-active">
                       <a  href="login.php" class="nav-link dropdown-toggle effect-3" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Account <span class="fa fa-angle-down"></span>
                       </a>
                       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item effect-3" href="login.php">Login</a>
                          <a class="dropdown-item effect-3" href="registration.php">Sign Up</a>
                        </div>
                      </li> ';
							}
						else
							{													
                echo'   <li class="nav-item @@about-active">
                <a class="nav-link effect-3" href="menu.php">Menu</a>
              </li>
                
                
                <li class="nav-item dropdown @@blog-active">
                          <a class="nav-link dropdown-toggle effect-3" href="login.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                          //  echo $_SESSION["username"];
                          echo "Welcome ";
                            echo $_SESSION["username"];
                            echo'<span class="fa fa-angle-down"></span> <br>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                                                                            <!--<a class="dropdown-item effect-3" href="your_orders.php">Your Orders</a>-->
                          <a class="dropdown-item effect-3" href="update_profile.php">My Profile</a> 
                          <a class="dropdown-item effect-3" href="your_orders.php">your orders</a> 
                          <a class="dropdown-item effect-3" href="logout.php">Logout</a>
                        </div>   
                            
                       </li> ';				
							}
						?>
					
          <div id="google_element">
<script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
                            <script >
                                function loadGoogleTranslate(){
                                   new google.translate.TranslateElement("google_element");
                                }
                            </script>
  </div>
          </ul>
          <!-- <div class="popup">
            <a href="#domain" class="domain" data-toggle="modal" data-target="#DomainModal">
              <div class="hamburger1">
                <div></div>
                <div></div>
                <div></div>
              </div>
            </a>
          </div>
        </div>
      </nav>
    </div> -->
  </header>
  
</div>
<!--/header-->

<!-- Domain Modal -->
<!-- <div class="modal right fade" id="DomainModal" tabindex="-1" role="dialog" aria-labelledby="DomainModalLabel2">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> -->

      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button> -->
        
      <!--  -->