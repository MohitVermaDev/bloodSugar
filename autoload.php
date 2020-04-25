<?php
if(!defined('AcessFile')){
header('location: ./');

die();
}
?>
<?php
session_start();

spl_autoload_register('myAutoloader');
function myAutoloader($className)
{
    $path = "Classes/";
    $extension = ".class.php";
    $class = str_replace("\\",'/',$className);
    // print_r($class);
    // print_r($className);
    // die();
    $fullpath = $class.$extension;
    include_once $fullpath;
}
define('weburl','http://ayurvedabliss.com.au/bloodapp');
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}
// spl_autoload_register('usersession');
// function usersession()
// {
    
// }