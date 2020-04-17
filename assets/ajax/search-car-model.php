<?php 
//require("../../core/sessie.php");
include('../core/sql/conf.php');

//Set timezone
//$item = "No admin rights!";
//if(isset($_COOKIE['cmsadmin'])){
	
	if(isset($_POST['keyword']) && $_POST['keyword'] != ""){
	
	$word = mysqli_real_escape_string($con,$_POST['keyword']);
	
	$model = mysqli_query($con,"SELECT * FROM `car_models` WHERE `title` LIKE '%".$word."%'  LIMIT 0,5");
	
		while($f_mod = mysqli_fetch_array($model)){

			//fetch brand
			$f_brand = mysqli_fetch_assoc($con->query("SELECT * FROM `car_brands` WHERE `brand_id` = '".$f_mod['brand_id']."'"));
			
			echo('<span class="search-result-item" modelid="'.$f_mod['model_id'].'">'.$f_brand['title'].' - '.$f_mod['title'].'</span>');
			
		}
	
		//No user
		if(mysqli_num_rows($model) == 0){
			echo('<span class="search-result-item">Car model not found. Please add first.</span>');	
		}
		
	}
	
//}
?>
