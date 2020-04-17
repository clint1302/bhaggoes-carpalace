<?php
//require("../../core/sessie.php");
//require("../../core/functies.php");

include('../core/sql/conf.php');

if(isset($_POST['img']) && $_POST['img'] !="" && isset($_POST['carid']) && $_POST['carid'] !="" && isset($_POST['model']) && $_POST['model'] !="" && isset($_POST['cat']) && $_POST['cat'] !="" && isset($_POST['steering']) && $_POST['steering'] !="" && isset($_POST['trans']) && $_POST['trans'] !="" && isset($_POST['wheelchair']) && $_POST['wheelchair'] !="" && isset($_POST['cylinder']) && $_POST['cylinder'] !="" && isset($_POST['fuel']) && $_POST['fuel'] !="" && isset($_POST['wheeldrive']) && $_POST['wheeldrive'] !="" && isset($_POST['color']) && $_POST['color'] !=""  && isset($_POST['price']) && $_POST['price'] !="" && isset($_POST['year']) && $_POST['year'] !="" && isset($_POST['seats']) && $_POST['seats'] !="" && isset($_POST['mileage']) && isset($_POST['chassis']) && isset($_POST['enginecap']) && $_POST['enginecap'] !="" && isset($_POST['doors']) && $_POST['doors'] !="" && isset($_POST['feat_car']) && $_POST['feat_car'] !="" && isset($_POST['carstatus']) && $_POST['carstatus'] !="" && isset($_POST['hide_price']) && $_POST['hide_price'] !="" && isset($_POST['owned_type']) && $_POST['owned_type'] !="" && isset($_POST['discount_car']) && $_POST['discount_car'] !="" && isset($_POST['licence_plate'])  ){
	
	//Clean vars
	$carid = mysqli_real_escape_string($con, $_POST['carid']);
	$img = mysqli_real_escape_string($con, $_POST['img']);
	$model = mysqli_real_escape_string($con, $_POST['model']);
	$cat = mysqli_real_escape_string($con, $_POST['cat']);
	$steering = mysqli_real_escape_string($con, $_POST['steering']);
	$trans = mysqli_real_escape_string($con, $_POST['trans']);
	$wheelchair = mysqli_real_escape_string($con, $_POST['wheelchair']);
	$cylinder = mysqli_real_escape_string($con, $_POST['cylinder']);
	$fuel = mysqli_real_escape_string($con, $_POST['fuel']);
	$wheeldrive = mysqli_real_escape_string($con, $_POST['wheeldrive']);
	$color = mysqli_real_escape_string($con, $_POST['color']);
	$price = mysqli_real_escape_string($con, $_POST['price']);
	$year = mysqli_real_escape_string($con, $_POST['year']);
	$seats = mysqli_real_escape_string($con, $_POST['seats']);
	$mileage = mysqli_real_escape_string($con, $_POST['mileage']);
	$chassis = mysqli_real_escape_string($con, $_POST['chassis']);
	$enginecap = mysqli_real_escape_string($con, $_POST['enginecap']);
	$doors = mysqli_real_escape_string($con, $_POST['doors']);
	$feat_car = mysqli_real_escape_string($con, $_POST['feat_car']);
	$status_car = mysqli_real_escape_string($con, $_POST['carstatus']);
	$hide_price = mysqli_real_escape_string($con, $_POST['hide_price']);
	$pre_owned = mysqli_real_escape_string($con, $_POST['owned_type']);
	$licence_plate = mysqli_real_escape_string($con, $_POST['licence_plate']);
	$discount_car = mysqli_real_escape_string($con, $_POST['discount_car']);
	//$caraccessories = mysqli_real_escape_string($con, $_POST['carAccessories']);

	//die($discount_car);

	$s_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$model."'"));
	$s_brand = mysqli_fetch_assoc($con->query("SELECT * FROM `car_brands` WHERE `brand_id` = '".$s_model['brand_id']."'"));
	
	//$update = $con->query("UPDATE `cars` SET `img` = '".$img."',`title` = '".$s_brand['title']." ".$s_model['title']."',`model_id`  = '".$model."',`category_id` = '".$cat."',`steering` = '".$steering."',`transmission` = '".$trans."',`wheelchair` = '".$wheelchair."',`cylinders` = '".$cylinder."',`fuel` = '".$fuel."',`wheeldrive` = '".$wheeldrive."',`color` = '".$color."',`price` = '".$price."',`year` = '".$year."',`seats` = '".$seats."',`mileage` = '".$mileage."',`chassis` = '".$chassis."',`engine_capacity` = '".$enginecap."',`doors` = '".$cat."',`featured` = '".$feat_car."',`status` = '".$status_car."',`price_state` = '".$hide_price."',`pre_owned` = '".$pre_owned."',`accessories` = '".$caraccessories."' WHERE `car_id` = '".$carid."'  ");
	$update = $con->query("UPDATE `cars` SET `img` = '".$img."',`title` = '".$s_brand['title']." ".$s_model['title']."',`model_id`  = '".$model."',`category_id` = '".$cat."',`steering` = '".$steering."',`transmission` = '".$trans."',`wheelchair` = '".$wheelchair."',`cylinders` = '".$cylinder."',`fuel` = '".$fuel."',`wheeldrive` = '".$wheeldrive."',`color` = '".$color."',`price` = '".$price."',`year` = '".$year."',`seats` = '".$seats."',`mileage` = '".$mileage."',`chassis` = '".$chassis."',`engine_capacity` = '".$enginecap."',`doors` = '".$cat."',`featured` = '".$feat_car."',`status` = '".$status_car."',`price_state` = '".$hide_price."',`pre_owned` = '".$pre_owned."',`discount` = '".$discount_car."',`licence_plate` = '".$licence_plate."' WHERE `car_id` = '".$carid."'  ");
	
	die("done");
	
			
}else{

die("Veld(en) zijn leeg!");		
}

?>