<?php
//Database vars
$sql_host = "localhost";
$sql_user = "root";
$sql_pass = "";
$sql_db = "bhaggoes_db";

//Database connection
$con = mysqli_connect($sql_host, $sql_user, $sql_pass) or die("Can't connect to sql server.");
$sql_select_db = mysqli_select_db($con, $sql_db) or die("Can't select database.");
$con->query("SET NAMES utf8");


//$now = time();
//date_default_timezone_set("America/Paramaribo");

date_default_timezone_set('America/Paramaribo');
$now = date('Y/m/d', time());

//Default functions
//$settings = mysqli_fetch_assoc($con->query("SELECT * FROM `settings` ORDER BY `setting_id` ASC LIMIT 1"));

//define("BASE","http://localhost/bhaggoes/");
define("BASEHREF","http://localhost/bhaggoes/");

?>