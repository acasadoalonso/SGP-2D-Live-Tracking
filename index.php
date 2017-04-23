<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'node/mobile.detect.php';
$detect = new Mobile_Detect;
require_once 'node/config.php';
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

if($deviceType=="phone") redirect($AppUrl."/node/ogn.phone.php");
if($deviceType!="phone") redirect($AppUrl."/node/ogn.desktop.php");

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

?>
