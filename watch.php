<?php 
require_once("includes/header.php"); 
require_once("includes/classes/videoPlayer.php"); 
require_once("includes/classes/videoInfoSection.php"); 



if(!isset(($_GET["id"]))){
  echo "no url";
  exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();
?>

<div class="watchLeftColumn">

<?php
$videoPlayer = new videoPlayer($video);
  echo $videoPlayer->create(true);
?>
  
</div>

<div class="suggestions">
</div>



<?php require_once("includes/footer.php"); ?>
