
<?php    
    include("connection/connect.php");
    // error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  //if usser is not login redirected baack to login page
{
	header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

  <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> 
  
    <link rel="stylesheet" href="review.css">
    <link rel="stylesheet" href="rating.css">
  
  
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

    </head>
    
    <body>
    <body style="background-color:#e9e9e9; padding-left:225px;padding-top:115px;">
    <!-- ***** Preloader Start ***** -->
    
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Men Area Starts ***** -->
    <section class="section" id="men">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="men-item-carousel">
                    <?php
                    if(isset($_GET['id'])) {
                        $products=$_GET['id'];
                        $user = $_SESSION['user_id'];
                        $sql = "SELECT user_rating, user_review FROM review_table WHERE user_id = $user AND product_id = $products";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_assoc($result);

                        if(mysqli_num_rows($result) > 0) {
                            $userratings = $row['user_rating'];
                            $userreviews = $row['user_review'];
                        } else {
                            $userratings = "";
                            $userreviews = "";
                        }
                    } 
                    ?>
                    
                      <div class="d-flex flex-row align-items-center">
                      <div class="col-lg-12">
                          
                        <form  method="POST">
                </br>
                </br>
                        <div class=" d-flex input-group mb-3">
                        <label for="userrating"  class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Rating:</label>
                        <div class="rating">

                        <input type="radio" name="userrating" value="5" id="rating-1"<?php if ($userratings == 5) { echo " checked"; } ?>><label for="rating-1">&#9734;</label>
                        <input type="radio" name="userrating" value="4" id="rating-2"<?php if ($userratings == 4) { echo " checked"; } ?>><label for="rating-2">&#9734;</label>
                        <input type="radio" name="userrating" value="3" id="rating-3"<?php if ($userratings == 3) { echo " checked"; } ?>><label for="rating-3">&#9734;</label>
                        <input type="radio" name="userrating" value="2" id="rating-4"<?php if ($userratings == 2) { echo " checked"; } ?>><label for="rating-4">&#9734;</label>
                        <input type="radio" name="userrating" value="1" id="rating-5"<?php if ($userratings == 1) { echo " checked"; } ?>><label for="rating-5">&#9734;</label>
                        </div>
                
                </br>
        
                        
               
                        <div class="input-group mb-3">
                        <label for="userreview" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Review</label>
                        <input id="userreview" name="userreview" type="text" value="<?php echo $userreviews;?>" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7"required >
                        </div>
                        

                        <input type="hidden" name="product" id="product">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                      </div> 
                      
                      
                                                                                                         
                    </div>
                        </br>
                        </br>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Men Area Ends ***** -->

    <!-- ***** Women Area Starts ***** -->
    
    <!-- ***** Kids Area Ends ***** -->

    <!-- ***** Explore Area Starts ***** -->
    
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->
    
    <!-- ***** Subscribe Area Ends ***** -->
    
    <!-- ***** Footer Start ***** -->
    
    

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/lightbox.js"></script> 
    <script src="assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    
<?php
if(isset($_POST['submit'])){
    $userrating = $_POST['userrating'];
    $userreview = $_POST['userreview'];
    $products = $_GET['id'];
    $user = $_SESSION['user_id'];
    
    
    $query = "SELECT * FROM review_table WHERE user_id = $user AND product_id = $products";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
  
    if ($row) {
      // If a review already exists, update the rating and review
      $review_id = $row['review_id'];
      $sql = "UPDATE review_table SET user_rating = $userrating, user_review = '$userreview' WHERE review_id = $review_id";
    } else {
      // Otherwise, insert a new row in the database with the rating and review
      $sql = "INSERT INTO review_table (user_id, product_id, user_rating, user_review) VALUES ($user, $products, $userrating,'$userreview')";
    }
  
    if (mysqli_query($db, $sql)) {
      echo "<script>alert('Review submitted successfully')</script>";
    } else {
      echo '<script>alert("Error: " . mysqli_error($db))</script>';
    }
  }


?>

<script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
  </body>
  
            <!-- end:Footer -->
        

<?php    
    include("connection/connect.php");
    // error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  //if usser is not login redirected baack to login page
{
	header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

  <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> 
  
    <link rel="stylesheet" href="review.css">
    <link rel="stylesheet" href="rating.css">
  
  
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

    </head>
    
    <body>
    <body style="background-color:#e9e9e9; padding-left:225px;padding-top:115px;">
    <!-- ***** Preloader Start ***** -->
    
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Men Area Starts ***** -->
   

    <!-- ***** Women Area Starts ***** -->
    
    <!-- ***** Kids Area Ends ***** -->

    <!-- ***** Explore Area Starts ***** -->
    
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->
    
    <!-- ***** Subscribe Area Ends ***** -->
    
    <!-- ***** Footer Start ***** -->
    
    

 
   
<script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
  </body>
  
            <!-- end:Footer -->
        

</html>