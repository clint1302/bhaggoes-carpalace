<?php
include('core/sql/conf.php');
///*

//Check if logout
if(isset($_GET['logout']) && $_GET['logout'] != ""){


//Set cookie
setcookie("cmsadmin", "", time()-3600, "/");
	
}

//Double check signed in
if(isset($_COOKIE['cmsadmin'])){
	
//Check if user is admin
$cadmin = mysqli_num_rows($con->query("SELECT * FROM `users` WHERE `user_id` = '".mysqli_real_escape_string($con, $_COOKIE['cmsadmin'])."'"));

if($cadmin > 0){
header("location: ".BASEHREF."cms/");
exit();	
}
	
}


//Check if login
if(isset($_POST['login'])){
$email = mysqli_real_escape_string($con, $_POST['email']);
$passw = mysqli_real_escape_string($con, $_POST['passw']);

//Check user
$clogin = mysqli_num_rows($glogin = $con->query("SELECT * FROM `users` WHERE `username` = '".$email."' AND `password` = '".$passw."'"));


if($clogin > 0){
$flogin = mysqli_fetch_assoc($glogin);

$cadmin = mysqli_num_rows($con->query("SELECT * FROM `users` WHERE `user_id` = '".$flogin['user_id']."'"));

if($cadmin > 0){
//Set cookie
setcookie("cmsadmin", $flogin['user_id'], time()+3600, "/");

header("location: ".BASEHREF."cms/dash/");	
exit();

}else{
header("location: ".BASEHREF."cms/login/?error=No%20Admin%20Permissions");	
exit();
}
	
}else{
header("location: ".BASEHREF."cms/login/?error=Login%20Failed");	
exit();
}
	
}
//*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="<?php echo BASEHREF ?>cms/scr/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASEHREF ?>cms/scr/jquery.extra.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASEHREF ?>cms/css/login.css"/>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Bhaggoes CMS - Login</title>
</head>

<body style="background-color: rgb(0, 150, 136);">

<div class="login-window-block <?php if(isset($_GET['error']) && $_GET['error'] != ""){ ?>login-window-err<?php } ?>">
	<span class="login-window-header"><img src="<?php echo BASEHREF ?>cms/img/bhaggoeslogo.png" draggable="false" class="cms-header-logo" /></span>
   <div class="login-window-section">
   		<form action="" method="POST">
        <span class="login-window-item"><input type="text" name="email" placeholder="Email" /></span>
        <span class="login-window-item"><input type="password" name="passw" placeholder="Password" /></span>
        
        <span class="login-window-options"><input type="submit" name="login" value="Login" /></span>
        </form>
    </div>
    <span class="login-window-error"><?php if(isset($_GET['error']) && $_GET['error'] != "") { echo $_GET['error']; } ?></span>
    <script>
	    history.pushState({}, '', "?error");
	</script>
</div>
    
</body>
</html>