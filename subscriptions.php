<?php
require_once("includes/header.php");

if(!User::isLoggedIn()){
  header("Location: signIn.php");
}

$subscriptionsProvider = new SubscriptionsProvider($con, $userLoggedInObj);
$videos = $subscriptionsProvider->getVideos();

$videoGrid = new videoGrid($con, $userLoggedInObj);

?>

<div class="largeVideoGridContainer">
  <?php   //もしtrendingVideoがあったら
  if(sizeOf($videos) > 0) {
    echo $videoGrid->createLarge($videos, "New from your subscriptions", false);
  } else {
    echo "No trending viedos";
  }
  ?>

</div>