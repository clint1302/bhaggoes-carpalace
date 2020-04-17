<?php
require("../../core/sessie.php");
require("../../core/functies.php");

require("../scr/phpexcel/PHPExcel.php");

if(isset($_POST['date']) && $_POST['date'] != ""){
	
$date = mysqli_real_escape_string($con, $_POST['date']);	

//Output
$file = "../exports/leden/export_leden_".time().".xls";

//Clean
$timestamp = strtotime($date);
$aanm = date("Y-m-d",$timestamp);

$getleden = $con->query("SElECT `voornaam`,`achternaam`,`emailadres` FROM `leden` WHERE `aanmelding` > '".$aanm."'");


$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

$row = 0;
while($fetchlid = mysqli_fetch_array($getleden)){
	
	if($row > 0){
	$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;
	}else{
	$row++;	
	}
	
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $fetchlid['voornaam']);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $fetchlid['achternaam']);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $fetchlid['emailadres']);

	
}

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($file);  

die($file);	
	
}else{
die("No date sent");	
}

?>