<?php
$link="";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "ogn";
$password = "ogn";
$dbname = "APRSLOG";
$connAPRSLOG = new mysqli($servername, $username, $password, $dbname);
	// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 5');    
  }
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
 if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))	header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}		
header('Content-Type: application/json'); 
	
// Create connection
$dbh = new mysqli($servername, $username, $password, $dbname);

//$dbh = Database::connect();

require('aerolist.php');
date_default_timezone_set('GMT');

//ouvrebase();

$bgc=0;
$durmini = 10;		// minimum duration (in secondes) to valide a flight
$planche = array();
$p1 = array();
$p2 = array();

$afget="";
$alti="QNH";
$json=true;
$gvv="1";		//1:diplay time in hh:mm:mm  2: display time in hh.mm
$unit="M";
$units = array ("M"=>"Meters", "F"=>"Feet");
$debug="";
$torecord=false;
$datatorecord="";
$timezone=0;
$password="";
$theme=0;
$debugpw="********";

$afget="SCLC";
$date="";		// date requested in URL


if (isset($_GET['j'])) { $json=true; $gvv=$_GET['j']; } 	// output to JSON format
	
if (isset($_GET['p'])) $password=$_GET['p'];		// password
if (isset($_POST['p'])) $password=$_POST['p'];  
$timezone=-3;
$tz=$timezone*3600;		// convert the "hour" timezone in seconds  

if ($unit=="M") { 
	$affunit="m"; 
	$m2f=1;
} else {
	$unit="F";
	$affunit="ft"; 
	$m2f=1/0.3048;
}


function duree($d,$a,$f=1,$b="-----") {		// return duration between take off ($d) and landing ($a)
	if ($d!="" && $a!="" && $d!=0 && $a!=0) {
		$t= $a-$d;
		$h= intval($t/3600);
		$t=$t-($h*3600);
		$m= intval($t/60);
		$t=$t-($m*60);
		$s=$t;
		if ($f!=2) $dur=sprintf("%02dh%02dm%02ds", $h,$m,$s);
		else $dur=sprintf("%02dh%02d", $h,$m);
		} 
	else {
		if ($d==0 && $a==0) $dur=""; else $dur=$b; 
		}
	return $dur;
	}

function maxalt($flid,$deco,$att) {			// return towplane maximum altitude in meters QNH
	global $req3;
	if ($deco=="" || $att=="") return '----';
	if (!$req3->execute(array(':fid' => $flid, ':deco' => $deco, ':att' => $att)))	return 'err';
	while($ligne = $req3->fetch(PDO::FETCH_ASSOC))  {  extract($ligne); }
	return $maxalt;
}

	$airfield = $afget;
	$nomaf = $aero[$airfield][0];
	$afpw = $aero[$airfield][3];
	if ($afpw!="") {	// if a password is requested for this airfield
		if ($afpw!=crypt($password, 'GliderNetdotOrg')) exit();
		}

	$geo = $aero[$airfield][1];
	$airfieldaltitude = $aero[$airfield][2];
	$altt=$airfieldaltitude+100;		// for landing detection, to check only point between airfield altitude and 100m above



//echo round($airfieldaltitude*$m2f);

$jour=intval(substr($date,0,2));
$mois=intval(substr($date,2,2));
$annee=intval(substr($date,4,4));


		

$deb=mktime(0,0,1,$mois,$jour,$annee);			
$deb-=$tz;			// $deb is the start (midnight - time zone)
$fin=$deb+86400;	// deb +24h			$fin is the end of time interval to check


$sqlString="SELECT * from OGNDATA where $geo";


$id=$dec=$att=$mcrc="";
$envol=false;


$cptt=0;
$a_enrg=0;
	
/*$req2 = $dbh->prepare("SELECT l.pseudo,l.alt,l.tim,l.vit,l.type,l.crc,l.fid,d.dev_accn as ccn,d.dev_actype as model
FROM OGNDATA AS l
LEFT JOIN devices AS d ON l.fid = d.dev_id
WHERE (l.tim BETWEEN $deb AND $fin ) AND $geo ORDER BY l.fid,l.tim;");
	
$req2->execute();

*/

echo $sqlString;
$req2 = $connAPRSLOG->query($sqlString);

while($ligne = $req2->fetch_assoc()) {
	extract($ligne);
	if ($idflarm!=$mcrc){			// if this is another aircraft
	
		if ($id!="") { // record the line
			if ($dec!="" || $att!="") {
				$ind=($dec=="")?$att:$dec;
				$ind.="+".sprintf("%06d", ++$cptt);
				if (strlen($id)>=8) $id1=$mcrc; else $id1=$id;
				$planche[$ind]=array($typ,$id1,$mod,$cn,$dec,$att,$flarmid);
			}
		}
		$id=$pseudo;
		$mod=$model;
		$typ=$type;
		$cn=$ccn;
		
		$mcrc=$crc;
		if (substr($pseudo,3)==$fid) $flarmid=""; else $flarmid=$fid;		// if aircraft in OGN database, retreive Flarm ID
		$att=$dec="";
		$a_enrg=0;
	
		if ($vit>50) $envol=true; else $envol=false;		// on the firt point, airborn status is true if speed>50km/h
	}
}
?>
