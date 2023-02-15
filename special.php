<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="assets/css/style-starter.css">
<style>
h3,p{
    text-align: center;
}
</style>
<?php include_once('header.php'); 
error_reporting(0);
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");//if logout is crt then redirect to login
  }
?>
<!-- Domain Modal -->
<div class="modal right fade" id="DomainModal" tabindex="-1" role="dialog" aria-labelledby="DomainModalLabel2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button>

      


        </div>
      </div>
    </div>
    <!-- //modal-content -->
  </div>
  <!-- //modal-dialog -->
</div>
<!-- //Domain modal -->

           
        <div class="chilly"></div>
        <!-- Food Menu -->
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

        <!-- How it works block ends -->
<!-- Image gallary -->



  <!-- footers 20 -->
  <?php include_once('footer.php'); ?>
  
  
  <!-- move top -->
  <button onclick="topFunction()" id="movetop" title="Go to top">
  	&#10548;
  </button>
  <script>
  	// When the user scrolls down 20px from the top of the document, show the button
  	window.onscroll = function () {
  		scrollFunction()
  	};

  	function scrollFunction() {
  		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
  			document.getElementById("movetop").style.display = "block";
  		} else {
  			document.getElementById("movetop").style.display = "none";
  		}
  	}

  	// When the user clicks on the button, scroll to the top of the document
  	function topFunction() {
  		document.body.scrollTop = 0;
  		document.documentElement.scrollTop = 0;
  	}
  </script>
  <!-- /move top -->
  </section>

  <!-- jQuery and Bootstrap JS -->
  <script src="assets/js/jquery-3.3.1.min.js"></script>

  <!-- libhtbox -->
  <script src="assets/js/lightbox-plus-jquery.min.js"></script>


  <script src="assets/js/jquery.magnific-popup.min.js"></script>

  <script src="assets/js/counter.js"></script>
  <script>
  	$(document).ready(function () {
  		$('.popup-with-zoom-anim').magnificPopup({
  			type: 'inline',

  			fixedContentPos: false,
  			fixedBgPos: true,

  			overflowY: 'auto',

  			closeBtnInside: true,
  			preloader: false,

  			midClick: true,
  			removalDelay: 300,
  			mainClass: 'my-mfp-zoom-in'
  		});

  		$('.popup-with-move-anim').magnificPopup({
  			type: 'inline',

  			fixedContentPos: false,
  			fixedBgPos: true,

  			overflowY: 'auto',

  			closeBtnInside: true,
  			preloader: false,

  			midClick: true,
  			removalDelay: 300,
  			mainClass: 'my-mfp-slide-bottom'
  		});
  	});
  </script>

  <!-- testimonials owlcarousel -->
  <script src="assets/js/owl.carousel.js"></script>
  <script>
  	$(document).ready(function () {
  		$('.owl-two').owlCarousel({
  			loop: true,
  			margin: 30,
  			nav: false,
  			responsiveClass: true,
  			autoplay: false,
  			autoplayTimeout: 5000,
  			autoplaySpeed: 1000,
  			autoplayHoverPause: false,
  			responsive: {
  				0: {
  					items: 1,
  					nav: false
  				},
  				480: {
  					items: 1,
  					nav: false
  				},
  				667: {
  					items: 1,
  					nav: false
  				},
  				1000: {
  					items: 1,
  					nav: false
  				}
  			}
  		})
  	})
  </script>
  <!-- //script for Testimonials-->

  <!-- script for food-->
  <script>
  	$(document).ready(function () {
  		$('.owl-carousel').owlCarousel({
  			loop: true,
  			margin: 0,
  			responsiveClass: true,
  			responsive: {
  				0: {
  					items: 1,
  					nav: true
  				},
  				480: {
  					items: 2,
  					nav: true,
  					margin: 20
  				},
  				769: {
  					items: 3,
  					nav: true,
  					margin: 20
  				},
  				1280: {
  					items: 4,
  					nav: true,
  					loop: true,
  					margin: 25
  				}
  			}
  		})
  	})
  </script>
  <!-- //script for food-->

  <!-- disable body scroll which navbar is in active -->
  <script>
  	$(function () {
  		$('.navbar-toggler').click(function () {
  			$('body').toggleClass('noscroll');
  		})
  	});
  </script>
  <!-- disable body scroll which navbar is in active -->
  <!--/MENU-JS-->
  <script>
  	$(window).on("scroll", function () {
  		var scroll = $(window).scrollTop();

  		if (scroll >= 80) {
  			$("#site-header").addClass("nav-fixed");
  		} else {
  			$("#site-header").removeClass("nav-fixed");
  		}
  	});

  	//Main navigation Active Class Add Remove
  	$(".navbar-toggler").on("click", function () {
  		$("header").toggleClass("active");
  	});
  	$(document).on("ready", function () {
  		if ($(window).width() > 991) {
  			$("header").removeClass("active");
  		}
  		$(window).on("resize", function () {
  			if ($(window).width() > 991) {
  				$("header").removeClass("active");
  			}
  		});
  	});
  </script>
  <!--//MENU-JS-->
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    (function(d, m){
        var kommunicateSettings = 
            {"appId":"1ce4e279826d566cef22385c9b6e57083","popupWidget":true,"automaticChatOpenOnNavigation":true};
        var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
        s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
        var h = document.getElementsByTagName("head")[0]; h.appendChild(s);
        window.kommunicate = m; m._globals = kommunicateSettings;
    })(document, window.kommunicate || {});
/* NOTE : Use web server to view HTML files as real-time update will not work if you directly open the HTML file in the browser. */
</script>

  </body>

  </html>