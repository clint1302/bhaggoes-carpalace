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
<link href="style.css" rel="stylesheet">
<link href="cs-automobile-plugin.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.css" rel="stylesheet">
<link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
<link href="assets/css/chosen.css" rel="stylesheet">
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
	<div class="main-section"> 
	 <div class="page-section">
	   <div class="container">
	     <div class="row">

	          <aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
	             <div class="cs-listing-filters">
									 <div class="search-button" id="search-car">Search</div>
									 <input type="text" placeholder="Keyword" id="carkeyword" class="search-keyword">
	              <!-- <div class="cs-search">
	                 <form class="search-form">
	                   <div class="loction-search">
	                     <input type="text" placeholder="Select Location"/>
	                     <a href="#"><i class="icon-hair-cross cs-color"></i></a>
	                   </div>
	                   <div class="select-input">
	                     <select data-placeholder="Select Make" tabindex="1" class="chosen-select">
                              <option>Select make</option>
                              <option>Select make</option>
                              <option>Select make</option>
                              <option>Select make</option>
                         </select>
	                   </div>
	                 </form>
	               </div>-->
                   <!--<div class="cs-select-model">
                       <div class="cs-filter-title"><h6>Select Model</h6></div>
					  <form>
                        <ul class="cs-checkbox-list mCustomScrollbar" data-mcs-theme="dark">
													
                           <li>
                             <div class="checkbox">
                                 <input id="checkbox" type="checkbox" modid="<?php echo $f_cmodels['model_id']; ?>" value="Speed">
	                             <label for="checkbox"><?php echo $f_cmodels['title']; ?></label>
	                             <span>(<?php echo $count_car_model ?>)</span>
                             </div>
													 </li>
													 

                        </ul>
                      </form>
								 </div>-->

								 <div class="inventory-model-box">
                       <div class="inventory-model-title"><h6>Select Make</h6></div>
													
											 <div class="inventory-model-items">
															
															<?php
																//get cars
																$g_cbrands = $con->query("SELECT * FROM `car_brands` ORDER BY `title` ASC");
																
																
																while($f_cbrands = mysqli_fetch_array($g_cbrands)){
															
															?>
															<div class="checkbox carmodel-item">
																<label><input class="chk-carbrand" type="checkbox" value="<?php echo $f_cbrands['brand_id']; ?>"><?php echo $f_cbrands['title']; ?></label>
																
															</div>
															<?php
															}
														?>
														
												</div>		 
								 </div>


								 <div class="inventory-model-box">
                       <div class="inventory-model-title"><h6>Select Model</h6></div>
													
											 <div class="inventory-model-items">
															<!--<div class="inventory-model-checkbox-item">
																	<input id="model-checkbox" name="Junk" class="checkbox-model-inventory" type="checkbox" modid="" value="">
																	<label for="model-checkbox" class="label-model-inventory">TEST</label>
																	<span>(2)</span>
															</div>-->
															
															<?php
													//get cars
													$g_cmodels = $con->query("SELECT * FROM `car_models` ORDER BY `title` ASC");
													
													
													while($f_cmodels = mysqli_fetch_array($g_cmodels)){
													
													$count_car_model = mysqli_num_rows($con->query("SELECT `car_id` FROM `cars` WHERE `model_id` = '".$f_cmodels['model_id']."' "));
													
													?>
															<div class="checkbox carmodel-item">
																<label><input class="chk-carmodel" type="checkbox" value="<?php echo $f_cmodels['model_id']; ?>"><?php echo $f_cmodels['title']; ?></label>
																<span>(<?php echo $count_car_model ?>)</span>
															</div>
															<?php
															}
														?>
														
												</div>		 
								 </div>
								 
	              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					
								<div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingOne">
				        <a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Model year
				        </a>
				    </div>
				    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				      <div class="panel-body">
				        <div class="cs-model-year">
				          <div class="cs-select-filed">
                           <select data-placeholder="Recent Added" class="chosen-select-no-single" tabindex="5">
													 <?php 
															for($i = 2000 ; $i < date('Y'); $i++){
																	echo "<option yearid=".$i.">$i</option>";
															}
														?>
                           </select>
				          </div>
				          <span>to</span>
				          <div class="cs-select-filed">
				            <select data-placeholder="Recent Added" class="chosen-select-no-single" tabindex="5">
														<?php 
															for($i = 2000 ; $i < date('Y'); $i++){
																	echo "<option yearid=".$i.">$i</option>";
															}
														?>
                            </select>
				          </div>
				        </div>
				      </div>
				    </div>
					</div>
					
				  <div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingTwo">
				        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          Body Style
				        </a>
				    </div>
				    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
				      <div class="panel-body">
				        <div class="cs-carbody-style">
				          <form>
	                        <ul class="cs-checkbox-list">

													<?php

													//get cars
													$g_categories = $con->query("SELECT * FROM `car_categories` ORDER BY `title` ASC");
													
													while($f_cat = mysqli_fetch_array($g_categories)){
													
													?>
	                           <li>
	                             <div class="checkbox carbody-item">
		                             <label>
																 	<input name="chkbx"class="chk-bodystyle" type="checkbox" value="<?php echo $f_cat['category_id']; ?>">
		                               <img src="assets/extra-images/car-styles/<?php echo $f_cat['icon']; ?>" alt=""/>
		                               <span><?php echo $f_cat['title']; ?></span>
		                             </label>
	                             </div>
														 </li>

														 <!--<li>
	                             <div class="checkbox">
	                                 <input id="checkbox10" catid="<?php //echo $f_cat['category_id']; ?>" type="checkbox" value="Speed">
		                             <label for="checkbox10">
		                               <img src="assets/extra-images/car-select-img1.jpg" alt=""/>
		                               <span><?php //echo $f_cat['title']; ?></span>
		                             </label>
	                             </div>
														 </li>-->


														 <?php
															}
														?>

	                        </ul>
	                      </form>
				        </div>
				      </div>
				    </div>
					</div>
					
					
				  <!--<div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingThree">
				        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          PRICE RANGE
				        </a>
				    </div>
				    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
				      <div class="panel-body">
				        <div class="cs-price-range">
				          <form>
				          <input id="price" type="text" class="span2" value="3000" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[600,200]"/>
				          <div class="selector-value">
				          <span>$60,000</span>
				           <span class="pull-right">$20,000</span>
				          </div>
				          </form>
				        </div>
				      </div>
				    </div>
					</div> -->
					<!--
				  <div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingfoure">
				        <a class="collapsed" role="button" data-toggle="collapse" href="#collapsefoure" aria-expanded="false" aria-controls="collapsefoure">
				         Transmission
				        </a>
				    </div>
				    <div id="collapsefoure" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfoure">
				      <div class="panel-body">
				        <div class="cs-select-transmission">
				          <form>
	                        <ul class="cs-checkbox-list">
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox16" type="checkbox" value="Speed">
		                             <label for="checkbox16">5-Speed Automatic</label>
		                             <span>(34)</span>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox17" type="checkbox" value="Speed">
		                             <label for="checkbox17">5-Speed Manual</label>
		                             <span>(12)</span>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox18" type="checkbox" value="Speed">
		                             <label for="checkbox18">6-Speed Automatic</label>
		                             <span>(45)</span>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox19" type="checkbox" value="Speed">
		                             <label for="checkbox19">6-Speed Manual</label>
		                             <span>(32)</span>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox20" type="checkbox" value="Speed">
		                             <label for="checkbox20">6-Speed Semi-Auto</label>
		                             <span>(102)</span>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox21" type="checkbox" value="Speed">
		                             <label for="checkbox21">7-Speed PDK</label>
		                             <span>(122)</span>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox22" type="checkbox" value="Speed">
		                             <label for="checkbox22">8-Speed Automatic</label>
		                             <span>(34)</span>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox23" type="checkbox" value="Speed">
		                             <label for="checkbox23">8-Speed Tiptronic</label>
		                             <span>(12)</span>
	                             </div>
	                           </li>
	                        </ul>
                         </form>
				        </div>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingfive">
				        <a class="collapsed" role="button" data-toggle="collapse" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
				         Transmission
				        </a>
				    </div>
				    <div id="collapsefive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfive">
				      <div class="panel-body">
				        <div class="cs-select-transmission">
				          <form>
	                        <ul class="cs-checkbox-list">
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox24" type="checkbox" value="Speed">
		                             <label for="checkbox24">Brand New</label>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox25" type="checkbox" value="Speed">
		                             <label for="checkbox25">Slightly Used</label>
	                             </div>
	                           </li>
	                           <li>
	                             <div class="checkbox">
	                                 <input id="checkbox26" type="checkbox" value="Speed">
		                             <label for="checkbox26">Used</label>
	                             </div>
	                           </li>
	                        </ul>
                         </form>
				        </div>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingsix">
				        <a class="collapsed" role="button" data-toggle="collapse" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
				          Engine Capacity(cc)
				        </a>
				    </div>
				    <div id="collapsesix" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingsix">
				      <div class="panel-body">
				        <div class="cs-engine-capacity">
				          <form>
				          <input id="engine" type="text" class="span2" value="3000" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[600,200]"/>
				          <div class="selector-value">
				          <span>800CC</span>
				           <span class="pull-right">5500CC</span>
				          </div>
				          </form>
				        </div>
				      </div>
				    </div>
					</div>-->
					


                 </div>
	             </div>
						</aside>
<script>
var carmodel;
var carbrand;
var bodystyle;

//checkbox bodystyle
$('input.chk-bodystyle').on('change', function() {
    $('input.chk-bodystyle').not(this).prop('checked', false);  
});

//checkbox car model
$('input.chk-carmodel').on('change', function() {
    $('input.chk-carmodel').not(this).prop('checked', false);  
});

//checkbox car brand
$('input.chk-carbrand').on('change', function() {
    $('input.chk-carbrand').not(this).prop('checked', false);  
});

//search car model & body style
$("#search-car").unbind("click").click(function(event){
	
	//Change button text
	var button = $(this);
	
	$(button).text("Searching..");
	
var carkeyword = $("#carkeyword").val()

	// Get body style
	$('input:checkbox[class=chk-bodystyle]').each(function(){    
			if($(this).is(':checked'))
			bodystyle = $(this).val();

	});

	// Get car model
	$('input:checkbox[class=chk-carmodel]').each(function(){    
			if($(this).is(':checked'))
			carmodel = $(this).val();
	});

		// Get car brand
		$('input:checkbox[class=chk-carbrand]').each(function(){    
			if($(this).is(':checked'))
			carbrand = $(this).val();
	});

	//var brand = $("#addbrand").val();
	//var brand = $("#addbrand option:selected").val(); 

	//alert(carkeyword);

//if car model selected 
if(carmodel > 0){

				$.ajax({
											
					url:"cms/ajax/search-filter-carmodel.php",
					type:"POST",
					data: {carmodel:carmodel},
					success: function(resp){
									
						if(resp.indexOf("<div found") >= 0){
							
								//hide all view
								$(".cars-main-section").hide();
								$(".pagination-allcars ").hide();
				
								//show search result
								$(".cars-main-section-result").html(resp).show();
							
							
							$(button).text("Search");
							
							}else{
							
								$(button).text("No Cars Found");
								
								//change button text after 5 seconds
								setTimeout(function() {

									$(button).text("Search again");

								}, 5000);

								//hide result
								//$(".cars-main-section-result").html("").hide();
								
								//show all view
								$(".cars-main-section").show();
								$(".pagination-allcars ").show();
								$(".cars-main-section-result").html(resp).show();

							}
					}
									
									
			});
		
	}

//if bodystyle selected
	if(bodystyle > 0){

				$.ajax({
											
					url:"cms/ajax/search-filter-bodystyle.php",
					type:"POST",
					data: {bodystyle:bodystyle},
					success: function(resp){
									
						if(resp.indexOf("<div found") >= 0){
							
								//hide all view
								$(".cars-main-section").hide();
								$(".pagination-allcars ").hide();

								//show search result
								$(".cars-main-section-result").html(resp).show();
							
							
							$(button).text("Search");
							
							}else{
							
								$(button).text("No Cars Found");
								
								//change button text after 5 seconds
								setTimeout(function() {

									$(button).text("Search again");

								}, 5000);

								//hide result
								//$(".cars-main-section-result").html("").hide();
								
								//show all view & stuff
								$(".cars-main-section").show();
								$(".pagination-allcars ").show();
								$(".cars-main-section-result").html(resp).show();
							
							}
					}
									
									
			});
		
	}

//*/
	event.preventDefault();
	
});

</script>




	          <div class="section-content col-lg-9 col-md-9 col-sm-12 col-xs-12">
							<div class="row cars-main-section-result"></div>
	            <div class="row cars-main-section">

	              <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="auto-sort-filter">
	                  <div class="auto-show-resuilt"><span>SHOWING <em>25</em> RESULTS FOR YOUR SEARCH</span></div>
	                 <div class="auto-list">
	                    <span>Sort</span>
	                    <ul>
	                      <li>
	                       <div class="cs-select-post">
	                         <select data-placeholder="Recent Added" class="chosen-select-no-single" tabindex="5">
                                  <option>Recent Added</option>
                                  <option>Recent Added</option>
                                  <option>Recent Added</option>
                                  <option>Recent Added</option>
                              </select>
	                       </div>
	                      </li>
	                      <li><a href="#"><i class=" icon-view_module"></i></a></li>
	                      <li><a href="#"><i class="icon-view_array"></i></a></li>
	                    </ul>
	                  </div>
	                </div>
								</div>-->
								<!--
	              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="auto-your-search">
	                  <ul class="filtration-tags">
	                    <li><a href="#">Hybrid <i class="icon-cross2"></i></a></li>
	                    <li><a href="#">Bmw<i class="icon-cross2"></i></a></li>
	                    <li><a href="#">Compact hatchbac<i class="icon-cross2"></i></a></li>
	                  </ul>
	                  <a href="#" class="clear-tags cs-color">Clear Filters</a>
	                </div>
								</div>-->
								


					<?php

						$perpage = 6;

						if(isset($_GET["page"])){

						$page = intval($_GET["page"]);

						}

						else {

						$page = 1;

						}

						$calc = $perpage * $page;

						$start = $calc - $perpage;

						$result = mysqli_query($con, "SELECT * FROM `cars` WHERE `status` > 0 LIMIT $start, $perpage");

						$rows = mysqli_num_rows($result);

						if($rows){

						$i = 0;
															
						//get cars
						//$g_cars = $con->query("SELECT * FROM cars WHERE `status` > 0 ORDER BY `year` DESC LIMIT $offset, $rowsperpage ");
						
						
						//while($f_cars = mysqli_fetch_array($g_cars)){
						while($f_cars = mysqli_fetch_assoc($result)) {
								
						//fetch model
						$f_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_cars['model_id']."'"));

				?>

	              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
	                <div class="auto-listing auto-grid">
	                  <div class="cs-media">
	                     <figure> 
												 <img src="<?php echo BASEHREF."cms/upload/cars/medium/".$f_cars['img']; ?>" alt="#"/>
												 <?php
														if($f_cars['status'] == 1 ){

																echo('<span class="car-status carstate-available">Available</span>');

														}else if($f_cars['status'] == 2 ){

															echo('<span class="car-status carstate-reserved">Reserved</span>');

														}else{

															echo('<span class="car-status carstate-sold">Sold</span>');

														}
												 ?>
												 
											</figure>
	                  </div>
	                  <div class="auto-text">
				   	<span class="cs-categories">Bhaggoes</span>
	                    <div class="post-title">
			            	<h4><a href="car-listing-detail.php?car-id=<?php echo $f_cars['car_id'] ?>"><?php echo $f_model['title'];?> - <?php echo $f_cars['year'];?></a></h4>
						<h6><a href="car-listing-detail.php?car-id=<?php echo $f_cars['car_id'] ?>"><?php echo $f_model['title'];?> - <?php echo $f_cars['year'];?></a></h6>

			            	<div class="auto-price"><span class="cs-color"><?php if($f_cars['price_state'] < 1){

																																				echo '$'.$f_cars['price'];

																																				}else{
																																					echo 'Contact us for the price';
																																				}

																																				?>
											</span><em><?php if($f_cars['price_state'] < 1){echo 'MSRP $'.$f_cars['price'];}?></em></div>
			            	<a href="#"><img src="assets/extra-images/post-list-img2.jpg" alt=""/></a>
			            </div><!--
			            <ul class="auto-info-detail">
			              <li>Year<span><?php echo $f_cars['year'];?></span></li>
			              <li>Mileage<span><?php echo $f_cars['mileage'];?></span></li>
			              <li>Trans<span><?php echo $f_cars['transmission'];?></span></li>
			              <li>Fuel Type<span><?php echo $f_cars['fuel'];?></span></li>
			            </ul>
			             <div class="btn-list">
			               <a href="javascript:void(0)" class="btn btn-danger collapsed" data-toggle="collapse" data-target="#list-view1"></a><div id="list-view1" class="collapse">
			                 <ul>
			                    <li>30/36 est. mpg 18</li>
			                    <li>Black front grille with chrome accent</li>
			                    <li>Cruise control</li>
			                    <li>Remote keyless entry system</li>
			                    <li>Tilt 3-spoke steering wheel with audio controls</li>
			                    <li>15-in. alloy wheels</li>
			                 </ul>
			               </div>
			             </div>
			            <p>Start by a group of maverick Nissan engineers heights of Nissan performance almost...<a href="#" class="read-more cs-color">+ More</a></p>
			            <div class="cs-checkbox">
			              <input type="checkbox" name="list" value="check-listn" id="check-list1">
						  <label for="check-list1">Compare</label>
									</div>-->
					 
			            <a href="#" class="short-list cs-color"><i class="icon-heart-o"></i>ShortList</a>
					  <a href="car-listing-detail.php?car-id=<?php echo $f_cars['car_id'] ?>" class="View-btn">View Detail<i class=" icon-arrow-long-right"></i></a>
			           </div>
	                </div>
	              </div>
								

<?php
					 	}
					}
?>

							
	              </div>
	              <div class="pagination-allcars col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <nav>
		                <ul class="pagination">
											 
											<?php
														if(isset($page))

														{

														$result = mysqli_query($con,"SELECT COUNT(*) AS Total FROM `cars` WHERE `status` > 0");

														$rows = mysqli_num_rows($result);

														if($rows)

														{

														$rs = mysqli_fetch_assoc($result);

														$total = $rs["Total"];

														}

														$totalPages = ceil($total / $perpage);

														if($page <=1 ){

														echo "<li><a aria-label='Previous'><span aria-hidden='true'><i class='icon-angle-left'></i></span></a></li>";

														}

														else

														{

														$j = $page - 1;

														echo "<li><a href='auto-grid.php?page=$j' aria-label='Previous'><span aria-hidden='true'><i class='icon-angle-left'></i></span></a></li>";

														}

														for($i=1; $i <= $totalPages; $i++)

														{

														if($i<>$page)

														{

														echo "<li><a href='auto-grid.php?page=$i'>$i</a></li>";

														}

														else

														{

														echo "<li><a class='active'>$i</a></li>";

														}

														}

														if($page == $totalPages )

														{

														echo "<li><a aria-label='Next'><span aria-hidden='true'><i class='icon-angle-right'></i></span></a></li>";

														}

														else

														{

														$j = $page + 1;

														echo "<li><a href='auto-grid.php?page=$j' aria-label='Next'><span aria-hidden='true'><i class='icon-angle-right'></i></span></a></li>";

														}
														}

											?>
											<!--<li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="icon-angle-left"></i></span></a></li>
											
			                <li><a class="active">1</a></li>
			                <li><a href="#">2</a></li>
			                <li><a href="#">3</a></li>
			                <li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											
											<li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="icon-angle-right"></i></span></a></li>-->
		                </ul>
	                </nav>
	              </div>
	            </div>
	          </div>
	     </div>
	   </div>
	 </div>        
        <div class="page-section" style="background:#19171a;">
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
<script src="assets/scripts/bootstrap-slider.js"></script> 
<script src="assets/scripts/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="assets/scripts/echo.js"></script>
<!-- Put all Functions in functions.js --> 
<script src="assets/scripts/functions.js"></script>
</body>
</html>