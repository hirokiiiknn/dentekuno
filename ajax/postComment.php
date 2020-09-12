<?php
require_once("../includes/config.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])){
  $query = $con->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body) VALUES (:postedBy, :videoId, :responseTo, :body)");
  $query->bindParam(":postedBy", $postedBy);
  $query->bindParam(":videoId", $videoId);
  $query->bindParam(":responseTo", $responseTo);
  $query->bindParam(":body", $commentText);
  
  $postedBy = $_POST['postedBy'];
  $videoId = $_POST['videoId'];
  $responseTo = (int)$_POST['responseTo'];
  $commentText = $_POST['commentText'];

  $query->execute();

  // return new comment html

} else {
  echo "one or more parameters are not passed into subscribe.php the file";
}
?>