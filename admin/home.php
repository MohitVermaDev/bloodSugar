<?php
if(!defined('AcessFile')){
header('location: ./');

die();
}

$alluser = $getadmin->allUsers();

$alllevels = $getadmin->allLevels();
$allPrescriptions = $getadmin->allPrescriptions();
if(isset($_POST['filterUser'])){
    $email = $_POST['email'];
    if(empty($email))
    {
        $erroremail = 'Email is Required';
    }else
    {
        $alluser = $getadmin->allUsers($email);
    }
}
if(isset($_POST['filterBS'])){
    $emailbs = $_POST['emailbs'];
    if(empty($emailbs))
    {
        $erroremailbs = 'Email is Required';
    }else
    {
        $alllevels = $getadmin->allLevels($emailbs);
    }
}
if(isset($_POST['filterPres'])){
    $file_name = $_POST['file_name'];
    if(empty($file_name))
    {
        $errorfile_name = 'File name is Required';
    }else
    {
        $allPrescriptions = $getadmin->allPrescriptions($file_name);
    }
}
?>
<section class="container mt-5">
<div class="card">

    
    <div class="card-body table-responsive">
        <h4>Users</h4>
        <hr>
        <form action="<?php echo weburl;?>/admin/" method="POST">
        <?php if(isset($erroremail)) { echo $erroremail; } ?>
            <div class="row">
                <div class="col-md-8">
                    <input type="email" name="email" id="email" value="<?php if(isset($email)){ echo $email; }?>" placeholder="Filter By Email" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="submit" value="Filter" class="btn btn-primary" style="width:100%" name="filterUser">
                </div>
            </div>
        </form>
        <br>
        <table class="table table-sm table-bordered">
            <tr>
                <th>Email</th>
                <th>Full Name</th>
            </tr>
            <?php
            if(count($alluser)>0){
                foreach($alluser as $user){?>
                <tr>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user['name'];?></td>
                </tr>
            <?php }}?>
        </table>
    </div>
</div>
<br>
<div class="card">

    
    <div class="card-body table-responsive">
        <h4>BS Level</h4>
        <hr>
        <form action="<?php echo weburl;?>/admin/" method="POST">
        <?php if(isset($erroremailbs)) { echo $erroremailbs; } ?>
            <div class="row">
                <div class="col-md-8">
                    <input type="email" name="emailbs" id="emailbs" value="<?php if(isset($emailbs)){ echo $emailbs; }?>" placeholder="Filter By Email" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="submit" value="Filter" class="btn btn-primary" style="width:100%" name="filterBS">
                </div>
            </div>
        </form>
        <br>
        <table class="table table-sm table-bordered">
            <tr>
                <th>Email</th>
                <th>SL No.</th>
                <th>BS Level</th>
                <th>Date & Time</th>
            </tr>
            <?php
            if(count($alllevels)>0){ $bs=0;
                foreach($alllevels as $levels){?>
                <tr>
                <td><?php echo $levels['email'];?></td>
                <td><?php echo ++$bs;?></td>
                <td><?php echo $levels['bs_level'];?></td>
                <td><?php echo $levels['created_at'];?></td>
                </tr>
            <?php }}?>
        </table>
    </div>
</div>

<div class="card">

    
    <div class="card-body table-responsive">
        <h4>Prescriptions</h4>
        <hr>
        <form action="<?php echo weburl;?>/admin/" method="POST">
        <?php if(isset($errorfile_name)) { echo $errorfile_name; } ?>
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="file_name" id="file_name" value="<?php if(isset($file_name)){ echo $file_name; }?>" placeholder="Filter By File Name" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="submit" value="Filter" class="btn btn-primary" style="width:100%" name="filterPres">
                </div>
            </div>
        </form>
        <br>
        <table class="table table-sm table-bordered">
            <tr>
                <th>Email</th>
                <th>SL No.</th>
                <th>File Name</th>
                <th>Description</th>
                <th>File Size</th>
                <th>Date & Time</th>
            </tr>
            <?php
            if(count($allPrescriptions)>0){ $ps=0;
                foreach($allPrescriptions as $pres){?>
                <tr>
                <td><?php echo $pres['email'];?></td>
                <td><?php echo ++$ps;?></td>
                <td><a href="<?php echo weburl;?>/prescription/<?php echo $pres['file'];?>"><?php echo $pres['file_name'];?></a></td>
                <td><?php echo $pres['description'];?></td>
                <td><?php echo formatSizeUnits($pres['file_size']);?></td>
                <td><?php echo $pres['created_at'];?></td>
                </tr>
            <?php }}?>
        </table>
    </div>
</div>
</section>