<?php
require_once("../includes/config.php");

if(isset($_POST['userTo']) && isset($_POST['userFrom'])){
  $userTo = $_POST['userTo'];
  $userFrom = $_POST['userFrom'];

  // check if the user is subbed
  $query = $con->prepare("SELECT * FROM subscribers WHERE userTO=:userTo AND userFrom=:userFrom");
  $query->bindParam("userTo", $userTo);
  $query->bindParam("userFrom", $userFrom);
  $query->execute();

  if($query->rowCount() == 0){
    // insert
    $query = $con->prepare("INSERT INTO subscribers(userTo, userFrom) VALUE(:userTo, :userFrom)");
    $query->bindParam("userTo", $userTo);
    $query->bindParam("userFrom", $userFrom);
    $query->execute();

  } else {
    // delete
    $query = $con->prepare("DELETE FROM subscribers WHERE userTO=:userTo AND userFrom=:userFrom");
    $query->bindParam("userTo", $userTo);
    $query->bindParam("userFrom", $userFrom);
    $query->execute();
  }
  // return new number of subs
  $query = $con->prepare("SELECT * FROM subscribers WHERE userTO=:userTo");
  $query->bindParam("userTo", $userTo);
  $query->execute();

  echo $query->rowCount(); 


}else {
  echo "one or more parameters are not passed into subscribe.php the file";
}
?>