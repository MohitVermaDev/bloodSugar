<?php
if(!defined('AcessFile')){
header('location: ../');

die();
}
?>
<script>
  var windowURL = window.location.href;
  
   var y= $('.menu-actie a[href="'+windowURL+'"]');
       y.addClass('active');

    </script>
</body>
</html>