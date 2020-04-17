<?php 
//require("../../core/sessie.php");
include('../core/sql/conf.php');

//Set timezone
//$item = "No admin rights!";
//if(isset($_COOKIE['cmsadmin'])){
	
	if(isset($_POST['carmodel']) && $_POST['carmodel'] != ""  && ($_POST['beginModelYear']) && $_POST['beginModelYear'] != "" && ($_POST['endModelYear']) && $_POST['endModelYear'] != ""){
	
	$carmodel = mysqli_real_escape_string($con,$_POST['carmodel']);
	$beginModelYear = mysqli_real_escape_string($con,$_POST['beginModelYear']);
	$endModelYear = mysqli_real_escape_string($con,$_POST['endModelYear']);
	$car_status = 0;
	//die($carmodel."-".$beginModelYear."-".$endModelYear);

	//$g_filtered_cars = mysqli_query($con,"SELECT * FROM `cars` WHERE `model_id` = '.$carmodel.' AND `category_id` = '.$bodystyle.'  LIMIT 0,6");
	$g_filtered_cars = mysqli_query($con,"SELECT * FROM `cars` WHERE (`year` BETWEEN ".$beginModelYear." AND ".$endModelYear.") AND `model_id` = ".$carmodel." AND `status` > 0 ");
	
	//count rows
	$count_results = mysqli_num_rows($g_filtered_cars);

	if($count_results != 0){
		echo('<div found class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="auto-sort-filter">
		  <div class="auto-show-resuilt"><span>SHOWING <em>'.$count_results.'</em> RESULTS FOR YOUR SEARCH</span></div>
		</div></div>');

		while($filtered_car = mysqli_fetch_array($g_filtered_cars)){
			
			//check car status
			if($filtered_car['status'] == 1 ){

				//echo('<span class="car-status carstate-available">Available</span>');
				$car_status = '<span class="car-status carstate-available">Available</span>';	

			}else if($filtered_car['status'] == 2 ){

				$car_status = '<span class="car-status carstate-reserved">Reserved</span>';

			}else{

				$car_status = '<span class="car-status carstate-sold">Sold</span>';

			}

			//fetch model & category info
			$s_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$filtered_car['model_id']."'"));
			$s_category = mysqli_fetch_assoc($con->query("SELECT * FROM `car_categories` WHERE `category_id` = '".$filtered_car['category_id']."'"));

			echo('<div found class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="auto-listing auto-grid">
			<div class="cs-media">
				<figure> 
				<a href="car-listing-detail.php?car-id='.$filtered_car['car_id'].'" class="View-btn">
				<img src="'.BASEHREF.'cms/upload/cars/medium/'.$filtered_car['img'].'" alt="#"/>'.$car_status.'</a>
				</figure>
			</div>
			<div class="auto-text">
			<span class="cs-categories">Key # '.$filtered_car['chassis'].'</span>
													<div class="post-title">
												<h4><a href="car-listing-detail.php?car-id='.$filtered_car['car_id'].'">'.$s_model['title'].' - '.$filtered_car['year'].'</a></h4>
								<h6><a href="car-listing-detail.php?car-id='.$filtered_car['car_id'].'">'.$s_model['title'].' - '.$filtered_car['year'].'</a></h6>
												<a href="#"><img src="assets/extra-images/post-list-img2.jpg" alt=""/></a>
											</div><a href="car-listing-detail.php?car-id='.$filtered_car['car_id'].'" class="View-btn">View Detail<i class=" icon-arrow-long-right"></i></a>
											</div>
										</div>
									</div>');
		}
	}else{
		echo('<div not-found class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="auto-sort-filter">
		  <div class="auto-show-resuilt"><span>SHOWING <em>'.$count_results.'</em> RESULTS FOR YOUR SEARCH</span></div>
		</div></div>');
	}


}
?>
