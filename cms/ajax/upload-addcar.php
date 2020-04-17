<?php
//require("../../core/sessie.php");
include('../core/sql/conf.php');
include('../core/upload/imanipulator/cropper.php');

//Default vars
$post_path = '../upload/cars/medium/';
$post_thumb = '../upload/cars/small/';
$rand = rand(0000,9999);


//if(isset($_COOKIE['cmsadmin'])){
//$myaccount = mysqli_fetch_assoc($con->query("SELECT * FROM `leden` WHERE `leden_id` = '".$_COOKIE['cmsadmin']."'"));
		
//if($myaccount['leden_id'] != ""){

//Check if file is submitted
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
		
		$ext_allowed = array("gif", "jpeg", "jpg", "png");
		//Clean image
        $img_name = strtolower($rand.str_replace(' ','_',$_FILES["image"]["name"]));
		//Init vars
        $img_tmp = $_FILES["image"]["tmp_name"];
		$img_dest = $post_path.$img_name;
		$img_desthumb = $post_thumb.$img_name;
        $img_size = $_FILES["image"]["size"];
		//Get extension
		$tmpext = explode(".", $img_name);
		$img_ext = end($tmpext);
		
		//Check extension 
		if (in_array($img_ext, $ext_allowed)) {
		//Valid, continue
			
		//Crop and stuff for THUMBNAIL
		$manipulator = new ImageManipulator($img_tmp);
        $width  = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
		
		//Resize first
		if($width > 200 || $height > 200){
			
			//Check which one is bigger
			if($width > $height){
			//Horizontal
			$prop = $width/$height;
			
			//Calculate new height
			$dheight = 200;
			$dwidth = round(200*$prop);
			
			}else{
			//Vertical	
			$prop = $height/$width;
			
			//Calculate new width
			$dwidth = 200;
			$dheight = round(200*$prop);	
			}
			
		}else{
		//Not big enough, leave size
		$dwidth = $width;
		$dheight = $height;	
		}
		
		
        //Our dimensions will be 200x200
        $x1 = $centreX - 100; // 200 / 2
        $y1 = $centreY - 100; // 200 / 2
 
        $x2 = $centreX + 100; // 200 / 2
        $y2 = $centreY + 100; // 200 / 2
 
        // center cropping to 200x200
		$newImageThumb = $manipulator->resample($dwidth, $dheight);
        //$newImageThumb = $manipulator->crop($x1, $y1, $x2, $y2);
        // saving file to uploads folder
        $manipulator->save($img_desthumb);
        
		//Resize for normal picture
		$fullmanipulator = new ImageManipulator($img_tmp);
        $fullwidth  = $fullmanipulator->getWidth();
        $fullheight = $fullmanipulator->getHeight();
		
		if($fullwidth > 800 || $fullheight > 800){
			
			//Check which one is bigger
			if($fullwidth > $fullheight){
			//Horizontal
			$prop = $fullwidth/$fullheight;
			
			//Calculate new height
			$nwidth = 800;
			$nheight = round(800/$prop);
			
			}else{
			//Vertical	
			$prop = $fullheight/$fullwidth;
			
			//Calculate new width
			$nheight = 800;
			$nwidth = round(800/$prop);	
				
			}
			
		}else{
		//Not big enough, leave size
		$nwidth = $fullwidth;
		$nheight = $fullheight;	
		}
		
		
		$newImageNorm = $fullmanipulator->resample($nwidth, $nheight);
        // saving file to uploads folder
        $fullmanipulator->save($img_dest);
		
		
		//Return thumbnail
		echo $img_name;
		die();
		
    	} else {
        die("Alleen foto's mogen upgeload worden.");
    	}
		
		
		
		//End function
}else{
//No image	
die("Geen foto doorgekomen.");	
}


			//}else{
			//die("Niet ingelogd.");
			//}
			
			
			
//}else{
//die("Niet ingelogd.");	
//}
?>