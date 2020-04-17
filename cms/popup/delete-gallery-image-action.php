<?php
//require("../../core/sessie.php");
//require("../../core/functies.php");
include('../core/sql/conf.php');

//Set timezone
$item = "No admin rights!";
//if(isset($_COOKIE['cmsadmin'])){
	
	if(isset($_GET['id']) && $_GET['id'] > 0){
	
	//Clean vars
	$g_id = mysqli_real_escape_string($con, $_GET['id']);
	
	//Check if blog exists
	$f_image = mysqli_fetch_assoc($con->query("SELECT * FROM `gallery_image` WHERE `id` = '".$g_id."'"));

		if($f_image['id'] != ""){
			
			//Delete actual blog
			$delete = $con->query("UPDATE `gallery_image` SET `status` = '0' WHERE `id` ='".$f_image['id']."'");
			
			if($delete){
				$item = "Image succesfully deleted";
			}else{
				$item = "Delete query went wrong";	
			}
			
		}else{
			$item = "Image does not exist";	
		}
			
		
	}else{
		$item = "No Image ID provided!";	
	}
//}

?>
<style>

</style>
<div class="popup-share-block" >
	<div class="popup-block-header" >
    	<span style="color:#fff !important;">Gallery Image</span>
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
	
	<?php if($item == "Image succesfully deleted" && isset($g_id)){ ?>
		$(".blog-main[bid='<?php echo $g_id; ?>'").hide("fade",400,function(){
			
			$(".blog-main[bid='<?php echo $g_id; ?>'").remove();
			
		});
	<?php } ?>

	popupClose();			
	
	event.preventDefault();
	
});


</script>
<?php
//}

?>