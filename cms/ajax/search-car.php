<?php 
//require("../../core/sessie.php");
include('../core/sql/conf.php');

//Set timezone
//$item = "No admin rights!";
//if(isset($_COOKIE['cmsadmin'])){
	
	if(isset($_POST['keyword']) && $_POST['keyword'] != ""){
	
	$key = mysqli_real_escape_string($con,$_POST['keyword']);
	
	$g_cars = mysqli_query($con,"SELECT * FROM `cars` WHERE  `chassis` LIKE '%".$key."%' AND `status` > 0 OR `title` LIKE '%".$key."%' AND `status` > 0  LIMIT 0,10");
	
		while($f_car = mysqli_fetch_array($g_cars)){

			$s_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_car['model_id']."'"));
			
			echo('<div class="blog-main" bid="'.$f_car['car_id'].'"  style="background-image:url('.BASEHREF.'cms/upload/cars/medium/'.$f_car['img'].');">
    		<div class="blog-top-bar">');
				if($f_car['featured'] > 0){
				 echo('<div class="car-feat-title">
						<span class="cars-featured">Featured</span>
					</div>');
					
				}
				echo('<div>
					<a href="'.BASEHREF.'cms/cars/edit-car/'.$f_car['car_id'].'"><span class="blog-top-button blog-edit-color">Edit</span></a>
					<span car-id="'.$f_car['car_id'].'" class="blog-top-button blog-delete-color search-car-del">Delete</span>
				</div>
            </div>
            <div class="blog-bottom-bar">
            	<span class="blog-bottom-title">
					<div>Key #'.$f_car['chassis'].'</div> 
					<div class="car-title">'.$s_model['title'].' - '.$f_car['year'].'</div>
				</span>
            </div>
		</div> 
		<script>
		$(".search-car-del").unbind("click").click(function(event){
				var cardel = $(this).attr("car-id");
				openPopup("delete-car.php?id="+cardel,false);
				event.preventDefault();
		});
		</script>');

		}
	
		//No Car Found
		if(mysqli_num_rows($g_cars) == 0){
			echo('<div class="blog-main" style="background-image:url('.BASEHREF.'cms/img/no-car.jpg);">
            <div class="blog-bottom-bar">
            	<span class="blog-bottom-title">
					<div>Key number does not exist.</div> 
				</span>
            </div>
        </div>');	
		}
		
	}
	
//}
?>
