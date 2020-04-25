<?php
if(!defined('AcessFile')){
header('location: ../');

die();
}
?>

<!-- Modal -->
<div class="modal fade" id="configureseet" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Configuration Settings</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo weburl;?>/admin/" method="POST">
          <?php if(isset($errortimer)) { ?>
            <div class="alert alert-danger"><?php echo $errortimer; ?></div>
          <?php } ?>
            <div class="form-group">
              <label for="">BS Time (Minutes)</label>
              <input type="number" name="bs_time" id="bs_time" value="<?php echo $getadmin->currentBsTime();?>" class="form-control" placeholder="BS Time">
            </div>
            <input type="submit" value="Submit" class="btn btn-primary" name="bsTimeenter">
        </form>
      </div>
      
    </div>
  </div>
</div>
<script>
$('#bs_time').change(function(){
  if($(this).val() <= 0)
  {
    $(this).val(1);
  }
});
</script>
<script>
  var windowURL = window.location.href;
  
   var y= $('.menu-actie a[href="'+windowURL+'"]');
       y.addClass('active');

    </script>
</body>
</html>