<?php
//require("../../core/sessie.php");
include('../core/sql/conf.php');

//Set timezone
//die("No admin rights!");
	
	//if(isset($_POST['img']) && $_POST['img'] !="" && isset($_POST['model']) && $_POST['model'] !="" && isset($_POST['cat']) && $_POST['cat'] !="" && isset($_POST['steering']) && $_POST['steering'] !="" && isset($_POST['trans']) && $_POST['trans'] !="" && isset($_POST['wheelchair']) && $_POST['wheelchair'] !="" && isset($_POST['cylinder']) && $_POST['cylinder'] !="" && isset($_POST['fuel']) && $_POST['fuel'] !="" && isset($_POST['wheeldrive']) && $_POST['wheeldrive'] !="" && isset($_POST['color']) && $_POST['color'] !=""  && isset($_POST['price']) && $_POST['price'] !="" && isset($_POST['year']) && $_POST['year'] !="" && isset($_POST['seats']) && $_POST['seats'] !=""  && isset($_POST['enginecap']) && $_POST['enginecap'] !="" && isset($_POST['doors']) && $_POST['doors'] !=""  && isset($_POST['status']) && $_POST['status'] !="" && isset($_POST['hide_price']) && $_POST['hide_price'] !="" && isset($_POST['owned_type']) && $_POST['owned_type'] !=""){
	if(isset($_POST['img']) && $_POST['img'] !="" && isset($_POST['model']) && $_POST['model'] !="" && isset($_POST['cat']) && $_POST['cat'] !="" && isset($_POST['steering']) && $_POST['steering'] !="" && isset($_POST['trans']) && $_POST['trans'] !="" && isset($_POST['wheelchair']) && $_POST['wheelchair'] !="" && isset($_POST['cylinder']) && $_POST['cylinder'] !="" && isset($_POST['fuel']) && $_POST['fuel'] !="" && isset($_POST['wheeldrive']) && $_POST['wheeldrive'] !="" && isset($_POST['color']) && $_POST['color'] !=""  && isset($_POST['price']) && $_POST['price'] !="" && isset($_POST['year']) && $_POST['year'] !="" && isset($_POST['seats']) && $_POST['seats'] !="" && isset($_POST['mileage']) && isset($_POST['chassis']) && isset($_POST['enginecap']) && $_POST['enginecap'] !="" && isset($_POST['doors']) && $_POST['doors'] !=""  && isset($_POST['status']) && $_POST['status'] !="" && isset($_POST['hide_price']) && $_POST['hide_price'] !="" && isset($_POST['owned_type']) && $_POST['owned_type'] !="" && isset($_POST['discount_car']) && $_POST['discount_car'] !="" && isset($_POST['licence_plate']) ){

	//Clean vars
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
	$status = mysqli_real_escape_string($con, $_POST['status']);
	$hprice = mysqli_real_escape_string($con, $_POST['hide_price']);
	$ownedtype = mysqli_real_escape_string($con, $_POST['owned_type']);
	$licenceplate = mysqli_real_escape_string($con, $_POST['licence_plate']);
	$discount_car = mysqli_real_escape_string($con, $_POST['discount_car']);

	//licence_plate

	//die($img."-".$model."-".$cat."-".$steering."-".$trans."-".$wheelchair."-".$cylinder."-".$fuel."-".$wheeldrive."-".$color."-".$price."-".$year."-".$seats."-".$mileage."-".$chassis."-".$enginecap."-".$doors."-".$status."-".$hprice."-".$licenceplate."-".$ownedtype);

	$s_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$model."'"));
	$s_brand = mysqli_fetch_assoc($con->query("SELECT * FROM `car_brands` WHERE `brand_id` = '".$s_model['brand_id']."'"));

	$save = $con->query("INSERT INTO `cars`(`img`,`title`,`model_id`,`category_id`,`color`,`price`,`year`,`fuel`,`seats`,`steering`,`transmission`,`mileage`,`chassis`,`engine_capacity`,`cylinders`,`wheeldrive`,`doors`,`wheelchair`,`featured`,`status`,`date_created`,`licence_plate`,`price_state`,`pre_owned`,`discount`)
						VALUES 
						('".$img."','".$s_brand['title']." ".$s_model['title']."',$model,$cat,'".$color."',$price,$year,'".$fuel."',$seats,'".$steering."','".$trans."','".$mileage."','".$chassis."',$enginecap,$cylinder,'".$wheeldrive."',$doors,'".$wheelchair."',0,$status,'".$now."','".$licenceplate."',$hprice,$ownedtype,$discount_car )");

	$gen_id = $con->insert_id;
	
	//('".$img."','".$model."','".$cat."','".$color."','".$price."','".$year."','".$fuel."','".$seats."','".$steering."','".$trans."','".$mileage."','".$chassis."','".$enginecap."','".$cylinder."','".$wheeldrive."','".$doors."','".$wheelchair."','".$status."','".$now."','".$hprice."' )");
	
	//$car_id = mysqli_insert_id($con);
	//$car_id = $con->mysqli_insert_id();
	
	//die($car_id);

	/*if($car_id != ""){

		$save = $con->query("INSERT INTO `car_images` (`car_id`,`img1`) VALUES ('".$car_id."','".$img."'')");

	die("done");

	}else{

	die("No Car ID found.");	

	}
	*/		
	// die("done");
	echo $gen_id;

}else{

die("fail");	

}

?>