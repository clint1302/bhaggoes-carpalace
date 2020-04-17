<!DOCTYPE html>
<?php 
include('cms/core/sql/conf.php'); 

//if (isset($_GET['brand-id'])) {
	
	
	//$id = $_GET['brand-id'];
	
	//Get car
	//$f_car = mysqli_fetch_assoc($con->query("SELECT * FROM `cars` WHERE `car_id` = '".$id."'"));
	
	//fetch model
	//$f_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_car['model_id']."'"));
	
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

                 </div>
	             </div>
						</aside>
<script>
var carmodel;
var carbrand = 0;
var bodystyle;
var loading;
var ajaxloader;
var button;
//hide car model block
$("#carmodel-box").hide(200);
$(".carmodel-spec").hide(200);

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



//show if brand is selected
$(".chk-carbrand").click(function() {
	if($(this).is(":checked")) {

			//hide model box and models
			$("#carmodel-box").hide(300);
		  $(".carmodel-spec").hide(200);

			// Get car brand
			$('input:checkbox[class=chk-carbrand]').each(function(){    
				if($(this).is(':checked'))
				carbrand = $(this).val();

			});
			
			//show model box and models
			$("#carmodel-box").show(300);
			$('.carmodel-spec:contains("'+carbrand+'")').show(300);

			//alert(carbrand);

	} else {

			$("#carmodel-box").hide(200);
	}

});

//search by keyword
$("#carkeyword").keyup(function(){
	
	var keyword = $(this).val();
	
	//alert(keyword);
	
	if(ajaxloader != null){
		ajaxloader.abort();
	}
	
	ajaxloader = $.ajax({
		type:"POST",
		data:{keyword:keyword},
		url:"<?php echo BASEHREF; ?>cms/ajax/search-filter-keyword.php",
		success:function(resp){
			
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
//	*/

	
	event.preventDefault();

});

//search car model & body style
$("#search-car").unbind("click").click(function(event){
	
	//Change button text
	button = $(this);
	
	$(button).text("Searching..");
	
var carkeyword = $("#carkeyword").val()
var beginModelYear = $('#b-modelyear').find(":selected").text();
var endModelYear = $('#e-modelyear').find(":selected").text();


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



	//var brand = $("#addbrand").val();
	//var brand = $("#addbrand option:selected").val(); 

	//alert(carbrand);
///*
	$.ajax({
											
					url:"cms/ajax/search-filter-car.php",
					type:"POST",
					data: {carmodel:carmodel,beginModelYear:beginModelYear,endModelYear:endModelYear},
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
//if car model selected 


//*/
	event.preventDefault();
	
});

</script>




	          <div class="section-content col-lg-9 col-md-9 col-sm-12 col-xs-12 item-preowned-block">
							<div class="row cars-main-section-result"></div>
	            <div class="row cars-main-section">


					<?php

						$perpage = 9;

						if(isset($_GET["page"])){

						$page = intval($_GET["page"]);

						}

						else {

						$page = 1;

						}

						$calc = $perpage * $page;

						$start = $calc - $perpage;

						$result = mysqli_query($con, "SELECT * FROM `cars` WHERE `status` > 0 AND `price_state` = 0 AND `discount` = 1 LIMIT $start, $perpage");

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

	              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 item-preownded">
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
	                  <div class="auto-text">
						 <!--<span class="cs-categories">Bhaggoes</span>-->
						 <span class="cs-categories">Key # <?php echo $f_cars['chassis']; ?></span>
						 
	                    <div class="post-title">
											
			            	<h4><a href="car-listing-detail.php?car-id=<?php echo $f_cars['car_id'] ?>"><?php echo $f_model['title'];?> - <?php echo $f_cars['year'];?></a></h4>
						<h6><a href="car-listing-detail.php?car-id=<?php echo $f_cars['car_id'] ?>"><?php echo $f_model['title'];?> - <?php echo $f_cars['year'];?></a></h6>
						<?php
						if($f_cars['licence_plate'] != ""){
						?>
						<span class="cs-licenceplate"><strong>Licence Plate </strong> - <?php echo $f_cars['licence_plate'];?></span>
						<?php } ?>

			            	<div class="auto-price"><span class="cs-color">
								<?php if($f_cars['price_state'] < 1){

								echo '$'.$f_cars['price'];

								}else{
									echo '<a href="contact-us.php">Contact us for the price</a>';
								}

								?>
											</span><em><?php if($f_cars['price_state'] < 1){echo 'MSRP $'.$f_cars['price'];}?></em></div>
			            	<a href="#"><img src="assets/extra-images/post-list-img2.jpg" alt=""/></a>
			            </div>
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

														$result = mysqli_query($con,"SELECT COUNT(*) AS Total FROM `cars` WHERE `status` > 0 AND `price_state` = 0 AND `discount` = 1 ");

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

														echo "<li><a href='auto-discount-cars.php?page=$j' aria-label='Previous'><span aria-hidden='true'><i class='icon-angle-left'></i></span></a></li>";

														}

														for($i=1; $i <= $totalPages; $i++)

														{

														if($i<>$page)

														{

														echo "<li><a href='auto-discount-cars.php?page=$i'>$i</a></li>";

														}

														else

														{

														echo "<li><a class='active' style='color:#fff !important;'>$i</a></li>";

														}

														}

														if($page == $totalPages )

														{

														echo "<li><a aria-label='Next'><span aria-hidden='true'><i class='icon-angle-right'></i></span></a></li>";

														}

														else

														{

														$j = $page + 1;

														echo "<li><a href='auto-discount-cars.php?page=$j' aria-label='Next'><span aria-hidden='true'><i class='icon-angle-right'></i></span></a></li>";

														}
														}

											?>
										
		                </ul>
	                </nav>
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
<?php
//}
?>