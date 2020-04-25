<?php
define('AcessFile',TRUE);
include '../autoload.php';
use Classes\Admin;
$getadmin = new Admin;
if(isset($_POST['setLogin']))
{
    $email = $_POST['aemail'];
    $password = $_POST['password'];
    if(empty($email) || empty($password))
    {
        $errorLogin = 'Email and Password is Required';
    }else
    {
        $userdetails = $getadmin->emailavailblty($email)->fetch_assoc();
        if(!empty($userdetails))
        {
            $signin = $getadmin->signin($email,$password);
            if($signin){
                echo '<script>alert("You are Login Successfully!");
                window.location.href="'.weburl.'/admin/"
                </script>';
            }else
            {
                $errorLogin = 'Email or Password is Not Valid';

            }
        }
    }
}
if(isset($_GET['logout'])){
    $getadmin->logoutme();
    echo '<script>alert("You are Logout Successfully!");
            window.location.href="'.weburl.'/admin/"
            </script>';
}
if(isset($_POST['bsTimeenter'])){
    $time = $_POST['bs_time'];
    if($time <= 0)
    {
        $errortimer = 'BS Time needs to be more than 0';
    }else{
        $getadmin->addBsTime($time);
        echo '<script>alert("Configuration Updated Successfully!");
                window.location.href="'.weburl.'/admin/"
                </script>';
    }
}
include_once '../includes/adminheader.php';

    //check if user login then include home.php else login.php
    include_once $getadmin->session_check();

include_once '../includes/adminfooter.php';

// print_r($_SESSION);
?>