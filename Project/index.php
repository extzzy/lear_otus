<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'vendor/autoload.php'; 
use Exception;
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
// Параметры подключения к MongoDB

$uri = 'mongodb://admin:36BbnDJNCcAJEWaoTlzmgRpzK@192.168.200.56:27017,192.168.200.57:27017,192.168.200.58:27017/?replicaSet=mongo_repl';
$mongoClient = new MongoDB\Client($uri);
$database = $mongoClient->demo;
$collection = $database->movies;

$client_id = "bkgw8BeK850KEONhtJiu-0V6G5FehPlzBLWdGWA5NlU";
$url = "https://api.unsplash.com/photos/random?client_id=" . $client_id."&orientation=landscape";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>One Movies | Home</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/contactstyle.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/faqstyle.css" type="text/css" media="all" />
<link href="css/single.css" rel='stylesheet' type='text/css' />
<link href="css/medile.css" rel='stylesheet' type='text/css' />
<!-- banner-slider -->
<link href="css/jquery.slidey.min.css" rel="stylesheet">
<!-- //banner-slider -->
<!-- pop-up -->
<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
<!-- //pop-up -->
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font-awesome.min.css" />
<!-- //font-awesome icons -->
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<!-- banner-bottom-plugin -->
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
<script src="js/owl.carousel.js"></script>
<script>
	$(document).ready(function() { 
		$("#owl-demo").owlCarousel({
	 
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
	 
		  items : 5,
		  itemsDesktop : [640,4],
		  itemsDesktopSmall : [414,3]
	 
		});
	 
	}); 
</script> 
<!-- //banner-bottom-plugin -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	
<body>

<!-- bootstrap-pop-up -->

	<script>
		$('.toggle').click(function(){
		  // Switches the Icon
		  $(this).children('i').toggleClass('fa-pencil');
		  // Switches the forms  
		  $('.form').animate({
			height: "toggle",
			'padding-top': 'toggle',
			'padding-bottom': 'toggle',
			opacity: "toggle"
		  }, "slow");
		});
	</script>
<!-- //bootstrap-pop-up -->
<!-- nav -->
<?php require 'topmenu.php'; ?>
<!-- //nav -->
<!-- banner -->
<!-- //banner -->
<!-- banner-bottom -->

<!-- //banner-bottom -->

<!-- general -->
	<?php /*
	*/
	?>
<!-- //general -->
<!-- Latest-tv-series -->
	<div class="Latest-tv-series">
		<h4 class="latest-text w3_latest_text w3_home_popular">Случайные фильмы</h4>
		
		<div class="container">
			<section class="slider">
				<?php 
				$randomMovies = $collection->aggregate([['$sample' => ['size' => 20]]]);
				$i = 0;



				
				// Вывод записей в виде таблицы
				foreach ($randomMovies as $movie) {
					$i++;
					if (isset($movie['thumbnail_height'])) {
						$image = $movie['thumbnail'];
						$image_height = $movie['thumbnail_height'];
					}else { 
						$image = "images/basic1-145_no_image-1024.png";
						$image_height = "250px";
					}
	
				echo '
				<div class="col-md-6 agile_tv_series_grid_left" style="max-width:250px">
									<div class="w3ls_market_video_grid1">
										<img src="'.$image.'" alt=" " class="img-responsive" style="height:'.$image_height.'" />
										
									</div>
								</div>';
				//echo '<img src="'.$movie['thumbnail'].'">';
	
					//echo "<td>".$movie['title']."</td>";
					//echo "<td>".$movie['extract']."</td>";
				
					//echo "</tr>";
			
				echo '<div class="agile_tv_series_grid"> 
 
					<div class="col-md-6 agile_tv_series_grid_right" style="height:'.$image_height.'px;max-height:390px"> 
						<p class="fexi_header">'.$movie['title'].'</p> ';
						if (isset($movie['extract'])) {
						echo '<p class="fexi_header_para"><span class="conjuring_w3">Story Line<label>:</label></span> '.substr($movie['extract'], 0, 150).'</p>';
						}else{
							echo '<p class="fexi_header_para"><span class="conjuring_w3">Story Line<label>:</label></span>описания нема</p>';
						}
						echo '
						<p class="fexi_header_para"><span>Date of Release<label>:</label></span>'.$movie['year'].' </p> 
						<p class="fexi_header_para">
						<span>Genres<label>:</label> </span> ';
						foreach ($movie['genres'] as $genre){
							echo '<a href="genres.html">'.$genre.'</a> | ';
						}
						echo '							
						</p> 
						<p class="fexi_header_para fexi_header_para1"><span>Star Rating<label>:</label></span> 
							<a href="#"><i class="fa fa-star" aria-hidden="true"></i></a> 
							<a href="#"><i class="fa fa-star" aria-hidden="true"></i></a> 
							<a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a> 
							<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a> 
							<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a> 
						</p> 
					</div> 
					

				</div>
				';

				if ($i % 2 == 0) {
					echo '<div class="clearfix" style="'.$i.'"> </div>';
				}else { echo '<div class="nofix"> </div>';
				}
			}
				?>
				<table>
				<?php

    ?>
			</table>
			</section>
		</div>
		
	</div>
	<!-- pop-up-box -->  
		<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<!--//pop-up-box -->
	<div id="small-dialog" class="mfp-hide">
		<iframe src="https://player.vimeo.com/video/164819130?title=0&byline=0"></iframe>
	</div>
	<div id="small-dialog1" class="mfp-hide">
		<iframe src="https://player.vimeo.com/video/148284736"></iframe>
	</div>
	<div id="small-dialog2" class="mfp-hide">
		<iframe src="https://player.vimeo.com/video/165197924?color=ffffff&title=0&byline=0&portrait=0"></iframe>
	</div>
	<script>
		$(document).ready(function() {
		$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
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
																		
		});
	</script>
<!-- //Latest-tv-series -->
<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="w3ls_footer_grid">
				<div class="col-md-6 w3ls_footer_grid_left">
					<div class="w3ls_footer_grid_left1">
						<h2>Subscribe to us</h2>
						<div class="w3ls_footer_grid_left1_pos">
							<form action="#" method="post">
								<input type="email" name="email" placeholder="Your email..." required="">
								<input type="submit" value="Send">
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6 w3ls_footer_grid_right">
					<a href="index.html"><h2>One<span>Movies</span></h2></a>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-5 w3ls_footer_grid1_left">
				<p>&copy; 2016 One Movies. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
			</div>
			<div class="col-md-7 w3ls_footer_grid1_right">
				<ul>
					<li>
						<a href="genres.html">Movies</a>
					</li>
					<li>
						<a href="faq.html">FAQ</a>
					</li>
					<li>
						<a href="horror.html">Action</a>
					</li>
					<li>
						<a href="genres.html">Adventure</a>
					</li>
					<li>
						<a href="comedy.html">Comedy</a>
					</li>
					<li>
						<a href="icons.html">Icons</a>
					</li>
					<li>
						<a href="contact.html">Contact Us</a>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- //Bootstrap Core JavaScript -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>