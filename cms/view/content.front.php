<span class="cms-content-header">News</span>
<div class="cms-content-block">
	
</div>

<script>
$( "#cards-sort" ).sortable({
      placeholder: "project-item-card-place"
    });


$(".project-dag-main").unbind("click").click(function(event){
	
	//clean
	$(".projdag-butt-custom").html("");
	$(".projdag-butt-custom-sel").removeClass("projdag-butt-custom-sel");
	
	$(this).find(".projdag-butt-custom").addClass("projdag-butt-custom-sel");
	$(this).find(".projdag-butt-custom").html("★");
	
	
});

$("#save-projects").unbind("click").click(function(event){
	
	
	
	//var projday = $('input:radio[name=proj-day]:checked').val();
	var projects = new Array();
	var projday = $(".projdag-butt-custom-sel").attr("pid");
	
	$(".project-item-card").each(function(index,elem){
		var proj_id = $(elem).attr("project_id");
		
		//Add to array
		projects.push(proj_id);
	});
	
	//Send data
		$.ajax({
			url: '<?php echo BASEHREF; ?>cms/ajax/projects-order.php',
			type: 'POST',
			data: {projday:projday, projects:projects},
			success: function(resp){
				
				if(resp.indexOf("done") >= 0){
				
					openPopup("pop-projdag.php",false);
					
				}else{
				popup(resp);		
				}
					
				
				}
			});
			
	
	event.preventDefault();
});
</script>
