<!DOCTYPE html>
<?php 
include('cms/core/sql/conf.php'); 
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bhaggoes Car Palace</title>
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/bootstrap-theme.css" rel="stylesheet">
<link href="assets/css/iconmoon.css" rel="stylesheet">
<link href="assets/css/chosen.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link href="cs-automobile-plugin.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/widget.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<!-- <link href="assets/css/bootstrap-rtl.css" rel="stylesheet"> Uncomment it if needed! -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="assets/scripts/jquery.js"></script>
<script src="assets/scripts/modernizr.js"></script>
<script src="assets/scripts/bootstrap.min.js"></script>
</head>
<body class="wp-automobile">
<div class="wrapper"> 
	<!-- Header Start -->
	<?php 
	//get header
	include('header.php'); 
	?>

	<!-- Main Start -->
	<div class="main-section">
		
		<div class="page-section" style="margin-bottom:40px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="cs-column-text">
							<h2 style="font-size:26px !important;">WELCOME TO Bhaggoes</h2>
							<p>Bhaggoe's Car Palace is one of the pioneering and emerging leaders in new and used cars, trucks, busses and machinery imported from all over the world. Our services are well tailored to customers’ choice and need of vehicles. </p>

							<p>We provide our customers:</p>
							<ul class="cs-icon-list">
								<li><i class="icon-check2 cs-color"></i>Better customer service</li>
								<li><i class="icon-check2 cs-color"></i>Internal financing</li>
								<li><i class="icon-check2 cs-color"></i>High quality vehicles</li>
								<li><i class="icon-check2 cs-color"></i>One week handeling</li>
								<li><i class="icon-check2 cs-color"></i>Special cars on order</li>
								<li><i class="icon-check2 cs-color"></i>Bank Financing</li>
								<li><i class="icon-check2 cs-color"></i>great prices</li>
							</ul>
							<h3>As our motto says: “We beat anybody's prices.”</h3>
							<a href="contact-us.html" class="btn-contact cs-color csborder-color">Contact us</a> </div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="cs-image-frame">
							<img src="assets/images/about-img.jpg" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="page-section" style="margin-bottom:70px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="section-title" style="text-align:center; color:#333333; margin-bottom:45px;">
							<h2 style="margin-bottom:5px;">MEDIA GALLERY</h2>
							<p>It will help us find the Toyota you're looking for in your area.</p>
						</div>
					</div>
					
						<?php
							//get cars
							$g_images = $con->query("SELECT * FROM `gallery_image` WHERE `status` > 0 ORDER BY `id` DESC");
							
							
							while($f_image = mysqli_fetch_array($g_images)){
						
						?>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="cs-gallery">
								<div class="cs-media">
									<figure><a href="cms/upload/gallery_images/<?php echo $f_image['img']; ?>" class="thumbnail"><img src="cms/upload/gallery_images/<?php echo $f_image['img']; ?>" alt="" /></a>
										<!-- <figcaption><i class="icon-search2"></i><span>People will get clean water</span></figcaption> -->
									</figure>
								</div>
							</div>
						</div>
						<?php
						}
					?>

				</div>
			</div>
		</div>
	</div>
	<!-- Main End --> 
	
	<!-- Footer Start -->
	<?php 
	//get footer
	include('footer.php'); 
	?>
	<!-- Footer End --> 
</div>
<script src="assets/scripts/responsive.menu.js"></script> 
<script src="assets/scripts/chosen.select.js"></script> 
<script src="assets/scripts/slick.js"></script> 
<script src="assets/scripts/theia-sticky-sidebar.js"></script> 
<script src="assets/scripts/bootstrap-slider.js"></script> 
<script src="assets/scripts/echo.js"></script> 
<script src="assets/scripts/counter.js"></script> 
<script src="assets/scripts/echo.js"></script> 
<script src="assets/scripts/jquery.viewbox.min.js"></script> <!-- Gallery Lightbox -->

<!-- Put all Functions in functions.js --> 
<script src="assets/scripts/functions.js"></script>
</body>
</html>