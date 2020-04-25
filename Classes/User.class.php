<?php
namespace Classes;
if(!defined('AcessFile')){
    header('location: ../');
    
    die();
    }

use Classes\Dbcon;
class User extends Dbcon
{
    protected $newdbh;
    function __construct()
    {
        // session_start();
        $con = parent::__construct();
        $this->newdbh = $con;        
    }

    // for username availblty
    public function emailavailblty($uemail) {
       
        $result = mysqli_query($this->newdbh,"SELECT * FROM tblusers WHERE email='$uemail'");
        return $result;

    }
    public function session_check()
    {
        //check if user login then include home.php else login.php
        if(isset($_SESSION['uid']))
        {
            return 'home.php';
        }else
        {
            return 'login.php';
        }   
    }
    // Function for registration
    public function registration($fname,$uemail)
    {
        $uniqid = uniqid();
        $fname = mysqli_real_escape_string($this->newdbh,$fname);

        $uemail = mysqli_real_escape_string($this->newdbh,$uemail);

        $ret = mysqli_query($this->newdbh,"insert into tblusers(name,email,token) values('$fname','$uemail','$uniqid')");
        if($ret){
            $this->sendMail($fname,$uemail,$uniqid);

            return true;
        }
        return false;
    }
    public function sendMail($fname,$uemail,$uniqid)
    {
        
        $to = $uemail;
        $from = 'mohitverma.may0@gmail.com';
        $subject = "HTML email";

        $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>Hello ".$fname."</p>
        <a href='".weburl."?type=verification&email=".$uemail."&token=".$uniqid."'>MAil</a>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <mohitverma.may0@gmail.com>' . "\r\n";

        mail($to,$subject,$message,$headers);
        return true;
        
    }
    // Function for signin
    public function signin($uemail,$pasword)
    {
        $uemail = mysqli_real_escape_string($this->newdbh,$uemail);
        $pasword = mysqli_real_escape_string($this->newdbh,$pasword);
        $pasword = md5($pasword);
        $result = mysqli_query($this->newdbh,"select id,name,email from tblusers where email='$uemail' and password='$pasword'");
        if($result->num_rows == 1){
            $res = $result->fetch_assoc();
            $_SESSION['uid'] = $res['id'];
            $_SESSION['name'] = $res['name'];
            $_SESSION['email'] = $res['email'];
            return true;
        }
        return false;

    }
    public function logoutme()
    {
        unset($_SESSION['uid']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        return true;
    }
    public function checkUser($email,$token)
    {
        $result = mysqli_query($this->newdbh,"SELECT * FROM tblusers where email = '$email' and token = '$token'");
        return $result->fetch_assoc();
    }
    public function verifyUser($email,$token,$password)
    {
        $email = mysqli_real_escape_string($this->newdbh,$email);
        $pass = mysqli_real_escape_string($this->newdbh,$password);
        $pass = md5($pass);
        $newtoken = uniqid();
        $update= mysqli_query($this->newdbh,"UPDATE tblusers SET password = '$pass',token = '$newtoken' where email = '$email' and token = '$token'");
        if($update)
        {
            if(!isset($_SESSION['uid'])){
                $this->signin($email,$password);
            }
            return true;
        }
        return false;
    }
    public function addBsLevels($level)
    {
        $value = mysqli_real_escape_string($this->newdbh,$level);
        $id = $_SESSION['uid'];
        $cdate = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')."+5 hours +30 minutes"));
        $udate = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')."+5 hours +30 minutes"));
        $result = mysqli_query($this->newdbh,"INSERT INTO `tbl_bs`(`user_id`, `bs_level`,created_at,updated_at) VALUES ('$id','$value','$cdate','$udate')");
        if($result)
        {
            return true;
        }
        return false;
    }
    public function myBsvalues()
    {
        $id = $_SESSION['uid'];
        $result = mysqli_query($this->newdbh,"SELECT * FROM tbl_bs where user_id = '$id'");
        $results_array = [];
        while ($row = $result->fetch_assoc()) {
          $results_array[] = $row;
        }
        return $results_array;
    }
    public function lastBsvalues()
    {
        $id = $_SESSION['uid'];
        $result = mysqli_query($this->newdbh,"SELECT status,created_at FROM tbl_bs where user_id = '$id' and status = 0 ORDER BY created_at DESC LIMIT 1");
        return $result->fetch_assoc();
    }
    public function updateBsLevels()
    {
        $id = $_SESSION['uid'];
        $udate = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')."+5 hours +30 minutes"));
        $result = mysqli_query($this->newdbh,"UPDATE `tbl_bs` SET `status`=1 ,updated_at='$udate' WHERE status=0 and user_id = '$id'");
        if($result)
        {
            return true;
        }
        return false;
    }
    public function allPrescritions($name="")
    {
        $id = $_SESSION['uid'];

        if(empty($name)){

            $result = mysqli_query($this->newdbh,"SELECT * FROM tbl_prescription where user_id = '$id'");
        }else
        {
            $result = mysqli_query($this->newdbh,"SELECT * FROM tbl_prescription where user_id = '$id' and `file_name` like '%$name%'");            
        }
        $results_array = [];
        while ($row = $result->fetch_assoc()) {
          $results_array[] = $row;
        }
        return $results_array;
    }
    public function addPrescription($name,$file,$size,$des)
    {
        $name = mysqli_real_escape_string($this->newdbh,$name);
        $file = mysqli_real_escape_string($this->newdbh,$file);
        $size = mysqli_real_escape_string($this->newdbh,$size);
        $des = mysqli_real_escape_string($this->newdbh,$des);
        $id = $_SESSION['uid'];
        $result = mysqli_query($this->newdbh,"INSERT INTO `tbl_prescription`(`user_id`, `file_name`, `file_size`, `file`, `description`) 
        VALUES ('$id','$name','$size','$file','$des')");
        if($result)
        {
            return true;
        }
        return false;
    }

}