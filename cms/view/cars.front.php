<span class="cms-content-header">Cars Inventory
	<div class="cms-content-header-right cms-content-header-right-link">

		

		<a href="<?php echo BASEHREF; ?>cms/cars/add-car-model" >Add Car Model</a>
    	<a href="<?php echo BASEHREF; ?>cms/cars/add-car" >Add Car</a>
    </div>
</span>
<div class="cms-content-block">
		<!--Search car section -->

		<div class="search-car">
			<input type="text" name="search" id="search-car" placeholder="Search car key number...">
		</div>

		<div class="car-search-result">

		</div>

		<!--Search car section -->

	<div class="blogs-main-block" >
        <?php
					//get cars
					$g_cars = $con->query("SELECT * FROM `cars` WHERE `status` > 0 ORDER BY `year` DESC ");
					
					
					 while($f_cars = mysqli_fetch_array($g_cars)){

					//fetch model
					$f_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_cars['model_id']."'"));
				?>
        
    	<div class="blog-main" bid="<?php echo $f_cars['car_id']; ?>"  style="background-image:url(<?php echo BASEHREF."cms/upload/cars/medium/".$f_cars['img']; ?>); <?php //if($f_research['foto_pos'] != ""){ echo 'background-position:'.$f_research['foto_pos'].';'; } ?>">
    		<div class="blog-top-bar">
				<?php if($f_cars['featured'] > 0){ ?>
				<div class="car-feat-title">
					<span class="cars-featured">Featured</span>
				</div>
				<?php
					 }
				?>
				<div>
					<a href="<?php echo BASEHREF; ?>cms/cars/edit-car/<?php echo $f_cars['car_id']; ?>"><span class="blog-top-button blog-edit-color">Edit</span></a>
					<span car-id="<?php echo $f_cars['car_id']; ?>" class="blog-top-button blog-delete-color">Delete</span>
				</div>
            </div>
            <div class="blog-bottom-bar">
            	<span class="blog-bottom-title">
					<div>Key #<?php echo $f_cars['chassis'];?></div> 
					<div class="car-title"><?php echo $f_model['title'];?> - <?php echo $f_cars['year'];?></div>
				</span>
            </div>
        </div>
        <?php
					 }
		?>
		
		
        
    </div>
</div>
<script>
var loading;
var ajaxloader;

function loadingAnimation(){
	
	
	if($("#addblog-uploadpic").hasClass("addblog-animate")){
		$("#addblog-uploadpic").removeClass("addblog-animate");
	}else{
		$("#addblog-uploadpic").addClass("addblog-animate");	
	}
	
}

$(".blog-delete-color").unbind("click").click(function(event){
	
			var cardel = $(this).attr("car-id");
			//alert(cardel);

			openPopup("delete-car.php?id="+cardel,false);
			
			
			event.preventDefault();
});



//Search Car key number
$("#search-car").keyup(function(){
	
	var keyword = $(this).val();
	
	if(ajaxloader != null){
		ajaxloader.abort();
	}
	
	ajaxloader = $.ajax({
		type:"POST",
		data:{keyword:keyword},
		url:"<?php echo BASEHREF; ?>cms/ajax/search-car.php",
		success:function(resp){
			
			if(resp.indexOf("<div") >= 0){ 
				
				//hide all view
				$(".blogs-main-block").hide();

				//show search result
				$(".car-search-result").html(resp).show();

			}else{

				//hide result
				$(".car-search-result").html("").hide();
				
				//show all view
				$(".blogs-main-block").show();
			}
		
		
		}
	
	});

	event.preventDefault();
	
});	
</script>