
	(function () {
	var input = document.getElementById("addproject-uimgs"), 
		formdata = false;

	function resetForm () {
		
		//Reset
		input.value = "";
		
		
	}   

	if (window.FormData) {
  		formdata = new FormData();
	}
	
 	input.addEventListener("change", function (evt) {
		this.files = "";
		formdata = new FormData();
		
		
		var i = 0, len = this.files.length, img, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
	
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.onloadend = function (e) { 
					};
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("images[]", file);
				}
			}	
		}
	
		if (formdata) {
			
			$("#project-uimgs .cms-project-form-loader").show();
			$("#project-uimgs .cms-project-form-upload").hide();
			$("#project-uimgs .project-form-image-text").hide();
			
			//Begin uploading
			$.ajax({
				url: "../../../ajax/upload-addproj.php",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					
					
				$("#project-uimgs .cms-project-form-loader").hide();
				$("#project-uimgs .cms-project-form-upload").show();
				$("#project-uimgs .project-form-image-text").show();
				
				var imgs = res.split(",");
					
				$.each( imgs, function( key, img ) {	
				
				//Update imgs
				var pimg = '<span class="project-form-imgs-item" img="'+img+'" style="background-image:url(../../../../projectimages/small/'+img+');"><a href="#" class="project-form-item-close">x</a></span>';
				$("#project-imgs").append(pimg);
				
				});
					
					itemDelete();
					
					//Reset
					resetForm();
				}
			});
		}
	}, false);
}());
