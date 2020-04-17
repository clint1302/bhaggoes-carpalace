<?php
//require("../../core/sessie.php");
include('../core/sql/conf.php');

//Set timezone
//die("No admin rights!");
	
	if(isset($_POST['brand']) && $_POST['brand'] !="" && isset($_POST['model']) && $_POST['model'] !="" ){
	
	//Clean vars
	$brand = mysqli_real_escape_string($con, $_POST['brand']);
	$model = mysqli_real_escape_string($con, $_POST['model']);
	
	//check if exists
	$check_models = mysqli_query($con,"SELECT * FROM `car_models` WHERE `title` LIKE '%".$model."%' ");

	//count
	$count_results = mysqli_num_rows($check_models);
		
	//echo($count_results);

	if($count_results < 1){

		$save = $con->query("INSERT INTO `car_models` (`brand_id`,`title`,`date_created`) VALUES ('".$brand."','".$model."','".$now."')");
		$modelid = mysqli_insert_id($con);
		
		
		die("done");

	}else{

		die("Car model already exists.");

	}

			
}else{

	die("Some fields are empty.");

}

?>