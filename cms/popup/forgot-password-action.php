<?php
require("../../core/sessie.php");
require("../../core/functies.php");
//error_reporting(0);

if(isset($_COOKIE['cmsadmin'])){

$item = "Emailadres kan niet leeg zijn.";

if(isset($_GET['mail']) && $_GET['mail'] != ""){

	//Clean email
	$email = mysqli_real_escape_string($con,$_GET['mail']);
		
	$fmember = mysqli_fetch_assoc($con->query("SELECT * FROM `leden` WHERE `emailadres` = '".$email."'"));
	
	if($fmember['emailadres'] != ""){
		
		
		//Send email
		$sendnot = sendNotEmail($fmember, $fmember, "reset-password");
		
		if(!$sendnot){
			$item = "Er kon geen email worden gestuurd om uw wachtwoord opnieuw aan te maken, Probeer het straks weer.";
		}else{
			$item = "Een email is verzonden naar jouw opgegeven emailadres om jouw wachtwoord opnieuw aan te maken. Check svp ook uw spam folder als u deze email niet ziet in uw inbox.";	
		}
		
	}else{
		$item = "Er kan geen account worden gevonden met het opgegeven emailadres.";	
		
	}
}
?>
<div class="popup-share-block">
	<div class="popup-block-header">
    	<span>Wachtwoord vergeten</span>
    	<a href="#" class="popup-block-close">×</a>
    </div>
    
	<div class="popup-block-content">
    	<?php echo $item; ?>
    </div>
    
    <?php if($item != "Een email is verzonden naar jouw opgegeven emailadres om jouw wachtwoord opnieuw aan te maken."){ ?>
    <div class="popup-block-options">
    	<a href="#" class="popup-block-options-true">Opnieuw proberen</a>
    	<a href="#" class="popup-block-options-false">Annuleren</a>
    </div>
    <?php } ?>
    
</div>
<script>


setTimeout(function(){
var popupH = $(".popup-share-block").height();
	var popupMT = popupH/2;
var windH = $(window).height();

	
	$(".popup-share-block").animate({
		marginTop: "-"+popupMT+"px"
	},300);
	
	<?php if($item == "Een email is verzonden naar jouw opgegeven emailadres om jouw wachtwoord opnieuw aan te maken. Check svp ook uw spam folder als u deze email niet ziet in uw inbox."){ ?>
		setTimeout(function(){
			
			popupClose();
			
			
		},3500);
	<?php } ?>		

},1);



$(".popup-block-options-true").unbind("click").click(function(event){
	
	//Open stuff
	openPopup("forgot-password.php");
	
	event.preventDefault();
});


	
$(".popup-block-options-false").unbind("click").click(function(event){
		
	popupClose();
		
	event.preventDefault();
});

</script>
<?php

}

?>