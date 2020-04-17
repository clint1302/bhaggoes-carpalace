<span class="cms-content-header">Gallery Images
	<div class="cms-content-header-right cms-content-header-right-link">
    	<a href="<?php echo BASEHREF; ?>cms/gallery/add-gallery-image" >Add Image</a>
    </div>
</span>
<div class="cms-content-block">

	<div class="blogs-main-block" >
        <?php
					//get cars
					$g_images = $con->query("SELECT * FROM `gallery_image` WHERE `status` > 0 ORDER BY `id` DESC ");
					while($g_image = mysqli_fetch_array($g_images)){
				?>
        
    	<div class="blog-main" bid="<?php echo $g_image['id']; ?>"  style="background-image:url(<?php echo BASEHREF."cms/upload/gallery_images/".$g_image['img']; ?>); <?php //if($f_research['foto_pos'] != ""){ echo 'background-position:'.$f_research['foto_pos'].';'; } ?>">
    		<div class="blog-top-bar">
				<div>
					<a href="<?php echo BASEHREF; ?>cms/gallery/edit-gallery-image/<?php echo $g_image['id']; ?>"><span class="blog-top-button blog-edit-color">Edit</span></a>
					<span gallery-image-id="<?php echo $g_image['id']; ?>" class="blog-top-button blog-delete-color">Delete</span>
				</div>
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
	
			var imagedel = $(this).attr("gallery-image-id");
			//alert(imagedel);

			openPopup("delete-gallery-image.php?id="+imagedel,false);
			
			
			event.preventDefault();
});

</script>