
	(function () {
	var input = document.getElementById("addproject-udocs"), 
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
		
		
		var i = 0, len = this.files.length, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
	
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.onloadend = function (e) { 
					};
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("docs[]", file);
				}
		}
	
		if (formdata) {
			
			$("#project-udocs .cms-project-form-loader").show();
			$("#project-udocs .cms-project-form-upload").hide();
		    $("#project-udocs .project-form-image-text").hide();
			
			
			
			//Begin uploading
			$.ajax({
				url: "../../../ajax/upload-adddocs.php",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					
					
				$("#project-udocs .cms-project-form-loader").hide();
				$("#project-udocs .cms-project-form-upload").show();
				$("#project-udocs .project-form-image-text").show();
				
				var docs = res.split(",");
					
				$.each( docs, function( key, file ) {	
				
				var splititem = file.split(";");
				
				//Update imgs
				var pdoc = '<div class="cms-project-document-item project-form-docs-item" file="'+splititem[0]+'"><a href="#" class="project-form-item-close">x</a><span class="cms-project-document-type">...</span><span class="cms-project-document-details"><span class="cms-project-document-title project-form-docs-text">'+splititem[1]+'</span><span class="cms-project-document-options"><span class="cms-project-document-size">...</span></span></span></div>';
				
				$("#project-docs").prepend(pdoc);
				
				});
					
					itemDelete();
					
					//Reset
					resetForm();
				}
			});
		}
	}, false);
}());
