<?php
//If page
if(isset($_GET['inc']) && $_GET['inc'] != ""){
	
include("core/cms-header.php");

//Check if exists
if(file_exists("view/".$_GET['inc'])){
include('view/'.$_GET['inc']);	
}else{
	
}
	
include("core/cms-footer.php");

}else{
header("location: dash/");
exit();	
}

?>