<?php
if(!defined('AcessFile')){
header('location: ./');

die();
}
$myBsvalues = $getuser->myBsvalues();
use Classes\Admin;
$adminClass = new Admin;
// $bslevel = 0.0;
if(isset($_POST['saveBS']))
{
    $bslevel = $_POST['bslevel'];
    if(!is_numeric($bslevel))
    {
        $errorbs = 'BS Level is Not valid '.$bslevel ;
    }else{
        $bslevel = (float)$_POST['bslevel'];
            if($bslevel >= 0 && $bslevel <= 10)
            {
                $errorbs = '';
                $myBsvaluesadd = $getuser->addBsLevels($bslevel);
                if($myBsvaluesadd)
                {
                    echo '<script> alert("BS Value Added"); location.href="'.weburl.'"</script>';
                }else
                {
                    $errorbs = 'Something Went Wrong';
                }
    
            }else{
                $errorbs = 'BS Level needs to be more the 0 and less than 10';
            }
    }
}
$getPres = $getuser->allPrescritions();

if(isset($_POST['filenameFilter'])){
    $filtername = $_POST['filtername'];
    if(empty($filtername))
    {
        $errorfilename = 'File name is Required';
    }else
    {
        $getPres = $getuser->allPrescritions($filtername);
    }
}

if(isset($_POST['savePres'])){
    
    $presDescription = $_POST['presDescription'];
    if(empty($_FILES['presFile']['name']) || empty($presDescription))
    {
        $erroruploads = 'FIle and Description is Required';
    }else
    {
        $target_dir = "prescription/";
        $file = time().$_FILES["presFile"]["name"];
        $target_file = $target_dir . basename($file);
        $filename = pathinfo($_FILES['presFile']['name'], PATHINFO_FILENAME);
        if (move_uploaded_file($_FILES["presFile"]["tmp_name"], $target_file)) {
            $filesize = filesize($target_file);
            $getuser->addPrescription($filename,$file,$filesize,$presDescription);
            header("location: ".weburl);
        } else {
            $erroruploads = 'FIle and Description is Required';
        }
    }
}


if(isset($_GET['bslevel']))
{
    $getuser->updateBsLevels();
    header('Location: '.weburl);
}
?>
<section class="container mt-5">
<div class="card">
    
<div class="card-body table-responsive">
        <h4>Blood Sugar</h4>
        <hr>
        <?php  $lasttime = $getuser->lastBsvalues(); 
       
        if(empty($lasttime)){ ?>
        <form action="<?php echo weburl;?>/" method="POST">
        <?php if(isset($errorbs)) { echo $errorbs; } ?>
            <div class="row">
                <div class="col-md-8">
                    <input type="number" step="0.01" name="bslevel" id="bslevel"  value="<?php if(isset($bslevel)){ echo $bslevel; }?>" placeholder="BS Value" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="submit" value="Save BS Value" class="btn btn-primary" style="width:100%" name="saveBS">
                </div>
            </div>
        </form>
        <?php } else
        {
            $admintime = (int)$adminClass->currentBsTime();
        $getnexttime = date('M d, Y H:i:s',strtotime($lasttime['created_at']." + $admintime minutes"));
            ?>
        <div class="alert alert-danger text-center" id="timerbs"></div>
      
        <script>
        
            // Set the date we're counting down to
            var countDownDate = new Date("<?php echo $getnexttime;?>").getTime();
           refreshIntervalId = setInterval(function() {

               
                var now = new Date().getTime();
                // console.log(now)
                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                $("#timerbs").html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(refreshIntervalId);
                    window.location.href="<?php echo weburl;?>/?bslevel=change";
                    return false;
                }
            }, 1000);

        </script>
     
        <?php } ?>

        <br>
        <table class="table table-sm table-bordered table-striped">
            <tr>
                <th>SL No.</th>
                <th>BS Level</th>
                <th>Date</th>
            </tr>
            <?php
            if(count($myBsvalues)>0){
                $i=0;
                foreach($myBsvalues as $value){?>
                <tr>
                <td><?php echo ++$i;?></td>
                <td><?php echo $value['bs_level'];?></td>
                <td><?php echo $value['created_at'];?></td>
                </tr>
            <?php }}?>
        </table>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body table-responsive">
        <h4>Prescriptions</h4>
       
            <div class="row">
                <div class="col-md-8">
                <form action="<?php echo weburl;?>/" method="POST">
                    <?php if(isset($errorfilename)) { echo $errorfilename; } ?>
            <div class="row">

                    <div class="col-md-8">
                    <input type="text" name="filtername"  id="filtername" value="<?php if(isset($filtername)){ echo $filtername; }?>" placeholder="Filter By Name" class="form-control">
                    </div>
                    <div class="col-md-4"> <input type="submit" value="Filter" class="btn btn-primary" style="width:100%" name="filenameFilter"></div>
                    </div>
                    </form>
                </div>
                <div class="col-md-4">
                <a href="#" data-toggle="modal" data-target="#addprescip" class="btn btn-dark"  style="width:100%">Add Prescription</a>
                </div>
            </div>
       <br>
        <table class="table table-striped table-bordered">
            <tr>
                <th>SL No.</th>
                <th>File Name</th>
                <th>Description</th>
                <th>File Size</th>
                <th>Date</th>
            </tr>
            <?php
            if(count($getPres)>0){
                $i=0;
                foreach($getPres as $pres){?>
                <tr>
                <td><?php echo ++$i;?></td>
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

<!-- Modal -->
<div class="modal fade" id="addprescip" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Prescription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo weburl;?>/"  method="POST" enctype="multipart/form-data">
                <?php if(isset($erroruploads)) { echo $erroruploads; } ?>
                    <div class="form-group">
                      <label for="presFile">File</label>
                      <input type="file" name="presFile" id="presFile" class="form-control" placeholder="File" >
                    </div>
                    <div class="form-group">
                      <label for="">Description</label>
                      <textarea class="form-control" name="presDescription" id="presDescription" rows="3" ><?php if(isset($presDescription)){ echo $presDescription;}?></textarea>
                    </div>
                    <input type="submit" value="Save" class="btn btn-primary" style="width:100%" name="savePres">
                </form>
            </div>
           
        </div>
    </div>
</div>