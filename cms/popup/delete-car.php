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
			
			$item = "Do you really want to delete this?";	
			
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
    	<span style="color:#fff !important;">Cars</span>
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

	<?php if(isset($f_car)){ ?>				
	openPopup("delete-car-action.php?id=<?php echo $f_car['car_id']; ?>",false);
	<?php } ?>						
	
	event.preventDefault();
	
});


</script>
<?php
//}

?>