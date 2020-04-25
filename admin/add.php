<?php
define('AcessFile',TRUE);
include '../autoload.php';
use Classes\Admin;
$getadmin = new Admin;
if(!isset($_SESSION['adminid']))
{
    header('location: '.weburl);
}
include_once '../includes/adminheader.php';
if(isset($_POST['setAdd']))
{
    $aname = $_POST['aname'];
    $email = $_POST['aemail'];
    $password = $_POST['password'];
    if(empty($email) || empty($aname) || empty($password))
    {
        $errorAdd = 'Name, Email and Password is Required';
    }else
    {
        $userdetails = $getadmin->emailavailblty($email)->fetch_assoc();
        if(empty($userdetails))
        {
            $startReg = $getadmin->addAdmin($aname,$email,$password);
            if($startReg)
            {   
                echo '<script>alert("New Admin Added Successfully!");
                    window.location.href="'.weburl.'/admin/add.php"
                    </script>';
            }
            else
            {
                $errorAdd = 'Something Went Wrong';
            }
        }else
        {
            $errorAdd = 'This Email is Already Registered| Try using another Email.';
        }
    }
}
?>


<section class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <h4 class="card-title text-center">Add More Admins <hr></h4>
                    <form action="<?php echo weburl;?>/admin/add.php" method="post" id="g">
                        <div class="form-group">
                        <?php if(isset($errorAdd)){?>
                            <div id="all-error" class="alert alert-danger"><?php echo $errorAdd;?></div>
                        <?php } ?>
                            <label for="aname">Name</label>
                            <input type="text" name="aname" id="aname" value="<?php if(isset($aname)){ echo $aname;} ?>" class="form-control" placeholder="Enter Your Name" >
                        </div>
                        <div class="form-group">
                            <label for="aemail">Email</label>
                            <input type="email" name="aemail" id="aemail" value="<?php if(isset($email)){ echo $email;} ?>" class="form-control" placeholder="Enter Your Email" >
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" value="<?php if(isset($password)){ echo $password;} ?>" class="form-control" placeholder="Enter Password" >
                        </div>
                        <div class="form-group">
                            
                                    <input type="submit" value="Add" name="setAdd" class="btn btn-dark">
                                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include_once '../includes/adminfooter.php';

// print_r($_SESSION);
?>