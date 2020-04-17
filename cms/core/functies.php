<?php 
setlocale (LC_ALL, 'nl_NL');
setlocale(LC_TIME,"Dutch");

define('ALGEMEEN_FOUT_SQL', "Er is iets fout gegaan met het versturen naar of ophalen uit de database");
define('PAGINA404', '404 ERROR');
define('ERROR_NOPAGE', 'De pagina die u probeerde op te vragen is niet (meer) aanwezig.');

$curUrl = explode("/",$_SERVER['REQUEST_URI']);
$curUrlEnd = str_replace('.html','',end($curUrl));
$curUrlLang = $curUrl[$urlID]; // $urlID in local
if(isset($curUrl[$urlID+1])){
	$curUrl = $curUrl[$urlID+1]; // $urlID in local
}
else{
	$curUrl = $curUrl[$urlID];
}
$curUrl = str_replace('.html','',$curUrl);

$formposturl = "http://" . $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];

if(isset($_GET['incl'])) {
	if(strpos($_GET['incl'],'?')) {
		list($vpage,$vars) = explode("?",$_GET['incl']);
		$vars = explode("|",$vars);
		foreach($vars as $var){
			$var = explode("=",$var);
			$$var[0] = $var[1];
		}
	} 
	else{
		$vpage = $_GET['incl'];
	} 
}
else{
	$vpage = 'home.pagina.php';
}


$con = new mysqli(DB_CMS_HOST, DB_CMS_USER, DB_CMS_PASS, DB_CMS_NAME);
$con->query('SET NAMES utf8');
if (!$con or mysqli_connect_errno() != 0) { 
	echo ALGEMEEN_FOUT_SQL;
}

function getPage($id){
	global $con;
	$array = array();
	$wpqry = $con->prepare("SELECT titel$_SESSION[lndb],tekst$_SESSION[lndb],header FROM webpaginas WHERE webpagina_id = ? ORDER BY datumtijd DESC LIMIT 1;");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->bind_result($titel,$tekst,$header);
		$wpqry->execute();
		$wpqry->store_result();
		$wpqry->fetch();
		if($wpqry->num_rows == 1){
			$array['titel'] = stripslashes($titel);
			$array['tekst'] = stripslashes($tekst);		
			if(isset($header) && $header != '' && file_exists('upload/webpaginas/'.$header)){	
				$array['header'] = BASEHREF.'upload/webpaginas/'.stripslashes($header);
			}
		}
	}
	$wpqry->close();
	return $array;
}


list($ch_leden_totaal,$ch_leden_dezemaand,$ch_leden_connecties,$ch_discussies,$ch_actieve_polls) = mysqli_fetch_array($con->query("SELECT leden_totaal, leden_dezemaand,leden_connecties,discussies,actieve_polls FROM caching ORDER BY cache_id DESC LIMIT 1"));


function createAssoc($var){
	if ($var === false){
		echo ALGEMEEN_FOUT_SQL;
	}
	else{
		$arr = array();
		while($v = $var->fetch_assoc()){
			$arr[] = $v;
		}
		return $arr;
	}
}


function prettyUrl($url,$html=true){
	$replaceArray = array(",",".","'","\"","!","?","%");
	$url = strip_tags($url);
	$url = str_replace(" ","-",stripslashes($url));
	$url = str_replace($replaceArray,"",stripslashes($url));
	$url = str_replace("/","-",stripslashes($url));
	if($html == true){
		$url = $url.".html";
	}
	$url = strtolower($url);
	return $url;
}


// strip symbolen en vreemde tekens
function clearUTF($s)
{
    $r = '';
    $s1 = @iconv('UTF-8', 'ASCII//TRANSLIT', $s);
    $j = 0;
    for ($i = 0; $i < strlen($s1); $i++) {
        $ch1 = $s1[$i];
        $ch2 = @mb_substr($s, $j++, 1, 'UTF-8');
        if (strstr('`^~\'"', $ch1) !== false) {
            if ($ch1 <> $ch2) {
                --$j;
                continue;
            }
        }
        $r .= ($ch1=='?') ? $ch2 : $ch1;
    }
    return $r;
}


// maak url's klikbaar (forum)
function maakklikbaar($url) 
{
	$url = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1:", $url); 
	$nurl = ' ' . $url; 
	$nurl = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\"  class='ahref'>\\2</a>", $nurl); 
	$nurl = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\" class='ahref'>\\2</a>", $nurl); 
	$nurl = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\"  class='ahref'>\\2@\\3</a>", $nurl);  
	$nurl = substr($nurl, 1); 
	return $nurl; 
}


// rss feed strippen van foute gegevens
function XMLEntities($string) 
{ 
	$string = preg_replace('/[^\x09\x0A\x0D\x20-\x7F]/e', '_privateXMLEntities("$0")', $string); 
	return $string; 
}

function _privateXMLEntities($num) 
{ 
	$chars = array( 128 => '&#8364;', 
	130 => '&#8218;', 
	131 => '&#402;', 
	132 => '&#8222;', 
	133 => '&#8230;', 
	134 => '&#8224;', 
	135 => '&#8225;', 
	136 => '&#710;', 
	137 => '&#8240;', 
	138 => '&#352;', 
	139 => '&#8249;', 
	140 => '&#338;', 
	142 => '&#381;', 
	145 => '&#8216;', 
	146 => '&#8217;', 
	147 => '&#8220;', 
	148 => '&#8221;', 
	149 => '&#8226;', 
	150 => '&#8211;', 
	151 => '&#8212;', 
	152 => '&#732;', 
	153 => '&#8482;', 
	154 => '&#353;', 
	155 => '&#8250;', 
	156 => '&#339;', 
	158 => '&#382;', 
	159 => '&#376;'); 
	$num = ord($num); 
	return (($num > 127 && $num < 160) ? $chars[$num] : "&#".$num.";" ); 
} 


function tags_normalize_string($string)
{
    $string = preg_replace( array("/�/","/�/","/�/","/�/","/�/","/�/","/�/"),array("oe","ue","ae","oe","ue","ae","ss"), $string);
    return utf8_encode($string);
}

function mooi_geld($geld, $teken = true, $geheel = false) {
	if($geheel) {
		$geld = ceil($geld);
	}
	$geld = number_format($geld, 2, ",", "");
	$geld = str_replace(",00",",-",$geld);
	if($teken) {
		return "&euro; $geld";
	} else {
		return $geld;
	}
}

function getYouTubeImg($url){
	return "http://img.youtube.com/vi/$url/2.jpg";
}

//Datum functies
function dateRewrite($var){
	if($var == ''){
		$var = '0000-00-00';
	}
	list($d1,$d2,$d3) = explode('-',$var);
	$var = $d3.'-'.$d2.'-'.$d1;
	return $var;
}

function dateRewrite2($var){
	if($var == ''){
		$var = '0000-00-00';
	}
	list($d1,$d2,$d3) = explode('/',$var);
	$var = $d3.'-'.$d1.'-'.$d2;
	return $var;
}

function dateRewrite3($var){
	if($var == ''){
		$var = '0000-00-00';
	}
	list($d1,$d2,$d3) = explode('-',$var);
	$var = $d2.'/'.$d3.'/'.$d1;
	return $var;
}

function dates_between($startdate,$enddate){
	$format = "Y-m-d";
	(is_int($startdate)) ? 1 : $startdate = strtotime($startdate);
	(is_int($enddate)) ? 1 : $enddate = strtotime($enddate);
	
	if($startdate > $enddate){
		return false;
	}

	while($startdate < $enddate){
		$arr[] = ($format) ? date($format, $startdate) : $startdate;
		$startdate += 86400;
	}
	$arr[] = ($format) ? date($format, $enddate) : $enddate;

	$arr = array_unique($arr);
	return $arr;
}

function dateToLang($datum){
	$tijd = '';
	if(strstr($datum,' ')){
		list($datum,$tijd) = explode(' ',$datum);
	}

	if($datum != '' && $datum != '0000-00-00'){
	
		list($y,$m,$d) = explode('-',$datum);
		$m = ltrim($m,'0');
		
		if($_SESSION['ln'] == 'nl'){
			$datum = date('j n Y',mktime(1,1,1,$m,$d,$y));
			$maandarray = array('januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december');
		} elseif($_SESSION['ln'] == 'en'){
			$datum = date('jS n Y',mktime(1,1,1,$m,$d,$y));	
			$maandarray =  array ("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		}	
		$datum = str_replace(' '. $m .' ',' '.$maandarray[$m-1].' ',$datum);
		if($tijd != ''){
			$datum = $datum .' '.$tijd;
		}	
		
		return $datum;
	}
}

function maxLength($string,$size){
	if(strlen($string) > $size){
		$string = substr(strip_tags($string),0,$size).'..';
	}	
	return stripslashes($string);	
}

function nlDate($datum){
	list($y,$m,$d) = explode('-',$datum);
	switch($m){
		case '01': $m = 'januari'; break;
		case '02': $m = 'februari'; break;
		case '03': $m = 'maart'; break;
		case '04': $m = 'april'; break;
		case '05': $m = 'mei'; break;
		case '06': $m = 'juni'; break;
		case '07': $m = 'juli'; break;
		case '08': $m = 'augustus'; break;
		case '09': $m = 'september'; break;
		case '10': $m = 'oktober'; break;
		case '11': $m = 'november'; break;
		case '12': $m = 'december'; break;
	}
	return $d.' '.$m.' '.$y;
}
//Eind datum functies


function maand($m){
	switch($m){
		case '1': $m = 'januari'; break;
		case '2': $m = 'februari'; break;
		case '3': $m = 'maart'; break;
		case '4': $m = 'april'; break;
		case '5': $m = 'mei'; break;
		case '6': $m = 'juni'; break;
		case '7': $m = 'juli'; break;
		case '8': $m = 'augustus'; break;
		case '9': $m = 'september'; break;
		case '10': $m = 'oktober'; break;
		case '11': $m = 'november'; break;
		case '12': $m = 'december'; break;
	}
	return $m;
}

function getWebTekst($id){
	global $con;
	$array = array();
	$wpqry = $con->prepare("SELECT webtitel,webtekst FROM webteksten WHERE webtekst_id = ? LIMIT 1;");
	if ($wpqry === false) {
		echo "". ALGEMEEN_FOUT_SQL ."";
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->execute();
		$wpqry->bind_result($webtitel,$webtekst);
		if ($wpqry->execute()) {
			$wpqry->fetch();
			$array['webtitel'] = stripslashes($webtitel);
			$array['webtekst'] = stripslashes($webtekst);
		}
	}
	$wpqry->close();
	return $array;
}

function createPages($max,$cur,$doel,$end=false){
	$pagenumbers = '';
	$backPage = $cur - 1;
	$pagenumbers .= "<div class='derde' style='text-align:left;'> &nbsp;";
	if($cur > 1){
		$pagenumbers .= "<a href=\"".BASEHREF.$doel."/pagina/$backPage"."$end\">".VORIGE_PAG."</a>";
	}
	$pagenumbers .= "&nbsp;</div>";
	if(isset($max) && $max != 0){
		if ($cur== $max){ 
			$to = $max; 
		} 
		elseif ($cur== $max-1){ 
			$to = $cur+1; 
		} 
		elseif ($cur== $max-2){ 
			$to = $cur+2; 
		} 
		else{ 
			$to = $cur+3; 
		} 
		if ($cur== 1 || $cur== 2 || $cur== 3){ 
			$from = 1; 
		} 
		else{ 
			$from = $cur-3; 
		}
		$pagenumbers .= "<div class='derde' style='text-align:center;'>&nbsp;&nbsp;"; 
		for ($np = $from; $np <= $to; $np++) { 
		$numb = $np;
			if ($np != $cur){ 
				$pagenumbers .= "<a href=\"".BASEHREF.$doel."/pagina/$np"."$end\">$numb.</a>&nbsp;"; 
			} 
			else{ 
			
				$pagenumbers .= "<span>$numb.</span>&nbsp;"; 
			} 
		}  
		$pagenumbers .= "</div>";  
		$nextPage = $cur+1;
		
		$pagenumbers .= "<div class='derde' style='text-align:right;'>";
		if($nextPage <= $max){
			$pagenumbers .= "<a href=\"".BASEHREF.$doel."/pagina/$nextPage"."$end\">".VOLGENDE_PAG."</a>";
		}
		$pagenumbers .= "</div>";
			
	}
	return $pagenumbers;
}

function blok($titel,$content,$class){
	?>
    <div class="blokshaduw">
        <div class="blok <?php echo $class ?>">
            <div class="bloktop"><h2><?php echo $titel ?></h2></div>
            <div class="blokcontent"><?php echo $content ?></div>
        </div>
    </div>
    <?php	
}

function doLogin($usr,$pw){
	global $con;
	$liqry = $con->prepare("SELECT emailadres,profielnaam,foto FROM leden WHERE leden_id = ? AND password = ? AND actief = '1' AND geblokkeerd = '0' LIMIT 1");
	if ($liqry === false) {
		echo "". ALGEMEEN_FOUT_SQL ."";
	} 
	else{
		$liqry->bind_param('ss',$usr,$pw);
		$liqry->bind_result($emailadres,$profielnaam,$foto);
		if ($liqry->execute()) {
			$liqry->fetch();
			if($emailadres!= '' && $profielnaam != ''){
				$_SESSION['nieuwlid_id'] = $usr;
				$_SESSION['user']['id'] = $usr;
				$_SESSION['user']['email'] = $emailadres;
				$_SESSION['user']['naam'] = ucfirst(stripslashes($profielnaam));
				$_SESSION['user']['foto'] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
			}
		}
	}
	$liqry->close();
}


function dropdownTabel($tabel,$id,$value,$name,$class,$emptyval=false,$sel=false,$where=false,$verplicht=false,$lang=false){
	global $con;
	$ret = '';
	if($verplicht) $verplicht = "alt='verplicht'"; else $verplicht = '';
	if($lang) $lang = "lang='".$lang."'"; else $lang = '';
	$ret .= "<select name='".$name."'  id='".$name."' class='".$class."'".$verplicht." ".$lang.">";
		if($emptyval != ''){
			$ret .= "<option value=''>".$emptyval."</option>";
		}
		
		$order = $value;
		if($tabel == 'landen'){
			$order = " top DESC,land ";
		}
		if($tabel == 'talen'){
			$order = " top DESC,taal ";
		}
		
        $qry = $con->query("SELECT $id AS id,$value AS value FROM $tabel $where ORDER BY $order ASC");
		while($r = $qry->fetch_assoc()){
			$ret .= "<option value='".$r['id']."' "; if($sel == $r['id']){ $ret.= 'selected'; } $ret.= ">".stripslashes($r['value'])."</option>";
		}
    $ret .= "</select>";
	return $ret;
}

function getOccupationData($tabel,$id,$value,$lang=false,$dataid,$textfiledid,$branchid=false,$hiddenid){
	global $con;
	$ret = '';
	if($lang) $lang = "lang='".$lang."'"; else $lang = '';
	$order = $value;
	$where ='';
	if($tabel == 'landen'){
		$order = " top DESC,land ";
	}else if($tabel == 'branches'){
		$where = " where branche_gid=$branchid";
	}
	
	$qry = $con->query("SELECT $id AS id,$value AS value FROM $tabel $where ORDER BY $order ASC");
	$ret.="<ul>";                     
	while($r = $qry->fetch_assoc()){
		$ret.="<li><a href='javascript:void(0);' onclick='showdata(\"$dataid\",\"$textfiledid\",\"$r[id]\",\"$r[value]\",\"$hiddenid\");'>&nbsp;<img src='images/bullet.png' width='11' height='11' />&nbsp;".stripslashes($r['value'])."</li>";
	}
	$ret .= "</ul>";
	return $ret;
}

function getOccupationData1($tabel,$id,$value,$lang=false,$dataid,$textfiledid,$branchid=false,$hiddenid,$flag=0, $flagtype=0){
	global $con;
	$ret = '';
	if($lang) $lang = "lang='".$lang."'"; else $lang = '';
	$order = $value;
	$where ='';
	if($tabel == 'landen'){
		$order = " top DESC,land ";
	}else if($tabel == 'branches'){
		$where = " where branche_gid=$branchid";
	}else if($tabel == 'studies_studierichting_detail'){
		$where = " where studierichting_id=$branchid";
	}
	
	$qry = $con->query("SELECT $id AS id,$value AS value FROM $tabel $where ORDER BY $order ASC");
	if($flag==1){
		$ret.="<select name=".$id." id=".$id." onchange='showhelp(this.value,".$flagtype.")'>";
	}else{
		$ret.="<select name=".$id." id=".$id.">";	
	}
	
	while($r = $qry->fetch_assoc()){
		$ret.="<option value=".$r['id'].">".stripslashes($r['value'])."</option>";
	}
	if($flag==1){
		$ret.="<option value='777'>Other</option>";
	}
	$ret .= "</select>";
	return $ret;
}

function getOccupationDataFilter($tabel,$id,$value,$lang=false,$dataid,$textfiledid,$branchid=false,$hiddenid,$flag=0, $flagtype=0){
	global $con;
	$ret = '';
	if($lang) $lang = "lang='".$lang."'"; else $lang = '';
	$order = $value;
	$where ='';
	if($tabel == 'landen'){
		$order = " top DESC,land ";
	}else if($tabel == 'branches'){
		$where = " where branche_gid=$branchid";
	}else if($tabel == 'studies_studierichting_detail'){
		$where = " where studierichting_id=$branchid";
	}
	
	$qry = $con->query("SELECT $id AS id,$value AS value FROM $tabel $where ORDER BY $order ASC");
	
	while($r = $qry->fetch_assoc()){
		$ret.="<option value=".$r['id'].">".stripslashes($r['value'])."</option>";
	}
	if($flag==1){
		$ret.="<option value='777'>Other</option>";
	}
	return $ret;
}


function getWerkzaam($id,$allestonen=false){
	global $con;
	$return = '';
	list($type_profiel) = mysqli_fetch_array($con->query("SELECT type_profiel FROM leden WHERE leden_id = '$id' LIMIT 1"));
	
	//Set placeholders
	$infod = '';
	$infow = '';
	
	if($type_profiel != 'Student'){
		$wpqry = $con->prepare("SELECT branche_id,bedrijf,functie FROM leden_profiel_fow WHERE leden_id = ? AND (vandatum <= CURDATE()) ORDER BY vandatum DESC LIMIT 1;");
		if ($wpqry === false) {
			echo  ALGEMEEN_FOUT_SQL;
		} 
		else{
			$wpqry->bind_param('i',$id);
			$wpqry->bind_result($branche_id,$bedrijf,$functie);
			$wpqry->execute();
			$wpqry->store_result();
			$wpqry->fetch();
				$bedrijf = stripslashes($bedrijf);
				$functie = stripslashes($functie);
				if(strlen($functie) > 20 && $allestonen == false){
					$functie = substr($functie,0,20).'..';
				}
				if(strlen($bedrijf) > 20 && $allestonen == false){
					$bedrijf = substr($bedrijf,0,20).'..';
				}
				//Set details
				$infod = $functie;
				$infow = $bedrijf;
				
				//Branche
				if($infow == ""){
				//Fetch branche
				$f_branche = mysqli_fetch_assoc($con->query("SELECT `branche` FROM `branches` WHERE `branche_id` = '".$branche_id."'"));
				$infow = $f_branche['branche'];
				}
				
		}
		$wpqry->close();
	}
	else{
		$wpqry = $con->prepare("SELECT studie_id,school,studienaam,website FROM leden_profiel_student WHERE leden_id = ? AND (vandatum <= CURDATE())  ORDER BY vandatum DESC  LIMIT 1;");
		if ($wpqry === false) {
			echo  ALGEMEEN_FOUT_SQL;
		} 
		else{
			$wpqry->bind_param('i',$id);
			$wpqry->bind_result($studie_id,$school,$studienaam,$website);
			$wpqry->execute();
			$wpqry->store_result();
			$wpqry->fetch();
				$school = stripslashes($school);
				$studienaam = stripslashes($studienaam);	
				if(strlen($school) > 20){
					$school = substr($school,0,20).'..';
				}
				$studienaam = 'Student '.$studienaam;
				if(strlen($studienaam) > 20){
					$studienaam = substr($studienaam,0,20).'..';
				}
				
				//Set details
				$infod = $studienaam;
				$infow = $school;
				
				
				//Studie
				if($infow == ""){
				//Fetch studie
				$f_studie = mysqli_fetch_assoc($con->query("SELECT `richtingdetail` FROM `studies_studierichting_detail` WHERE `studierichting_id` = '".$studie_id."'"));
				$infow = $f_studie['richtingdetail'];
				}
				
			
		}
		$wpqry->close();
	}	
	
	//Check emptyness
	if($infod == ""){
	$infod = $type_profiel." in";	
	}
	
	//Set info
	$return = $infod."<br/>".$infow;
	
	return $return;
}

function getBanners(){
	global $con;
	$array = array();
	$wpqry = $con->prepare("SELECT banner_id,link,afbeelding FROM banners WHERE actief = '1' ORDER BY RAND() LIMIT 2;");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_result($banner_id,$link,$afbeelding);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			$array['link'][$banner_id] = stripslashes($link);
			$array['afbeelding'][$banner_id] = BASEHREF.'upload/banners/'.stripslashes($afbeelding);
		}
	}
	$wpqry->close();
	return $array;
}

function getPages($cat){
	global $con;
	$array = array();
	$wpqry = $con->prepare("SELECT webpagina_id,titel$_SESSION[lndb],tekst$_SESSION[lndb] FROM webpaginas WHERE categorie = ? ORDER BY volgnr ASC;");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('s',$cat);
		$wpqry->bind_result($wpid,$titel,$tekst);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			$array['titel'][$wpid] = stripslashes($titel);
			$array['tekst'][$wpid] = stripslashes($tekst);
			$array['url'][$wpid] = BASEHREFLN.$cat.'/'.$wpid.'/'.prettyUrl($titel);
		}
	}
	$wpqry->close();
	return $array;
}

/*function networkShort($id,$short=false){
	global $con;
	$array = array();
	$wpqry = $con->prepare("SELECT a.voornaam,a.achternaam,a.stad,b.land,a.link1,a.profielnaam,a.foto,a.type_profiel FROM leden AS a LEFT JOIN landen AS b ON a.land_id = b.land_id WHERE a.leden_id = ? LIMIT 1;");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->bind_result($voornaam,$achternaam,$stad,$land,$link1,$profielnaam,$foto,$type_profiel);
		$wpqry->execute();
		$wpqry->store_result();
		$wpqry->fetch();
		$array['stad'] = stripslashes($stad);
		$array['land'] = stripslashes($land);
		$array['link1'] = stripslashes($link1);
		if(strlen($profielnaam) > 27){
			$profielnaam = substr($profielnaam,0,25).'..';
		}
		$array['profielnaam'] = stripslashes($profielnaam);
		$array['url'] = BASEHREFLN.'network/'.$id.'/'.prettyUrl($profielnaam);
		$array['foto'] = BASEHREF.'upload/leden/profiel/midden/'.stripslashes($foto);
		$array['fotoklein'] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
		$array['type_profiel'] = stripslashes($type_profiel);
		
		
	}
	$wpqry->close();
	
	if($short == false){
		if($type_profiel != 'Student'){ 
			$array['sw'] = 'werk';
			$wpqry = $con->prepare("SELECT bedrijf,functie,website FROM leden_profiel_fow WHERE leden_id = ? AND (vandatum <= CURDATE())  ORDER BY vandatum DESC  LIMIT 1;");
			if ($wpqry === false) {
				echo  ALGEMEEN_FOUT_SQL;
			} 
			else{
				$wpqry->bind_param('i',$id);
				$wpqry->bind_result($bedrijf,$functie,$website);
				$wpqry->execute();
				$wpqry->store_result();
				$wpqry->fetch();
				$array['bedrijf'] = stripslashes($bedrijf);
				$array['functie'] = stripslashes($functie);
				
				if(!strstr($website,'http://')){
					$website = 'http://'.$website;
				}
				$array['website'] = stripslashes($website);
			}
			$wpqry->close();
		} else {
			$array['sw'] = 'studie';
			$wpqry = $con->prepare("SELECT school,studienaam,website FROM leden_profiel_student WHERE leden_id = ? AND (vandatum <= CURDATE()) ORDER BY vandatum DESC  LIMIT 1;");
			if ($wpqry === false) {
				echo  ALGEMEEN_FOUT_SQL;
			} 
			else{
				$wpqry->bind_param('i',$id);
				$wpqry->bind_result($school,$studienaam,$website);
				$wpqry->execute();
				$wpqry->store_result();
				$wpqry->fetch();
				$array['school'] = stripslashes($school);
				$array['studienaam'] = stripslashes($studienaam);
				if(!strstr($website,'http://')){
					$website = 'http://'.$website;
				}
				$array['website'] = stripslashes($website);
			}
			$wpqry->close();
		}	
	
		
		BACKUP CODE, NIET VERWIJDEREN - C
		//WERKZAAM OP DIT MOMENT?
		$array['sw'] = 'werk';
		$wpqry = $con->prepare("SELECT bedrijf,functie,website FROM leden_profiel_fow WHERE leden_id = ? AND (vandatum <= CURDATE() AND (totdatum >= CURDATE() OR totdatum = '0000-00-00')) LIMIT 1;");
		if ($wpqry === false) {
			echo  ALGEMEEN_FOUT_SQL;
		} 
		else{
			$wpqry->bind_param('i',$id);
			$wpqry->bind_result($bedrijf,$functie,$website);
			$wpqry->execute();
			$wpqry->store_result();
			$wpqry->fetch();
			if($wpqry->num_rows > 0){
				$array['bedrijf'] = stripslashes($bedrijf);
				$array['functie'] = stripslashes($functie);
				
				if(!strstr($website,'http://')){
					$website = 'http://'.$website;
				}
				$array['website'] = stripslashes($website);
				
				
			}	
			else{
				$array['sw'] = 'studie';
			}
		}
		$wpqry->close();
		
		//STUDIE OP DIT MOMENT?
		if($array['sw'] == 'studie'){
			$wpqry = $con->prepare("SELECT school,studienaam,website FROM leden_profiel_student WHERE leden_id = ? AND (vandatum <= CURDATE() AND (totdatum >= CURDATE() OR totdatum = '0000-00-00')) LIMIT 1;");
			if ($wpqry === false) {
				echo  ALGEMEEN_FOUT_SQL;
			} 
			else{
				$wpqry->bind_param('i',$id);
				$wpqry->bind_result($school,$studienaam,$website);
				$wpqry->execute();
				$wpqry->store_result();
				$wpqry->fetch();
				if($wpqry->num_rows > 0){
					$array['school'] = stripslashes($school);
					$array['studienaam'] = stripslashes($studienaam);
					if(!strstr($website,'http://')){
						$website = 'http://'.$website;
					}
					$array['website'] = stripslashes($website);
				}	
				else{
					$array['sw'] = 'geen';
				}
			}
			$wpqry->close();
		}	
		
		
		
		
		//LAATSTE VRIENDEN OPHALEN
		list($array['aantalvrienden']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM vrienden WHERE leden_id = '$id'"));
		$wpqry = $con->prepare("SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = ? GROUP BY vriend_id ORDER BY RAND() LIMIT 4;");
		if ($wpqry === false) {
			echo  ALGEMEEN_FOUT_SQL;
		} 
		else{
			$wpqry->bind_param('i',$id);
			$wpqry->bind_result($leden_id,$foto,$profielnaam);
			$wpqry->execute();
			$wpqry->store_result();
			while($wpqry->fetch()){
				if(strlen($profielnaam) > 27){
					$profielnaam = substr($profielnaam,0,25).'..';
				}
				$array['vriendnaam'][$leden_id] = stripslashes($profielnaam);
				$array['vriendfoto'][$leden_id] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
				$array['vriendurl'][$leden_id] = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($profielnaam);
				$array['vriendwerkzaam'][$leden_id] = getWerkzaam($leden_id);
			}
		}
		$wpqry->close();
		
		//ONGELEZEN IN INBOX
		list($array['aantalinbox']) = mysqli_fetch_array($con->query("SELECT COUNT(a.bericht_id) FROM berichten AS a, berichten_ontvangers AS b WHERE a.bericht_id = b.bericht_id AND b.ontvanger_id = '$id' AND geopend = '0' AND verwijderd = '0'"));
		list($array['aantalvriendverzoeken']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM vrienden_verzoek WHERE leden_id = '$id' AND status = 'open'"));
		list($array['laatstestatus'],$array['statusdatumtijd'],$array['laatstestatus_medium']) = mysqli_fetch_array($con->query("SELECT status,datumtijd,medium FROM leden_status WHERE leden_id = '$id' AND reply_id = '0' and geplaatst_bij = '$id' ORDER BY datumtijd DESC LIMIT 1"));
		$array['laatstestatus_sinds'] = timeSince(strtotime($array['statusdatumtijd']));
		
		$array['laatstestatus'] = maakklikbaar(wordwrap(strip_tags(stripslashes($array['laatstestatus'])),40,' ',true));
		list($array['aantalman']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM leden WHERE geblokkeerd = '0' AND 	actief = '1' AND geslacht = 'man'"));
		list($array['aantalvrouw']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM leden WHERE geblokkeerd = '0' AND 	actief = '1' AND geslacht = 'vrouw'"));
		$array['aantalmanvrouw'] = $array['aantalman'] + $array['aantalvrouw'];
	}
	return $array;
}
*/

function networkShort($id,$short=false){
	global $con;
	$array = array();
	$wpqry = $con->prepare("SELECT a.voornaam,a.achternaam,a.stad,b.land,a.prov_id,a.link1,a.profielnaam,a.foto,a.type_profiel FROM leden AS a LEFT JOIN landen AS b ON a.land_id = b.land_id WHERE a.leden_id = ? LIMIT 1;");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->bind_result($voornaam,$achternaam,$stad,$land,$prov,$link1,$profielnaam,$foto,$type_profiel);
		$wpqry->execute();
		$wpqry->store_result();
		$wpqry->fetch();
		$array['stad'] = stripslashes($stad);
		$array['land'] = stripslashes($land);
		$array['prov_id'] = stripslashes($prov);
		$array['link1'] = stripslashes($link1);
		if(strlen($profielnaam) > 27){
			$profielnaam = substr($profielnaam,0,25).'..';
		}
		$array['profielnaam'] = stripslashes($profielnaam);
		$array['url'] = BASEHREFLN.'network/'.$id.'/'.prettyUrl($profielnaam);
		$array['foto'] = BASEHREF.'upload/leden/profiel/midden/'.stripslashes($foto);
		$array['fotoklein'] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
		$array['type_profiel'] = stripslashes($type_profiel);
		
		
	}
	$wpqry->close();
	
	if($short == false){
		if($type_profiel != 'Student'){ 
			$array['sw'] = 'werk';
			$wpqry = $con->prepare("SELECT bedrijf,functie,website FROM leden_profiel_fow WHERE leden_id = ? ORDER BY vandatum DESC  LIMIT 1;");
			if ($wpqry === false) {
				echo  ALGEMEEN_FOUT_SQL;
			} 
			else{
				$wpqry->bind_param('i',$id);
				$wpqry->bind_result($bedrijf,$functie,$website);
				$wpqry->execute();
				$wpqry->store_result();
				$wpqry->fetch();
				$array['bedrijf'] = stripslashes($bedrijf);
				$array['functie'] = stripslashes($functie);
				
				if(!strstr($website,'http://')){
					$website = 'http://'.$website;
				}
				$array['website'] = stripslashes($website);
			}
			$wpqry->close();
		} else {
			$array['sw'] = 'studie';
			$wpqry = $con->prepare("SELECT school,studienaam,website FROM leden_profiel_student WHERE leden_id = ? ORDER BY vandatum DESC  LIMIT 1;");
			if ($wpqry === false) {
				echo  ALGEMEEN_FOUT_SQL;
			} 
			else{
				$wpqry->bind_param('i',$id);
				$wpqry->bind_result($school,$studienaam,$website);
				$wpqry->execute();
				$wpqry->store_result();
				$wpqry->fetch();
				$array['school'] = stripslashes($school);
				$array['studienaam'] = stripslashes($studienaam);
				if(!strstr($website,'http://')){
					$website = 'http://'.$website;
				}
				$array['website'] = stripslashes($website);
			}
			$wpqry->close();
		}	
	
		/*
		BACKUP CODE, NIET VERWIJDEREN - C
		//WERKZAAM OP DIT MOMENT?
		$array['sw'] = 'werk';
		$wpqry = $con->prepare("SELECT bedrijf,functie,website FROM leden_profiel_fow WHERE leden_id = ? AND (vandatum <= CURDATE() AND (totdatum >= CURDATE() OR totdatum = '0000-00-00')) LIMIT 1;");
		if ($wpqry === false) {
			echo  ALGEMEEN_FOUT_SQL;
		} 
		else{
			$wpqry->bind_param('i',$id);
			$wpqry->bind_result($bedrijf,$functie,$website);
			$wpqry->execute();
			$wpqry->store_result();
			$wpqry->fetch();
			if($wpqry->num_rows > 0){
				$array['bedrijf'] = stripslashes($bedrijf);
				$array['functie'] = stripslashes($functie);
				
				if(!strstr($website,'http://')){
					$website = 'http://'.$website;
				}
				$array['website'] = stripslashes($website);
				
				
			}	
			else{
				$array['sw'] = 'studie';
			}
		}
		$wpqry->close();
		
		//STUDIE OP DIT MOMENT?
		if($array['sw'] == 'studie'){
			$wpqry = $con->prepare("SELECT school,studienaam,website FROM leden_profiel_student WHERE leden_id = ? AND (vandatum <= CURDATE() AND (totdatum >= CURDATE() OR totdatum = '0000-00-00')) LIMIT 1;");
			if ($wpqry === false) {
				echo  ALGEMEEN_FOUT_SQL;
			} 
			else{
				$wpqry->bind_param('i',$id);
				$wpqry->bind_result($school,$studienaam,$website);
				$wpqry->execute();
				$wpqry->store_result();
				$wpqry->fetch();
				if($wpqry->num_rows > 0){
					$array['school'] = stripslashes($school);
					$array['studienaam'] = stripslashes($studienaam);
					if(!strstr($website,'http://')){
						$website = 'http://'.$website;
					}
					$array['website'] = stripslashes($website);
				}	
				else{
					$array['sw'] = 'geen';
				}
			}
			$wpqry->close();
		}	
		*/
		
		
		
		//LAATSTE VRIENDEN OPHALEN
		list($array['aantalvrienden']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM vrienden WHERE leden_id = '$id'"));
		$wpqry = $con->prepare("SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = ? GROUP BY vriend_id ORDER BY RAND() LIMIT 4;");
		if ($wpqry === false) {
			echo  ALGEMEEN_FOUT_SQL;
		} 
		else{
			$wpqry->bind_param('i',$id);
			$wpqry->bind_result($leden_id,$foto,$profielnaam);
			$wpqry->execute();
			$wpqry->store_result();
			while($wpqry->fetch()){
				if(strlen($profielnaam) > 27){
					$profielnaam = substr($profielnaam,0,25).'..';
				}
				$array['vriendnaam'][$leden_id] = stripslashes($profielnaam);
				$array['vriendfoto'][$leden_id] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
				$array['vriendurl'][$leden_id] = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($profielnaam);
				$array['vriendwerkzaam'][$leden_id] = getWerkzaam($leden_id);
			}
		}
		$wpqry->close();
		
		//ONGELEZEN IN INBOX
		list($array['aantalinbox']) = mysqli_fetch_array($con->query("SELECT COUNT(a.bericht_id) FROM berichten AS a, berichten_ontvangers AS b WHERE a.bericht_id = b.bericht_id AND b.ontvanger_id = '$id' AND geopend = '0' AND verwijderd = '0'"));
		list($array['aantalvriendverzoeken']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM vrienden_verzoek WHERE leden_id = '$id' AND status = 'open'"));
		list($array['laatstestatus'],$array['statusdatumtijd'],$array['laatstestatus_medium']) = mysqli_fetch_array($con->query("SELECT status,datumtijd,medium FROM leden_status WHERE leden_id = '$id' AND reply_id = '0' and geplaatst_bij = '$id' ORDER BY datumtijd DESC LIMIT 1"));
		$array['laatstestatus_sinds'] = timeSince(strtotime($array['statusdatumtijd']));
		
		$array['laatstestatus'] = maakklikbaar(wordwrap(strip_tags(stripslashes($array['laatstestatus'])),40,' ',true));
		list($array['aantalman']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM leden WHERE geblokkeerd = '0' AND 	actief = '1' AND geslacht = 'man'"));
		list($array['aantalvrouw']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM leden WHERE geblokkeerd = '0' AND 	actief = '1' AND geslacht = 'vrouw'"));
		$array['aantalmanvrouw'] = $array['aantalman'] + $array['aantalvrouw'];
	}
	return $array;
}


function timeSince($original) {

	$repl = array(JAAR=>JAARS,MAAND=>MAANDS,WEEK=>WEEKS,DAG=>DAGS,UUR=>UURS,MIN=>MINS,SEC=>SECS);

    // array of time period chunks
    $chunks = array(
	array(60 * 60 * 24 * 365 , JAAR),
	array(60 * 60 * 24 * 30 , MAAND),
	array(60 * 60 * 24 * 7, WEEK),
	array(60 * 60 * 24 , DAG),
	array(60 * 60 , UUR),
	array(60 , MIN),
	array(1 , SEC),
    );

    $today = time(); /* Current unix time  */
    $since = $today - $original;

    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
		$name = $chunks[$i][1];
		// finding the biggest chunk (if the chunk fits, break)
		if (($count = floor($since / $seconds)) != 0) {
			break;
		}
    }
	if($count == 1){
		$print = '1 '.$name;
	} else {
		$print = $count.' '.$name;
		$print = str_replace(array_keys($repl),array_values($repl),$print);
	}
    if ($i + 1 < $j) {
		// now getting the second item
		$seconds2 = $chunks[$i + 1][0];
		$name2 = $chunks[$i + 1][1];
		// add second item if its greater than 0
		if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
		
			if($count2 == 1){
				$print2 = ', 1 '.$name2;
				
			} else {
				$print2 = ', '.$count2.' '.$name2;
				$print2 = str_replace(array_keys($repl),array_values($repl),$print2);
			}	
			$print = $print.$print2;
		}
    }
    return $print;
}

	
function maakMailTemplate($mid,$replace,$button=false,$buttonlink=false){
	global $con;
	$buttontext = "";
	
	list($tekst) = mysqli_fetch_array($con->query("SELECT tekst$_SESSION[lndb] FROM emails WHERE email_id = '$mid' LIMIT 1"));
	$tekst = stripslashes($tekst);
	$tekst = str_replace(array_keys($replace),array_values($replace),$tekst);
	
	if($button) {
		$buttontext =
			'<tr>
				<td colspan="2">&nbsp;</td>
				<td><a href="'.$buttonlink.'" style="padding: 8px 17px; background-color: #ffd602; color: #000000; height: 66px; line-height: 66px; border: 1px solid #ffc000; text-decoration: none; font-family:Arial, Helvetica, sans-serif; font-size: 13px;">'.$button.'</td>
			</tr>';
	}
	
	$html = '<html>
			<body>
				<table align="center" width="502" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td width="50">&nbsp;</td>
						<td width="7">&nbsp;</td>
						<td width="445">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2"><img src="'.BASEHREF.'images/mail_top_bar.jpg" alt=""/></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
						<td><font color="#000000" face="Arial, Helvetica, sans-serif" size="-1">'.$tekst.'<BR><BR></font></td>
					</tr>'
					.$buttontext.
					'<tr>
						<td>&nbsp;</td>
						<td colspan="2"><img src="'.BASEHREF.'images/mail_mid_bar.jpg" alt=""/></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
						<td><font color="#333333"  face="Arial, Helvetica, sans-serif" size="-2">'.EMAILFOOTERTEKST.'<BR><BR><BR></font>
							<img src="'.BASEHREF.'images/footerlogo.jpg" alt=""/>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2"><img src="'.BASEHREF.'images/mail_bot_bar.jpg" alt=""/></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
						<td><font color="#000000"  face="Arial, Helvetica, sans-serif" size="-2">'.EMAILCOPYRIGHT.'<BR></font>
					</tr>
				</table>
			</body>
		</html>';
	return $html;
}

function sendNotificationEmail($type,$leden_id){
	global $con;
	$button = "";
	$buttonlink = "";
	
	require_once('mail/htmlMimeMail.php');
	$mail = new htmlMimeMail5();
	
	
	switch($type){
		case 'activation': 
			$id = 1;
			list($naam,$email) = mysqli_fetch_array($con->query("SELECT profielnaam,emailadres FROM leden WHERE leden_id = '$leden_id' LIMIT 1"));
			list($password) = mysqli_fetch_array($con->query("SELECT password FROM leden WHERE leden_id = '".$leden_id."' LIMIT 1"));
			$subject = EMAILREGISTRATIE; 
			$button = ACTIVEERBUTTON; 
			$buttonlink = BASEHREFLN.'account-activation/'.$email.'/'.substr($password,3,10);
			$replacearray = array('[naam]'=>utf8_decode(stripslashes($naam)),'[activatielink]'=>$buttonlink);	
		break;
		case 'nieuwbericht': 
			$id = 7;
			list($naam,$email) = mysqli_fetch_array($con->query("SELECT profielnaam,emailadres FROM leden WHERE leden_id = '$leden_id' LIMIT 1"));
			$subject = $vriend.' '.EMAILNIEUWBERICHT; 
			$button = BEKIJKINBOXBUTTON; 
			$buttonlink = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($naam,false).'/inbox.html';
			$replacearray = array('[naam]'=>utf8_decode(stripslashes($naam)), '[vriend]'=>$_SESSION['user']['naam']);	
		break;
		/* 3 (wachtwoord vergeten) wordt in network_handleinputprompt.php afgehandeld. */
		case 'vriendschap': 
			$id = 4;
			list($naam,$email) = mysqli_fetch_array($con->query("SELECT profielnaam,emailadres FROM leden WHERE leden_id = '$leden_id' LIMIT 1"));
			$subject = $_SESSION['user']['naam'].' '.EMAILVRIENDSCHAPVERZOEK; 
			$button = ACCEPTEERBUTTON; 
			$buttonlink = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($naam,false).'/dashboard.html';
			$replacearray = array('[naam]'=>utf8_decode(stripslashes($naam)), '[vriend]'=>$_SESSION['user']['naam']);	
		break;	
		case 'sollicitatie': 
			if(!file_exists($_POST['pdfname'])){ //is al gesolliciteerd (f5 mag niet nog een keer de mail uitsturen)
				echo "<meta http-equiv=\"refresh\" content=\"2; URL=".BASEHREFLN."talentconnect/talentconnect.html\">";
				exit;		
			}
			$id = 5;
			$pageurl = explode('=',$_GET['incl']);
			list($vacature_id) = explode('|',$pageurl[3]);
	
			list($vacature,$email,$naam) = mysqli_fetch_array($con->query("SELECT a.titel,b.email,c.profielnaam FROM bedrijven_vacatures a, bedrijven b, leden c WHERE a.bedrijf_id = b.bedrijf_id AND b.leden_id = c.leden_id AND a.vacature_id = '".$vacature_id."'"));
			list($sollicitant) = mysqli_fetch_array($con->query("SELECT profielnaam FROM leden WHERE leden_id = '".$_SESSION['user']['id']."' LIMIT 1"));
			$mail->addAttachment(new fileAttachment($_POST['pdfname'] ,'application/pdf', new Base64Encoding()));
			if(isset($_FILES['eigencv']['name']) && $_FILES['eigencv']['name'] != ""){
				$uploadbestand = str_replace(' ','_',$_FILES['eigencv']['tmp_name']);
				$uploadnaam = $vacature_id . "_" . str_replace(' ','_',$_FILES['eigencv']['name']);
				copy($uploadbestand, "upload/leden/cv/$uploadnaam");
				$mail->addAttachment(new fileAttachment(BASEHREF."upload/leden/cv/".$uploadnaam ,'', new Base64Encoding()));
			}
	
			$mail->setCc($_SESSION['user']['email']);
			$mail->setBcc('info@apura.org');
			$subject = $sollicitant.' '.EMAILSOLLICITATIE.' '.$vacature;
			$replacearray = array('[naam]'=>utf8_decode(stripslashes($naam)), '[vacature]'=>utf8_decode(stripslashes($vacature)), '[sollicitant]'=>$_SESSION['user']['naam']);
		break;
		case 'forumbericht': 
			$id = 6;
			$pageurl = explode('=',$_GET['incl']);
			list($thread_id) = explode('|',$pageurl[5]);
			list($naam,$email) = mysqli_fetch_array($con->query("SELECT profielnaam,emailadres FROM leden WHERE leden_id = '$leden_id' LIMIT 1"));
			list($cat_id,$categorie,$titel) = mysqli_fetch_array($con->query("SELECT a.cat_id,categorie,titel FROM forum_threads a, forum_categorie b WHERE a.cat_id = b.cat_id AND thread_id = '".$thread_id."' LIMIT 1"));
			$subject = EMAILNIEUWEREACTIE; 
			$button = TOPICRBUTTON; 
			$buttonlink = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($naam,false).'/forum/'.$cat_id.'/'.prettyUrl($categorie,false).'/'.$thread_id.'/'.prettyUrl($titel);
			$replacearray = array('[naam]'=>utf8_decode(stripslashes($naam)), '[vriend]'=>$_SESSION['user']['naam'], '[topic]'=>utf8_decode(stripslashes($titel)));	
		break;	
	}
	$html = maakMailTemplate($id,$replacearray,$button,$buttonlink);
	
	$mail->setFrom("Apura.org <info@apura.org>");
	$mail->setSubject($subject);
	$mail->setPriority('normal');
	$mail->setHTML($html);
	$mail->send(array($email));
}

function researchTop(){
	global $con;
	$array = array();
	$wpqry = $con->prepare("SELECT research_id,categorie FROM research ORDER BY volgnr ASC;");
	if ($wpqry === false) {
		echo ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->execute();
		$wpqry->bind_result($research_id,$categorie);
		if ($wpqry->execute()) {
			while($wpqry->fetch()){
				$catshow = $categorie;
				if(strstr($categorie,'&')){
					list($catshow,) = explode('&',$categorie);
				}
				$array['categorie'][$research_id] = stripslashes($catshow);
				$array['url'][$research_id] = BASEHREFLN.'research/'.$research_id.'/'.prettyUrl($categorie);
			}
		}
	}
	$wpqry->close();
	return $array;
}


/*function getNewestMembers($id){
	//status updates tonen van nieuwe personen op volgorde van tijd
	global $con;
	$array = array();
	$wqry = " WHERE b.leden_id != '$id' AND b.actief=1 ";
	$limitqry = " LIMIT 6"; 
	
	$qry = $con->query("SELECT vriend_id FROM vrienden WHERE leden_id = '$id'");
	while($r = mysqli_fetch_assoc($qry)){
		$wqry .= " AND b.leden_id != '".$r['vriend_id']."' ";
	}
	list($array['status_totaal']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM leden AS b " . $wqry . " AND b.verwijderd = '0' AND b.aanmelding >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)"));

	$qry1 = $con->query("SELECT b.leden_id FROM  leden AS b " . $wqry . " AND b.verwijderd = '0' AND b.aanmelding >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK) GROUP BY b.leden_id ORDER BY RAND() ".$limitqry);
	while($r1 = mysqli_fetch_array($qry1)){
		$array['nieuwlid'][$r1['leden_id']] = networkShort($r1['leden_id'],true);
		$array['nieuwlidwerkzaam'][$r1['leden_id']] = getWerkzaam($r1['leden_id']);
	}
	return $array;	 
}*/

function getNewestMembers($id){
	//status updates tonen van nieuwe personen op volgorde van tijd
	global $con;
	$array = array();
	$wqry = " WHERE b.leden_id != '$id' ";
	$limitqry = " LIMIT 6"; 
	
	$qry = $con->query("SELECT vriend_id FROM vrienden WHERE leden_id = '$id'");
	while($r = mysqli_fetch_assoc($qry)){
		$wqry .= " AND b.leden_id != '".$r['vriend_id']."' ";
	}
	//list($array['status_totaal']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM leden AS b " . $wqry . " AND b.verwijderd = '0' AND b.aanmelding >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH)"));
	
	$qry1 = $con->query("SELECT b.leden_id FROM  leden AS b " . $wqry . " AND b.verwijderd = '0' AND b.aanmelding >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK) GROUP BY b.leden_id ORDER BY RAND() ".$limitqry);
	//$qry1 = $con->query("SELECT b.leden_id FROM  leden AS b " . $wqry . " AND b.verwijderd = '0' GROUP BY b.leden_id ORDER BY leden_id DESC ".$limitqry);
	while($r1 = mysqli_fetch_array($qry1)){
		$array['nieuwlid'][$r1['leden_id']] = networkShort($r1['leden_id'],true);
		$array['nieuwlidwerkzaam'][$r1['leden_id']] = getWerkzaam($r1['leden_id']);
	}
	return $array;	 
}


function getStatusUpdates($id,$waar,$limit=false){
	//status updates tonen van persoon en vrienden van persoon op volgorde van tijd
	global $con;
	$array = array();
	$wqry = " leden_id = '$id' ";

	$limitqry = " ";
	if(isset($limit) && $limit != ''){
		list($a,$b) = explode(',',$limit);
		$limitqry = " LIMIT ".$limit;
	}	
	else{
		if($waar == 'dashboard'){
			$limitqry = " LIMIT 5"; 
		}
		if($waar == 'alleupdate'){
			$limitqry = " LIMIT 12"; 
		}
	}
	
	$qry = $con->query("SELECT vriend_id FROM vrienden WHERE leden_id = '$id'");
	while($r = mysqli_fetch_assoc($qry)){
		$wqry .= " OR leden_id = '".$r['vriend_id']."' ";
	}
	list($array['status_totaal']) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM leden_status WHERE (" . $wqry . ") AND reply_id = '0' ORDER BY datumtijd DESC"));
	$totaalposts = $array['status_totaal'];
	if(isset($a) && $a != ''){
		$totaalposts = $totaalposts - $a;
	}
	//$qry1 = $con->query("SELECT status_id,status,leden_id,medium,datumtijd FROM leden_status WHERE (" . $wqry . ") AND reply_id = '0' AND (geplaatst_bij = '0' || geplaatst_bij = '$id') ORDER BY datumtijd DESC ".$limitqry);
	$qry1 = $con->query("SELECT status_id,status,leden_id,medium,datumtijd,geplaatst_bij FROM leden_status WHERE reply_id = '0' ORDER BY datumtijd DESC ".$limitqry);
	while($r1 = mysqli_fetch_array($qry1)){
		$qry2 = $con->query("SELECT foto,profielnaam FROM leden WHERE leden_id = '".$r1['leden_id']."' LIMIT 1");
		$r2 = mysqli_fetch_assoc($qry2);
		$qry3 = $con->query("SELECT profielnaam FROM leden WHERE leden_id = '".$r1['geplaatst_bij']."' LIMIT 1");
		$r3 = mysqli_fetch_assoc($qry3);
		$array['status_status'][$r1['status_id']] = maakklikbaar(wordwrap(strip_tags(stripslashes($r1['status'])),50,' ',true));
		$array['status_leden_id'][$r1['status_id']] = stripslashes($r1['leden_id']);
		$array['status_naam'][$r1['status_id']] = stripslashes($r2['profielnaam']);
		$array['status_foto'][$r1['status_id']] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($r2['foto']);
		$array['status_url'][$r1['status_id']] = BASEHREFLN.'network/'.$r1['leden_id'].'/'.prettyUrl($r2['profielnaam']);
		$array['status_sinds'][$r1['status_id']] = timeSince(strtotime($r1['datumtijd']));
		$array['status_via'][$r1['status_id']] = $r1['medium'];
		$array['status_postnummer'][$r1['status_id']] = $totaalposts;
		$array['status_postedto'][$r1['status_id']] = stripslashes($r1['geplaatst_bij']);
		$array['status_postedto_naam'][$r1['status_id']] = stripslashes($r3['profielnaam']);
		$array['status_postedto_url'][$r1['status_id']] = BASEHREFLN.'network/'.$r1['geplaatst_bij'].'/'.prettyUrl($r3['profielnaam']);

		
		$qry3 = $con->query("SELECT status_id,status,leden_id,medium,datumtijd FROM leden_status  WHERE reply_id = '".$r1['status_id']."' ORDER BY datumtijd ASC");
		while($r3 = mysqli_fetch_array($qry3)){
			$qry4 = $con->query("SELECT foto,profielnaam FROM leden WHERE leden_id = '".$r3['leden_id']."' LIMIT 1");
			$r4 = mysqli_fetch_assoc($qry4);
			$array['re_status_status'][$r1['status_id']][$r3['status_id']] = maakklikbaar(wordwrap(strip_tags(stripslashes($r3['status'])),50,' ',true));
			$array['re_status_leden_id'][$r1['status_id']][$r3['status_id']] = stripslashes($r3['leden_id']);
			$array['re_status_naam'][$r1['status_id']][$r3['status_id']] = stripslashes($r4['profielnaam']);
			$array['re_status_foto'][$r1['status_id']][$r3['status_id']] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($r4['foto']);
			$array['re_status_url'][$r1['status_id']][$r3['status_id']] = BASEHREFLN.'network/'.$r3['leden_id'].'/'.prettyUrl($r4['profielnaam']);
			$array['re_status_sinds'][$r1['status_id']][$r3['status_id']] = timeSince(strtotime($r3['datumtijd']));
			$array['re_status_via'][$r1['status_id']][$r3['status_id']] = $r3['medium'];
			$array['re_status_postnummer'][$r1['status_id']][$r3['status_id']] = $totaalposts;
		}
	}
	return $array;	
}

function getAllFriends($id,$nopage=false,$page=false,$zoek=false,$type=false,$filter=false,$profiel=false,$studierichting_id=false,$studierichting_did=false,$branche_gid=false,$branche_id=false) {
	global $con;
	$array = array();
	$type = mysqli_escape_string($con,$type);
	$zoek = mysqli_escape_string($con,$zoek);
	$filter = mysqli_escape_string($con,$filter);
	$profiel = mysqli_escape_string($con,$profiel);
	$branche_id = mysqli_escape_string($con,$branche_id);
	$branche_gid = mysqli_escape_string($con,$branche_gid);
	$studierichting_id = mysqli_escape_string($con,$studierichting_id);
	$studierichting_did = mysqli_escape_string($con,$studierichting_did);
	$page = mysqli_escape_string($con,$page);

	list($paginaprofielnaam) = mysqli_fetch_array($con->query("SELECT profielnaam FROM leden WHERE leden_id = '$id' LIMIT 1"));
	
	if ($nopage) { //bericht sturen vriendenlijst (geen pagina nummering)
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = '$id' AND a.actief = '1' AND a.verwijderd = '0' ORDER BY profielnaam DESC";
	}
	else if($type != '' && $type != false){ //geslacht geselecteerd
		$limit = "60";
		$pagvars = '?type='.$type.'&page=';
		if($type == 'alle') {
			$where = "WHERE a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY leden_id DESC";
		} 
		else {
			$where = "WHERE geslacht = '$type' AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam DESC";
		}
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a $where  ";

	}
	else if($filter != '' && $filter != false) { //zoeken
		$where = '';
		$limit = "60";
		$pagvars = '?zoek='.$zoek.'&filter=1&profiel='.$profiel.'&studierichting_id='.$studierichting_id.'&studierichting_did='.$studierichting_did.'&branche_gid='.$branche_gid.'&branche_id='.$branche_id.'&page=';
		if($profiel != '') { 
			$where .= "AND type_profiel = '$profiel' "; 
			if($profiel == 'Student') {
				if($studierichting_did != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_student as b WHERE a.leden_id = b.leden_id and studierichting_did = '$studierichting_did')"; 
				}
				elseif($studierichting_id != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_student as b WHERE a.leden_id = b.leden_id and studie_id = '$studierichting_id')"; 
				}
			}
			else {
				if($branche_id != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_fow as b WHERE a.leden_id = b.leden_id and 	branche_id = '$branche_id')"; 
				}
				elseif($branche_gid != '') {
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_fow as b, branches_groepen c, branches d WHERE c.branche_gid = d.branche_gid AND b.branche_id = d.branche_id AND a.leden_id = b.leden_id and c.branche_gid = '$branche_gid')"; 
				}			
			}
		}
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a WHERE (voornaam LIKE '%$zoek%' OR achternaam LIKE '%$zoek%' OR profielnaam LIKE '%$zoek%') $where AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam DESC ";
		
	}
	else { //vriendoverzicht network
		$limit = "30";
		$pagvars = '?vrienden&page=';
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = '$id' AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam DESC ";
	}
	
	$aantalberichten = mysqli_num_rows(mysqli_query($con,$qry1));
	if(isset($limit) && $limit != 0) {
	$totalpage = round($aantalberichten / $limit,0);
	}
	if(isset($limit) && $limit != 0) {
		$qry1 .= "LIMIT ".($limit * $page).",". $limit;
	}
	$wpqry = $con->prepare($qry1);	
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_result($leden_id,$foto,$profielnaam);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			if(strlen($profielnaam) > 27){
				$profielnaam = substr($profielnaam,0,25).'..';
			}
			$array['vriendnaam'][$leden_id] = stripslashes($profielnaam);
			$array['vriendfoto'][$leden_id] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
			$array['vriendurl'][$leden_id] = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($profielnaam);
			$array['vriendwerkzaam'][$leden_id] = getWerkzaam($leden_id);
			$array['isfriend'][$leden_id] = isfriend($leden_id);
		}
	}


	if(isset($limit)) {

		if(($limit * $page) < ($aantalberichten - $limit)) {
			$nxtpage = $pagvars.($page+1);
			$array['volgendeurl'] = "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$nxtpage."' class='switchartikel'>&rsaquo;</a>";
			//$array['volgendeurl'] = "<a href='".BASEHREFLN."network/community.html".$nxtpage."' class='switchartikel'>&rsaquo;</a>";
		}
		if($page > 0) {
			$prvpage = $pagvars.($page-1);
			$array['volgendeurl'] = "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$prvpage."' class='switchartikel'>&rsaquo;</a>";
			//$array['vorigeurl'] = "<a href='".BASEHREFLN."network/community.html".$prvpage."' class='switchartikel'>&lsaquo;</a>";
		}
		
		$showpages = 3;
		
		$totalpages = $totalpage+1;
		if($page<=$showpages)
			$start = 1;
		else
			$start = $page-$showpages;	
			
		if($page<$totalpage-$showpages)
			$end = $page+$showpages;
		else
			$end = $totalpage;
			
		
		if($page!=0){
			$array['pagina'] = "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$prvpage."' class='prev'>Prev</a>";	
			$array['pagina'].= "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$pagvars."0'>1</a>";	
		}else{
			$array['pagina'] = "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$pagvars."0' class='active'>1</a>";	
		}

		if($start>1)
		$array['pagina'].= "<span class='dots'>...</span>";
		
		if($page!=$totalpage){
			for($i=$start; $i<=$end; $i++) {
				$j = $i+1;
				if($page == $i) {
					$array['pagina'].= "<a href='javascript:void(0);' class='active'>".$j."</a>";
				} else if($i < $totalpage) {
					$array['pagina'].= "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$pagvars.$i."'>".$j."</a>";	
				}
			}
		}else{

			for($i=$start; $i<=$end; $i++) {
				if($page == $i) {
					$array['pagina'].= "<a href='javascript:void(0);' class='active'>".$i."</a>";
				} else {
					$array['pagina'].= "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$pagvars.$i."'>".($i-1)."</a>";
				}
			}
		}

		//print_r();

		
		if($page<($totalpage-$showpages-1)){
			if($page<$totalpage-($showpages+1)){
				$array['pagina'].= "<span class='dots'>...</span>";
			}
			$array['pagina'].= "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$pagvars.($totalpages-2)."'>".($totalpages-1)."</a>";	
		}

		if($page<$totalpage-1){
			$nxtpage = $pagvars.($page+1);
			$array['pagina'].= "<a href='".BASEHREFLN."network/".$id."/".prettyUrl($paginaprofielnaam,false)."/my-friends.html".$nxtpage."' class='next'>Next</a>";	
		}
	}

	$wpqry->close();
	return $array;
}


/*function getCommFriends($id,$nopage=false,$page=false,$zoek=false,$type=false,$country=false,$filter=false,$profiel=false,$studierichting_id=false,$studierichting_did=false,$branche_gid=false,$branche_id=false) {
	global $con;
	$array = array();
	$type = mysqli_escape_string($con,$type);
	$country = mysqli_escape_string($con,$country);
	$zoek = mysqli_escape_string($con,$zoek);
	$filter = mysqli_escape_string($con,$filter);
	$profiel = mysqli_escape_string($con,$profiel);
	$branche_id = mysqli_escape_string($con,$branche_id);
	$branche_gid = mysqli_escape_string($con,$branche_gid);
	$studierichting_id = mysqli_escape_string($con,$studierichting_id);
	$studierichting_did = mysqli_escape_string($con,$studierichting_did);
	$page = mysqli_escape_string($con,$page);

	list($paginaprofielnaam) = mysqli_fetch_array($con->query("SELECT profielnaam FROM leden WHERE leden_id = '$id' LIMIT 1"));
	
	if ($nopage) { //bericht sturen vriendenlijst (geen pagina nummering)
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = '$id' AND a.actief = '1' AND a.verwijderd = '0' ORDER BY profielnaam DESC";
	}
	else if($type != '' && $type != false){ //geslacht geselecteerd
		$limit = "60";
		$pagvars = '?type='.$type.'&country='.$country.'&page=';
		if($type == 'alle') {
			if(!empty($country) && $country!="alle"){
				$where = "WHERE a.geblokkeerd = '0' AND verwijderd = '0' and a.land_id=$country AND a.actief = '1' ORDER BY leden_id DESC";	
			}else{
				$where = "WHERE a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY leden_id DESC";	
			}
		} 
		else{
			if(!empty($country) && $country!="alle"){
				$where = "WHERE geslacht = '$type' AND a.geblokkeerd = '0' and a.land_id=$country AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam ASC";
			}else{
				$where = "WHERE geslacht = '$type' AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam ASC";
			}
		}
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a $where ";
	}else if($filter != '' && $filter != false) { //zoeken
		$where = '';
		$limit = "60";
		$pagvars = '?country='.$country.'&zoek='.$zoek.'&filter=1&profiel='.$profiel.'&studierichting_id='.$studierichting_id.'&studierichting_did='.$studierichting_did.'&branche_gid='.$branche_gid.'&branche_id='.$branche_id.'&page=';
		if($profiel != '') { 
			$where .= "AND type_profiel = '$profiel' "; 
			if($profiel == 'Student') {
				if($studierichting_did != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_student as b WHERE a.leden_id = b.leden_id and studierichting_did = '$studierichting_did')"; 
				}
				elseif($studierichting_id != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_student as b WHERE a.leden_id = b.leden_id and studie_id = '$studierichting_id')"; 
				}
			}
			else {
				if($branche_id != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_fow as b WHERE a.leden_id = b.leden_id and 	branche_id = '$branche_id')"; 
				}
				elseif($branche_gid != '') {
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_fow as b, branches_groepen c, branches d WHERE c.branche_gid = d.branche_gid AND b.branche_id = d.branche_id AND a.leden_id = b.leden_id and c.branche_gid = '$branche_gid')"; 
				}			
			}
		}
		
		if(!empty($country) && $country=='alle'){
			$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a WHERE (voornaam LIKE '%$zoek%' OR achternaam LIKE '%$zoek%' OR profielnaam LIKE '%$zoek%') $where AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam ASC ";
		}else{
			$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a WHERE (voornaam LIKE '%$zoek%' OR achternaam LIKE '%$zoek%' OR profielnaam LIKE '%$zoek%') $where AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' AND a.land_id=$country ORDER BY profielnaam ASC ";
		}
	}
	else { //vriendoverzicht network
		$limit = "30";
		$pagvars = '?vrienden&page=';
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = '$id' AND a.land_id=$country AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam ASC ";
	}
	
	$aantalberichten = mysqli_num_rows(mysqli_query($con,$qry1));
	if(isset($limit) && $limit != 0) {
	$totalpage = round($aantalberichten / $limit,0);
	}
	if(isset($limit) && $limit != 0) {
		$qry1 .= "LIMIT ".($limit * $page).",". $limit;
	}
	
	//echo $qry1;
	//exit;
	$wpqry = $con->prepare($qry1);	
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_result($leden_id,$foto,$profielnaam);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			if(strlen($profielnaam) > 27){
				$profielnaam = substr($profielnaam,0,25).'..';
			}
			$array['vriendnaam'][$leden_id] = stripslashes($profielnaam);
			$array['vriendfoto'][$leden_id] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
			$array['vriendurl'][$leden_id] = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($profielnaam);
			$array['vriendwerkzaam'][$leden_id] = getWerkzaam($leden_id);
			$array['isfriend'][$leden_id] = isfriend($leden_id);
		}
	}
	
	if(isset($limit)) {
		if(($limit * $page) < ($aantalberichten - $limit)) {
			$nxtpage = $pagvars.($page+1);
			$array['volgendeurl'] = "<a href='".BASEHREFLN."network/community.html".$nxtpage."' class='switchartikel'>&rsaquo;</a>";
		}
		if($page > 0) {
			$prvpage = $pagvars.($page-1);
			$array['vorigeurl'] = "<a href='".BASEHREFLN."network/community.html".$prvpage."' class='switchartikel'>&lsaquo;</a>";
		}
		
		$showpages = 3;
		
		$totalpages = $totalpage+1;
		$start = $page-$showpages;	
		
		if($page<=$showpages)
			$start = 1;
			
		$end = $totalpage;	
		if($page<$totalpage-$showpages)
			$end = $page+$showpages;
			
		if($page!=0){	
			$array['pagina'] = "<a href='".BASEHREFLN."network/community.html".$prvpage."' class='prev'>Prev</a>";
			$array['pagina'].= "<a href='".BASEHREFLN."network/community.html".$pagvars."0'>1</a>";
		}else{
			$array['pagina'].= "<a href='".BASEHREFLN."network/community.html".$pagvars."0' class='active'>1</a>";
		}
		
		
		if($start>1)
		$array['pagina'].= "<span class='dots'>...</span>";
		
		if($page!=$totalpage){
			for($i=$start; $i<=$end; $i++) {
				$j = $i+1;
				if($page == $i) {
					$array['pagina'] .= "<a href='javascript:void(0);' class='active'>".$j."</a>";
				} else {
					$array['pagina'] .= "<a href='".BASEHREFLN."network/community.html".$pagvars.$i."'>".$j."</a>";
				}
			}
		}else{
			for($i=$start; $i<=$end; $i++) {
				$j = $i+1;
				if($page == $i) {
					$array['pagina'] .= "<a href='javascript:void(0);' class='active'>".$j."</a>";
				} else {
					$array['pagina'] .= "<a href='".BASEHREFLN."network/community.html".$pagvars.$i."'>".$j."</a>";
				}
			}
		}
		
		if($page<$totalpage-$showpages){
			if($page<$totalpage-($showpages+1)){
				$array['pagina'].= "<span class='dots'>...</span>";
			}
			$array['pagina'].= "<a href='".BASEHREFLN."network/community.html".$pagvars.$totalpage."'>".$totalpages."</a>";			
		}
		if($page<$totalpage){
			$array['pagina'].= "<a href='".BASEHREFLN."network/community.html".$nxtpage."' class='next'>Next</a>";	
		}
	}
	
	$wpqry->close();
	return $array;
}*/

function getCommFriends($id,$nopage=false,$page=false,$zoek=false,$type=false,$country=false,$filter=false,$profiel=false,$studierichting_id=false,$studierichting_did=false,$branche_gid=false,$branche_id=false,$prov=false) {
	global $con;
	$array = array();
	$type = mysqli_escape_string($con,$type);
	$country = mysqli_escape_string($con,$country);
	$prov = mysqli_escape_string($con,$prov);
	$zoek = mysqli_escape_string($con,$zoek);
	$filter = mysqli_escape_string($con,$filter);
	$profiel = mysqli_escape_string($con,$profiel);
	$branche_id = mysqli_escape_string($con,$branche_id);
	$branche_gid = mysqli_escape_string($con,$branche_gid);
	$studierichting_id = mysqli_escape_string($con,$studierichting_id);
	$studierichting_did = mysqli_escape_string($con,$studierichting_did);
	$page = mysqli_escape_string($con,$page);

	list($paginaprofielnaam) = mysqli_fetch_array($con->query("SELECT profielnaam FROM leden WHERE leden_id = '$id' LIMIT 1"));
	
	
	
	if ($nopage) { //bericht sturen vriendenlijst (geen pagina nummering)
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = '$id' AND a.actief = '1' AND a.verwijderd = '0' ORDER BY profielnaam DESC";
	}
	else if($type != '' && $type != false && $zoek == false && $profiel == false){ //geslacht geselecteerd
		$limit = "60";
		$pagvars = '?type='.$type.'&country='.$country.'&prov='.$prov.'&page=';
			
		if($prov != ''){
			$whereadd = "AND prov_id = '$prov'";
		}else{
			$whereadd = "";	
		}
		
		if($type == 'alle') {
			
		
			if(!empty($country) && $country!="alle"){
				$where = "WHERE a.geblokkeerd = '0' AND verwijderd = '0' and a.land_id=$country AND a.actief = '1' $whereadd ORDER BY leden_id DESC";	
			}else{
				$where = "WHERE a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' $whereadd ORDER BY leden_id DESC";	
			}
		} 
		else{
			if(!empty($country) && $country!="alle"){
				$where = "WHERE geslacht = '$type' AND a.geblokkeerd = '0' and a.land_id=$country AND verwijderd = '0' AND a.actief = '1' $whereadd ORDER BY profielnaam ASC";
			}else{
				$where = "WHERE geslacht = '$type' AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' $whereadd ORDER BY profielnaam ASC";
			}
		}
		
		
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a $where ";
	}else if($filter != '' && $filter != false) { //zoeken
		$where = '';
		$limit = "60";
		$pagvars = '?type='.$type.'&country='.$country.'&zoek='.$zoek.'&filter=1&profiel='.$profiel.'&studierichting_id='.$studierichting_id.'&studierichting_did='.$studierichting_did.'&branche_gid='.$branche_gid.'&branche_id='.$branche_id.'&prov='.$prov.'&page=';
		
		if($type != 'alle'){
			$where .= "AND geslacht = '$type'";
		}
		
		if($prov != ''){
			$where .= "AND prov_id = '$prov'";
		}
		
		if($profiel != '') { 
			if($profiel == 'Professionals'){
			$where .= "AND type_profiel != 'Student' "; 
			}else{
			$where .= "AND type_profiel = '$profiel' "; 
			}
			if($profiel == 'Student') {
				if($studierichting_did != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_student as b WHERE a.leden_id = b.leden_id and studierichting_did = '$studierichting_did')"; 
				}
				if($studierichting_id != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_student as b WHERE a.leden_id = b.leden_id and studie_id = '$studierichting_id')"; 
				}
			}
			else {
				if($branche_id != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_fow as b WHERE a.leden_id = b.leden_id and 	branche_id = '$branche_id')"; 
				}
				if($branche_gid != '') {
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_fow as b, branches_groepen c, branches d WHERE c.branche_gid = d.branche_gid AND b.branche_id = d.branche_id AND a.leden_id = b.leden_id and c.branche_gid = '$branche_gid')"; 
				}			
			}
		}
		
		//Search more
		$searcher = "";
		if(trim($zoek) != ""){
		$cleans = $zoek;
		$searcher = "AND (";	
		
		if (strpos($zoek,'%20') !== false || strpos($zoek,' ') !== false) {
		$cleans = str_replace(" ","%20",$zoek);
		$sarr = explode("%20", $cleans);
		foreach($sarr as $searcht){
		$searcher .= "(voornaam LIKE '%$searcht%' OR achternaam LIKE '%$searcht%' OR profielnaam LIKE '%$searcht%') AND ";	
		}
		}else{
		//One search
		$searcher .= "voornaam LIKE '%$cleans%' OR achternaam LIKE '%$cleans%' OR profielnaam LIKE '%$cleans%'";
		}
		
		$searcher = rtrim($searcher, " AND ");
		$searcher .= ")";
		}
		
		if(!empty($country) && $country=='alle'){
			$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a WHERE voornaam != '' $searcher $where AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam ASC ";
		}else{
			$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a WHERE voornaam != '' $searcher $where AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' AND a.land_id=$country ORDER BY profielnaam ASC ";
		}
	}
	else { //vriendoverzicht network
		$limit = "30";
		$pagvars = '?vrienden&page=';
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = '$id' AND a.land_id=$country AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam ASC ";
	}
	
	
	
	$aantalberichten = mysqli_num_rows(mysqli_query($con,$qry1));
	if(isset($limit) && $limit != 0) {
	$totalpage = round($aantalberichten / $limit,0);
	}
	if(isset($limit) && $limit != 0) {
		$qry1 .= "LIMIT ".($limit * $page).",". $limit;
	}
	
	//echo $qry1;
	//exit;
	$wpqry = $con->prepare($qry1);	
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_result($leden_id,$foto,$profielnaam);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			if(strlen($profielnaam) > 27){
				$profielnaam = substr($profielnaam,0,25).'..';
			}
			$array['vriendnaam'][$leden_id] = stripslashes($profielnaam);
			$array['vriendfoto'][$leden_id] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
			$array['vriendurl'][$leden_id] = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($profielnaam);
			$array['vriendwerkzaam'][$leden_id] = getWerkzaam($leden_id);
			$array['isfriend'][$leden_id] = isfriend($leden_id);
		}
	}
	
	if(isset($limit)) {
		if(($limit * $page) < ($aantalberichten - $limit)) {
			$nxtpage = $pagvars.($page+1);
			$array['volgendeurl'] = "<a href='".BASEHREFLN."network/community.html".$nxtpage."' class='switchartikel'>&rsaquo;</a>";
		}
		if($page > 0) {
			$prvpage = $pagvars.($page-1);
			$array['vorigeurl'] = "<a href='".BASEHREFLN."network/community.html".$prvpage."' class='switchartikel'>&lsaquo;</a>";
		}
		
		$showpages = 3;
		
		$totalpages = $totalpage+1;
		if($page<=$showpages)
			$start = 1;
		else
			$start = $page-$showpages;	
			
		if($page<$totalpage-$showpages)
			$end = $page+$showpages;
		else
			$end = $totalpage;
			
		if($page!=0){	
			$array['pagina'] = "<a href='".BASEHREFLN."network/community.html".$prvpage."' class='prev'>Prev</a>";
			$array['pagina'].= "<a href='".BASEHREFLN."network/community.html".$pagvars."0'>1</a>";
		}else{
			$array['pagina'] = "<a href='".BASEHREFLN."network/community.html".$pagvars."0' class='active'>1</a>";
		}
		
		
		if($start>1)
		$array['pagina'].= "<span class='dots'>...</span>";
		
		//if($start)
		if($page!=$totalpage){
			for($i=$start; $i<=$end; $i++) {
				$j = $i+1;
				if($page == $i) {
					$array['pagina'] .= "<a href='javascript:void(0);' class='active'>".$j."</a>";
				} else {
					$array['pagina'] .= "<a href='".BASEHREFLN."network/community.html".$pagvars.$i."'>".$j."</a>";
				}
			}
		}else{
			for($i=$start; $i<=$end; $i++) {
				$j = $i+1;
				if($page == $i) {
					$array['pagina'] .= "<a href='javascript:void(0);' class='active'>".$j."</a>";
				} else {
					$array['pagina'] .= "<a href='".BASEHREFLN."network/community.html".$pagvars.$i."'>".$j."</a>";
				}
			}
		}
		
		if($page<$totalpage-$showpages){
			if($page<$totalpage-($showpages+1)){
				$array['pagina'].= "<span class='dots'>...</span>";
			}
			$array['pagina'].= "<a href='".BASEHREFLN."network/community.html".$pagvars.$totalpage."'>".$totalpages."</a>";			
		}
		if($page<$totalpage){
			$nxtpage = $pagvars.($page+1);
			$array['pagina'].= "<a href='".BASEHREFLN."network/community.html".$nxtpage."' class='next'>Next</a>";	
		}
	}
	
	$wpqry->close();
	return $array;
}

function getCountCommFriends($id,$nopage=false,$page=false,$zoek=false,$type=false,$country=false,$filter=false,$profiel=false,$studierichting_id=false,$studierichting_did=false,$branche_gid=false,$branche_id=false,$prov=false) {
	global $con;
	$array = array();
	$type = mysqli_escape_string($con,$type);
	$country = mysqli_escape_string($con,$country);
	$prov = mysqli_escape_string($con,$prov);
	$zoek = mysqli_escape_string($con,$zoek);
	$filter = mysqli_escape_string($con,$filter);
	$profiel = mysqli_escape_string($con,$profiel);
	$branche_id = mysqli_escape_string($con,$branche_id);
	$branche_gid = mysqli_escape_string($con,$branche_gid);
	$studierichting_id = mysqli_escape_string($con,$studierichting_id);
	$studierichting_did = mysqli_escape_string($con,$studierichting_did);
	$page = mysqli_escape_string($con,$page);

	list($paginaprofielnaam) = mysqli_fetch_array($con->query("SELECT profielnaam FROM leden WHERE leden_id = '$id' LIMIT 1"));
	
	if ($nopage) { //bericht sturen vriendenlijst (geen pagina nummering)
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = '$id' AND a.actief = '1' AND a.verwijderd = '0' ORDER BY profielnaam DESC";
	}
	else if($type != '' && $type != false && $zoek == false && $profiel == false){ //geslacht geselecteerd
		$limit = "60";
		$pagvars = '?type='.$type.'&country='.$country.'&page=&prov='.$prov;
		
		
		if($prov != ''){
			$whereadd = "AND prov_id = '$prov'";
		}else{
			$whereadd = "";	
		}
		
		
		if($type == 'alle') {
			
			
		
			if(!empty($country) && $country!="alle"){
				$where = "WHERE a.geblokkeerd = '0' AND verwijderd = '0' and a.land_id=$country AND a.actief = '1' $whereadd ORDER BY leden_id DESC";	
			}else{
				$where = "WHERE a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' $whereadd ORDER BY leden_id DESC";	
			}
		} 
		else{
			if(!empty($country) && $country!="alle"){
				$where = "WHERE geslacht = '$type' AND a.geblokkeerd = '0' and a.land_id=$country AND verwijderd = '0' AND a.actief = '1' $whereadd ORDER BY profielnaam ASC";
			}else{
				$where = "WHERE geslacht = '$type' AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' $whereadd ORDER BY profielnaam ASC";
			}
		}
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a $where ";
	}else if($filter != '' && $filter != false) { //zoeken
		$where = '';
		$limit = "60";
		$pagvars = '?type='.$type.'&country='.$country.'&zoek='.$zoek.'&filter=1&profiel='.$profiel.'&studierichting_id='.$studierichting_id.'&studierichting_did='.$studierichting_did.'&branche_gid='.$branche_gid.'&branche_id='.$branche_id.'&page=';
		
		if($type != 'alle'){
			$where .= "AND geslacht = '$type'";
		}
		
		
		if($prov != ''){
			$where .= "AND prov_id = '$prov'";
		}
		
		
		if($profiel != '') { 
			if($profiel == 'Professionals'){
			$where .= "AND type_profiel != 'Student' "; 
			}else{
			$where .= "AND type_profiel = '$profiel' "; 
			}
			if($profiel == 'Student') {
				if($studierichting_did != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_student as b WHERE a.leden_id = b.leden_id and studierichting_did = '$studierichting_did')"; 
				}
				if($studierichting_id != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_student as b WHERE a.leden_id = b.leden_id and studie_id = '$studierichting_id')"; 
				}
			}
			else {
				if($branche_id != '') { 
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_fow as b WHERE a.leden_id = b.leden_id and 	branche_id = '$branche_id')"; 
				}
				if($branche_gid != '') {
					$where .= "AND a.leden_id IN (SELECT b.leden_id FROM leden_profiel_fow as b, branches_groepen c, branches d WHERE c.branche_gid = d.branche_gid AND b.branche_id = d.branche_id AND a.leden_id = b.leden_id and c.branche_gid = '$branche_gid')"; 
				}			
			}
		}
		
		
		//Search more
		$searcher = "";
		if(trim($zoek) != ""){
		$cleans = $zoek;
		$searcher = "AND (";	
		
		if (strpos($zoek,'%20') !== false || strpos($zoek,' ') !== false) {
		$cleans = str_replace(" ","%20",$zoek);
		$sarr = explode("%20", $cleans);
		foreach($sarr as $searcht){
		$searcher .= "(voornaam LIKE '%$searcht%' OR achternaam LIKE '%$searcht%' OR profielnaam LIKE '%$searcht%') AND ";	
		}
		}else{
		//One search
		$searcher .= "voornaam LIKE '%$cleans%' OR achternaam LIKE '%$cleans%' OR profielnaam LIKE '%$cleans%'";
		}
		
		$searcher = rtrim($searcher, " AND ");
		$searcher .= ")";
		}
		
		if(!empty($country) && $country=='alle'){
			$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a WHERE voornaam != '' $searcher $where AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam ASC ";
		}else{
			$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a WHERE voornaam != '' $searcher $where AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' AND a.land_id=$country ORDER BY profielnaam ASC ";
		}
		
	}
	else { //vriendoverzicht network
		$limit = "30";
		$pagvars = '?vrienden&page=';
		$qry1 = "SELECT a.leden_id,a.foto,a.profielnaam FROM leden AS a, vrienden AS b WHERE a.leden_id = b.vriend_id AND b.leden_id = '$id' AND a.land_id=$country AND a.geblokkeerd = '0' AND verwijderd = '0' AND a.actief = '1' ORDER BY profielnaam ASC ";
	}
	
	
	
	$count = 0;
	$wpqry = $con->prepare($qry1);	
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_result($leden_id,$foto,$profielnaam);
		$wpqry->execute();
		$wpqry->store_result();
		$count = $wpqry->num_rows;
	}
	$wpqry->close();
	return $count;
}

function getLastForumPosts($networkbaseurl) {
	global $con;
	$array = array();
	
	$wpqry = $con->prepare("SELECT a.thread_id,a.cat_id,a.leden_id,a.titel,b.categorie,DATE_FORMAT(a.laatstepost,'%Y-%m-%d %H:%i') AS startdatum,(SELECT COUNT(*) FROM forum_reacties AS c WHERE a.thread_id = c.thread_id) FROM forum_threads AS a, forum_categorie AS b WHERE a.cat_id = b.cat_id ORDER BY a.laatstepost DESC LIMIT 3");
	if ($wpqry === false) {
		echo mysqli_error($con);
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_result($thread_id,$cat_id,$leden_id,$titel,$categorie,$startdatum,$reacties);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			$array['threadtitel'][$thread_id] = maxLength($titel,30);
			$array['threadurl'][$thread_id] = $networkbaseurl.'forum/'.$cat_id.'/'.prettyUrl($categorie,false).'/'.$thread_id.'/'.prettyUrl($titel);
			$array['startdatum'][$thread_id] = dateToLang($startdatum);
			$array['aantalreacties'][$thread_id] = $reacties;
			
		}
	}
	$wpqry->close();	
	
	
	foreach($array['threadtitel'] as $key2 => $val2){
		$wpqry = $con->prepare("SELECT b.reactie_id,b.leden_id,DATE_FORMAT(b.plaatsdatum,'%Y-%m-%d') AS reactiedatum FROM forum_reacties AS b WHERE b.thread_id = '$key2' ORDER BY b.reactie_id DESC LIMIT 1");
		if ($wpqry === false) {
			echo mysqli_error($con);
			echo  ALGEMEEN_FOUT_SQL;
		} 
		else{
			$wpqry->bind_result($reactie_id,$leden_id,$reactiedatum);
			$wpqry->execute();
			$wpqry->store_result();
			while($wpqry->fetch()){
				$array['reactie_id'][$key2] = $reactie_id;
				$array['member_id'][$key2] = $leden_id;
				$array['reageerder'][$key2] = networkShort($leden_id,true);
				$array['reageerderwerkzaam'][$key2] = getWerkzaam($leden_id);
				$array['threadurl'][$key2] .= $reactie_id;
			}
		}
		$wpqry->close();		
	}					
	return $array;
}


function mysql_enum_values($con,$tableName,$fieldName)
{
	$result = $con->query("DESCRIBE $tableName;");
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{	
		//ereg('^([^ (]+)(\((.+)\))?([ ](.+))?$',$row['Type'],$fieldTypeSplit);\
		preg_match('/^([^ (]+)(\((.+)\))?([ ](.+))?$/i',$row['Type'],$fieldTypeSplit);
		$ret_fieldName = $row['Field'];
		$fieldType = $fieldTypeSplit[1];
		$fieldFlags = $fieldTypeSplit[5];
		$fieldLen = $fieldTypeSplit[3];
	
		if (($fieldType=='enum' || $fieldType=='set') && ($ret_fieldName==$fieldName) )
		{
			$fieldOptions = explode("','",substr($fieldLen,1,-1));
			$array = array();
			
			foreach($fieldOptions as $key => $value){
				$valuetrans = $value; //hier vertaal array maken if taal = engels
				$array[$value] = $valuetrans;
			}
			return $array;
		}
	}
	return FALSE;
}

function loadMailbox($id,$prof){
	global $con;
	$array = array();
	
	$page = "0";
	$limit = "10";
	if($prof == 'outbox') {
		$veld = 'a.verzender_id';
	} 
	else {
		$veld = 'b.ontvanger_id';
	}
		 
	$query = $con->query("SELECT a.onderwerp FROM berichten AS a, berichten_ontvangers AS b, leden AS c WHERE a.bericht_id = b.bericht_id AND a.verzender_id = c.leden_id AND ".$veld." = '".$_SESSION['user']['id']."' AND b.verwijderd = '0' GROUP BY a.bericht_id");
	$aantalberichten = mysqli_num_rows($query);
	if(isset($_GET['page'])) {
		$page = mysqli_escape_string($con,$_GET['page']); 
		$limitqry = $limit * $page .",". $limit;
	} 
	else {
		$limitqry = $limit;
	}
	
	if(($limit * $page) < ($aantalberichten - $limit)) {
		$nxtpage = $page+1;
		$array['volgendeurl'] = "<a href='#' class='pagenavhandler pagination' id='".$prof."' rel='".$nxtpage."'>Next &raquo;</a>";
	}
	if($page > 0) {
		$prvpage = $page-1;
		$array['vorigeurl'] = "<a href='#' class='pagenavhandler pagination' id='".$prof."' rel='".$prvpage."'>Prev &laquo;</a>";
	}

	$wpqry = $con->prepare("SELECT a.onderwerp,a.omschrijving,a.bericht_id,b.geopend,c.leden_id,c.foto,c.profielnaam,DATE_FORMAT(datumtijd,'%d-%m-%Y %H:%m') AS ontvangst FROM berichten AS a, berichten_ontvangers AS b, leden AS c WHERE a.bericht_id = b.bericht_id AND a.verzender_id = c.leden_id AND $veld = ? AND b.verwijderd = '0' GROUP BY a.bericht_id ORDER BY a.datumtijd DESC LIMIT $limitqry");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->bind_result($onderwerp,$omschrijving,$bericht_id,$geopend,$leden_id,$foto,$profielnaam,$ontvangst);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			if(strlen($onderwerp) > 40){
				$array['onderwerp'][$bericht_id] = substr(stripslashes($onderwerp),0,38).'..';
			} else {
				$array['onderwerp'][$bericht_id] = stripslashes($onderwerp);
			}
			if(strlen($omschrijving) > 40){
				$array['omschrijving'][$bericht_id] = strip_tags(substr(stripslashes($omschrijving),0,38).'..');
			} else {
				$array['omschrijving'][$bericht_id] = strip_tags(stripslashes($omschrijving));
			}
			if(strlen($profielnaam) > 27){
				$profielnaam = substr($profielnaam,0,25).'..';
			}
			$array['gelezen'][$bericht_id] = $geopend;
			$array['leden_id'][$bericht_id] = $leden_id;
			$array['profielnaam'][$bericht_id] = stripslashes($profielnaam);
			$array['foto'][$bericht_id] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
			$array['url'][$bericht_id] = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($profielnaam);
			$array['ontvangen'][$bericht_id] = $ontvangst;
		}
	}
	$wpqry->close();
	return $array;

}	
function loadBericht($id,$prof){
	global $con;
	$array = array();
	
	if($prof == 'outbox') {
		$veld = 'a.verzender_id';
	} 
	else {
		$veld = 'b.ontvanger_id';
	}
	$wpqry = $con->prepare("SELECT a.onderwerp,a.omschrijving,a.bericht_id,b.geopend,c.leden_id,c.foto,c.profielnaam,DATE_FORMAT(datumtijd,'%d-%m-%Y %H:%m') AS ontvangst, (SELECT DATE_FORMAT(datumtijd,'%d-%m-%Y %H:%m') AS replydate FROM berichten AS d WHERE d.reply_id = a.bericht_id ORDER BY d.datumtijd DESC LIMIT 1), (SELECT e.bericht_id FROM berichten AS e WHERE e.reply_id = a.bericht_id ORDER BY e.datumtijd DESC LIMIT 1) FROM berichten AS a, berichten_ontvangers AS b, leden AS c WHERE a.bericht_id = b.bericht_id AND a.verzender_id = c.leden_id AND b.verwijderd = '0' AND $veld = ? AND a.bericht_id = ? GROUP BY a.bericht_id LIMIT 1");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('ii',$_SESSION['user']['id'],$id);
		$wpqry->bind_result($onderwerp,$omschrijving,$bericht_id,$geopend,$leden_id,$foto,$profielnaam,$ontvangst,$replydate,$reply_id);
		$wpqry->execute();
		$wpqry->store_result();
		$wpqry->fetch();
		$array['onderwerp'] = stripslashes($onderwerp);
		$array['omschrijving'] = nl2br(stripslashes($omschrijving));
		$array['leden_id'] = $leden_id;
		$array['profielnaam'] = stripslashes($profielnaam);
		$array['foto'] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
		$array['werkzaam'] = getWerkzaam($leden_id);
		$array['url'] = BASEHREFLN.'network/'.$leden_id.'/'.prettyUrl($profielnaam);
		$array['ontvangen'] = $ontvangst;
		$array['reply_id'] = $reply_id;
		$array['replydate'] = $replydate;
		
		if($prof != 'outbox') {
			$con->query("UPDATE berichten_ontvangers SET geopend = '1' WHERE bericht_id = '$id' and ontvanger_id = '".$_SESSION['user']['id']."' LIMIT 1");
		}
		
		$ontvangers = '';
		$qry = $con->query("SELECT a.ontvanger_id,b.profielnaam FROM berichten_ontvangers AS a, leden AS b WHERE a.ontvanger_id = b.leden_id AND a.bericht_id = '$id'");
		while($r = mysqli_fetch_assoc($qry)){
			$lid = $r['ontvanger_id'];
			$ontvangernaam = stripslashes($r['profielnaam']);
			if($lid != $_SESSION['user']['id']){
				$ontvangers .= "<a href='".BASEHREFLN.'network/'.$r['ontvanger_id'].'/'.prettyUrl($r['profielnaam'])."'>$ontvangernaam</a>, ";
			} else {
				$ontvangers .= $ontvangernaam.', ';
			}
		}
		$array['ontvangers'] = substr($ontvangers,0,-2);
		
	}
	$wpqry->close();
	
	
	
	return $array;
}	


function leeftijdsgroep($gebdatum){
	
	list($y,$m,$d) = explode("-",$gebdatum);
    $age = date('Y')-$y;
	if(date('md')<$m.$d){
		$age--;
	}
	if($age < 15){
		$lgt = '-15';
	}
	else if($age >= 60){
		$lgt = '60+';
	}
	else{	
		$calcage = $age;
		$a = substr($age,1,1);
		if($a <= 4){
			$calcage -= $a;
			$calcagetop = $calcage +4;
		} else {
			$calcage = ($calcage - $a) + 5;
			$calcagetop = $calcage + 4;
		}
		$lgt = $calcage.'-'.$calcagetop;
	}
	return $lgt;
}



function Profile($id){
	global $con;
	$array = array();
	$wpqry = $con->prepare("SELECT a.voornaam,a.achternaam,a.stad,b.land,a.link1,a.profielnaam,a.foto,c.taal,a.emailadres,a.link1,a.land_id,a.taal_id,a.geboortedatum,a.geboortedatum_in_profiel,telefoon,adres,postcode,nationaliteit,burgelijkestaat,tonen_in_profiel,type_profiel,geslacht,titulatuur,omschrijving,interesses,skills,overige,prov_id
	FROM leden AS a LEFT JOIN landen AS b ON a.land_id = b.land_id LEFT JOIN talen AS c ON a.taal_id = c.taal_id WHERE a.leden_id = ? LIMIT 1;");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->bind_result($voornaam,$achternaam,$stad,$land,$link1,$profielnaam,$foto,$taal,$emailadres,$link1,$land_id,$taal_id,$geboortedatum,$geboortedatum_in_profiel,$telefoon,$adres,$postcode,$nationaliteit,$burgelijkestaat,$tonen_in_profiel,$type_profiel,$geslacht,$titulatuur,$omschrijving,$interesses,$skills,$overige,$prov_id);
		$wpqry->execute();
		$wpqry->store_result();
		$wpqry->fetch();
		$array['stad'] = stripslashes($stad);
		$array['land'] = stripslashes($land);
		$array['taal'] = stripslashes($taal);
		$array['geboortedatum'] = stripslashes($geboortedatum);
		$array['voornaam'] = stripslashes($voornaam);
		$array['telefoon'] = stripslashes($telefoon);
		$array['adres'] = stripslashes($adres);
		$array['postcode'] = stripslashes($postcode);
		$array['nationaliteit'] = stripslashes($nationaliteit);
		$array['burgelijkestaat'] = stripslashes($burgelijkestaat);
		$array['achternaam'] = stripslashes($achternaam);
		$array['emailadres'] = stripslashes($emailadres);
		$array['tonen_in_profiel'] = stripslashes($tonen_in_profiel);
		$array['type_profiel'] = stripslashes($type_profiel);
		$array['geslacht'] = stripslashes($geslacht);
		$array['titulatuur'] = stripslashes($titulatuur);
		$array['omschrijving'] = stripslashes($omschrijving);
		$array['interesses'] = stripslashes($interesses);
		$array['skills'] = stripslashes($skills);
		$array['overige'] = stripslashes($overige);
		$array['prov_id'] = stripslashes($prov_id);
		$array['foto'] = BASEHREF.'upload/leden/profiel/midden/'.stripslashes($foto);
		
		$link1 = stripslashes($link1);
		if(!strstr($link1,'http://')){
			$link1 = 'http://'.$link1;
		}
		$array['linkedit'] = $link1;
		if($link1 != 'http://'){
			$array['link1'] = '<a href="'.$link1.'" target="_blank">'.$link1.'</a>';
		} else {	
			$array['link1'] = '';
		}
		
		if($emailadres != ''){
			$array['emaillink'] = '<a href="mailto:'.$emailadres.'">'.$emailadres.'</a>';
		} else {	
			$array['emaillink'] = '';
		}
		
		$array['land_id'] = stripslashes($land_id);
		$array['taal_id'] = stripslashes($taal_id);
		$array['geboortedatum'] = dateRewrite($geboortedatum);
		$array['geboortedatum_in_profiel'] = $geboortedatum_in_profiel;
		$array['ltg'] = leeftijdsgroep($geboortedatum);
	}
	$wpqry->close();
	
	//prof
	$wpqry = $con->prepare("SELECT profiel_fowid,bedrijf,functie,website,vandatum,totdatum,branche$_SESSION[lndb],a.branche_id, b.branche_gid,omschrijving FROM leden_profiel_fow AS a LEFT JOIN branches AS b ON a.branche_id = b.branche_id WHERE leden_id = ?  GROUP BY profiel_fowid ORDER BY vandatum DESC;");
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->bind_result($profiel_fowid,$bedrijf,$functie,$website,$vandatum,$totdatum,$branche,$branche_id,$branche_gid,$omschrijving);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			if($wpqry->num_rows > 0){
				$array['bedrijf'][$profiel_fowid] = stripslashes($bedrijf);
				$array['functie'][$profiel_fowid] = stripslashes($functie);
				$array['startdatum'][$profiel_fowid] = dateRewrite($vandatum);
				$array['einddatum'][$profiel_fowid] = dateRewrite($totdatum);	
				if(!strstr($website,'http://')){
					$website = 'http://'.$website;
				}
				$array['website'][$profiel_fowid] = stripslashes($website);	
				if($website != 'http://'){
					$array['websitelink'][$profiel_fowid] = '<a href="'.$website.'" target="_blank">'.$website.'</a>';
				} else {
					$array['websitelink'][$profiel_fowid] = '';
				}
				$array['branche'][$profiel_fowid] = stripslashes($branche);	
				$array['branche_id'][$profiel_fowid] = stripslashes($branche_id);	
				$array['branche_gid'][$profiel_fowid] = stripslashes($branche_gid);					
				$array['promschrijving'][$profiel_fowid] = stripslashes($omschrijving);	
			}	
		}
	}
	$wpqry->close();
	
	//studie
	$wpqry = $con->prepare("SELECT profiel_sid,a.studiefase_id,a.studie_id,a.studierichting_did,studienaam,school,website,vandatum,totdatum,omschrijving,b.studie$_SESSION[lndb], c.fase, d.richtingdetail$_SESSION[lndb],d.studierichting_id 
	FROM leden_profiel_student AS a, studies AS b, studies_fase AS c, studies_studierichting_detail d 
	WHERE leden_id = ? AND a.studie_id = b.studie_id AND a.studiefase_id = c.studiefase_id AND a.studierichting_did = d.studierichting_did 
	GROUP BY profiel_sid ORDER BY vandatum DESC;");
	echo mysqli_error($con);
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->bind_result($profiel_sid,$studiefase_id,$studie_id,$studierichting_did,$studienaam,$school,$website,$vandatum,$totdatum,$omschrijving,$studie,$fase,$richting,$studierichting_id);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			if($wpqry->num_rows > 0){			
				$array['studie_id'][$profiel_sid] = $studie_id;
				$array['studiefase_id'][$profiel_sid] = $studiefase_id;
				$array['studierichting_id'][$profiel_sid] = $studierichting_id;
				$array['studierichting_did'][$profiel_sid] = $studierichting_did;
				$array['studienaam'][$profiel_sid] = stripslashes($studienaam);
				$array['school'][$profiel_sid] = stripslashes($school);
				$array['ststartdatum'][$profiel_sid] = dateRewrite($vandatum);
				$array['steinddatum'][$profiel_sid] = dateRewrite($totdatum);	
				if(!strstr($website,'http://')){
					$website = 'http://'.$website;
				}
				$array['stwebsite'][$profiel_sid] = stripslashes($website);		
				if($website != 'http://'){
					$array['stwebsitelink'][$profiel_sid] = '<a href="'.$website.'" target="_blank">'.$website.'</a>';
				} else {
					$array['stwebsitelink'][$profiel_sid] = '';
				}
				$array['stomschrijving'][$profiel_sid] = stripslashes($omschrijving);	
				$array['studie'][$profiel_sid] = stripslashes($studie);	
				$array['fase'][$profiel_sid] = stripslashes($fase);	
				$array['richting'][$profiel_sid] = stripslashes($richting);				
			}	
		}
	}
	$wpqry->close();
	
	//opleiding
	$wpqry = $con->prepare("SELECT profiel_oid,a.land_id,a.studierichting_id,a.studierichting_did,school,graad,vandatum,totdatum,
	opleidingnaam,omschrijving,b.land,c.studierichting$_SESSION[lndb],d.richtingdetail$_SESSION[lndb] 
	FROM leden_profiel_opleiding AS a, landen AS b, studies_richting AS c, studies_studierichting_detail AS d
	WHERE leden_id = ? AND a.land_id = b.land_id AND a.studierichting_id = c.studierichting_id AND a.studierichting_did = d.studierichting_did GROUP BY profiel_oid ORDER BY vandatum DESC;");
	echo mysqli_error($con);
	if ($wpqry === false) {
		echo  ALGEMEEN_FOUT_SQL;
	} 
	else{
		$wpqry->bind_param('i',$id);
		$wpqry->bind_result($profiel_oid,$land_id,$studierichting_id,$studierichting_did,$school,$graad,$vandatum,$totdatum,$opleidingnaam,$omschrijving,$land,$studiegroep,$studierichting);
		$wpqry->execute();
		$wpqry->store_result();
		while($wpqry->fetch()){
			if($wpqry->num_rows > 0){	
				$array['opschool'][$profiel_oid] = stripslashes($school);
				$array['opland_id'][$profiel_oid] = stripslashes($land_id);
				$array['opgraad_id'][$profiel_oid] = stripslashes($graad);
				$array['opstudierichting_id'][$profiel_oid] = stripslashes($studierichting_id);
				$array['opstudierichting_did'][$profiel_oid] = stripslashes($studierichting_did);
				$array['opstartdatum'][$profiel_oid] = dateRewrite($vandatum);
				$array['opeinddatum'][$profiel_oid] = dateRewrite($totdatum);	
				$array['opland'][$profiel_oid] = stripslashes($land);	
				$array['opleidingnaam'][$profiel_oid] = stripslashes($opleidingnaam);	
				$array['opomschrijving'][$profiel_oid] = stripslashes($omschrijving);		
				$array['opstudierichting'][$profiel_oid] = stripslashes($studierichting);
				$array['opstudiegroep'][$profiel_oid] = stripslashes($studiegroep);
			}	
		}
	}
	$wpqry->close();
	return $array;
}

function isfriend($leden_id){
	global $con;
	$isvriend = 'nee';
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] != ''){
		list($vriend) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM vrienden WHERE leden_id = '$leden_id' AND vriend_id = '".$_SESSION['user']['id']."' LIMIT 1"));
		if($vriend > 0){
			$isvriend = 'ja';
		}
		else{
			list($vriend2) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM vrienden_verzoek WHERE leden_id = '$leden_id' AND vriend_id = '".$_SESSION['user']['id']."' AND (status = 'goedgekeurd' OR status = 'open') LIMIT 1"));
			if($vriend2 > 0){
				$isvriend = 'ja';
			}
			else{
				list($vriend3) = mysqli_fetch_array($con->query("SELECT COUNT(*) FROM vrienden_verzoek WHERE leden_id = '".$_SESSION['user']['id']."' AND vriend_id = '$leden_id' AND (status = 'goedgekeurd' OR status = 'open') LIMIT 1"));
				if($vriend3 > 0){
					$isvriend = 'ja';
				}
			}
		}
	}
	return $isvriend;
}

function maakPdf($type){
	require_once('pdf/config/lang/eng.php');
	require_once('pdf/tcpdf.php');
	
	class MYPDF extends TCPDF {
	
		public function Header() {
			
			$this->Cell(0, 10, 'CV '.$_SESSION['user']['naam'], 0, false, 'L', 0, '', 0, false, 'T', 'M');
			$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		}
	
		public function Footer() {
			$this->SetY(-15);
			$this->Cell(0, 10, DATUM.': '.date("d").' '.maand(date("m")).' '.date("Y"), 0, false, 'L', 0, '', 0, false, 'T', 'M');
			$this->SetXY(135, 270);
			$this->Image(BASEHREF.'images/footerlogo.jpg', '', '', '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);	
		}
	}

	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	switch($type) {
		case 'cv': 
			global $va; //vacature
			$mp = Profile($_SESSION['user']['id']); 
			$pdfname = 'upload/leden/cv/CV_'.substr(md5($mp['voornaam']),5,5).substr(md5($va['titel']),5,5).$_SESSION['user']['id'].'.pdf';
			$pdf->AddPage();
			$html = '
			<table cellspacing="0" cellpadding="1" border="0">
			<tr>
				<td width="630">
					'.FUNCTIE.': <b>'.$va['titel'].'</b><br>
					'.TYPE.': <b>'.$va['time'].'</b><br>
					'.BEDRIJF.': <b>'.$va['bedrijfsnaam'].'</b><br>
					'.INGANGSDATUM.': <b>'.$va['ingangsdatum'].'</b><br>
				</td>
			</tr>
			<tr>
				<td width="230"><img src="'.$mp['foto'].'"/></td>
				<td width="400">
					<font size="16">'.$mp['voornaam'].'&nbsp;'.$mp['achternaam'].'</font><br>'
					.substr($mp['geboortedatum'],0,2)." ".maand(substr($mp['geboortedatum'],3,2))." ".substr($mp['geboortedatum'],6,4).'<br>'
					.$mp['nationaliteit'].',&nbsp;'.$mp['burgelijkestaat'].'<br>
					<br>
					<img src="'.BASEHREF.'images/cv_home.jpg"/> &nbsp; '.$mp['adres'].',&nbsp;'.$mp['postcode'].',&nbsp;'.$mp['stad'].'<br>
					<img src="'.BASEHREF.'images/cv_telefoon.jpg"/> &nbsp; '.$mp['telefoon'].'<br>
					<img src="'.BASEHREF.'images/cv_email.jpg"/> &nbsp; '.$mp['emaillink'].'<br>';
					
					if($mp['link1'] != '') {
						$html .= '<img src="'.BASEHREF.'images/cv_website.jpg"/> &nbsp; '.$mp['link1'];
					}
					
					$html .= '
				</td>
			</tr>
			<tr>
				<td width="630">&nbsp;</td>
			</tr>
			<tr>
				<td width="230">'.MOTIVATIE.'</td>
				<td width="400">'.$_POST['motivatie'].'<br></td>
			</tr>
			<tr>
				<td width="230">'.PROFIELSAMENVATTING.'</td>
				<td width="400">'.$mp['omschrijving'].'<br></td>
			</tr>
			<tr>
				<td width="230">'.SKILLS.'</td>
				<td width="400">'.$mp['skills'].'<br></td>
			</tr>
			</table>';
			
			$html2 = '<table cellspacing="0" cellpadding="1" border="0">';
			if((isset($mp['studienaam']) && !empty($mp['studienaam'])) || (isset($mp['opschool']) && !empty($mp['opschool']))){
				$html2 .= '
				<tr>
					<td width="230">'.STUDIEACHTERGROND.'</td>
					<td width="400">';
					
					if(isset($mp['studienaam']) && !empty($mp['studienaam'])) {
						foreach($mp['studienaam'] as $key => $val){ 
							$html2 .= substr($mp['ststartdatum'][$key],3,2).'/'.substr($mp['ststartdatum'][$key],6,4).' - ';
							if($mp['steinddatum'][$key] == '00-00-0000') {
								$html2 .= HEDEN.'<br>';
							} else {
								$html2 .= substr($mp['steinddatum'][$key],3,2).'/'.substr($mp['steinddatum'][$key],6,4).'<br>';
							}
							$html2 .= $mp['fase'][$key].' - '.$mp['studienaam'][$key].'<br>';
							$html2 .= $mp['school'][$key].' ('.$mp['studie'][$key].')<br>';
							if($mp['stomschrijving'][$key] != '') {
								$html2 .= $mp['stomschrijving'][$key].'<br>';
							}
							if($mp['stwebsitelink'][$key] != '') {
								$html2 .= $mp['stwebsitelink'][$key].'<br>';
							}
							$html2 .= '<br>';
						}
					}
					
					if(isset($mp['opschool']) && !empty($mp['opschool'])) {
						foreach($mp['opschool'] as $key => $val){ 
							$html2 .= substr($mp['opstartdatum'][$key],3,2).'/'.substr($mp['opstartdatum'][$key],6,4).' - ';
							if($mp['opeinddatum'][$key] == '00-00-0000') {
								$html2 .= HEDEN.'<br>';
							} else {
								$html2 .= substr($mp['opeinddatum'][$key],3,2).'/'.substr($mp['opeinddatum'][$key],6,4).'<br>';
							}
							$html2 .= $mp['opleidingnaam'][$key].' ('.$mp['opgraad_id'][$key].')<br>';
							$html2 .= $mp['opschool'][$key].'<br>';
							if($mp['opomschrijving'][$key] != '') {
								$html2 .= $mp['opomschrijving'][$key].'<br>';
							}
							$html2 .= '<br>';
						}
					}
								
				$html2 .= '
					</td>
				</tr>';
			}


			if(isset($mp['bedrijf']) && !empty($mp['bedrijf'])){
				$html2 .= '
				<tr>
					<td width="230">'.WERKERVARING.'</td>
					<td width="400">';
					
					foreach($mp['bedrijf'] as $key => $val){ 
						$html2 .= substr($mp['startdatum'][$key],3,2).'/'.substr($mp['startdatum'][$key],6,4).' - ';
						if($mp['einddatum'][$key] == '00-00-0000') {
							$html2 .= HEDEN.'<br>';
						} else {
							$html2 .= substr($mp['einddatum'][$key],3,2).'/'.substr($mp['einddatum'][$key],6,4).'<br>';
						}
						$html2 .= $mp['functie'][$key].'<br>';
						$html2 .= $mp['bedrijf'][$key].'<br>';
						if($mp['promschrijving'][$key] != '') {
							$html2 .= $mp['promschrijving'][$key].'<br>';
						}
						if($mp['websitelink'][$key] != '') {
							$html2 .= $mp['websitelink'][$key].'<br>';
						}
						$html2 .= '<br>';
					}
								
				$html2 .= '
					</td>
				</tr>';
			}

			$html2 .= '
			<tr>
				<td width="230">'.INTERESSESPASSIE.'</td>
				<td width="400">'.$mp['interesses'].'<br></td>
			</tr>
			<tr>
				<td width="230">'.OVERIGE.'<br><font size="10">'.TALENETC.'</font></td>
				<td width="400">'.$mp['overige'].'<br></td>
			</tr>
			</table>';
		break;
	}
	
	$pdf->writeHTML($html);
	$pdf->AddPage();
	$pdf->writeHTML($html2);
	$pdf->Output($pdfname, 'F');
	return $pdfname;
}

function validateUser($username,$password){
	global $con;
	list($leden_id, $profielnaam, $foto, $registration_steps, $actief) = mysqli_fetch_array($con->query("SELECT leden_id,profielnaam,foto,registration_steps,actief FROM leden WHERE emailadres='$username' AND password='$password' AND geblokkeerd = '0' LIMIT 1"));
	$memberid = stripslashes($leden_id);
	$profielnaam = stripslashes($profielnaam);
	$foto = stripslashes($foto);
	$regisration_steps = stripslashes($registration_steps);
	$actief = stripslashes($actief);
	
	if($memberid=='') {
		$return = 0;
	}else{
		if($memberid!=''){
			if($actief==0 && $registration_steps==2){
				$_SESSION['user']['smlogin'] = 0;
				$_SESSION['user']['nr_id'] = $leden_id;
				$return = 2;
			}else if($actief==0 && $registration_steps==3){
				$_SESSION['user']['smlogin'] = 0;
				$_SESSION['user']['nr_id'] = $leden_id;
				$return = 3;
			}else{
				$_SESSION['nieuwlid_id'] = $leden_id; 	
				$_SESSION['user']['id'] = $leden_id;
				$_SESSION['user']['email'] = $username;
				$_SESSION['user']['steps'] = $registration_steps;
				$_SESSION['user']['naam'] = ucfirst(stripslashes($profielnaam));
				$_SESSION['user']['foto'] = BASEHREF.'upload/leden/profiel/klein/'.stripslashes($foto);
				$_SESSION['autologedin'] = true;
				$return = 1;
			}
		}
		return $return;
	}
}

function getProfilePicture($memberid, $type){
	global $con;
	list($gender, $foto,$ft_id,$linkedin_id,$linkedin_pic) = mysqli_fetch_array($con->query("SELECT geslacht, foto, ft_id, linkedin_id, linkedin_pic FROM leden WHERE leden_id='$memberid'"));
	$foto = stripslashes($foto);
	$pos = strpos($foto, "noimage");
	if ($pos!==false) {
		$foto = "noimage.jpg";
	}
	
	//Fix if woman
	if(strpos($gender, "vrouw") !== false){
	$place = 'womanplace.png';	
	}else{
	$place = 'manplace.png';	
	}
	
	if($foto!='noimage.jpg'){
		$profilepic = BASEHREF."upload/leden/profiel/midden/".$foto;
		$smallpic = BASEHREF. "upload/leden/profiel/klein/".$foto;
	}else{
		if($ft_id>0){
			$smallpic = "https://graph.facebook.com/".$ft_id."/picture?width=50&height=50";
			$profilepic = "https://graph.facebook.com/".$ft_id."/picture?width=210&height=160";
		}else if($linkedin_pic!=NULL){
			$smallpic = $linkedin_pic;
			$profilepic = $linkedin_pic;
		}else{
			$profilepic = BASEHREF."newhome/img/icons/".$place;
			$smallpic= BASEHREF."newhome/img/icons/".$place;
		}
	}
	
	if($type=='small')
		return $smallpic;
	else{
		return $profilepic;	
	}
}

function getActivePicId($memberid){
	global $con;
	$activeid = 0;
	list($foto,$ft_id,$linkedin_id) = mysqli_fetch_array($con->query("SELECT foto, ft_id, linkedin_id FROM leden WHERE leden_id='$memberid'"));
	$foto = stripslashes($foto);
	$pos = strpos($foto, "noimage");
	if ($pos!==false) {
		$foto = "noimage.jpg";
	}
	
	if($foto!='noimage.jpg'){
		$activeid = 1;
	}else{
		if($ft_id>0){
			$activeid = 2;
		}else if($linkedin_id!=NULL){
			$activeid = 3;
		}
	}
	
	return $activeid;
}


// function to encrypt a string
function encryptstring($str){
	$key = "s8XV8bp5iJ";
	$encrypted = openssl_encrypt($str, 'blowfish', $key);
	return $encrypted;
}

function decryptstring($encryptstring){
	$encryptstring = $encryptstring."==";
	$key = "s8XV8bp5iJ";
	$decrypted = openssl_decrypt($encryptstring, 'blowfish', $key);
	return $decrypted;
}

function getFeaturedArticles(){
	global $con;
	$featured_articles = array();
	$query = "SELECT a.titel, a.inleiding, a.foto, a.research_artikel_id, a.research_categorie_id, b.sort_order FROM research_artikelen as a, featured_articles as b WHERE a.research_artikel_id=b.article_id ORDER BY b.sort_order asc";
	if($result=mysqli_query($con,$query)){
		$keyval = 0;
		while($obj=mysqli_fetch_object($result)){
			if($keyval==0){
				$desc = $obj->inleiding;
				if(strlen($desc)>210){
					$desc = substr($desc,0,207)."...";
				}
			}else{
				$desc = $obj->inleiding;
				if(strlen($desc)>170){
					$desc = substr($desc,0,167)."...";
				}
			}
			
			$url = getArticleUrl($obj->research_categorie_id, $obj->research_artikel_id, $obj->titel);
			$featured_articles[$keyval]['title'] = $obj->titel;
			$featured_articles[$keyval]['description'] = $desc;
			$featured_articles[$keyval]['url'] = $url;
			$featured_articles[$keyval]['foto'] = $obj->foto;
			$keyval++;
		}
	  	mysqli_free_result($result);
	}
	return $featured_articles;
}

function getArticleUrl($catid, $articleid, $title){
	global $con;
	$query = "select a.research_id, a.submenu, b.categorie from research_categorie as a, research as b where a.research_categorie_id=$catid and a.research_id=b.research_id limit 1";
	if($result=mysqli_query($con,$query)){
		$obj=mysqli_fetch_object($result);
		$submenuname = prettyUrl($obj->submenu,false);
		$catname = prettyUrl($obj->categorie,false);
	}
	$url = "nl/research/".$obj->research_id."/".$catname."/".$obj->research_id."/".$submenuname."/0/0/".$articleid."/".prettyUrl($title,true);
	
	return $url;
}

function getProjectMembers($projectid){
	global $con;
	$members="";
	$query = "select member_id from project_members where project_id=$projectid";
	if($result=mysqli_query($con,$query)){
		while($obj=mysqli_fetch_object($result)){
			$members=$members.",".$obj->member_id;
		}
	}
	$members = ltrim($members,",");
	return $members;
}


//NEW FUNCTIONS
function link_it($message)
{
	global $con;
    
    //Convert all urls to links
    $message = preg_replace('#([\s|^])(www)#i', '$1http://$2', $message);

    $pattern = "~(?<!href=\")((?:http|https|ftp)://(?:\S*?\.\S*?))(?=\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)~i";
    $replacement = '<a href="$1" class="apura-link" target="_blank">$1</a>';


    $message = preg_replace($pattern, $replacement, $message);


    /* Convert all E-mail matches to appropriate HTML links */
    $pattern = '#([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.';
    $pattern .= '[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)#i';
    $replacement = '<a href="mailto:\\1" class="apura-link">\\1</a>';
    $message = preg_replace($pattern, $replacement, $message);
	
	
	//Do tags
	$regex = "/@apura_[0-9]*/";

	if (preg_match_all($regex, $message, $tags)) {
		
		
		foreach($tags[0] as $tag){
			//Clean stuff
			$ctag = str_replace("@apura_","", $tag);	
			
			//Get lid
			$flid = mysqli_fetch_assoc($con->query("SELECT * FROM `leden` WHERE `leden_id` = '".$ctag."'"));
			
			if($flid['profielnaam'] != ""){
				$litem = '<a href="'.BASEHREF.'nl/network/'.$flid['leden_id'].'/'.str_replace(" ","-",$flid['profielnaam']).'.html" class="profile-tagged">@'.$flid['profielnaam'].'</a>';
				
				$message = str_replace($tag, $litem, $message);
			}
			
		}
		
	}
    return $message;
}

function sendNotEmail($myaccount, $emailmember, $type){
global $con;

$not = true;

if($type != "reset-password"){
		
	//Check if user wants notifications
	$f_not = mysqli_fetch_assoc($con->query("SELECT * FROM `wall_not_emails` WHERE `leden_id` = '".$emailmember['leden_id']."' AND `type` = '".$type."'"));
								
	if($f_not['notem_id'] != ""){
		
		$not = false;
		
	}
	
}


if($not){

	if($type == "new-blog"){
	//Import stuff and set up mailer		
	require '../../newhome/core/phpmailer/PHPMailerAutoload.php';
	}else{
	//Import stuff and set up mailer		
	require '../core/phpmailer/PHPMailerAutoload.php';
	}
				
	
	if($emailmember['emailadres'] != ""){	
	
		$title = "";
		$content = "";
		
		/*
		
		//Init
		ini_set("smtp_port", "25");  
		$mail = new PHPMailer();
									
		$mail->isSMTP();                                    
		$mail->Host     = "mail.apura.org"; 
		$mail->SMTPAuth = true;                              
		$mail->Username =  "info@apura.org";                  
		$mail->Password = "infoapura77";                        
		//$mail->SMTPSecure = 'ssl'; 
		$mail->Port = "25";
		
				
		$mail->FromName = "ApuraNetworks";
		$mail->From     = "info@apura.org";       
		$mail->Subject  = "ApuraNetworks - ".$title;
		$mail->IsHTML(true);
		$mail->SMTPDebug = 1;
			
		*/					
		
		switch($type){
		
			case "new-message":
				
				$title = "Nieuw bericht";	
					
				ob_start();
				include('../emails/new-message.php');
				$content = trim(ob_get_contents());
				ob_end_clean();
			
			break;	
			
			
			case "friend-request":
				
				$title = "Nieuw vriendschapverzoek";
					
				ob_start();
				include('../emails/friend-request.php');
				$content = trim(ob_get_contents());
				ob_end_clean();
			
			break;	
			
			
			case "reset-password":
				
				$title = "Wachtwoord resetten";
					
				ob_start();
				include('../emails/forgot-passw.php');
				$content = trim(ob_get_contents());
				ob_end_clean();
			
			break;	
			
			
			case "new-blog":
				
				$title = "Nieuwe Blog";
					
				ob_start();
				include('../../newhome/emails/new-blog.php');
				$content = trim(ob_get_contents());
				ob_end_clean();
			
			break;	


			case "new-comment":
				
				$title = "Nieuwe reactie";
					
				ob_start();
				include('../../newhome/emails/new-comment.php');
				$content = trim(ob_get_contents());
				ob_end_clean();
			
			break;	
			
			
			case "new-like":
				
				$title = "Nieuwe like";
					
				ob_start();
				include('../../newhome/emails/new-like.php');
				$content = trim(ob_get_contents());
				ob_end_clean();
			
			break;	
			
		}
		
		
		$subject = "ApuraNetworks - ".$title;
		
		/*
		
		//Send stuff						
		$mail->Body = $content;
		$mail->ClearAddresses();
		$mail->AddAddress($emailmember['emailadres']);
		
		
		if($mail->Send()){
			return true;
		}else{
			return $mail->ErrorInfo;
			//return false;	
		}
		
		*/
		
		
		require_once('../../core/mail/htmlMimeMail.php');
		$mail = new htmlMimeMail5();
		
		$mail->setFrom("Apura.org <info@apura.org>");
		$mail->setSubject($subject);
		$mail->setPriority('normal');
		$mail->setHTML($content);
		$sendmail = $mail->send(array($emailmember['emailadres']));
		
		if($sendmail){
			return true;
		}else{
			return false;
		}
			
		
	
	}
	
}
	
}


function syncProjectToHolder($pid){
global $con;	
	
//GET project
$f_project = mysqli_fetch_assoc($con->query("SELECT * FROM `projects` WHERE `id` = '".$pid."'"));
$f_projectd = mysqli_fetch_assoc($con->query("SELECT * FROM `project_details` WHERE `project_id` = '".$pid."'"));

if($f_project['id'] != "" && $f_projectd['id'] != ""){
	//Init array
	$json = array();
	
	//Make project
	$projarr = array();
	$projarr['title'] = $f_project['title'];
	$projarr['short_description'] = $f_project['short_description'];
	
	//Get category
	$f_category = mysqli_fetch_assoc($con->query("SELECT * FROM `project_categories` WHERE `id` = '".$f_project['category_id']."'"));
	
	$projarr['category_id'] = $f_category['category_name'];
	
	//Get land
	$f_country = mysqli_fetch_assoc($con->query("SELECT * FROM `landen` WHERE `land_id` = '".$f_project['country_id']."'"));
	
	$projarr['country'] = $f_country['land'];
	$projarr['city'] = $f_project['city'];
	$projarr['project_pic'] = BASEHREF."projectimages/large/".$f_project['project_pic'];
	
	$projarr['target_funding'] = $f_project['rel_bedr'];
	
	$projarr['facebook_link'] = $f_project['soc_fb'];
	$projarr['linkedin_link'] = $f_project['soc_li'];
	$projarr['twitter_link'] = $f_project['soc_tw'];
	$projarr['google_link'] = $f_project['soc_go'];
	$projarr['website_link'] = $f_project['soc_web'];
	
	$projarr['description'] = $f_projectd['description'];
	
	//Make video
	if($f_projectd['videotype'] == "1"){
		//Youtube
		$projarr['video_url'] = "//www.youtube.com/embed/".$f_projectd['videoid'];
	}else if($f_projectd['videotype'] == "2"){
		//Youtube
		$projarr['video_url'] = "//player.vimeo.com/video/".$f_projectd['videoid'];
	}else{
		//NO
		$projarr['video_url'] = "null";
	}
	
	
	//Make rewards
	$rewarr = array();
	
	$g_rewards = $con->query("SELECT * FROM `project_perks` WHERE `project_id` = '".$f_project['id']."'");
	while($f_rewards = mysqli_fetch_array($g_rewards)){
		$perkarr = array();
			
		$perkarr['title'] = "PERK TITLE";
		$perkarr['description'] = $f_rewards['descr'];
		$perkarr['price'] = $f_rewards['amount'];
		$perkarr['price_incl_vat'] = "".$f_rewards['amount']+10.00."";
		$perkarr['price_vat'] = "10.00";
		
		//Add to rewards
		$rewarr[] = $perkarr;
	}
	
	//Make project images
	$imgarr = array();
	
	$g_images = $con->query("SELECT * FROM `project_images` WHERE `project_id` = '".$f_project['id']."'");
	while($f_images = mysqli_fetch_array($g_images)){
		$imarr = array();
		
		$imarr['image'] = BASEHREF."projectimages/large/".$f_images['project_pic'];
		
		//Add to images
		$imgarr[] = $imarr;
	}
	
	//Make project documents
	$docarr = array();
	
	$g_docs = $con->query("SELECT * FROM `project_documents` WHERE `project_id` = '".$f_project['id']."'");
	while($f_docs = mysqli_fetch_array($g_docs)){
		$darr = array();
		
		$darr['file'] = BASEHREF."projectimages/docs/".$f_docs['path'];
		
		//Add to images
		$docarr[] = $darr;
	}
	
	//Set all data together
	$json['project'] = $projarr;
	$json['rewards'] = $rewarr;
	$json['project_images'] = $imgarr;
	$json['project_documents'] = $docarr;
	
	$data_string = json_encode($json,JSON_PRETTY_PRINT);
	
	
	//die ($data_string);
	
	
	//Init CURL
	$ch = curl_init('https://projects.apura.org/api/v1/projects');   
	
	//Authentication
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, "apura:holder123!");
													
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                   
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                       
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                          
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
	//Response 
	$result = curl_exec($ch);
	
	
	return($result);
	
}else{	
	return "notfound";	
}

}


function saveDonation($json){
	global $con;
	
	//Check results, Split big things
	$donatie = $json->donatie;
	$project = $json->project;
	$token = $json->random_number;
	
	//Get stuff
	$leden_id = mysqli_real_escape_string($con, $donatie->leden_id);
	$perk_id = mysqli_real_escape_string($con, $donatie->perk_id);
	$fund_fee = mysqli_real_escape_string($con, $donatie->fund_fee);
	
	$project_id = mysqli_real_escape_string($con, $project->id);
	
	
	//Update stuff
	$member = mysqli_fetch_assoc($con->query("SELECT * FROM `leden` WHERE `leden_id` = '".$leden_id."'"));
	$project = mysqli_fetch_assoc($con->query("SELECT * FROM `projects` WHERE `id` = '".$project_id."'"));
	
	
	//Check if token is used
	$don = mysqli_fetch_assoc($con->query("SELECT * FROM `project_donateurs` WHERE `token` = '".$token."'"));
	
	
	if($project['id'] > 0 && $don['token'] == ""){
		
		//New funding
		$current_funding = number_format($project['rel_fund'], 2)+number_format($fund_fee, 2);
		
		if($member['leden_id'] > 0 || $leden_id == 0){ //PRIVATE
			
			
			//Insert as donateur
			$donate = $con->query("INSERT INTO `project_donateurs` (`project_id`, `leden_id`, `amount`, `perk_id`, `date`, `token`) VALUES ('".$project['id']."', '".$member['leden_id']."', '".$fund_fee."', '".$perk_id."', '".time()."', '".$token."')");


			//Get final count
			$rdon_fund = 0.00;
			
			$g_rdon = $con->query("SELECT * FROM `project_donateurs` WHERE `project_id` = '".$project['id']."' GROUP BY `token`");
			while($f_rdon = mysqli_fetch_assoc($g_rdon)){
				
				
				//Add
				$rdon_fund = $rdon_fund+number_format($f_rdon['amount'], 2);
			}
			
			//Update
			$current_funding = $rdon_fund;



			//Update project
			$updproj = $con->query("UPDATE `projects` SET `rel_fund` = '".$current_funding."' WHERE `id` = '".$project['id']."'");
			
			
			//Error,log
			apiLog("1","".$leden_id."","Donatie done", "".$jsonraw."");
			apiLog("1","0","Donatie done SQL", "UPDATE `projects` SET `rel_fund` = '".$current_funding."' WHERE `id` = '".$project['id']."'");
			
			
			if($member['leden_id'] != ""){
				
				//Insert as update
				$update = $con->query("INSERT INTO `wall_feed` (`leden_id`, `type`, `ctype`, `item`, `date`) VALUES 	('".$member['leden_id']."', '2', 3, '".$member['leden_id'].",".$project['id']."', '".time()."')");
			
			}
		
		}
			
	}else{
			//Error,log
			apiLog("2","".$leden_id."","Project #".$project_id." not found" ,"".$jsonraw."");
			
			
	}	
	
}
?>