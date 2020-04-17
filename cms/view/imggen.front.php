<span class="cms-content-header">ImageLink Generator</span>
<div class="cms-content-block">
	
    <div class="cms-imggen-header">
    	<span class="cms-imggen-backdrop"></span>
        <span class="cms-imggen-backimg">
        </span>
		<span class="cms-imggen-place">&#127748;</span>
    </div>
        
    <div class="cms-imggen-link">
    	<input type="text" readonly="readonly" id="imggen-link" placeholder="Generated Link" />
    	<input type="text" readonly="readonly" id="imggen-link-thumb" placeholder="Generated Thumbnail Link" />
    </div>    
        
</div>
<input type="file" name="imggen-pictureupload" backlink="../" id="imggen-pictureupload" class="image-uploader" base="<?php echo BASEHREF; ?>" />

<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/core/upload/imggen-uploadimg.js"></script>
<script>
function startLoading(){
	$(".cms-imggen-backdrop").addClass("cms-imggen-load");
}
function stopLoading(){
	$(".cms-imggen-load").removeClass("cms-imggen-load");
}

$(".cms-imggen-link input").unbind("click").click(function() {
   $(this).select();
});

//Upload
$(".cms-imggen-backimg, .cms-imggen-place").unbind("click").click(function(event){
						
	$("#imggen-pictureupload").click();
						
						
	event.preventDefault();
});
</script>