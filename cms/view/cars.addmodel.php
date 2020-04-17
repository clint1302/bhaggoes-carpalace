<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/scr/rich-editor/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/scr/rich-editor/controls/wysiwyg.image.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF; ?>cms/scr/rich-editor/jquery.wysiwyg.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF; ?>cms/scr/rich-editor/input.css" />

<span class="cms-content-header">Add Car Model</span>
<div class="cms-content-block">
	<div class="blogs-main-block">
    	
      
    	<div class="addblog-form-block">
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Brand<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
								
								<?php 
									//$f_cbrand = mysqli_fetch_assoc($con->query("SELECT * FROM `car_brands` WHERE `brand_id` = '1'"));
								?>
								<!--<input type="text" id="addbrand" brandid="<?php echo $f_cbrand['brand_id'];  ?>" value="<?php echo $f_cbrand['title'];  ?>" readonly/>-->
								<div class="cars-form-dropdown">
								<span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
									<select id="addbrand" class="addcar-combo">
										<option disabled selected value>-- Select</option>	
									<?php
										$g_cbrand = $con->query("SELECT * FROM `car_brands` ORDER BY `title` ASC");

										while($f_cbrand = mysqli_fetch_array($g_cbrand)){

										?>
										<option  value="<?php echo $f_cbrand['brand_id']; ?>" ><?php echo $f_cbrand['title'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Model<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addmodel" value=""/>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
        </div>
       <!--Form-block -->
       <div class="project-submit-main">
       		
       		<a href="#" id="save-model">SAVE</a>
       </div>
    </div>
</div>
<script>
var ajaxloader;

//saveblog
$("#save-model").unbind("click").click(function(event){
	
	//Change button text
	var button = $(this);
	
	$(button).text("Saving..");
	
	
	//var brand = $("#addbrand").val();
	var brand = $("#addbrand option:selected").val(); 
	var model = $("#addmodel").val();

	//alert(brand);
	///*	
	$.ajax({
									
			url:"../ajax/add-carmodel.php",
			type:"POST",
			data: {brand:brand,model:model},
			success: function(response){
							
							if(response == "done"){
							
								$(".project-submit-main").prepend('<a class="submit-main-result">Succesfully added a Model</a>');
								//Clear field
								$("#addmodel").val("");
							 
							 
							$(button).text("Save");
							
							}else{
							
								$(button).text("Save");
								
								$(".project-submit-main").prepend('<a class="submit-main-result submit-blog-wrong">'+response+'</a>');
							
							}
					}
									
									
			});

			//*/
		
	event.preventDefault();
	
});

</script>