<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/scr/rich-editor/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/scr/rich-editor/controls/wysiwyg.image.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF; ?>cms/scr/rich-editor/jquery.wysiwyg.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF; ?>cms/scr/rich-editor/input.css" />

<span class="cms-content-header">Edit-Car</span>
<div class="cms-content-block">
	<div class="blogs-main-block">
    	
		<?php
function br2nl($text){
	$br = array("<br/>", "<br />", "<br>");
	
	$text = str_ireplace($br, "\r\n", $text);
	
	return $text;	
}
		
if (isset($_GET['pid'])) {

$id = $_GET['pid'];

//Fetch car
$f_car = mysqli_fetch_assoc($con->query("SELECT * FROM `cars` WHERE `car_id` = '".$id."'"));

//Fetch model
$f_model = mysqli_fetch_assoc($con->query("SELECT * FROM `car_models` WHERE `model_id` = '".$f_car['model_id']."'"));

//Fetch car images
$f_car_images = mysqli_fetch_assoc($con->query("SELECT * FROM `car_images` WHERE `car_id` = '".$id."'"));
$imgoldname1 = $f_car_images['img1'];
$imgoldname2 = $f_car_images['img2'];
$imgoldname3 = $f_car_images['img3'];
if( $f_car_images['img1'] != "" ) {
    $image1 = BASEHREF."cms/upload/cars_slider/".$f_car_images['img1'];
    $img1block = "block";
} else {
    $image1 = "#";
}
if( $f_car_images['img2'] != "" ) {
    $image2 = BASEHREF."cms/upload/cars_slider/".$f_car_images['img2'];    
    $img2block = "block";
} else {
    $image2 = "#";
}
if( $f_car_images['img3'] != "" ) {
    $image3 = BASEHREF."cms/upload/cars_slider/".$f_car_images['img3'];
    $img3block = "block";
} else {
    $image3 = "#";
}

$carphoto = BASEHREF."cms/upload/cars/medium/".$f_car['img'];

}

?>
	   <div class="addblog-main-image" style="background-image:url(<?php echo $carphoto; ?>);">  
	   		<span class="addcar-feat-main">
				  <input class="feat-star" name="featured-star" type="checkbox" title="bookmark page" <?php if($f_car['featured'] > 0){ echo"checked"; } ?>> 
			</span>

          	<span class="addblog-image-upload" id="addblog-uploadpic" style="background-image:url(<?php echo $carphoto; ?>);" img="<?php echo $f_car['img'] ?>">
                    <span class="addblog-image-upload-icon">&#xe065;</span>
                    
                	<span class="addblog-image-upload-material">
                    </span>
             </span>
             <input type="file" name="addblog-pictureupload" backlink="../../"  id="addblog-pictureupload" class="image-uploader" base="<?php echo BASEHREF; ?>cms/" />
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
											<option value="1" <?php if( $f_car['status'] == '1') echo 'selected="selected"'; ?> >AVAILABLE</option>
											<option value="2" <?php if($f_car['status'] == '2') echo 'selected="selected"'; ?> >RESERVED</option>
											<option value="3" <?php if( $f_car['status'] == '3') echo 'selected="selected"'; ?> >SOLD</option>
										</select>
										
								</div>
								<span class="addprice-check">
									<input type="checkbox" id="discount" name="discount-car"  <?php if($f_car['discount'] > 0){ echo"checked"; } ?>/>
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
                            	<input type="text" id="addlplate" value="<?php echo $f_car['licence_plate'];?>"/>
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

								 <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addmodel" class="addcar-combo">
                                      <?php
										$g_models = $con->query("SELECT * FROM `car_models` ORDER BY `title` ");

										while($f_model = mysqli_fetch_array($g_models)){

											//fetch brand
											$f_brand = mysqli_fetch_assoc($con->query("SELECT * FROM `car_brands` WHERE `brand_id` = '".$f_model['brand_id']."' "));
                                        ?>
                                         <option value="<?php echo $f_model['model_id']; ?>" <?php if($f_model['model_id'] == $f_car['model_id']) echo 'selected="selected"'; ?> ><?php echo $f_brand['title'] ?> - <?php echo $f_model['title'] ?></option>
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
            		<span class="normal-form-place">Category<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addcategory" class="addcar-combo">
                                      <?php
										$g_cat = $con->query("SELECT * FROM `car_categories`");

										while($f_cat = mysqli_fetch_array($g_cat)){

                                        ?>
                                         <option value="<?php echo $f_cat['category_id']; ?>" <?php if($f_cat['category_id'] == $f_car['category_id']) echo 'selected="selected"'; ?> ><?php echo $f_cat['title'] ?></option>
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
                            	<input type="text" id="addcar-color" value="<?php echo $f_car['color'];?>"/>
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
								<input type="text" id="addcar-price" class="addprice" value="<?php echo $f_car['price'];?>"/>
								<span class="addprice-check">
									<input type="checkbox" id="hideprice" name="hide-price"  <?php if($f_car['price_state'] > 0){ echo"checked"; } ?>/>
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
                            	<input type="text" id="addcar-year" value="<?php echo $f_car['year'];?>"/>
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
										<option value="diesel" <?php if( $f_car['fuel'] == 'diesel') echo 'selected="selected"'; ?> >Diesel</option>
										<option value="petrol" <?php if($f_car['fuel'] == 'petrol') echo 'selected="selected"'; ?> >Petrol</option>
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
                            	<input type="text" id="addcar-seats" value="<?php echo $f_car['seats'];?>"/>
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
										 <option value="left" <?php if( $f_car['steering'] == 'left') echo 'selected="selected"'; ?> >Left</option>
										 <option value="right" <?php if($f_car['steering'] == 'right') echo 'selected="selected"'; ?> >Right</option>
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
										 <option value="automatic" <?php if( $f_car['transmission'] == 'automatic') echo 'selected="selected"'; ?> >Automatic</option>
										 <option value="manual" <?php if($f_car['transmission'] == 'manual') echo 'selected="selected"'; ?> >Manual</option>
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
            		<span class="normal-form-place">Mileage</span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
								<!--<input type="text" id="addcar-mileage" value="<?php echo $f_car['mileage'];?>"/>-->
								<input type="text" id="addcar-mileage" class="addprice" value="<?php echo $f_car['mileage'];?>"/>
								<span class="addprice-check">
									<input type="checkbox" id="ownedtype" name="owned-type" <?php if($f_car['pre_owned'] > 0){ echo"checked"; } ?>/>
									<label for="ownedtype">Pre-owned</label>
								</span>
                            </span>
                        </div>
                    </div>
                    
                </div>
            	<!-- Form item -->
				
				<!-- Form item -->
            	<div class="normal-form-item">
            		<span class="normal-form-place">Key number</span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            	<input type="text" id="addcar-chassis" value="<?php echo $f_car['chassis'];?>"/>
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
                            	<input type="text" id="addcar-engcap" value="<?php echo $f_car['engine_capacity'];?>"/>
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
										 <option value="4" <?php if( $f_car['cylinders'] == '4') echo 'selected="selected"'; ?> >4</option>
										 <option value="6" <?php if($f_car['cylinders'] == '6') echo 'selected="selected"'; ?> >6</option>
										 <option value="8" <?php if( $f_car['cylinders'] == '8') echo 'selected="selected"'; ?> >8</option>
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
            		<span class="normal-form-place">Wheeldrive<span class="required-star">*</span></span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input">
                            <div class="cars-form-dropdown">
                                    <span class="cars-form-pointer" style="background-image:url(<?php echo BASEHREF; ?>cms/img/icons/dropdown-pointer.png);"></span>
                                    <select id="addwheeldrive" class="addcar-combo">
										 <option value="2wd" <?php if( $f_car['wheeldrive'] == '2wd') echo 'selected="selected"'; ?> >2WD</option>
										 <option value="optinal 4wd" <?php if($f_car['wheeldrive'] == 'optinal 4wd') echo 'selected="selected"'; ?> >Optional 4WD</option>
										 <option value="fulltime 4wd" <?php if($f_car['wheeldrive'] == 'fulltime 4wd') echo 'selected="selected"'; ?> >Fulltime 4WD</option>
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
                            	<input type="text" id="addcar-doors" value="<?php echo $f_car['doors'];?>"/>
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
										 <option value="yes" <?php if( $f_car['wheelchair'] == 'yes') echo 'selected="selected"'; ?> >Yes</option>
										 <option value="none" <?php if($f_car['wheelchair'] == 'none') echo 'selected="selected"'; ?> >No</option>
                                    </select>
                                    </div>
                            </span>
                            </span>
                        </div>
                    </div>
                    
				</div>
				<!-- Form item -->

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
                                    <img class="car-preview" src="<?php echo $image1; ?>" alt="" style="<?php if($img1block=='block') { echo 'display: '.$img1block; } ?>" />
                                    <input type="hidden" name="imgoldname1" value="<?php echo $imgoldname1; ?>">
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
                                    <img class="car-preview" src="<?php echo $image2; ?>" alt="" style="<?php if($img2block=='block') { echo 'display: '.$img2block; } ?>" />
                                    <input type="hidden" name="imgoldname2" value="<?php echo $imgoldname2; ?>">
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
                                    <img class="car-preview" src="<?php echo    $image3; ?>" alt="" style="<?php if($img3block=='block') { echo 'display: '.$img3block; } ?>" />
                                    <input type="hidden" name="imgoldname3" value="<?php echo $imgoldname3; ?>">
                                </span>
                            </div>
                        </div>
                        
                    </div>
                </form>
                <!-- Form item -->

				<!-- Form item
            	<div class="normal-form-item">
            		<span class="normal-form-place">Accessories</span>    
                	
                    <div class="normal-form-item-content">
                    	<div class="normal-form-rcontent">
                        	<span class="normal-form-input"> -->
								<!--<input type="text" id="addcar-accessories" value="<?php echo $f_car['accessories'];?>"/>
								<textarea rows="4" cols="50" name="comment" id="addcar-accessories">
									<?php if($f_car['accessories'] != ""){echo $f_car['accessories'];}else{echo("Enter accessories here...");}?></textarea>
                            </span>
                        </div>
                    </div>
                    
				</div>
				 Form item -->

				
       
        </div>
       <!--Form-block -->
        <div class="project-submit-main"><a href="#" id="update-car">SAVE</a></div>
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

        var cid = <?php echo $id; ?>;

        $.ajax({
        url: "<?php echo BASEHREF; ?>cms/ajax/edit-car-images.php?id="+cid, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            if ( data == "done" ) {
                
                $(".car-images-info").val("");                            
                $(".project-submit-main").prepend('<a class="submit-main-result">Succesfully saved</a>');
                $("#update-car").text("Save");

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
var feat_car = <?php echo $f_car['featured'];  ?>;
var hide_price = <?php echo $f_car['price_state'];  ?>;
var discount_car = <?php echo $f_car['discount'];  ?>;
var owned_type = <?php echo $f_car['pre_owned'];  ?>;
var chassis = "<?php if($f_car['chassis'] != ""){echo $f_car['chassis'];}   ?>";
var licence_plate = "<?php if($f_car['licence_plate'] != ""){echo $f_car['licence_plate'];}  ?>";

//var blogid = "<?php echo $f_car['car_id'];  ?>";
/*
function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}
	
function SetSelection(char)
{
  var textComponent = document.getElementById('add-blog-descr');
  var selectedText;
  
  if (document.selection != undefined)
  {
    textComponent.focus();
    var sel = document.selection.createRange();
    selectedText = sel.text;
  }
  
  else if (textComponent.selectionStart != undefined)
  {
    var startPos = textComponent.selectionStart;
    var endPos = textComponent.selectionEnd;
    selectedText = textComponent.value.substring(startPos, endPos);
	
	//Get stuff to replace
	if(endPos > 0){
		var chcount = textComponent.value.length;
		
		var lefttext = textComponent.value.substring(0, startPos);	
		var righttext = textComponent.value.substring(endPos, chcount);	
		
		var finaltext = lefttext+"<"+char+">"+selectedText+"</"+char+">"+righttext;
		
		//Set text
		textComponent.value = finaltext;
		
	}
	
  }
  
  return selectedText;
}
*/

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

//Clean Textarea
$('textarea').each(function(){
            $(this).val($(this).val().trim());
        }
);

//update car
$("#update-car").unbind("click").click(function(event){
	
	//$(".submit-main-result").remove();
	
	//Change button text
	var button = $(this);
	
	$(button).text("Saving..");
	
	//Get textarea content
	if ($('textarea#addcar-accessories') != undefined) {

		var carAccessories = $('textarea#addcar-accessories').val();

	}

	//check if featured
	if ($('input[name=featured-star]:checked').length > 0) {
	
		feat_car = 1;

	}else{

		feat_car=0;

	}

	//check price shown
	if ($('input[name=hide-price]:checked').length > 0) {
		
			hide_price = 1;
	
	}else{
	
			hide_price = 0;
			
	}

	//check if pre-owned
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

	//alert(feat_car);
	
	var carid = <?php echo $f_car['car_id'] ?>;
	var img = $("#addblog-uploadpic").attr("img");

	var model = $("#addmodel option:selected").val(); 
	var cat = $("#addcategory option:selected").val(); 
	var steering = $("#addsteering option:selected").val(); 
	var trans = $("#addtransmission option:selected").val();
	var wheelchair = $("#addwheelchair option:selected").val();
	var cylinder = $("#addcylinder option:selected").val(); 
	var fuel = $("#addfuel option:selected").val(); 
	var wheeldrive = $("#addwheeldrive option:selected").val();
	var carstatus = $("#addstatus option:selected").val();  

	var color = $("#addcar-color").val();
	var price = $("#addcar-price").val();
	var year = $("#addcar-year").val();
	var seats = $("#addcar-seats").val(); 
	var mileage = $("#addcar-mileage").val(); 
	var enginecap = $("#addcar-engcap").val(); 
	var doors = $("#addcar-doors").val(); 
	
	
	chassis = $("#addcar-chassis").val();
	licence_plate = $("#addlplate").val();

	//alert(discount_car);

	///*
		$.ajax({
									
			url:"../../ajax/edit-car.php",
			type:"POST",
				//with carAccessories
				//data: {img:img,carid:carid,model:model,cat:cat,steering:steering,trans:trans,wheelchair:wheelchair,cylinder:cylinder,fuel:fuel,wheeldrive:wheeldrive,color:color,price:price,year:year,seats:seats,mileage:mileage,chassis:chassis,enginecap:enginecap,doors:doors,feat_car:feat_car,carstatus:carstatus,hide_price:hide_price,owned_type:owned_type,carAccessories:carAccessories},
				data: {img:img,carid:carid,model:model,cat:cat,steering:steering,trans:trans,wheelchair:wheelchair,cylinder:cylinder,fuel:fuel,wheeldrive:wheeldrive,color:color,price:price,year:year,seats:seats,mileage:mileage,chassis:chassis,enginecap:enginecap,doors:doors,feat_car:feat_car,carstatus:carstatus,hide_price:hide_price,owned_type:owned_type,licence_plate:licence_plate,discount_car:discount_car},
			success: function(response){
				
						if(response == "done"){
							
                            $("#multiImageUpload").submit();

							// $(button).text("Save");
							
							// $(".project-submit-main").prepend('<a class="submit-main-result">Succesfully saved</a>');
							
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
