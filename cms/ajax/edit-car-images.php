<?php
include('../core/sql/conf.php');

if(isset($_REQUEST["id"]) && $_REQUEST["id"] != "") {
	$cid = $_REQUEST["id"];

	if ($_FILES["car-image-1"]['name'] == "") {
		$fileName1 = $_REQUEST['imgoldname1'];
	} else {
		if(isset($_FILES["car-image-1"]["type"])) {
			$sourcePath = $_FILES['car-image-1']['tmp_name']; // Storing source path of the file in a variable
			$fileName1 = $cid."_".$_FILES['car-image-1']['name']; // Rename File
			$targetPath = "../upload/cars_slider/".$fileName1; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file
		}
	}

	if ($_FILES["car-image-2"]['name'] == "") {
		$fileName2 = $_REQUEST['imgoldname2'];
	} else {
		if(isset($_FILES["car-image-2"]["type"])) {
			$sourcePath = $_FILES['car-image-2']['tmp_name']; // Storing source path of the file in a variable
			$fileName2 = $cid."_".$_FILES['car-image-2']['name']; // Rename File
			$targetPath = "../upload/cars_slider/".$fileName2; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file
		}
	}

	if ($_FILES["car-image-3"]['name'] == "") {
		$fileName3 = $_REQUEST['imgoldname3'];
	} else {
		if(isset($_FILES["car-image-3"]["type"])) {
			$sourcePath = $_FILES['car-image-3']['tmp_name']; // Storing source path of the file in a variable
			$fileName3 = $cid."_".$_FILES['car-image-3']['name']; // Rename File
			$targetPath = "../upload/cars_slider/".$fileName3; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file
		}
	}

	$update = $con->query("UPDATE `car_images` SET `img1` = '".$fileName1."',`img2` = '".$fileName2."',`img3` = '".$fileName3."' WHERE `car_id` = '".$cid."'");

	die("done");

}

?>