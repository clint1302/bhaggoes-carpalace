<?php
//require("../../core/sessie.php");
//require("../../core/functies.php");
include('../core/sql/conf.php');

//Set timezone
$item = "No admin rights!";
//if(isset($_COOKIE['cmsadmin'])){
	
	if(isset($_GET['id']) && $_GET['id'] > 0){
	
	//Clean vars
	$imageid = mysqli_real_escape_string($con, $_GET['id']);
	
	//Check if blog exists
	$f_image = mysqli_fetch_assoc($con->query("SELECT * FROM `gallery_image` WHERE `id` = '".$imageid."'"));
	
		if($f_image['id'] != ""){
			
			$item = "Do you really want to delete this?";	
			
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
    	<?php if($item == "Do you really want to delete this?"){ ?><a href="#" id="delete-blog" class="blog-delete-color">delete</a><?php } ?>
        <a href="#" id="cancel-del" class="blog-cancel-color">cancel</a>
    </div>


</div>
<script>

setTimeout(function(){
var popupMT = $(".popup-share-block").height()/2;

	$(".popup-share-block").animate({
		marginTop: "-"+popupMT+"px"
	},300);
	

},1);

$("#cancel-del").unbind("click").click(function(event){
		
	popupClose();
		
	event.preventDefault();
});

//Delete
$("#delete-blog").unbind("click").click(function(event){

	<?php if(isset($f_image)){ ?>				
	openPopup("delete-gallery-image-action.php?id=<?php echo $f_image['id']; ?>",false);
	<?php } ?>						
	
	event.preventDefault();
	
});


</script>
<?php
//}

?>