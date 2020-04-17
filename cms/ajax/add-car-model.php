<?php
//require("../../core/sessie.php");
include('sql/conf.php');

//Set timezone
//die("No admin rights!");
	
	if(isset($_POST['title']) && $_POST['title'] !="" ){
	
	//Clean vars
	$title = mysqli_real_escape_string($con, $_POST['title']);
	$brandid = "1";
	
	$count_mod = mysqli_num_rows($con->query("SELECT * FROM `car_models` WHERE `title` = '.$title.' "));

	if($count_mod > 0){

		die("Car model already exists.");

	}else{

		$save = $con->query("INSERT INTO `car_models` (`brand_id`,`title`,`date_created`) VALUES ('".$brandid."','".$title."','".$now."')");
		$modelid = mysqli_insert_id($con);

		die("done");
	}
			
}else{

die("Some Fields are empty.");	
}

?>