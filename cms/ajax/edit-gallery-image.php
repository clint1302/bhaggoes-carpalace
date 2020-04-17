<?php
include('../core/sql/conf.php');

if(isset($_FILES["gallery-image"]['name']) && $_FILES["gallery-image"]['name'] != "" ) {
	$gid = $_REQUEST["id"];
	if (file_exists("../upload/gallery_images/" . $_FILES["gallery-image"]["name"])) {
		die("Image already exists");
	} else {
		$sourcePath = $_FILES['gallery-image']['tmp_name']; // Storing source path of the file in a variable
		$img = $_FILES['gallery-image']['name']; // Rename File
		$targetPath = "../upload/gallery_images/".$img; // Target path where file is to be stored

		$update = $con->query("UPDATE `gallery_image` SET `img` = '".$img."' WHERE `id` = '".$gid."'");

		if ($update === TRUE) {
			move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file
			die("done");
		} else {
			die("Somthing wrong!");
		}
	}
} else {
	die("Please choose an Image");
}

?>