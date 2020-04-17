<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/scr/rich-editor/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/scr/rich-editor/controls/wysiwyg.image.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF; ?>cms/scr/rich-editor/jquery.wysiwyg.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF; ?>cms/scr/rich-editor/input.css" />

<span class="cms-content-header">Add Car</span>
<div class="cms-content-block">
	<div class="blogs-main-block">
    	
        <div class="addblog-main-image">   
          	<span class="addblog-image-upload" id="addblog-uploadpic">
				  
                    <span class="addblog-image-upload-icon">&#xe065;</span>
                    
                	<span class="addblog-image-upload-material">
                    </span>
             </span>
             <input type="file" name="addblog-pictureupload" backlink="../" id="addblog-pictureupload" class="image-uploader" base="<?php echo BASEHREF; ?>cms/" />
        </div>
        <!--Form-block -->
    	<div class="addblog-form-block">

				<!-- Form item -->
				<div class="normal-form-item">
            		<span class="normal-form-place">Status<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<div class="cars-form-dropdown" style="display:inline-block;width:calc(80% - 4px);">
									<span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
									<select id="addstatus" class="addcar-combo">
										<option disabled selected value>-- Select status</option>	
											<option value="1" >AVAILABLE</option>
											<option value="2" >RESERVED</option>
											<option value="3"  >SOLD</option>
									</select>
								</div>
								<span class="addprice-check">
									<input type="checkbox" id="discount" name="discount-car"/>
									<label for="discount">Discount</label>
								</span>
                            </span>
                            </span>
                        </div>
                    </div>
                    
				</div>
				<!-- Form item -->

				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Licence Plate</span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addlplate" value=""/>
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
                            	<input type="text" modelid="" id="addcar-model" value=""/>
                            </span>
                            <div class="search-result">
                                	
                            </div>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->

                <!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Category<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addcategory" class="addcar-combo">
										<option disabled selected value>-- Select category</option>	
                                     <?php 
										$g_cat = $con->query("SELECT * FROM `car_categories` ORDER BY `title`");
										while($f_cat = mysqli_fetch_array($g_cat)){
										?>
                                         <option value="<?php echo $f_cat['category_id'] ?>"><?php echo ($f_cat['title']); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    </div>
                            </span>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
        		<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Color<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addcar-color" value=""/>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Price<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
								<input type="text" id="addcar-price" class="addprice" value=""/>
								<span class="addprice-check">
									<input type="checkbox" id="hideprice" name="hide-price" />
									<label for="hideprice">Hide</label>
								</span>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Year<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addcar-year" value=""/>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
				<!-- Form item -->
				
				<div class="normal-form-item">
            		<span class="normal-form-place">Fuel<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addfuel" class="addcar-combo">
										<option disabled selected value>-- Select fuel</option>	
										 <option value="petrol">Petrol</option>
										 <option value="diesel">Diesel</option>
                                    </select>
                                    </div>
                            </span>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Seats<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addcar-seats" value=""/>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
				<!-- Form item -->
				<div class="normal-form-item">
            		<span class="normal-form-place">Steering<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addsteering" class="addcar-combo">
										<option disabled selected value>-- Select</option>	
										 <option value="left">Left</option>
										 <option value="right">Right</option>
                                    </select>
                                    </div>
                            </span>
                            </span>
                        </div>
                    </div>
                    
				</div>
				<!-- Form item -->
				
				<!-- Form item -->
				
				<div class="normal-form-item">
            		<span class="normal-form-place">Transmission<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addtransmission" class="addcar-combo">
										<option disabled selected value>-- Select transmission type</option>	
										 <option value="automatic">Automatic</option>
										 <option value="manual">Manual</option>
                                    </select>
                                    </div>
                            </span>
                            </span>
                        </div>
                    </div>
                    
                </div>
            	<!-- Form item -->
        
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Mileage<!--<span class="required-star">*</span>--></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
								<!--<input type="text" id="addcar-mileage" value=""/>-->
								
								<input type="text" id="addcar-mileage" class="addprice" value=""/>
								<span class="addprice-check">
									<input type="checkbox" id="ownedtype" name="owned-type" />
									<label for="ownedtype">Pre-owned</label>
								</span>
                            </span>  
                        </div>
                    </div>
                    
                </div>
            	<!-- Form item -->
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Key number<!--<span class="required-star">*</span>--></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addcar-chassis" value=""/>
                            </span>
                        </div>
                    </div>
                    
                </div>
            	<!-- Form item -->
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Engine Capacity<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addcar-engcap" value=""/>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
				<!-- Form item -->
				

				<div class="normal-form-item">
            		<span class="normal-form-place">Cylinders<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addcylinder" class="addcar-combo">
										<option disabled selected value>-- Select</option>	
										 <option value="4">4</option>
										 <option value="6">6</option>
										 <option value="8">8</option>
                                    </select>
                                    </div>
                            </span>
                            </span>
                        </div>
                    </div>
                    
				</div>
				
				<!-- Form item -->
				
				<!-- Form item -->
            	<!--<div class="normal-form-item">
            		<span class="normal-form-place">Wheeldrive<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addcar-wheeldrive" value=""/>
                            </span>
                        </div>
                    </div>
                    
				</div>-->
				
				<div class="normal-form-item">
            		<span class="normal-form-place">Wheeldrive<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addwheeldrive" class="addcar-combo">
										<option disabled selected value>-- Select</option>	
										 <option value="2wd">2WD</option>
										 <option value="optinal 4wd">Optional 4WD</option>
										 <option value="fulltime 4wd">Fulltime 4WD</option>
                                    </select>
                                    </div>
                            </span>
                            </span>
                        </div>
                    </div>
                    
				</div>
				<!-- Form item -->
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Doors<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addcar-doors" value=""/>
                            </span>
                        </div>
                    </div>
                    
                </div>
				<!-- Form item -->
				
				<!-- Form item -->
				<div class="normal-form-item">
            		<span class="normal-form-place">Wheelchair<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addwheelchair" class="addcar-combo">
										<option disabled selected value>-- Select</option>	
										 <option value="yes">Yes</option>
										 <option value="none">No</option>
                                    </select>
                                    </div>
                            </span>
                            </span>
                        </div>
                    </div>
                    
				</div>

				<!-- Form item -->
                <form id="multiImageUpload" action="" method="post" enctype="multipart/form-data">
                  <style>
                    .car-preview {
                      max-width: 100%;
                      width: 100%;
                      margin-top: 10px;
                      display: none;
                    }
                    .addblog-form-block>form>div {
                        display: block;
                        padding: 15px 15px;
                        border-bottom: solid 1px #f6f6f6;
                    }
                  </style>
                    <!-- Form item -->
                    <div class="normal-form-item">
                        <span class="normal-form-place">Car Image 1<span class="required-star"></span></span>    
                        
                        <div class="normal-form-item-content">
                            <div class="normal-form-rcontent">
                                <span class="normal-form-input">
                                    <input type="file" class="car-images-info" name="car-image-1" value=""/>
                                    <img class="car-preview" src="#" alt="" />
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Form item -->
                    
                    <!-- Form item -->
                    <div class="normal-form-item">
                        <span class="normal-form-place">Car Image 2<span class="required-star"></span></span>    
                        
                        <div class="normal-form-item-content">
                            <div class="normal-form-rcontent">
                                <span class="normal-form-input">
                                    <input type="file" class="car-images-info" name="car-image-2" value=""/>
                                    <img class="car-preview" src="#" alt="" />
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Form item -->

                    <!-- Form item -->
                    <div class="normal-form-item">
                        <span class="normal-form-place">Car Image 3<span class="required-star"></span></span>    
                        
                        <div class="normal-form-item-content">
                            <div class="normal-form-rcontent">
                                <span class="normal-form-input">
                                    <input type="file" class="car-images-info" name="car-image-3" value=""/>
                                    <img class="car-preview" src="#" alt="" />
                                </span>
                            </div>
                        </div>
                        
                    </div>
                </form>
                <!-- Form item -->
				
        </div>
       <!--Form-block -->
       <div class="project-submit-main">
       		
       		<a href="#" id="save-blog">SAVE</a>
       </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/core/upload/addblog-uploadimg.js"></script>
<script>
  $(document).ready(function(){
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $(input).next().attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    // Validation for car image 1
    $(".car-images-info").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only this formats are allowed : "+fileExtension.join(', '));
            $(this).val("");
            $(this).next().css("display", "none");
        } else {
            $(this).next().css("display", "block");
            readURL(this);
        }
    });
  
    // Submit image form
    $("#multiImageUpload").on('submit',(function(e) {
        e.preventDefault();

        var cid = $("#cid").val();

        $.ajax({
        url: "<?php echo BASEHREF; ?>cms/ajax/add-car-images.php?id="+cid, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            if ( data == "done" ) {
              
              $(".car-images-info").val("");
              $(".car-preview").css("display", "none");

              $(".project-submit-main").prepend('<a class="submit-main-result">Succesfully added a Car</a>');

              //Clear fields
              $(".blogs-main-block input").val("");
              $(".addblog-main-image").removeAttr("style"); 
              $(".addblog-image-upload").removeAttr("style");
              $(".addblog-image-upload").removeAttr("img");
              $("#cid").remove();

              $(button).text("Save");

            } else {
              $(".project-submit-main").prepend('<a class="submit-main-result submit-blog-wrong">Something wrong!</a>');
            }
        }
        });

    }));
    
  });
</script>
<script>
var loading;
var ajaxloader;
var hide_price = 0;
var owned_type = 0;
var discount_car = 0;
var chassis = "";
var licence_plate = "";

//Key functions		
$("#add-blog-descr").keydown(function(e){
	
	
	if(e.which == 66 && (e.ctrlKey || e.metaKey)){
		
		SetSelection("b");
		e.preventDefault();
		
		
	}else if(e.which == 65 && (e.ctrlKey || e.metaKey)){
		
		SetSelection("a");
		e.preventDefault();
		
	}
	
});


function loadingAnimation(){
	
	
	if($("#addblog-uploadpic").hasClass("addblog-animate")){
		$("#addblog-uploadpic").removeClass("addblog-animate");
	}else{
		$("#addblog-uploadpic").addClass("addblog-animate");	
	}
	
}

function startLoading(){
	
	stopLoading();
	loading = setInterval(loadingAnimation, 1000);
	
}

function stopLoading(){
	
	if(loading != null){
		clearInterval(loading);
	}
	
	$("#addblog-uploadpic").removeClass("addblog-animate");
	
}


//Upload
$("#addblog-uploadpic").unbind("click").click(function(event){
						
	$("#addblog-pictureupload").click();
						
						
	event.preventDefault();
});


//Search Car model
//$(".normal-form-input input").keyup(function(){
$("#addcar-model").keyup(function(){

	
	var keyword = $(this).val();
	
	//make modelid empty
	$("#addcar-model").attr("modelid","");
	
	if(ajaxloader != null){
		ajaxloader.abort();
	}
	
	ajaxloader = $.ajax({
		type:"POST",
		data:{keyword:keyword},
		url:"<?php echo BASEHREF; ?>cms/ajax/search-car-model.php",
		success:function(resp){
			
			if(resp.indexOf("<span") >= 0){ 
			
				$(".search-result").html(resp).show();
				
				
				
				$(".search-result-item").click(function(event) {
						
						
						//Get stuff
						var modelid = $(this).attr('modelid');
						var name = $(this).text();
						
						//Set name as value
        				$("#addcar-model").val(name);
						$("#addcar-model").attr("modelid",modelid);
						
						//Hide 
						$(".search-result").hide();
						
						//Or hide the whole block
						$(".search-result").html("").hide();
						
    			});
			
			}else{
				$(".search-result").html("").hide();
			}
		
		
		}
	
	});
	
});

//Make inputs Numeric
$("#addcar-price").numeric({ decimal : ","  });
$("#addcar-year").numeric();
$("#addcar-seats").numeric();
$("#addcar-mileage").numeric();
$("#addcar-engcap").numeric();
$("#addcar-doors").numeric();

//saveblog
$("#save-blog").unbind("click").click(function(event){


	//$(".submit-main-result").remove();
	
	//Change button text
	var button = $(this);
	
	$(button).text("Saving..");
	
	//check price shown
	if ($('input[name=hide-price]:checked').length > 0) {
	
		hide_price = 1;

	}else{

		hide_price = 0;

	}
	
	//check if preowned
	if ($('input[name=owned-type]:checked').length > 0) {
	
		owned_type = 1;

	}else{

		owned_type = 0;

	}

	//check if discount-car
	if ($('input[name=discount-car]:checked').length > 0) {
	
		discount_car = 1;

	}else{

		discount_car = 0;

	}

	///*

	var img = $("#addblog-uploadpic").attr("img");
	var model = $("#addcar-model").attr("modelid"); 

	var cat = $("#addcategory option:selected").val(); 
	var steering = $("#addsteering option:selected").val(); 
	var trans = $("#addtransmission option:selected").val();
	var wheelchair = $("#addwheelchair option:selected").val();
	var cylinder = $("#addcylinder option:selected").val(); 
	var fuel = $("#addfuel option:selected").val(); 
	var wheeldrive = $("#addwheeldrive option:selected").val(); 
	var status = $("#addstatus option:selected").val(); 

	var color = $("#addcar-color").val();
	var price = $("#addcar-price").val();
	var year = $("#addcar-year").val();
	var seats = $("#addcar-seats").val(); 
	var enginecap = $("#addcar-engcap").val(); 
	var doors = $("#addcar-doors").val(); 

	var mileage = $("#addcar-mileage").val(); 
	chassis = $("#addcar-chassis").val();
	licence_plate = $("#addlplate").val();
	
	//alert(discount_car);

	/*reset combobox
	$('.addcar-combo option').each(function () {
								if (this.defaultSelected) {
									this.selected = true;
									return false;
								}
	});
	*/
	
	///*
	$.ajax({
									
			url:"../ajax/add-car.php",
			type:"POST",
			//data: {img:img,model:model,cat:cat,steering:steering,trans:trans,wheelchair:wheelchair,cylinder:cylinder,fuel:fuel,wheeldrive:wheeldrive,color:color,price:price,year:year,seats:seats,mileage:mileage,chassis:chassis,enginecap:enginecap,doors:doors},
			data: {img:img,model:model,cat:cat,steering:steering,trans:trans,wheelchair:wheelchair,cylinder:cylinder,fuel:fuel,wheeldrive:wheeldrive,color:color,price:price,year:year,seats:seats,mileage:mileage,chassis:chassis,enginecap:enginecap,doors:doors,status:status,hide_price:hide_price,owned_type:owned_type,licence_plate:licence_plate,discount_car:discount_car},
			success: function(response){
							
						if(response != "fail"){

                            $("body").append("<input type='hidden' id='cid' value='"+response+"'>");

                            $("#multiImageUpload").submit();
							
							
						}else{
							
							$(button).text("Save");
							
							$(".project-submit-main").prepend('<a class="submit-main-result submit-blog-wrong">Some field(s) are empty!</a>');
							
						}
					}
									
									
			});
		
	//*/

	event.preventDefault();
	
});
</script>