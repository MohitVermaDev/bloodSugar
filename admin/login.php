<?php
if(!defined('AcessFile')){
header('location: ./');

die();
}
?>

<section class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <h4 class="card-title text-center">Admin Login <hr></h4>
                    <form action="<?php echo weburl;?>/admin/" method="POST">
                        <div class="form-group">
                        <?php if(isset($errorLogin)){?>
                                    <div id="all-error" class="alert alert-danger"><?php echo $errorLogin;?></div>
                        <?php } ?>
                            
                                
                                    <label for="aemail">Email</label>
                                
                                    <input type="email" name="aemail" id="aemail" value="<?php if(isset($email)){ echo $email;} ?>" class="form-control" placeholder="Enter Your Email" >
                               
                        </div>
                        <div class="form-group">
                            
                                
                                    <label for="password">Password</label>
                               
                                    <input type="password" name="password" id="password" value="<?php if(isset($password)){ echo $password; } ?>" class="form-control" placeholder="Enter Password" >
                                
                        </div>
                        <div class="form-group">
                            
                                    <input type="submit" value="Login" name="setLogin" class="btn btn-dark">
                                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>