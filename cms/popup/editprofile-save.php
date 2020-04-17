<?php
require("../../core/sessie.php");
require("../../core/functies.php");

//Set timezone
$resp = "No admin rights!";

if(isset($_COOKIE['cmsadmin'])){
	
	//Check values to save	
		if(isset($_GET['idlid']) && isset($_GET['idlid']) && isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['gender']) && isset($_GET['email']) && isset($_GET['stad']) && isset($_GET['land']) && isset($_GET['bio']) && isset($_GET['webfb']) && isset($_GET['webtw']) && isset($_GET['webli']) && isset($_GET['webgo']) && isset($_GET['website']) && isset($_GET['type']) && isset($_GET['groep']) && isset($_GET['detail']) && isset($_GET['func']) && isset($_GET['place']) && isset($_GET['wwebsite'])){
			
		//Clean vars
		$lidid = mysqli_real_escape_string($con, $_GET['idlid']);	
		$fname = ucfirst(strtolower(mysqli_real_escape_string($con, $_GET['fname'])));	
		$lname = ucfirst(strtolower(mysqli_real_escape_string($con, $_GET['lname'])));	
		$gender = mysqli_real_escape_string($con, $_GET['gender']);	
		$email = mysqli_real_escape_string($con, $_GET['email']);	
		$stad = mysqli_real_escape_string($con, $_GET['stad']);	
		$land = mysqli_real_escape_string($con, $_GET['land']);	
		$bio = mysqli_real_escape_string($con, $_GET['bio']);	
		$webfb = mysqli_real_escape_string($con, $_GET['webfb']);	
		$webtw = mysqli_real_escape_string($con, $_GET['webtw']);	
		$webli = mysqli_real_escape_string($con, $_GET['webli']);	
		$webgo = mysqli_real_escape_string($con, $_GET['webgo']);	
		$website = mysqli_real_escape_string($con, $_GET['website']);	
		
		//Check if work or study
		$type = mysqli_real_escape_string($con, $_GET['type']);
		$groep = mysqli_real_escape_string($con, $_GET['groep']);	
		$detail = mysqli_real_escape_string($con, $_GET['detail']);	
		$func = mysqli_real_escape_string($con, $_GET['func']);	
		$place = mysqli_real_escape_string($con, $_GET['place']);	
		$wwebsite = mysqli_real_escape_string($con, $_GET['wwebsite']);	
		
		
		$myaccount = mysqli_fetch_assoc($con->query("SELECT * FROM `leden` WHERE `leden_id` = '".$lidid."'"));
		
		if($type == "professional"){
			//Work
			$cwork = mysqli_num_rows($con->query("SELECT * FROM `leden_profiel_fow` WHERE `leden_id` = '".$myaccount['leden_id']."'"));
			
			//Remove study
			$removestudy = $con->query("DELETE FROM `leden_profiel_student` WHERE `leden_id` = '".$myaccount['leden_id']."'");
			
			if($cwork > 0){
			$updatework = $con->query("UPDATE `leden_profiel_fow` SET `branche_group_id` = '".$groep."',`branche_id` = '".$detail."', `functie` = '".$func."', `bedrijf` = '".$place."', `website` = '".$wwebsite."' WHERE `leden_id` = '".$myaccount['leden_id']."'");
			
			}else{
			//Add	
			
			$addwork = $con->query("INSERT INTO `leden_profiel_fow` (`leden_id`, `branche_group_id`,`branche_id`,`functie`,`bedrijf`,`website`,`datumtijd`) VALUES ('".$myaccount['leden_id']."','".$groep."','".$detail."','".$func."','".$place."','".$wwebsite."','".date("Y-m-d H:i:s")."')");
			
				
			}
			
		}else{
			//Study	
			$cstudy = mysqli_num_rows($con->query("SELECT * FROM `leden_profiel_student` WHERE `leden_id` = '".$myaccount['leden_id']."'"));
			
			//Remove work
			$removework = $con->query("DELETE FROM `leden_profiel_fow` WHERE `leden_id` = '".$myaccount['leden_id']."'");
			
			if($cstudy > 0){
			$updatestudy = $con->query("UPDATE `leden_profiel_student` SET `studie_id` = '".$groep."',`studierichting_did` = '".$detail."', `studienaam` = '".$func."', `school` = '".$place."', `website` = '".$wwebsite."' WHERE `leden_id` = '".$myaccount['leden_id']."'");
			
			}else{
			//Add	
			
			$addstudy = $con->query("INSERT INTO `leden_profiel_student` (`leden_id`, `studie_id`,`studierichting_did`,`studienaam`,`school`,`website`,`datumtijd`) VALUES ('".$myaccount['leden_id']."','".$groep."','".$detail."','".$func."','".$place."','".$wwebsite."','".date("Y-m-d H:i:s")."')");
				
			}
			
		}
		
		
		//Update
		$update = $con->query("UPDATE `leden` SET `voornaam` = '".$fname."', `achternaam` = '".$lname."', `profielnaam` = '".$fname." ".$lname."', `geslacht` = '".$gender."',`emailadres` = '".$email."',`stad` = '".$stad."',`land_id` = '".$land."',`welkom` = '".$bio."',`soc_fb` = '".$webfb."',`soc_tw` = '".$webtw."',`soc_li` = '".$webli."',`soc_go` = '".$webgo."',`link1` = '".$website."' WHERE `leden_id` = '".$myaccount['leden_id']."'");
		
		$resp = "Profiel opgeslagen.";	
			
		}else{
		$resp = "Geen data doorgekomen.";	
		}
	}

?>

<div class="popup-share-block" >
	<div class="popup-block-header">
    	<span style="color:#fff !important;">Profiel bewerken</span>
    	<a href="#" class="popup-block-close">×</a>
    </div>
    
	<div class="popup-block-content">
        <div class="geachte-title"><?php echo $resp; ?></div>
    </div>
    
    <div class="popup-block-options">
    	<a href="#" class="popup-block-options-false">Sluiten</a>
    </div>


</div>
<script>
setTimeout(function(){
var popupMT = $(".popup-share-block").height()/2;

	$(".popup-share-block").animate({
		marginTop: "-"+popupMT+"px"
	},300);
	

},1);

$(".popup-block-options-false").unbind("click").click(function(event){
		
		popupClose();
		
		
		//location.reload();
		
	event.preventDefault();
});
</script>
