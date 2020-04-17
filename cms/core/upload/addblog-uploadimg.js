
	(function () {
	var input = document.getElementById("addblog-pictureupload"), 
		formdata = false;
	var base = $(input).attr("base");
	var backlink = $(input).attr("backlink");

	function resetForm () {
		
		//Reset
		input.value = "";
		
		
	}   

	if (window.FormData) {
  		formdata = new FormData();
	}
	
 	input.addEventListener("change", function (evt) {
		
		file = this.files[0];
	
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("image", file);
				}
			
		}
	
		if (formdata) {
			
			//Loading
			startLoading();
			
			//Begin uploading
			$.ajax({
				url: backlink+"ajax/upload-addcar.php",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					
					
					stopLoading();
					
					var rres = base+"upload/cars/small/"+res;
					var hres = base+"upload/cars/medium/"+res;
					
					$("#addcompany-uploadpic-loader").hide();
					
					//Set new image
					$("#addblog-uploadpic").attr("img",res).css("background-image","url("+rres+")");
					$(".addblog-main-image").css("background-image","url("+hres+")");
					
					//Reset
					resetForm();
				}
			});
		}
	}, false);
}());
