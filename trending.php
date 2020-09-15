<?php
require_once("includes/header.php");
require_once("includes/classes/TrendingProvider.php");

$trendingProvider = new TrendingProvider($con, $userLoggedInObj);
$videos = $trendingProvider->getVideos();

$videoGrid = new videoGrid($con, $userLoggedInObj);

?>

<div class="largeVideoGridContainer">
  <?php   //もしtrendingVideoがあったら
  if(sizeOf($videos) > 0) {
    echo $videoGrid->createLarge($videos, "Trending videos uploaded in the last week", false);
  } else {
    echo "No trending viedos";
  }
  ?>

</div>