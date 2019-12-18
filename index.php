<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'node/config.php';

redirect($AppUrl."/node/ogn.desktop.php");

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   header('Access-Control-Allow-Origin: *');
   die();
}

?>
