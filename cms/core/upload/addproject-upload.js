
	(function () {
	var input = document.getElementById("addproject-img"), 
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
			
			//Set class
			$("#project-img").attr("img","").css("background-image","");
				
			$("#project-img .cms-project-form-loader").show();
			$("#project-img .cms-project-form-upload").hide();
			
			
			
			//Begin uploading
			$.ajax({
				url: "../../../ajax/upload-addproj.php",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					
				$("#project-img .cms-project-form-loader").hide();
			$("#project-img .cms-project-form-upload").show();
				
				var imgs = res.split(",");
					
				$.each( imgs, function( key, img ) {	
				//Update cover
				$("#project-img").attr("img",res).css("background-image","url(../../../../projectimages/"+res+")").css("border","0");
					
				});
					
					
					//Reset
					resetForm();
				}
			});
		}
	}, false);
}());
