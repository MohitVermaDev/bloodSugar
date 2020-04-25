<?php
if(!defined('AcessFile')){
header('location: ../');

die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Sugar Record &amp; Prescription Management System</title>

    <link rel="stylesheet" href="<?php echo weburl; ?>/assets/bootstrap/css/bootstrap.css">

    <script src="<?php echo weburl; ?>/assets/jquery.js"></script>
    <script src="<?php echo weburl; ?>/assets/bootstrap/js/bootstrap.js"></script>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo weburl;?>">BS App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php if(isset($_SESSION['uid'])){?>
      <li class="nav-item  menu-actie">
        <a class="nav-link" href="<?php echo weburl;?>/">My Space</a>
      </li>
    <?php } ?>
      <?php if(!isset($_SESSION['uid'])){?>
        <li class="nav-item  menu-actie">
        <a class="nav-link" href="<?php echo weburl;?>/">Login </a>
      </li>
        <li class="nav-item menu-actie">
            <a class="nav-link" href="<?php echo weburl;?>/register">Registration</a>
        </li>
      <?php } ?>
    </ul>
    <?php if(isset($_SESSION['uid'])){?>

        <form class="form-inline my-2 my-lg-0" action="<?php echo weburl;?>/">
            <input type="hidden" name="logout" value="logout">
            <button stype="submit" class="btn btn-danger">Logout</button>
        </form>
    <?php } ?>
  </div>
</nav>