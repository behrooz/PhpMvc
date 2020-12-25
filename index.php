<?php

$path_info = isset($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] :"/";
if($path_info != "/")
{
    $path_info =explode('/',ltrim($_SERVER["PATH_INFO"],'/'));

}

