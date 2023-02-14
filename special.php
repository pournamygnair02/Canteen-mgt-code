<?php include_once('header.php'); ?>
<link rel="stylesheet" href="assets/css/style-starter.css">
<!-- //Domain modal -->
<section class="w3l-breadcrumb">
    <div class="container">
        <ul class="breadcrumbs-custom-path">
            <li><a href="#url">Home</a></li>
            <li class="active"><span class="fa fa-arrow-right mx-2" aria-hidden="true"></span> About Us</li>
        </ul>
    </div>
</section>
<!--  Intro video popup section -->
<section class="w3l-food" id="food">
    <div class="foods1 py-5">
        <div class="container py-lg-5 py-md-4">
            <div class="title-content text-center">
                <h6 class="sub-title">Special Iteam</h6>
                <h3 class="title-big">Dish Of The Day</h3>
            </div>
            <div class="foods1-content mt-lg-5 mt-4 mb-sm-0 mb-4">
                <div class="owl-carousel owl-theme text-center">
                <?php 
						$query_res= mysqli_query($db,"SELECT * FROM dishes where in_today_menu='1'"); 
						while($product=mysqli_fetch_array($query_res))
					    {
                ?>
                            <div class="item">
                                <div class="d-grid food-info">
                                    <div class="column">
                                        <h4 class="name-pos"><a href="#url"><?php echo $product['title']; ?></a></h4>
                                        <p><?php echo $product['slogan']; ?></p>
                                        <h5>₹ <?php echo $product['price']; ?></h5>
                                        <a href="login.php?c_id=<?php echo $product['c_id']; ?>&action=add1&id=<?php echo $product['d_id']; ?>" class="btn-style btn-primary btn mt-4" >Order Online</a>
                                        <a href="#url"><?php echo '<img src="admin/Category_Image/dishes/'.$product['img'].'" alt="Food logo" class="img-fluid radius-image mt-4 responsive" style="height: 160px; width:220px">'; ?></a>
                                    </div>
                                </div>
                            </div>  
                <?php
				         }					
				?>
                    <!-- <div class="item">
                        <div class="d-grid food-info">
                            <div class="column">
                                <h4 class="name-pos"><a href="#url">Prosciutto e Funghi</a></h4>
                                <p>Tomato sauce, ham, and mushrooms</p>
                                <h5>20$</h5>
                                <a href="#url" class="btn-style btn-primary btn mt-4">Order Online</a>
                                <a href="#url"><img src="assets/images/p4.jpg" alt="" class="img-fluid radius-image mt-4"/></a>
                            </div>
                        </div> -->
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section>

   
<!-- // form-12 -->

  <!-- footers 20 -->
  <?php include_once('footer.php'); ?>