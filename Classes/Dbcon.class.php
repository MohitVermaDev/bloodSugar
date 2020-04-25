<?php

namespace Classes;
    if(!defined('AcessFile')){
    header('location: ../');
    
    die();
    }
define('DB_SERVER','localhost');// Your hostname
define('DB_USER','auayurve_bloodap'); // Databse username
define('DB_PASS' ,']mIO%m;F.d#N'); // Database Password
define('DB_NAME', 'auayurve_bloodapp');// Database name
class Dbcon
{
    
    public function __construct()
    {
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            return false;
        }
        return $con;
    }
    
}
