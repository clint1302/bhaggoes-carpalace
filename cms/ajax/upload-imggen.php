<?php
require("../../core/sessie.php");
require("../../core/functies.php");
include('../core/upload/imanipulator/cropper.php');

//Default vars
$post_path = '../../upload/generated/';
$post_thumb = '../../upload/generated/thumbs/';

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_COOKIE['cmsadmin'])){
$myaccount = mysqli_fetch_assoc($con->query("SELECT * FROM `leden` WHERE `leden_id` = '".$_COOKIE['cmsadmin']."'"));
		
if($myaccount['leden_id'] != ""){

//Check if file is submitted
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
		
		$ext_allowed = array("gif", "jpeg", "jpg", "png");
		
		$tmp_name = $_FILES["image"]["name"];
		//Get extension
		$tmpext = explode(".", $tmp_name);
		$img_ext = strtolower(end($tmpext));
		
		//Clean image
        $img_name = generateRandomString(15).".".$img_ext;
		//Init vars
        $img_tmp = $_FILES["image"]["tmp_name"];
        $img_size = $_FILES["image"]["size"];
		$img_dest = $post_path.$img_name;
		$img_desthumb = $post_thumb.$img_name;
		
		
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
		if($width > 400 || $height > 400){
			
			//Check which one is bigger
			if($width > $height){
			//Horizontal
			$prop = $width/$height;
			
			//Calculate new height
			$dheight = 400;
			$dwidth = round(400*$prop);
			
			}else{
			//Vertical	
			$prop = $height/$width;
			
			//Calculate new width
			$dwidth = 400;
			$dheight = round(400*$prop);	
			}
			
		}else{
		//Not big enough, leave size
		$dwidth = $width;
		$dheight = $height;	
		}
		
		
        //Our dimensions will be 400x400
        $x1 = $centreX - 200; // 400 / 2
        $y1 = $centreY - 200; // 400 / 2
 
        $x2 = $centreX + 200; // 400 / 2
        $y2 = $centreY + 200; // 400 / 2
 
        // center cropping to 400x400
		$newImageThumb = $manipulator->resample($dwidth, $dheight);
        //$newImageThumb = $manipulator->crop($x1, $y1, $x2, $y2);
        // saving file to uploads folder
        $manipulator->save($img_desthumb);
        
		//Resize for normal picture
		$fullmanipulator = new ImageManipulator($img_tmp);
        $fullwidth  = $fullmanipulator->getWidth();
        $fullheight = $fullmanipulator->getHeight();
		
		if($fullwidth > 1400 || $fullheight > 1400){
			
			//Check which one is bigger
			if($fullwidth > $fullheight){
			//Horizontal
			$prop = $fullwidth/$fullheight;
			
			//Calculate new height
			$nwidth = 1400;
			$nheight = round(1400/$prop);
			
			}else{
			//Vertical	
			$prop = $fullheight/$fullwidth;
			
			//Calculate new width
			$nheight = 1400;
			$nwidth = round(1400/$prop);	
				
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


			}else{
			die("Niet ingelogd.");
			}
			
			
			
}else{
die("Niet ingelogd.");	
}
?>