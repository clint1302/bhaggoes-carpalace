	
			
	(function () {
	//get leden id	
	
	
	var input = document.getElementById("editprofile-pictureupload");
	
	var lidid = $(input).attr("lidid");

		formdata = false;
	var base = $(input).attr("base");
	
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
			
			//Add lid
			formdata.append("lidid", lidid);
			
		if (formdata) {
			
			
			//Loading
			$("#editprofile-prof-loader").show();
			
			//Begin uploading
			$.ajax({
				url: "../../ajax/editprofile-uploadpicture.php",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					
					//alert(res);
					$("#editprofile-prof-loader").hide();
					
					//Set new image
					$(".own-prof-pic").css("background-image","url("+res+")");
					
					//Reset
					resetForm();
				}
			});
		}
	}, false);
}());
