<?php
namespace Classes;
if(!defined('AcessFile')){
    header('location: ../');
    
    die();
    }

use Classes\Dbcon;
class Admin extends Dbcon
{
    protected $newdbh;
    function __construct()
    {
        // session_start();
        $con = parent::__construct();
        $this->newdbh = $con;        
    }
    public function emailavailblty($aemail) {
       
        $result = mysqli_query($this->newdbh,"SELECT * FROM tbladmins WHERE email='$aemail'");
        return $result;
    }
    public function session_check()
    {
        //check if user login then include home.php else login.php
        if(isset($_SESSION['adminid']))
        {
            return 'home.php';
        }else
        {
            return 'login.php';
        }   
    }
    public function signin($aemail,$pasword)
    {
        $aemail = mysqli_real_escape_string($this->newdbh,$aemail);
        $pasword = mysqli_real_escape_string($this->newdbh,$pasword);
        $pasword = md5($pasword);
        $result = mysqli_query($this->newdbh,"select id,name,email from tbladmins where email='$aemail' and password='$pasword'");
        if($result->num_rows == 1){
            $res = $result->fetch_assoc();
            $_SESSION['adminid'] = $res['id'];
            $_SESSION['adminname'] = $res['name'];
            $_SESSION['adminemail'] = $res['email'];
            return true;
        }
        return false;

    }
    public function logoutme()
    {
        unset($_SESSION['adminid']);
        unset($_SESSION['adminname']);
        unset($_SESSION['adminemail']);
        return true;
    }
    public function addAdmin($name,$email,$password)
    {
        $name = mysqli_real_escape_string($this->newdbh,$name);
        $email = mysqli_real_escape_string($this->newdbh,$email);
        $password = mysqli_real_escape_string($this->newdbh,$password);
        $password = md5($password);
        $id = $_SESSION['adminid'];
        $res = mysqli_query($this->newdbh,"INSERT INTO tbladmins (admin_id,name,email,password) VALUES ('$id','$name','$email','$password')");
        if($res){
            return true;
        }
        return false;
    }
    public function currentBsTime()
    {
        $res = mysqli_query($this->newdbh,"SELECT setting_value FROM tblsettings where setting_name = 'bs_time'");
        $newres = $res->fetch_assoc();
        return $newres['setting_value'];        
    }
    public function addBsTime($time)
    {
        $id = $_SESSION['adminid'];
        $res = mysqli_query($this->newdbh,"UPDATE tblsettings SET setting_value = '$time', updated_by = '$id' where setting_name = 'bs_time'");        
        return true;
    }
    public function allUsers($email = '')
    {
        if(empty($email)){

            $result = mysqli_query($this->newdbh,"SELECT email,name FROM tblusers");
        }else
        {
            $result = mysqli_query($this->newdbh,"SELECT email,name FROM tblusers where email like '%$email%'");
            
        }
        $results_array = [];
        while ($row = $result->fetch_assoc()) {
          $results_array[] = $row;
        }
        return $results_array;
    }
    public function allLevels($email = '')
    {
        if(empty($email)){

            $result = mysqli_query($this->newdbh,"SELECT tblusers.email,tbl_bs.* FROM tbl_bs JOIN tblusers ON tblusers.id = tbl_bs.user_id");
        }else
        {
            $result = mysqli_query($this->newdbh,"SELECT tblusers.email,tbl_bs.* FROM tbl_bs JOIN tblusers ON tblusers.id = tbl_bs.user_id where email like '%$email%'");            
        }
        $results_array = [];
        while ($row = $result->fetch_assoc()) {
          $results_array[] = $row;
        }
        return $results_array;
    }
    public function allPrescriptions($file_name = '')
    {
        if(empty($file_name)){

            $result = mysqli_query($this->newdbh,"SELECT tblusers.email,tbl_prescription.* FROM tbl_prescription JOIN tblusers ON tblusers.id = tbl_prescription.user_id");
        }else
        {
            $result = mysqli_query($this->newdbh,"SELECT tblusers.email,tbl_prescription.* FROM tbl_prescription JOIN tblusers ON tblusers.id = tbl_prescription.user_id where `file_name` like '%$file_name%'");            
        }
        $results_array = [];
        while ($row = $result->fetch_assoc()) {
          $results_array[] = $row;
        }
        return $results_array;
    }
}