<?php

$path_info = isset($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] :"/";
if($path_info != "/")
{
    $path_info =explode('/',ltrim($_SERVER["PATH_INFO"],'/'));

}

//print_r($path_info);

require_once('core/InitClass.php');
$init = new InitClass();
$init->getControllerList();
$init->parseRequest($path_info);
$init->getControllerInstance('siteController');