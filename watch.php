<?php 
require_once("includes/header.php"); 
require_once("includes/classes/videoPlayer.php"); 
require_once("includes/classes/videoInfoSection.php"); 
require_once("includes/classes/CommentSection.php"); 




if(!isset(($_GET["id"]))){
  echo "no url";
  exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();
?>
<script src='assets/js/videoPlayerActions.js'></script>

<div class="watchLeftColumn">

<?php
$videoPlayer = new videoPlayer($video);
  echo $videoPlayer->create(true);

$videoPlayer = new videoInfoSection($con, $video, $userLoggedInObj);
  echo $videoPlayer->create();

$CommentSection = new CommentSection($con, $video, $userLoggedInObj);
  echo $CommentSection->create();
?>
  
</div>

<div class="suggestions">
</div>



<?php require_once("includes/footer.php"); ?>
