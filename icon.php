<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$cn="00"; $c="red";
if (isset($_GET['cn'])) $cn = $_GET['cn'];
if (isset($_GET['c'])) $c = $_GET['c'];
$file="/var/www/html/node/img/icons/".$cn."-".$c.".png";

$angle=-90;
if (isset($_GET['angle'])) $angle = $_GET['angle']-90;
if($angle!=0){
	$angle=$angle*2*pi()/360;
}

if(file_exists($file)){
	header( 'Content-Type: image/png' );
	readfile($file);

}else{
	include ("imageSmoothArc.php");
	
	$image_width=32; $image_height=32;
	$txt="11";
	
	
	$image = imageCreateTrueColor($image_width, $image_height);

	$tcolor = imageColorAllocate( $image, 255,255,255);
	if($c=="red"){
		$cColor=array(255,0,0,0);
	}elseif($c=="green"){
		$cColor=array(51,153,0,0);
	}elseif($c=="yellow"){
		$cColor=array(255,255,0,0);
		$tcolor = imageColorAllocate( $image, 40,40,40);
	}elseif($c=="blue"){
		$cColor=array(0,102,255,0);
	}elseif($c=="orange"){
		$cColor=array(255,153,0,0);
	}elseif($c=="cyan"){
		$cColor=array(0, 255, 255,0);
	}elseif($c=="brown"){
		$cColor=array(128, 64, 0,0);
	}
	imagesavealpha($image, true);
	imagealphablending($image,true);
	$color = imageColorAllocate( $image, 0,0,0);

	$trans = imagecolorallocatealpha($image, 0,0,0,127);
	imagefill($image, 0, 0, $trans);

	//$tcolor = imageColorAllocate( $image, 40,40,40);
	//imagefill( $image, 0, 0, $color );
	
	//imagefilledrectangle($image, 0, 0, 249, 249, $cColor);
	
	$arrowColor = imageColorAllocate( $image, 192,192,192);
	$circleX = (16 + 16 * cos($angle));
	$circleY = (16 + 16 * sin($angle));
	
	echo $circleX;
	echo $circleY;
	$valores=array(0,0,15,0,15,15,15,0);
	$valores = array(
            16,  0,  // Point 1 (x, y)
            19,  5, // Point 2 (x, y)
            13,  5   // Point 6 (x, y)
            );
	imagefilledpolygon($image, $valores, 3, $arrowColor);
	
	imageSmoothArc ( $image, 15,15, 20,20, array(192,192,192,0),0, M_PI*2);
	imageSmoothArc ( $image, 15,15, 16,16, $cColor,0, M_PI*2);
	
	//$image=imagerotate($image, 45, 0);
	
	$text_box = imagettfbbox(8,0,"/var/www/html/node/arialbd.ttf", $cn);
	
	// Get your Text Width and Height
	$text_width = $text_box[2]-$text_box[0];
	$text_height = $text_box[7]-$text_box[1];
	
	// Calculate coordinates of the text
	$x = ($image_width/2) - ($text_width/2);
	$y = ($image_height/2) - ($text_height/2);
	
	imagettftext($image, 8, 0, $x+2, $y-1, $tcolor, "/var/www/html/node/arialbd.ttf", $cn);
	
	//imagettftext($image, 9, 0, 32, 13, $tcolor, "/var/www/html/node/arialbd.ttf", $txt);
	//imagettftext($image, 8, 0, 32, 27, $tcolor, "/var/www/html/node/arial.ttf", $txt2);
	
	imagealphablending($image, false);
	imagesavealpha($image, true);
	//header( 'Content-Type: image/png' );
	//imagePNG($image, $file);
	header( 'Content-Type: image/png' );
	imagePNG($image);
}
?>