<?php
class VideoInfoSection{
  private $con, $video, $userLoggedInObj;
  public function __construct($con, $video, $userLoggedInObj){
    $this->con = $con;
    $this->video = $video;
    $this->userLoggedInObj = $userLoggedInObj;
  }
  public function create(){
    return $this->createPrimaryInfo() . $this->createSecondaryInfo();
  }

  private function createPrimaryInfo(){

  }
  private function createSecondaryInfo(){
    
  }

}
?>