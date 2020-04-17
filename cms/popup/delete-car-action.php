<?php
//require("../../core/sessie.php");
//require("../../core/functies.php");
include('../core/sql/conf.php');

//Set timezone
$item = "No admin rights!";

//if(isset($_COOKIE['cmsadmin'])){
	
	if(isset($_GET['id']) && $_GET['id'] > 0){
	
	//Clean vars
	$carid = mysqli_real_escape_string($con, $_GET['id']);
	
	//Check if blog exists
	$f_car = mysqli_fetch_assoc($con->query("SELECT * FROM `cars` WHERE `car_id` = '".$carid."'"));

		if($f_car['car_id'] != ""){
			
			//Delete actual blog
			$delete = $con->query("UPDATE `cars` SET `status` = '0' WHERE `car_id` ='".$f_car['car_id']."'");
			
			if($delete){
				$item = "Car succesfully deleted";
			}else{
				$item = "Delete query went wrong";	
			}
			
		}else{
			$item = "Car does not exist";	
		}
			
		
	}else{
		$item = "No Car ID provided!";	
	}
//}

?>
<style>

</style>
<div class="popup-share-block" >
	<div class="popup-block-header" >
    	<span style="color:#fff !important;">Blogs</span>
    	<a href="#" class="popup-block-close">×</a>
    </div>
    
	<div class="popup-block-content">
    
        <div class="geachte-title"><?php echo $item; ?></div>
       
    
    </div>
    
    <div class="popup-block-options">
    	<a href="#" id="close-blog" class="blog-delete-color">close</a>
    </div>


</div>
<script>

setTimeout(function(){
var popupMT = $(".popup-share-block").height()/2;

	$(".popup-share-block").animate({
		marginTop: "-"+popupMT+"px"
	},300);
	

},1);

//Delete
$("#close-blog").unbind("click").click(function(event){
	
	<?php if($item == "Car succesfully deleted" && isset($carid)){ ?>
		$(".blog-main[bid='<?php echo $carid; ?>'").hide("fade",400,function(){
			
			$(".blog-main[bid='<?php echo $carid; ?>'").remove();
			
		});
	<?php } ?>

	popupClose();			
	
	event.preventDefault();
	
});


</script>
<?php
//}

?>