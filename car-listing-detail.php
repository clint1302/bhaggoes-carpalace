<!DOCTYPE html>
<?php 

include('cms/core/sql/conf.php');

if (isset($_GET['car-id'])) {


$id = $_GET['car-id'];

//Get car
$f_car = mysqli_fetch_assoc($con->query("SELECT * FROM `cars` WHERE `car_id` = '".$id."'"));

//Get car
$f_car_images = mysqli_fetch_assoc($con->query("SELECT * FROM `car_images` WHERE `car_id` = '".$id."'"));

$car_images1 = $f_car_images['img1'];
$car_images2 = $f_car_images['img2'];
$car_images3 = $f_car_images['img3'];

//fetch model
$f_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_car['model_id']."'"));

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
<link href="assets/css/bootstrap-slider.css" rel="stylesheet">
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
<body class="wp-automobile single-page">
<div class="wrapper"> 
	<!-- Header Start -->
	<?php 
    //get header
    include('header.php'); 
    ?>
	<!-- Header End -->      
    <!-- Single - Page Slider Start -->
    <div class="cs-banner loader">
        <ul class="cs-banner-slider">
        	
        	<li>
            	<div class="cs-media">
                	<figure><img data-echo="<?php echo BASEHREF."cms/upload/cars/medium/".$f_car['img']; ?>"  src="assets/images/blank.gif"  alt=""/></figure>
                </div>
            </li>
        	<!-- <li>
            	<div class="cs-media">
                	<figure><img data-echo="<?php echo BASEHREF."cms/upload/cars/medium/".$f_car['img']; ?>"  src="assets/images/blank.gif"  alt="" /></figure>
                </div>
            </li>
        	<li>
            	<div class="cs-media">
                	<figure><img data-echo="<?php echo BASEHREF."cms/upload/cars/medium/".$f_car['img']; ?>"  src="assets/images/blank.gif"  alt=""/></figure>
                </div>
            </li>
            <li>
            	<div class="cs-media">
                	<figure><img data-echo="<?php echo BASEHREF."cms/upload/cars/medium/".$f_car['img']; ?>"  src="assets/images/blank.gif"  alt=""/></figure>
                </div>
            </li>
            <li>
            	<div class="cs-media">
                	<figure><img data-echo="<?php echo BASEHREF."cms/upload/cars/medium/".$f_car['img']; ?>"  src="assets/images/blank.gif"  alt=""/></figure>
                </div>
            </li> -->
        	<?php
        		if($car_images1 != "") {
        			?>
								<li>
							  	<div class="cs-media">
							      	<figure><img data-echo="<?php echo BASEHREF."cms/upload/cars_slider/".$car_images1; ?>"  src="<?php echo BASEHREF."cms/upload/cars_slider/".$car_images1; ?>" alt=""/></figure>
							      </div>
							  </li>
        			<?php
        		}
        		if($car_images2 != "") {
        			?>
								<li>
							  	<div class="cs-media">
							      	<figure><img data-echo="<?php echo BASEHREF."cms/upload/cars_slider/".$car_images2; ?>"  src="<?php echo BASEHREF."cms/upload/cars_slider/".$car_images2; ?>" alt=""/></figure>
							      </div>
							  </li>
        			<?php
        		}
        		if($car_images3 != "") {
        			?>
								<li>
							  	<div class="cs-media">
							      	<figure><img data-echo="<?php echo BASEHREF."cms/upload/cars_slider/".$car_images3; ?>"  src="<?php echo BASEHREF."cms/upload/cars_slider/".$car_images3; ?>" alt=""/></figure>
							      </div>
							  </li>
        			<?php
        		}
        	?>
        	
        </ul>
        <div class="container">
        	<div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                	<!--<div class="cs-button-style">
                    	<a class="btn-video" href="#"><i class="icon-play_arrow"></i> Watch video</a>
                    	<a class="btn-compare" href="#"><i class="icon-flow-tree"></i> Compare</a>
                    	<a class="btn-shortlist" href="#"><i class="icon-heart-o"></i> shortlist</a>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Single - Page Slider End -->
	<!-- Main Start -->
	<div class="main-section"> 
		<div class="page-section" style="position:relative;">
        	<div class="container">
            	<div class="row">
                	<div class="custom-content col-lg-9 col-md-9 col-sm-12 col-xs-12" style="width:calc(100%);">
                    	<div class="page-section">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="car-detail-heading">
                                        <div class="auto-text">
                                        	<h2><?php echo $f_model['title'];?> - <?php echo $f_car['year'];?></h2>
                                            <span><i class="icon-building-o"></i> Bhaggoes car palace</span>
                                            <address><i class="icon-location"></i>Kwattaweg 407, Paramaribo, Suriname</address>
                                        </div>
                                        <div class="auto-price">
											<span class="cs-color">
											<?php if($f_car['price_state'] < 1){
														echo '$'.$f_car['price'];
												  }else{
														echo 'Contact us for the price';
												  }
											?>
											</span> 
											<em><?php if($f_car['price_state'] < 1){echo 'MSRP $'.$f_car['price'];}?></em>
										</div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                	<div class="cs-detail-nav">
                                    	<ul>
                                            <!--<li><a class="active" href="#vehicle">Vehicle overview</a></li>-->
                                            <li><a class="active" href="#specification">Technical Specification</a></li>
                                            <?php if($f_car['accessories'] != "") {  ?><li><a href="#accessories">Accessories</a></li><?php } ?>
                                            <!--<li><a href="#location">Location</a></li>
                                            <li><a href="#contact">Contact Us</a></li>-->
                                        </ul>
                                        <div class="detail-btn">
                                            <!--<div class="cs-button-style">
                                                <a class="btn-compare" href="#"><i class="icon-flow-tree"></i> Compare</a>
                                                <a class="btn-shortlist" href="#"><i class="icon-heart-o"></i> shortlist</a>
                                            </div>-->
                                        </div>
                                    </div>
									<div class="on-scroll">
										<div id="vehicle" class="auto-overview detail-content">
											<ul class="row">
												<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
													<div class="cs-media">
														<figure><i class="icon-driving2 cs-color"></i></figure>
													</div>
													<div class="auto-text">
														<span>Year</span>
														<strong><?php echo $f_car['year'];?></strong>
													</div>
												</li>
												<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
													<div class="cs-media">
														<figure><i class="icon-vehicle92 cs-color"></i></figure>
													</div>
													<div class="auto-text">
														<span>Mileage(x1000km)</span>
														<strong><?php echo $f_car['mileage'];?></strong>
													</div>
												</li>
												<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
													<div class="cs-media">
														<figure><i class="icon-engine cs-color"></i></figure>
													</div>
													<div class="auto-text">
														<span>Trans</span>
														<strong><?php echo $f_car['transmission'];?></strong>
													</div>
												</li>
												<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
													<div class="cs-media">
														<figure><i class="icon-gas20 cs-color"></i></figure>
													</div>
													<div class="auto-text">
														<span>Fuel Type</span>
														<strong><?php echo $f_car['fuel'];?></strong>
													</div>
												</li>
											</ul>
											<!--<p class="more-text">
												Arear view camera and lane departure warning. This car has 6 airbags fitted for your protection. It has front & rear power windows, central locking and 2nd row split folding seats. Family life is made easy in this 2016 Jaguar XF. This car has Bluetooth connectivity, side curtain airbags, subwoofer, trailer sway control, sports pedals and heads up information display. This car has forward collision alert/warning. This car comes with enough seats for 5. You can relax, this car also has park assist. It has electric power assisted steering. It has 19" alloy wheels. It has an ANCAP safety rating 4. This car has starter button. Options added to vehicle includes Seats - 2nd Row Electric Folding, Sunvisors - Rear and Sunvisors - Rear.
											</p>
											<p class="more-text">
												This Stunning Brand New Jaguar XF 2016 comes with 3 years / Unlimited km new car warranty. This car has an ANCAP safety rating of 4 so you can be sure you are driving with utmost safety new car available to order.Family life is made easy in this 2016 Jaguar XF. This car has Bluetooth connectivity, side curtain airbags, subwoofer, trailer sway control, sports pedals and heads up information display.
											</p>
											<p class="more-text">
												This Stunning Brand New Jaguar XF 2016 comes with 3 years / Unlimited km new car warranty. This car has an ANCAP safety rating of 4 so you can be sure you are driving with utmost safety new car available to order.Family life is made easy in this 2016 Jaguar XF.
											</p>
											<a id="load-text" href="" class="btn-show-more cs-color"> + Show More</a>-->
                                        </div>
                                        
										<div id="specification" class="auto-specifications detail-content">
											<div class="section-title" style="text-align:left;">
												<h4>Technical Specifications</h4>
											</div>
											<ul class="row">
												<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<div class="element-title">
														<i class="cs-color icon-engine"></i>
														<span>Engine and Drive Train</span>
													</div>
												</li>
												<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<div class="specifications-info">
														<ul>
															<li>
																<span>Number of cylinders</span>
																<strong><?php echo $f_car['cylinders'];?></strong>
															</li>
															<li>
																<span>Engine capacity</span>
																<strong><?php echo $f_car['engine_capacity'];?></strong>
															</li>
															<li>
																<span>Wheeldrive</span>
																<strong><?php echo $f_car['wheeldrive'];?></strong>
															</li>
															<li>
																<span>Steering</span>
																<strong><?php echo $f_car['steering'];?></strong>
															</li>
															<li>
																<span>Seats</span>
																<strong><?php echo $f_car['seats'];?></strong>
															</li>
														</ul>
													</div>
												</li>
												<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<div class="specifications-info">
														<ul>
															<li>
																<span>No of Doors</span>
																<strong><?php echo $f_car['doors'];?></strong>
															</li>
															<li>
																<span>Wheelchair</span>
																<strong><?php echo $f_car['wheelchair'];?></strong>
															</li>
															<li>
																<span>Color</span>
																<strong><?php echo $f_car['color'];?></strong>
                                                            </li>
                                                            <li>
																<span>Status</span>
                                                                <strong>
                                                                <?php
                                                                    if($f_car['status'] == 1 ){

                                                                            echo('Available');

                                                                    }else if($f_car['status'] == 2 ){

                                                                        echo('Reserved');

                                                                    }else{

                                                                        echo('Sold');

                                                                    }
																	?>
                                                                </strong>
                                                            </li>
                                                            <?php
                                                            if($f_car['licence_plate'] != ""){
                                                            ?>
                                                            <li>
																<span>Licence Plate</span>
																<strong><?php echo $f_car['licence_plate'];?></strong>
                                                            </li>
                                                            <?php } ?>
														</ul>
													</div>
												</li>
											</ul>
											<!--<ul class="row">
												<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<div class="element-title">
														<i class="cs-color icon-vehicle92"></i>
														<span>Transmission</span>
													</div>
												</li>
												<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<div class="specifications-info">
														<ul>
															<li>
																<span>Weiaght</span>
																<strong>Sport gauge cluster</strong>
															</li>
															<li>
																<span>MileagE</span>
																<strong>Sportier driver’s position</strong>
															</li>
														</ul>
													</div>
												</li>
												<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<div class="specifications-info">
														<ul>
															<li>
																<span>Weiaght</span>
																<strong>Paddle shifters</strong>
															</li>
															<li>
																<span>MileagE</span>
																<strong>6-speed manual</strong>
															</li>
														</ul>
													</div>
												</li>
                                            </ul>-->
                                            
                                        </div>
                                        
                                        <?php

                                        if($f_car['accessories'] != "") {                                            

                                        ?>
										<div id="accessories" class="cs-auto-accessories detail-content">
											<div class="element-title">
												<i class="cs-color icon-gear42"></i>
												<span>Accessories & Options</span>
											</div>
											<ul>
												<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<div class="cs-listing-icon">
														<ul>
                                                            <?php 

                                                            //convert string to array
                                                            $accessor = (explode(",",$f_car['accessories']));


                                                            //Loop the array
                                                            for ($i = 0; $i < count($accessor); $i++) {

                                                            ?>
															<li class="available">
	
                                                                <span><?php echo $accessor[$i]; ?></span>
                                                                
                                                            </li>
                                                            
                                                            <?php
                                                                }
                                                            ?>
															
															
														</ul>
													</div>
												</li>
												<!--<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<div class="cs-listing-icon">
														<ul>
															<li class="available">
	
																<span>Car Kit</span>
															</li>
															
															<li class="available">
	
																<span>Power sunroof</span>
															</li>
															<li class="available">
	
																<span>Power windows front</span>
															</li>
														</ul>
													</div>
												</li>-->
												
											</ul>
                                        </div>
                                        <?php

                                        } 

                                        ?>
										<!--<div id="contact" class="cs-contact-form detail-content">
											 <div class="section-title">
												<h4 style="text-align:left;">Contact Us</h4>
											 </div>
											  <form>
														<input type="text" placeholder="Full Name">
														<input type="email" placeholder="Email Address">
														<input type="text" placeholder="Phone Number">
														<textarea placeholder="Your Message"></textarea>
													<input type="submit" value="submit" class="cs-bgcolor">
													</form>
										</div>-->
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                	<!--<aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="cs-category-link-icon">
                        	<ul>
                                <li><a data-toggle="modal" href="remote.html" data-target="#request-more-info"><i class="cs-color icon-question-circle"></i>Request More Info</a></li>
                                <li><a data-toggle="modal" href="remote.html" data-target="#schedule-test-drive"><i class="cs-color icon-chrome2"></i>Schedule Test Drive</a></li>
                                <li><a data-toggle="modal" href="remote.html" data-target="#make-an-Offer"><i class="cs-color icon-documents2"></i>Make an Offer</a></li>
                                <li><a href="assets/extra-images/pdf-sample.pdf" download><i class="cs-color icon-print3"></i>Print this Detail</a></li>
                                <li><a data-toggle="modal" href="remote.html" data-target="#email-to-friend"><i class="cs-color icon-mail5"></i>Email to a Friend</a></li>
                            </ul>
                            <div class="cs-form-modal">
                            	<div class="modal fade" id="request-more-info" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Request More Info</h4>
                                                <div class="cs-login-form">
                                                    <form class="row">
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="cs-username-3">
                                                                    <strong>USERNAME</strong>
                                                                    <i class="icon-user-plus2"></i>
                                                                    <input type="text" id="cs-username-3" placeholder="Type desired username" required>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                            <label for="cs-email-3">
                                                                <strong>Email</strong>
                                                                <i class="icon-envelope"></i>
                                                                <input type="email" id="cs-email-3" placeholder="Type desired email" required>
                                                            </label>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="phone">
                                                                    <strong>Phone</strong>
                                                                    <i class="icon-iphone26"></i>
                                                                    <input type="tel" id="phone" placeholder="+44 123 456 789">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label>
                                                                    <textarea required></textarea>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <div class="cs-media">
                                                                        <figure><img src="assets/extra-images/cs-captha-img.png" alt="" /></figure>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <input class="cs-color csborder-color" type="submit" value="Submit Query">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            	</div> 
                            </div>
                            <div class="cs-form-modal">
                                <div class="modal fade" id="schedule-test-drive" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Schedule Test Drive</h4>
                                                <div class="cs-login-form">
                                                    <form class="row">
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                            <label for="cs-username-4">
                                                                <strong>USERNAME</strong>
                                                                <i class="icon-user-plus2"></i>
                                                                <input type="text" id="cs-username-4" placeholder="Type desired username" required>
                                                            </label>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                            <label for="cs-email-4">
                                                                <strong>Email</strong>
                                                                <i class="icon-envelope"></i>
                                                                <input type="email" id="cs-email-4" placeholder="Type desired username" required>
                                                            </label>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="phone-1">
                                                                    <strong>Phone</strong>
                                                                    <i class="icon-iphone26"></i>
                                                                    <input type="tel" id="phone-1" placeholder="+44 123 456 789">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="best-time-1">
                                                                    <strong>Best time</strong>
                                                                    <i class="icon-clock96"></i>
                                                                    <input type="text" id="best-time-1" placeholder="Select date" required>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label>
                                                                    <textarea required></textarea>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <div class="cs-media">
                                                                    <figure><img src="assets/extra-images/cs-captha-img.png" alt="" /></figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <input class="cs-color csborder-color" type="submit" value="Submit Query">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="cs-form-modal">
                                <div class="modal fade" id="make-an-Offer" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Make an Offer</h4>
                                                <div class="cs-login-form">
                                                    <form class="row">
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                            <label for="cs-username-6">
                                                                <strong>USERNAME</strong>
                                                                <i class="icon-user-plus2"></i>
                                                                <input type="text" id="cs-username-6" placeholder="Type desired username" required>
                                                            </label>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                            <label for="cs-email-6">
                                                                <strong>Email</strong>
                                                                <i class="icon-envelope"></i>
                                                                <input type="email" id="cs-email-6" placeholder="Type desired email" required>
                                                            </label>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="phone-6">
                                                                    <strong>Phone</strong>
                                                                    <i class="icon-iphone26"></i>
                                                                    <input type="tel" id="phone-6" placeholder="+44 123 456 789">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="offered-price">
                                                                    <strong>Offered Price</strong>
                                                                    <i class="icon-dollar183"></i>
                                                                    <input type="text" id="offered-price" placeholder="$25,000">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label>
                                                                    <strong>Financing Required</strong>
                                                                    <i class="icon-expand38"></i>
                                                                    <select data-placeholder="" style="width:100%;" class="chosen-select" tabindex="5">
                                                                        <option>$30,000</option>
                                                                        <option>$35,000</option>
                                                                        <option>$45,000</option>
                                                                        <option>$55,000</option>
                                                                      </select>
                                                                  </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label>
                                                                    <textarea required></textarea>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <div class="cs-media">
                                                                        <figure><img src="assets/extra-images/cs-captha-img.png" alt="" /></figure>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <input class="cs-color csborder-color" type="submit" value="Submit Query">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cs-form-modal">
                                <div class="modal fade" id="email-to-friend" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Email to a Friend</h4>
                                                <div class="cs-login-form">
                                                    <form class="row">
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                            <label for="cs-username-7">
                                                                <strong>USERNAME</strong>
                                                                <i class="icon-user-plus2"></i>
                                                                <input type="text" id="cs-username-7" placeholder="Type desired username" required>
                                                            </label>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="cs-email-7">
                                                                    <strong>Email</strong>
                                                                    <i class="icon-envelope"></i>
                                                                    <input type="email" id="cs-email-7" placeholder="Type desired email" required>
                                                                </label>
                                                        	</div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="cs-friend-email">
                                                                    <strong>Friend Email</strong>
                                                                    <i class="icon-envelope"></i>
                                                                    <input type="email" id="cs-friend-email" placeholder="Type desired friend email" required>
                                                                </label>
                                                        	</div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label for="phone-7">
                                                                    <strong>Phone</strong>
                                                                    <i class="icon-iphone26"></i>
                                                                    <input type="tel" id="phone-7" placeholder="+44 123 456 789">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <label>
                                                                    <textarea required></textarea>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <div class="cs-media">
                                                                    <figure><img src="assets/extra-images/cs-captha-img.png" alt="" /></figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="cs-modal-field">
                                                                <input class="cs-color csborder-color" type="submit" value="Submit Query">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>


                        <div class="auto-detail-filter">
                        	<div class="element-title">
                                <h6><i class="cs-bgcolor icon-line-graph"></i> Financing calculator</h6>
                            </div>
                            <div class="auto-filter">
                            	<form>
                                	<ul>
                                    	<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="auto-field">
                                            	<label>Vehicle price <span class="cs-color"> (&#x24;)</span></label>
          										<select data-placeholder="$25,000" style="width:100%;" class="chosen-select" tabindex="5">
                                                    <option>$30,000</option>
                                                    <option>$35,000</option>
                                                    <option>$45,000</option>
                                                    <option>$55,000</option>
                                                  </select>
                                            </div>
                                        </li>
                                    	<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="auto-field">
                                            	<label>Interest rate <span class="cs-color"> (&#x25;)</span></label>
          										<select data-placeholder="50%" style="width:100%;" class="chosen-select" tabindex="5">
                                                    <option>30%</option>
                                                    <option>35%</option>
                                                    <option>45%</option>
                                                    <option>55%</option>
                                                  </select>
                                            </div>
                                        </li>
                                        <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="auto-field">
                                            	<label>Period <span class="cs-color"> (month)</span></label>
                                                <span id="ex6CurrentSliderValLabel"><span id="ex6SliderVal">9</span> Months</span>
          										<input id="ex6" type="text" data-slider-min="0" data-slider-max="12" data-slider-step="1" data-slider-value="9"/>
                                            </div>
                                        </li>
                                        <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="auto-field">
                                            	<label>Down Payment<span class="cs-color"> (&#x25;)</span></label>
                                                <input type="text" placeholder="$326,500">
                                            </div>
                                        </li>
                                        <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="auto-field">
                                                <input class="cs-bgcolor" type="submit" value="Calculate">
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>

                    </aside>-->
                </div>
            </div>
		</div>
		

        <!--<div class="page-section" style="margin-bottom:50px">
            <div id="location" class="cs-map loader maps">
                 <iframe height='450' src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15876.382972391064!2d-55.2045817!3d5.8421285!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x868754a53c922104!2sBhaggoes+car+palace!5e0!3m2!1sen!2s!4v1491567228637">  </iframe>
            </div>
        </div>-->

        <div class="page-section" style="margin-bottom:30px;">
            <div class="container">
                <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div  style="text-align:left;" class="cs-section-title">
							<h3>Related Cars</h3>
						</div>
					</div>

					<?php
						//get cars
						$g_related_cars = $con->query("SELECT * FROM `cars` WHERE `status` > 0 AND `model_id` = '".$f_car['model_id']."' LIMIT 0,4");
						
						
						while($f_related_cars = mysqli_fetch_array($g_related_cars)){

						//fetch model
						$f_relatedcar_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_related_cars['model_id']."'"));

					?>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	                <div class="auto-listing auto-grid">
	                  <div class="cs-media">
                        <figure>
                            <a href="car-listing-detail.php?car-id=<?php echo $f_related_cars['car_id'] ?>" class="View-btn">
                            <img src="<?php echo BASEHREF."cms/upload/cars/medium/".$f_related_cars['img']; ?>" alt="#"/>
                            <?php if($f_related_cars['featured'] > 0){ echo'<figcaption><span class="auto-featured">Featured</span></figcaption>';} ?>
                            <?php
                                if($f_related_cars['status'] == 1 ){

                                        echo('<span class="car-status carstate-available">Available</span>');

                                }else if($f_related_cars['status'] == 2 ){

                                    echo('<span class="car-status carstate-reserved">Reserved</span>');

                                }else{

                                    echo('<span class="car-status carstate-sold">Sold</span>');

                                }
                            ?>
                            </a>
                        </figure>
	                  </div>
	                  <div class="auto-text">
	                    <span class="cs-categories">Key # <?php echo $f_related_cars['chassis']; ?></span>
	                    <div class="post-title">
			            	<h6><a href="#"><?php echo $f_relatedcar_model['title'];?> - <?php echo $f_related_cars['year'];?></a></h6>
			            	<div class="auto-price">
								<span class="cs-color">
								<?php if($f_related_cars['price_state'] < 1){
										echo '$'.$f_related_cars['price'];
									}else{
										echo '<a href="contact-us.php">Contact us for the price</a>';
									}
									?>
								</span> 
								<em><?php if($f_related_cars['price_state'] < 1){echo 'MSRP $'.$f_related_cars['price'];}?></em>
							</div>
			            </div>
			            <a href="car-listing-detail.php?car-id=<?php echo $f_related_cars['car_id'] ?>" class="View-btn">View Detail<i class=" icon-arrow-long-right"></i></a>
			           </div>
	                </div>
	              </div>
				 <?php
						}
				 ?>
	              
                </div>
            </div>
        </div>
       <!-- <div class="page-section" style="background:#19171a;">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <div class="cs-ad" style="text-align:center; padding:55px 0 32px;">
                          <div class="cs-media">
                                <figure>
                                    <img src="assets/extra-images/cs-ad-img.jpg" alt="" />
                                </figure>
                        	</div>
                    	</div>
                    </div>
                </div>
            </div>
  		</div>-->
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
<script src="assets/scripts/bootstrap-slider.js"></script>
<script src="assets/scripts/echo.js"></script>
<!-- Put all Functions in functions.js --> 
<script src="assets/scripts/functions.js"></script>

</body>
</html>
<?php
}
?>