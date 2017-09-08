<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("./imageSmoothArc.php");
$cn="00"; $c="red";
$image_width=40; $image_height=40;
$fontSizeRatio=10/$image_width;
$radioExterior=($image_width-12)/2;
$radioInterior=($image_width-15)/2;
if (isset($_GET['cn'])) $cn = $_GET['cn'];
if ($cn=="") $cn="00";
$cn=right($cn,2);

function left($str, $length) {
    return substr($str, 0, $length);
}

function right($str, $length) {
    return substr($str, -$length);
}

$a=-90;
if (isset($_GET['a'])) $a = $_GET['a']-90;
$a=round($a/10)*10;

if (isset($_GET['c'])) $c = $_GET['c'];

$file="/var/www/html/node/img/icons/".$cn."_".$c."_".$a.".png";
if(file_exists($file)){
	header( 'Content-Type: image/png' );
	readfile($file);

}else{
	$imagen = imagecreatetruecolor($image_width+2,$image_height+2);
	$flecha = imagecreatetruecolor($image_width+2,$image_height+2);
	
	
	imagealphablending($imagen, TRUE);
	imagesavealpha($imagen, true);
	$trans_colour = imagecolorallocatealpha($imagen, 0, 0, 0, 127);
	imagefill($imagen, 0, 0, $trans_colour);

	imagealphablending($flecha, TRUE);
	imagesavealpha($flecha, true);
	$trans_colourFlecha = imagecolorallocatealpha($flecha, 0, 0, 0, 127);
	imagefill($flecha, 0, 0, $trans_colourFlecha);




	//imageantialias($imagen, FALSE);
	
	$cx=$image_width/2;
	$cy=$image_height/2;
	
	$x= $cx + (cos(deg2rad($a)) * $radioInterior);
	$y= $cy + (sin(deg2rad($a)) * $radioInterior);
	
	$t1x=$cx + (cos(deg2rad($a)) * ($radioInterior+8));
	$t1y=$cy + (sin(deg2rad($a)) * ($radioInterior+8));
	
	$t2x=$cx + (cos(deg2rad($a-75)) * ($radioInterior*1.0) );
	$t2y=$cy + (sin(deg2rad($a-75)) * ($radioInterior*1.0) );
	
	$t3x=$cx + (cos(deg2rad($a+75)) * ($radioInterior*1.0) );
	$t3y=$cy + (sin(deg2rad($a+75)) * ($radioInterior*1.0) );
	
	function doBreak(){echo "<br>";}
	if(1==2){
		echo sin(deg2rad(-90));
		doBreak();
		echo $x;
		doBreak();
		echo $y;
		doBreak();
		echo $radioInterior;
		doBreak();
		echo $radioExterior;
		doBreak();
		die();
	}
	$arrowColor=imagecolorallocatealpha($flecha, 255,60,60, 0); 
	imagefilledpolygon($imagen, array($t1x, $t1y, $t2x, $t2y, $t3x, $t3y), 3, $arrowColor);
	//$rotate=imagerotate($flecha, $a, imagecolorallocatealpha($flecha, 0,0,0, 127), 1);
	//die();
	imagesavealpha($flecha, true);

		
	//imageSmoothArc($imagen, $x,$y, 10,10, array(60,60,60, 0), 0,2*M_PI);
	$transparency=0;
	$tcolor = imageColorAllocate( $imagen, 255,255,255);
	if($c=="red"){
		$cColor=array(255,0,0,$transparency);
	}elseif($c=="green"){
		$cColor=array(51,153,0,$transparency);
	}elseif($c=="yellow"){
		$cColor=array(255,255,0,$transparency);
		$tcolor = imageColorAllocate( $imagen, 0,0,0);
	}elseif($c=="blue"){
		$cColor=array(0,102,255,$transparency);
	}elseif($c=="orange"){
		$cColor=array(255,153,0,$transparency);
	}elseif($c=="cyan"){
		$cColor=array(0, 255, 255,$transparency);
	}elseif($c=="brown"){
		$cColor=array(128, 64, 0,$transparency);
	}elseif($c=="gray"){
		$cColor=array(210, 210, 210,$transparency);
		$tcolor = imageColorAllocate( $imagen, 0,0,0);
	}elseif($c=="black"){
		$cColor=array(0,0,0,$transparency);
		//$tcolor = imageColorAllocate( $imagen, 40,40,40);
	}
	
	imageSmoothArc($imagen, $cx, $cy, $radioExterior*2, $radioExterior*2, array(60,60,60, 0), 0,2*M_PI); 
	imageSmoothArc($imagen, $cx, $cy, $radioInterior*2, $radioInterior*2, $cColor, 0,2*M_PI);
	
	
	//crear el triangulo de rumbo
	$triColor = imageColorAllocate( $imagen, 255,255,255);
	//imagefilledpolygon($imagen, array(9,5, 21,5, 16,0), 3, $triColor);
	
	
	
	//interponer la matricula de competicion
	$text_box = imagettfbbox(9,0,"/var/www/html/node/arialbd.ttf", $cn);
	
	// Get your Text Width and Height
	$text_width = $text_box[2]-$text_box[0];
	$text_height = $text_box[1]-$text_box[7];
	$text_width=$text_width-5;
	// Calculate coordinates of the text
	$x = ($image_width/2) - ($text_width/2);
	$y = ($image_height/2) - ($text_height/2);

	imagettftext($imagen, 9, 0, ($image_width-$text_width)/2, (($image_height-$text_height)/2)+$text_height, $tcolor, "/var/www/html/node/arialbd.ttf", $cn);
	//echo $text_width;
	//die();
	header("Content-type: image/png");
	imagepng($imagen, $file);
	imagepng($imagen);
	imagedestroy($imagen);
}
?>