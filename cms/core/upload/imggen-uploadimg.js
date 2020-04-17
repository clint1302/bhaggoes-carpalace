
	(function () {
	var input = document.getElementById("imggen-pictureupload"), 
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
				url: backlink+"ajax/upload-imggen.php",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					
					var hqres = base+"upload/generated/"+res;
					var lqres = base+"upload/generated/thumbs/"+res;
					
					stopLoading();
					
					$(".cms-imggen-backimg").css("border-radius", "2px").html('<img src="'+lqres+'" draggable="false" /><span></span>');
					$(".cms-imggen-place").addClass("cms-imggen-placefoc");
					$(".cms-imggen-backdrop").css("border-radius", "2px");
					
					$("#imggen-link").val(hqres);
					$("#imggen-link-thumb").val(lqres);
					
					//Reset
					resetForm();
				}
			});
		}
	}, false);
}());
