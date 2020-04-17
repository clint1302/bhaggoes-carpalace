<?php
//require("sessie.php");
//require("functies.php");
include('sql/conf.php');
///*
//Double check signed in
if(!isset($_COOKIE['cmsadmin'])){
header("location: ".BASEHREF."cms/login/");
exit();	
}else{
//Check if user is admin

$cadmin = mysqli_num_rows($gadmin = $con->query("SELECT * FROM `users` WHERE `user_id` = '".mysqli_real_escape_string($con, $_COOKIE['cmsadmin'])."'"));

if($cadmin == 0){
header("location: ".BASEHREF."cms/login/");
exit();	
}else{
$fcms = mysqli_fetch_assoc($gadmin);
$fadmin = mysqli_fetch_assoc($con->query("SELECT * FROM `users` WHERE `user_id` = '".$fcms['user_id']."'"));
	
setcookie("cmsadmin", $fadmin['user_id'], time()+3600, "/");

}
	
}
//*/
//Check inc
$menu = "";
if(isset($_GET['inc']) && $_GET['inc'] != ""){
	$inc = $_GET['inc'];

if(strpos($inc,'dash') !== false) {
$menu = "dash";
}else if(strpos($inc,'content') !== false) {
$menu = "content";	
}else if(strpos($inc,'cars') !== false) {
$menu = "cars";
}else if(strpos($inc,'gallery') !== false) {
$menu = "gallery";	
}else if(strpos($inc,'corporate') !== false) {
$menu = "corporate";
}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script type="text/javascript" src="<?php echo BASEHREF ?>cms/scr/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASEHREF ?>cms/scr/jquery.extra.js"></script>
<script type="text/javascript" src="<?php echo BASEHREF ?>cms/scr/jquery.autoresize.js"></script>
<script type="text/javascript" src="<?php echo BASEHREF ?>cms/scr/jquery.numeric.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF ?>cms/css/cms.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF ?>cms/css/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF ?>cms/css/icons.css"/>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CMS</title>
</head>

<!--<body style="background-image:url(<?php echo BASEHREF ?>cms/img/backgrounds/bgblue.jpg);">-->

<body style="background-color:#009688;">



<div class="cms-content">

<div class="cms-header-bar">
	<img src="<?php echo BASEHREF ?>cms/img/bhaggoeslogo.png" draggable="false" class="cms-header-logo" />
    
    <div class="cms-header-bar-left">
    	<span class="cms-header-bar-date entypo-calendar" id="datenow"></span><span class="cms-header-bar-date entypo-clock" id="timenow"></span>
    </div>
    <script>
	var weekday = new Array(7);
	weekday[0]=  "Sun";
	weekday[1] = "Mon";
	weekday[2] = "Tue";
	weekday[3] = "Wed";
	weekday[4] = "Thu";
	weekday[5] = "Fri";
	weekday[6] = "Sat";
	
	//Trigger
	updateTime();
	
	
	function updateTime(){
	
	var dt = new Date();
	
	
	var date = weekday[dt.getDay()] + ", " + dt.getDate() + " " + dt.getFullYear();
	var time = pad(dt.getHours(), 2) + " : " + pad(dt.getMinutes(), 2) + " : " + pad(dt.getSeconds(), 2);		
	
	$("#datenow").text(date);
	$("#timenow").text(time);
	
	//Update
	setTimeout(updateTime, 1000);
		
	}
	</script>
    
    <div class="cms-header-bar-right">
            <span class="cms-header-bar-right-pic" style="background-image:url(<?php //echo $fadmin['pic']; ?>);"></span>
    		<span class="cms-header-bar-cred">
            <a href="#" class="cms-header-bar-right-name">
            	<span class="cms-header-bar-right-name-text">Hi, <?php echo $fadmin['username']; ?></span>
            	<span class="cms-header-bar-right-name-pointer"></span>
            </a>
            
            <span class="cms-header-bar-credpointer cms-header-bar-drop"></span>
            <div class="cms-header-bar-credwindow cms-header-bar-drop">
            	<a href="<?php echo BASEHREF ?>cms/login/?logout=true">Logout</a>
            </div>
            <script>
			$(".cms-header-bar-right-name").unbind("click").click(function(event){
				
				if($(".cms-header-bar-drop").is(":visible")){
					$(".cms-header-bar-drop").hide();
					
					if($(".cms-header-bar-right-name").hasClass("cms-header-bar-right-name-sel")){
						$(".cms-header-bar-right-name-sel").removeClass("cms-header-bar-right-name-sel");
					}
					
				}else{
					$(".cms-header-bar-drop").show();	
					
					if(!$(".cms-header-bar-right-name").hasClass("cms-header-bar-right-name-sel")){
						$(".cms-header-bar-right-name").addClass("cms-header-bar-right-name-sel");
					}
					
				}
				
				event.preventDefault();
			});
			</script>
            
       	</span>
    </div>
    
</div>


<div class="cms-rcontent">

    <div class="cms-side-bar">
    
    	<div class="cms-side-bar-section">
        	<span class="cms-side-bar-header">
            	<span class="cms-side-bar-headerfl">Management</span>
            </span>
        	<a href="<?php echo BASEHREF ?>cms/dash/" class="cms-side-bar-item <?php if($menu == "dash") echo 'cms-side-bar-sel'; ?>"><span class="cms-side-bar-pointer"></span>Dashboard</a>
        	<a href="<?php echo BASEHREF ?>cms/cars/" class="cms-side-bar-item <?php if($menu == "cars") echo 'cms-side-bar-sel'; ?>"><span class="cms-side-bar-pointer"></span>Cars<span class="cms-side-bar-count"><?php
			
			
$count_s = mysqli_num_rows($con->query("SELECT `car_id` FROM `cars` WHERE `status` >= '1' "));
echo $count_s;
			
			 ?>
        	<!--<a href="<?php echo BASEHREF ?>cms/content/" class="cms-side-bar-item <?php if($menu == "content") echo 'cms-side-bar-sel'; ?>"><span class="cms-side-bar-pointer"></span>News</a></span></a>-->
        	<a href="<?php echo BASEHREF ?>cms/gallery/" class="cms-side-bar-item <?php if($menu == "gallery") echo 'cms-side-bar-sel'; ?>"><span class="cms-side-bar-pointer"></span>Gallery</a></span></a>
        	
        </div>
    
    	
    
    <div class="cms-main-overlay">
    			<img class="wall-popup-loader" src="<?php echo BASEHREF; ?>cms/img/normloader.gif" draggable="false" />
                <div class="cms-main-popup">
                </div>
        
	</div>
	
</div>
    <script>
	function popupShow(){
	
	//Show overlay	
	$(".cms-main-popup").html("").hide();
	$(".cms-main-overlay").show("fade",100);
	$(".cms-main-loader").show("fade",100);
	
		$(".wall-popup-loader").unbind("click").click(function(event){
			
			popupClose();
			
			if(popuploader != null){
				popuploader.abort();	
			}
			
			event.preventDefault();
		});
	
	}
	function popupClose(){
	
	//Show overlay	
	$(".cms-main-loader").hide("fade",100);
	$(".cms-main-overlay").hide("fade",100,function(){
		
		$(".cms-main-popup").html("").hide();
		
	});
	
	}
	
	
	function popupStopLoading(){
		
		//Show overlay	
		$(".cms-main-loader").hide("fade",100);
		$(".cms-main-overlay").show("fade",100);
		
	}


function openPopup(view, callback){
	
	popupShow();
	
	//Load shit
	popuploader = $.ajax({
					url: "<?php echo BASEHREF; ?>cms/popup/"+view,
					type: "POST",
					error: function(resp){
						
						//Error
						popupClose();
						
						
					},
					success: function(resp){
						
						popupStopLoading();
						
						
						//Do stuff
						$(".cms-main-popup").html(resp).show();
						
						//Standard close
						$(".popup-block-close").unbind("click").click(function(event){
							
							popupClose();
							
							event.preventDefault();
						});
						
					}
				});



      if (typeof callback == "function") callback(); 
}
	
</script>



    <div class="cms-mid-content">
		

