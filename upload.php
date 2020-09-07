<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
?>


<div class="column">

    <?php
    $formProvider = new VideoDetailsFormProvider($con);
    echo $formProvider->createUploadForm();
    ?>


</div>

<script>
$("form").submit(function(){
    $("#loadingModal").modal("show");
});

</script>

<!-- data-backdrop="static"はmodalが出ている時にどっかおしてもそのmodalが消えないようにしていて、data-keyboard="false"はキーボードをおしてもそのmodalが消えないようにしている -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        Please wait. This might take a while.<br>
        少々お待ちください。少し時間がかかります。
        <img src="assets/images/icons/loading-spinner.gif">
      </div>
      
    </div>
  </div>
</div>


<?php require_once("includes/footer.php"); ?>
                