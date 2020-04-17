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
	<!-- Header End --> 
	
	<!-- Main Start -->
	
	
		


<!--full width category section-->
		<div class="page-section" style="background:#edf0f5 url(<?php echo BASEHREF."assets/bhaggoes_location.png"; ?>) no-repeat; padding:100px 0 0 0;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div style="min-height:510px;"></div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="row"> 
							<!--Element Section Start-->
							<div class="catagory-section">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="cs-element-title">
										<h3>Browse cars by make</h3>
										
										<span class="cs-color">We currently have <?php $count_allcars = mysqli_num_rows($con->query("SELECT `car_id` FROM `cars` WHERE `status` >= '1' ")); echo $count_allcars; ?> cars available</span> </div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="cs-catagory">
										<ul>
										<?php
													//get cars
													$g_brands1 = $con->query("SELECT * FROM `car_brands` ORDER BY `title` ASC LIMIT 0,10");

													$g_carscount2 = $con->query("SELECT * FROM `cars` WHERE `status` > 0 ");
													
													while($f_carscount2 = mysqli_fetch_array($g_carscount2)){
													
													$count_brandmodels = mysqli_num_rows($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_carscount2['model_id']."' "));
													
													}

													while($f_brands1 = mysqli_fetch_array($g_brands1)){
										?>
											<a href="auto-brands.php?brand-id=<?php echo $f_brands1['brand_id'] ?>"><li><span><?php echo $f_brands1['title']; ?></span><small><?php //echo $count_brandmodels; ?></small></li></a>

										<?php
													}
										?>
										</ul>
									</div>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="cs-catagory">
										<ul>
											<?php
													//get cars
													$g_brands2 = $con->query("SELECT * FROM `car_brands` WHERE `brand_id` != 24 ORDER BY `title` ASC LIMIT 10,10");
													
													

													while($f_brands2 = mysqli_fetch_array($g_brands2)){
														
														$g_carscount1 = $con->query("SELECT * FROM `cars` WHERE `status` > 0 ");
														
														while($f_carscount1 = mysqli_fetch_array($g_carscount1)){

															$count_brandmodels = mysqli_num_rows($con->query("SELECT c.car_id
															
															FROM cars  c
															
															RIGHT OUTER JOIN car_models m ON m.`model_id` = c.`model_id`
																				
															RIGHT OUTER JOIN car_brands b ON b.`brand_id` = m.`brand_id`
																				
															WHERE c.model_id = '".$f_carscount1['model_id']."' "));
														}

													
										?>
											<a href="auto-brands.php?brand-id=<?php echo $f_brands2['brand_id'] ?>"><li><span><?php echo $f_brands2['title']; ?></span><small><?php //echo $count_brandmodels; ?></small></li></a>
											<?php
													}
											?>
										</ul>
									</div>
								</div>

								
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="cs-catagory">
										<ul>
											<?php
													//get cars
													$g_brands3 = $con->query("SELECT * FROM `car_brands` ORDER BY `title` ASC LIMIT 20,10");
													
													$f_brandother = mysqli_fetch_assoc($con->query("SELECT * FROM `car_brands` WHERE `brand_id` = 24 "));

													while($f_brands3 = mysqli_fetch_array($g_brands3)){
													
													//$count_brandmodels = mysqli_num_rows($con->query("SELECT `cars.car_id`,`` FROM `cars` INNER JOIN `cars.model_id` = `car_models.model_id` WHERE `model_id` = '".$f_brands1['brand_id']."' "));
													
										?>
											<!--<li><span><?php echo $f_brands3['title']; ?></span><small>(<?php //echo $count_brandmodels; ?>)</small></li>-->
											<a href="auto-brands.php?brand-id=<?php echo $f_brands3['brand_id'] ?>"><li><span><?php echo $f_brands3['title']; ?></span><small><?php //echo $count_brandmodels; ?></small></li></a>
											<?php
													}

											?>
											<a href="auto-brands.php?brand-id=<?php echo $f_brandother['brand_id'] ?>">
												<li><span><?php echo $f_brandother['title']; ?></span><small><?php //echo $count_brandmodels; ?></small></li>
											</a>
										</ul>
									</div>
								</div>


								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="button_style cs-button"> <a href="auto-grid.php">Search for cars</a> </div>
								</div>
							</div>
							<!--Element Section End--> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--full width category section--> 










		<?php

		//Fetch car
		$f_sfeat_car = mysqli_fetch_assoc($con->query("SELECT * FROM `cars` WHERE `status` > 0 AND `featured` = 1 ORDER BY  RAND() LIMIT 1 "));

		//fetch model
		$f_sfeat_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_sfeat_car['model_id']."'"));

		$f_sfeat_brand = mysqli_fetch_assoc($con->query("SELECT * FROM `car_brands` WHERE `brand_id` = '".$f_sfeat_model['brand_id']."'"));

		?>
		<div class="page-section" style="padding:110px 0;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="image-frame defualt">
							<div class="cs-media">
								<figure> <img src="<?php echo BASEHREF."cms/upload/cars/medium/".$f_sfeat_car['img']; ?>" alt=""/> </figure>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="cs-column-text"> <span class="cs-color" style="font-size:14px;margin-bottom:15px;text-transform: capitalize !important; font-weight:bold;">Check one of our Featured cars out!</span>
							<h1 style=" line-height:43px !important;"><?php echo $f_sfeat_brand['title'];?> <?php echo $f_sfeat_model['title'];?>, <?php echo $f_sfeat_car['year'];?>, <?php echo $f_sfeat_car['transmission'];?>, <?php echo $f_sfeat_car['engine_capacity'].'CC';?>, <?php echo $f_sfeat_car['wheeldrive'];?>, <?php echo $f_sfeat_car['fuel'];?>  </h1>
							<h1 style=" line-height:43px !important; color:#d00000 !important">
							<?php if($f_sfeat_car['price_state'] < 1){
								echo '$'.$f_sfeat_car['price'];
							}else{
								echo '<a href="contact-us.php">Contact us for the price</a>';
							}
							?>
							</h1>
							<!--<p style="margin-bottom:25px; ">Arear view camera and lane departure warning. This car has 6 airbags fitted for your protection. It has front &amp; rear power windows, central locking and 2nd row split folding seats. Family life is made easy in this 2016 Jaguar XF. This car has Bluetooth connectivity, side curtain airbags, subwoofer, trailer sway control, sports pedals and heads up information display. This car has forward collision alert/warning. This car comes with enough seats for 5. You can relax.</p>-->
							<a href="car-listing-detail.php?car-id=<?php echo $f_sfeat_car['car_id'] ?>" class="cs-button" style="color:#fff;font-size:11px; padding:12px 45px; font-weight:bold; text-transform:uppercase;">More info</a> </div>
					</div>
				</div>
			</div>
		</div>
		<!--image frame with cloum text by My Shahzad--> 
		
		<!--tabs section-->
		<div class="page-section" style="padding-top:70px; padding-bottom:65px;">
			<div class="container">
				<div class="row">
					<div class="section-fullwidtht col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 co-sm-12 col-xs-12"><!--Element Section Start-->
								<div class="cs-section-title">
									<h3 style="text-transform:uppercase !important;">Perfect Cars for you</h3>
								</div>
								<!--Tabs Start-->
								
								<div class="cs-tabs full-width">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#home">New Cars</a></li>
										<li><a data-toggle="tab" href="#menu1">Preowned Cars</a></li>
										<li><a data-toggle="tab" href="#menu2">Trucks and Bus</a></li>
									</ul>
									<div class="tab-content">

										<!-- New -->
										<div id="home" class="tab-pane fade in active">
											<div class="row">

												
												<?php
													//get cars
													$g_cars = $con->query("SELECT * FROM `cars` WHERE `status` > 0 AND `pre_owned` = 0 ORDER BY `year` DESC LIMIT 0,8");
													
													
													while($f_cars = mysqli_fetch_array($g_cars)){

													//fetch model
													$f_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_cars['model_id']."'"));

													?>
													<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
														<div class="auto-listing auto-grid">
															<div class="cs-media">
																<figure> 
																	<a href="car-listing-detail.php?car-id=<?php echo $f_cars['car_id'] ?>" class="View-btn">
																		<img src="<?php echo BASEHREF."cms/upload/cars/medium/".$f_cars['img']; ?>" alt="#"/>
																	
																<?php if($f_cars['featured'] > 0){ echo'<figcaption><span class="auto-featured">Featured</span></figcaption>';} ?>
																<?php
																		if($f_cars['status'] == 1 ){

																				echo('<span class="car-status carstate-available">Available</span>');

																		}else if($f_cars['status'] == 2 ){

																			echo('<span class="car-status carstate-reserved">Reserved</span>');

																		}else{

																			echo('<span class="car-status carstate-sold">Sold</span>');

																		}
																?>
																</a>
																</figure>
															</div>
															<div class="auto-text"> <span class="cs-categories">Key # <?php echo $f_cars['chassis']; ?></span>
																<div class="post-title">
																	<h6><a href="#"><?php echo $f_model['title'];?> - <?php echo $f_cars['year'];?></a></h6>
																	<div class="auto-price"><span class="cs-color">
																		<?php if($f_cars['price_state'] < 1){
																			echo '$'.$f_cars['price'];
																		}else{
																			echo '<a href="contact-us.php">Contact us for the price</a>';
																		}
																		?>
																		</span> 
																		<em><?php if($f_cars['price_state'] < 1){echo 'MSRP $'.$f_cars['price'];}?></em></div>
																</div>
																<a href="car-listing-detail.php?car-id=<?php echo $f_cars['car_id'] ?>" class="View-btn">View Detail<i class=" icon-arrow-long-right"></i></a> 
															
															</div>

														</div>
													</div>
													<?php

														}


													?>

											</div>
										</div>
										<!-- New -->


										<!-- Pre-owned -->
										<div id="menu1" class="tab-pane fade">
											<div class="row">

												<?php
													//get cars
													$feat_cars = $con->query("SELECT * FROM `cars` WHERE `status` > 0 AND `pre_owned` = 1 ORDER BY `year` DESC LIMIT 0,8");
													
													
													while($f_featc = mysqli_fetch_array($feat_cars)){

													//fetch model
													$f_modfeat = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_featc['model_id']."'"));

												?>
													<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
														<div class="auto-listing auto-grid">
															<div class="cs-media">
																<figure> 
																	<a href="car-listing-detail.php?car-id=<?php echo $f_featc['car_id'] ?>" class="View-btn">
																		<img src="<?php echo BASEHREF."cms/upload/cars/medium/".$f_featc['img']; ?>" alt="#"/>
																	
																	<?php if($f_featc['featured'] > 0){ echo'<figcaption><span class="auto-featured">Featured</span></figcaption>';} ?>
																	<?php
																		if($f_featc['status'] == 1 ){

																				echo('<span class="car-status carstate-available">Available</span>');

																		}else if($f_featc['status'] == 2 ){

																			echo('<span class="car-status carstate-reserved">Reserved</span>');

																		}else{

																			echo('<span class="car-status carstate-sold">Sold</span>');

																		}
																	?>
																	</a>
																</figure>
															</div>
															<div class="auto-text"> <span class="cs-categories">Key # <?php echo $f_featc['chassis']; ?></span>
																<div class="post-title">
																	<h6><a href="#"><?php echo $f_modfeat['title'];?> - <?php echo $f_featc['year'];?></a></h6>
																	<?php
																	if($f_featc['licence_plate'] != ""){
																	?>
																	<span class="cs-licenceplate"><strong>Licence Plate </strong> - <?php echo $f_featc['licence_plate'];?></span>
																	<?php } ?>
																	<div class="auto-price">
																		<span class="cs-color">
																			<?php if($f_featc['price_state'] < 1){
																					echo '$'.$f_featc['price'];
																				}else{
																					echo '<a href="contact-us.php">Contact us for the price</a>';
																				}
																			?>
																		</span> 
																		<em><?php if($f_featc['price_state'] < 1){echo 'MSRP $'.$f_featc['price'];}?></em>
																	</div>
																</div>
																<a href="car-listing-detail.php?car-id=<?php echo $f_featc['car_id'] ?>" class="View-btn">View Detail<i class=" icon-arrow-long-right"></i></a>
															</div>

														</div>
													</div>
												<?php

														}


												?>
											</div>
										</div> 
										<!-- Pre-owned -->
										

										<!-- Car-cat1 -->
										<div id="menu2" class="tab-pane fade">
											<div class="row">

											<?php
													//get cars
													$all_cars_cat = $con->query("SELECT * FROM `cars` WHERE `status` > 0 AND `category_id` IN (1,5)  ORDER BY `year` DESC LIMIT 0,8");
													
													
													while($f_allcars_cat = mysqli_fetch_array($all_cars_cat)){

													//fetch model
													$f_mod_allcarscat = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_allcars_cat['model_id']."'"));

												?>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="auto-listing auto-grid">
														<div class="cs-media">
															<figure> 
																<a href="car-listing-detail.php?car-id=<?php echo $f_allcars_cat['car_id'] ?>" class="View-btn">
																<img src="<?php echo BASEHREF."cms/upload/cars/medium/".$f_allcars_cat['img']; ?>" alt="#"/>
																<?php if($f_allcars_cat['featured'] > 0){ echo'<figcaption><span class="auto-featured">Featured</span></figcaption>';} ?>
																<?php
																		if($f_allcars_cat['status'] == 1 ){

																				echo('<span class="car-status carstate-available">Available</span>');

																		}else if($f_allcars_cat['status'] == 2 ){

																			echo('<span class="car-status carstate-reserved">Reserved</span>');

																		}else{

																			echo('<span class="car-status carstate-sold">Sold</span>');

																		}
																	?>
																</a>
															</figure>
														</div>
														<div class="auto-text"> <span class="cs-categories">Key # <?php echo $f_allcars_cat['chassis']; ?></span>
															<div class="post-title">
																<h6><a href="#"><?php echo $f_mod_allcarscat['title'];?> - <?php echo $f_allcars_cat['year'];?></a></h6>
																<div class="auto-price">
																	<span class="cs-color">
																		<?php if($f_allcars_cat['price_state'] < 1){
																						echo '$'.$f_allcars_cat['price'];
																					}else{
																						echo '<a href="contact-us.php">Contact us for the price</a>';
																					}
																		?>
																	</span> 
																	<em><?php if($f_allcars_cat['price_state'] < 1){echo 'MSRP $'.$f_allcars_cat['price'];}?></em>
																</div>
															</div>
															<a href="car-listing-detail.php?car-id=<?php echo $f_allcars_cat['car_id'] ?>" class="View-btn">View Detail<i class=" icon-arrow-long-right"></i></a>
														</div>
													</div>
												</div>
												<?php

														}


												?>
											</div>
										</div>

										<!-- Car-cat1 -->

										<!-- Car-cat2 
										<div id="menu3" class="tab-pane fade">
											<div class="row">
												<?php
													//get cars
													$all_cars_cat2 = $con->query("SELECT * FROM `cars` WHERE `category_id` IN (2,9)  ORDER BY `year` DESC LIMIT 0,8");
													
													
													while($f_allcars_cat2 = mysqli_fetch_array($all_cars_cat2)){

													//fetch model
													$f_mod_allcarscat2 = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_allcars_cat2['model_id']."'"));

												?>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="auto-listing auto-grid">

														<div class="cs-media">
															<figure> <img src="<?php echo BASEHREF."cms/upload/cars/medium/".$f_allcars_cat2['img']; ?>" alt="#"/>
																<?php if($f_allcars_cat2['featured'] > 0){ echo'<figcaption><span class="auto-featured">Featured</span></figcaption>';} ?>
															</figure>
														</div>
														<div class="auto-text"> <span class="cs-categories">Key # <?php echo $f_allcars_cat2['chassis']; ?></span>
															<div class="post-title">
																<h6><a href="#"><?php echo $f_mod_allcarscat2['title'];?> - <?php echo $f_allcars_cat2['year'];?></a></h6>
																<div class="auto-price">
																	<span class="cs-color">
																		<?php if($f_allcars_cat2['price_state'] < 1){
																						echo '$'.$f_allcars_cat2['price'];
																					}else{
																						echo 'Contact us for the price';
																					}
																		?>
																	</span> 
																	<em><?php if($f_allcars_cat2['price_state'] < 1){echo 'MSRP $'.$f_allcars_cat2['price'];}?></em>
																</div>
															</div>
															<a href="car-listing-detail.php?car-id=<?php echo $f_allcars_cat2['car_id'] ?>" class="View-btn">View Detail<i class=" icon-arrow-long-right"></i></a>
														</div>

													</div>
												</div>
												<?php

														}


												?>

											</div>
										</div> -->
										<!-- Car-cat2 -->				

									</div>
								</div>
								<!--Tabs End--> 
								<!--Element Section End--></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--tabs section--> 
		
		<!--Latest Model Auto Slider End-->
		<div class="page-section" style=" padding-top:70px; padding-bottom:50px;">
			<div class="container">
				<div class="row">
					<div class="section-fullwidtht col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row"> 
							
							<div class="cs-seprater" style="text-align:center;"> <span> <i class="icon-transport177"> </i> </span> </div>
							<!--Element Section End--> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--
		<div class="page-section" style="margin-bottom:70px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="section-title" style="text-align:center; color:#333333; margin-bottom:45px;">
							<h3 style="margin-bottom:5px;">WHY CHOOSE US</h3>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="cs-services">
							<div class="cs-media"> <i class="icon-fuel1 cs-color" style="font-size:70px;"> </i> </div>
							<div class="cs-text">
								<h6>OIL CHANGES </h6>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="cs-services">
							<div class="cs-media"> <i class="icon-car230 cs-color" style="font-size:40px"> </i> </div>
							<div class="cs-text">
								<h6>AIR CONDITIONING</h6>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="cs-services">
							<div class="cs-media"> <i class="icon-energy42 cs-color" style="font-size:40px"> </i> </div>
							<div class="cs-text">
								<h6>AUTO ELECTRIC </h6>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="cs-services">
							<div class="cs-media"> <i class="icon-car36 cs-color" style="font-size:40px"> </i> </div>
							<div class="cs-text">
								<h6>BRAKE SERVICE </h6>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="cs-services">
							<div class="cs-media"> <i class="icon-car228 cs-color" style="font-size:40px"> </i> </div>
							<div class="cs-text">
								<h6>TRANSMISSION</h6>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="cs-services">
							<div class="cs-media"> <i class="icon-transport177 cs-color" style="font-size:40px"> </i> </div>
							<div class="cs-text">
								<h6>TIRE &amp; WHEEL SERVICE</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!--<div class="page-section" style="background:#19171a;;">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="cs-ad" style="text-align:center; padding:55px 0 25px;">
							<div class="cs-media">
								<figure> <a href="#"><img alt="" src="assets/extra-images/cs-ad-img.jpg"></a> </figure>
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
<script src="assets/scripts/echo.js"></script> 
<!-- Put all Functions in functions.js --> 
<script src="assets/scripts/functions.js"></script>
</body>
</html>