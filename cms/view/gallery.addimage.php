<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/scr/rich-editor/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo BASEHREF; ?>cms/scr/rich-editor/controls/wysiwyg.image.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF; ?>cms/scr/rich-editor/jquery.wysiwyg.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF; ?>cms/scr/rich-editor/input.css" />

<span class="cms-content-header">Add Gallery Image</span>
<div class="cms-content-block">
	<div class="blogs-main-block">
    	
        <!--Form-block -->
    	<div class="addblog-form-block">
				
				<!-- Form item -->
                <form id="multiImageUpload" action="" method="post" enctype="multipart/form-data">
                  <style>
                    .gallery-image-preview {
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
                        <span class="normal-form-place">Gallery Image<span class="required-star">*</span></span>    
                        
                        <div class="normal-form-item-content">
                            <div class="normal-form-rcontent">
                                <span class="normal-form-input">
                                    <input type="file" class="gallery-image" name="gallery-image" value=""/>
                                    <img class="gallery-image-preview" src="#" alt="" />
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Form item -->
                </form>
				
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
    // Validation for gallery image
    $(".gallery-image").change(function () {
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

        $.ajax({
        url: "<?php echo BASEHREF; ?>cms/ajax/add-gallery-image.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            if ( data == "done" ) {
              
              $(".submit-main-result.submit-blog-wrong").remove();
              $(".gallery-image").val("");
              $(".gallery-image-preview").css("display", "none");

              $(".project-submit-main").prepend('<a class="submit-main-result cust-suc">Succesfully added</a>');

              $("#save-blog").text("Save");

            } else {
                $(".submit-main-result.cust-suc").remove();
                $(".submit-main-result.submit-blog-wrong").remove();
              $(".project-submit-main").prepend('<a class="submit-main-result submit-blog-wrong">'+data+'</a>');
              // $(".project-submit-main").prepend('<a class="submit-main-result submit-blog-wrong">Something wrong!</a>');
              $("#save-blog").text("Save");

            }
        }
        });

    }));
    
  });
</script>
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

//saveblog
$("#save-blog").unbind("click").click(function(event){


	//$(".submit-main-result").remove();
	
	//Change button text
	var button = $(this);
	
	$("#save-blog").text("Saving..");
	
	$("#multiImageUpload").submit();

	event.preventDefault();
	
});
</script>