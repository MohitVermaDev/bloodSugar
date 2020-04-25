<?php
define('AcessFile',TRUE);
include 'autoload.php';
use Classes\User;
$getuser = new User;
// $getuser->sendMail('Mohit','mohitverma.may0@gmail.com','dgfgd');
if(isset($_POST['setLogin']))
{
    $email = $_POST['uemail'];
    $password = $_POST['password'];
    if(empty($email) || empty($password))
    {
        $errorLogin = 'Email and Password is Required';
    }else
    {
        $userdetails = $getuser->emailavailblty($email)->fetch_assoc();

        if(!empty($userdetails))
        {
            $signin = $getuser->signin($email,$password);
            if($signin){
                echo '<script>alert("You are Login Successfully!");
                window.location.href="'.weburl.'"
                </script>';
            }else
            {
                $errorLogin = 'Something Went Wrong';
            }
        }else
        {
            $errorLogin = 'Something Went Wrong';
        }
    }
}
if(isset($_GET['logout'])){
    $getuser->logoutme();
    echo '<script>alert("You are Logout Successfully!");
            window.location.href="'.weburl.'"
            </script>';
}
include_once './includes/header.php';
if(isset($_GET['type']) && $_GET['type']=='verification')
{
    $email = $_GET['email'];
    $token = $_GET['token'];
    $verify = $getuser->checkUser($email,$token);
    if(!empty($verify))
    {
        ?>

<section class="container">
<div class="card">
  
    <div class="card-body">
    <h5 class="modal-title">Enter Password to complete your registration!</h5>

<form action="<?php echo weburl; ?>/" method="post">
 <input type="hidden" name="type" value="verify">
 <input type="hidden" name="email" value="<?php echo $email;?>">
 <input type="hidden" name="token" value="<?php echo $token;?>">
 <div class="form-group">
   <label for="newpassword">New Password</label>
   <input type="text" name="newpassword" id="newpassword" class="form-control" placeholder="Password">
 </div>
 <input type="submit" value="Submit" class="btn btn-danger">
</form>
    </div>
</div>
           
            
</section>

        <?php
    }else
    {
        echo '<script>alert("Email or Token is not valid"); location.href="'.weburl.'"</script>';
    }
}elseif(isset($_POST['type']) && $_POST['type']=='verify')
{
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['newpassword'];
    $verify = $getuser->checkUser($email,$token);
    if(!empty($verify))
    {
        $checkit = $getuser->verifyUser($email,$token,$password);
        if($checkit)
        {
            echo '<script>alert("You are Verified!"); location.href="'.weburl.'"</script>';
        }else{
        echo '<script>alert("Something Went Wrong 2!"); location.href="'.weburl.'?type=verification&email='.$email.'&token='.$token.'"</script>';

        }
    }else
    {
       
        echo '<script>alert("Something Went Wrong!"); location.href="'.weburl.'?type=verification&email='.$email.'&token='.$token.'"</script>';

    }
}
else
{

    //check if user login then include home.php else login.php
    include_once $getuser->session_check();
}
?>
<?php
include_once './includes/footer.php';

// print_r($_SESSION);
?>