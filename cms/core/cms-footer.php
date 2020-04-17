
    </div>
    </div>

</div>

<!-- Default stuff -->
<div class="cms-main-notifs" id="float-notifs">
	<span class="cms-notifs-alert icon-message"></span>
</div>
<script>
function alertthis(msg, type){

$(".cms-notifs-alert").hide();
$(".cms-notifs-alert").text(msg).show("fade", 200);	

//Remove
setTimeout(function(){
	
$(".cms-notifs-alert").hide("fade", 200);
	
	
},3000);

}
</script>
<!-- Default stuff -->
</body>
</html>