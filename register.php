<?php
define('AcessFile',TRUE);
include 'autoload.php';
use Classes\User;
$getuser = new User;
if(isset($_SESSION['uid']))
{
    header('location: ./');
}
include_once './includes/header.php';
if(isset($_POST['setRegister']))
{
    $uname = $_POST['uname'];
    $email = $_POST['uemail'];
    if(empty($email) || empty($uname))
    {
        $errorRegister = 'Name and Email is Required';
    }else
    {
        $userdetails = $getuser->emailavailblty($email)->fetch_assoc();
        if(empty($userdetails))
        {
            $startReg = $getuser->registration($uname,$email);
            if($startReg)
            {   
                $userdetailsnew = $getuser->emailavailblty($email)->fetch_assoc();
                // print_r($userdetailsnew);
              //  $errorRegister = 'Register Successfully : <a href='.weburl.'/?type=verification&email='.$email.'&token='.$userdetailsnew["token"].'>MAil</a>';
                echo '<script>alert("You are successfully registered, Check Your Mail to verify!");
                     window.location.href="'.weburl.'/register.php"
                    </script>';
            }else
            {
            $errorRegister = 'Something Went Wrong';
            }
        }else
        {
            $errorRegister = 'This Email is Already Registered| Try using another Email.';
        }
    }
}
?>



<section class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <h4 class="card-title text-center">Registration <hr></h4>
                    <form action="<?php echo weburl;?>/register.php" method="post">
                        <div class="form-group">
                        <?php if(isset($errorRegister)){?>
                            <div id="all-error" class="alert alert-danger"><?php echo $errorRegister;?></div>
                        <?php } ?>
                            <label for="uname">Name</label>
                            <input type="text" name="uname" id="uname" value="<?php if(isset($uname)){ echo $uname;} ?>" class="form-control" placeholder="Enter Your Name" >
                        </div>
                        <div class="form-group">
                            <label for="uemail">Email</label>
                            <input type="email" name="uemail" id="uemail" value="<?php if(isset($email)){ echo $email;} ?>" class="form-control" placeholder="Enter Your Email" >
                        </div>
                        
                        <div class="form-group">
                            
                                    <input type="submit" value="Register" name="setRegister" class="btn btn-dark" style="margin:0 auto">
                                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include_once './includes/footer.php';

// print_r($_SESSION);
?>
