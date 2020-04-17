<?php
require("../../core/sessie.php");
require("../../core/functies.php");


if(isset($_COOKIE['cmsadmin'])){

if(isset($_GET['email']) && $_GET['email'] !=""){

$email = mysqli_real_escape_string($con,$_GET['email']);
	
?>
<div class="popup-share-block">
	<div class="popup-block-header">
    	<span style="color:#fff !important;">Wachtwoord veranderen</span>
    	<a href="#" class="popup-block-close">×</a>
    </div>
    
	<div class="popup-block-content">
    	
        <span><input type="text" placeholder="Voer jouw emailadres in" id="email" value="<?php echo $email; ?>"  /></span>
        
    </div>
    
    <div class="popup-block-options">
    	<a href="#" class="popup-block-options-true">Sturen</a>
    	<a href="#" class="popup-block-options-false">Annuleren</a>
    </div>

</div>

<script>
var send = false;

setTimeout(function(){
var popupMT = $(".popup-share-block").height()/2;

	$(".popup-share-block").animate({
		marginTop: "-"+popupMT+"px"
	},300);
	
		//Open stuff
		if($(".login-window").is(":visible")){
			//Hide switch
			$("#login-switch").click();
		}

},1);


$(".popup-block-options-true").unbind("click").click(function(event){
	
	//var butt = $(this);
	
		var mail = $("#email").val();
		
		//alert(email);
		
		openPopup("forgot-password-action.php?mail="+mail+"", false);
	
	event.preventDefault();
});


	
$(".popup-block-options-false").unbind("click").click(function(event){
		
	popupClose();
		
	event.preventDefault();
});

</script>

<?php

	}else{
	
	die("Geen email adres");
		
	}
	
	
}else{
	
die("No admin rights!");
	
}

?>