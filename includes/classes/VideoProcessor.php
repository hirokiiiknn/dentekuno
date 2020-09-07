<?php
class VideoProcessor {

    private $con;
    private $sizeLimit = 500000000;
    private $allowedTypes = array("mp4", "flv", "webm", "mkv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
    private $ffmpegPath = "ffmpeg/bin/ffmpeg";

    public function __construct($con) {
        $this->con = $con;
    }
    // ビデオをアップロードする
    public function upload($videoUploadData) {
        $targetDir = "uploads/videos/";//ビデオの保存下
        $videoData = $videoUploadData->videoDataArray;
        // 一時的な保存パス
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        //uploads/videos/5aa3e9343c9ffdogs_playing.flv
        // 空欄に＿を追加する
        $tempFilePath = str_replace(" ", "_", $tempFilePath);
        // 正しいデータかどうか
        $isValidData = $this->processData($videoData, $tempFilePath);
        if(!$isValidData) {
            return false;
        }
        // アップロードした動画を移動させる
        if(move_uploaded_file($videoData["tmp_name"], $tempFilePath)) {
            // 最後に残すファイルのパスはmp4
            $finalFilePath = $targetDir . uniqid() . ".mp4";
            // $videoUploadData, $finalFilePathを入れてデータベースに代入できなかったら、、、false
            if(!$this->insertVideoData($videoUploadData, $finalFilePath)) {
                echo "Insert query failed\n";
                return false;
            }
            // mp４に変えれなかったら、、、false
            if(!$this->convertVideoToMp4($tempFilePath, $finalFilePath)){
                echo "Upload failed\n";
                return false;
            }
            // $tempFilePathを削除できなかったら、、、false
            if(!$this->deleteFile($tempFilePath)){
                echo "Upload failed\n";
                return false;
            }
            // 上記以外はtrue
        }
    }
    
    private function processData($videoData, $filePath) {
        $videoType = pathInfo($filePath, PATHINFO_EXTENSION);
        if(!$this->isValidSize($videoData)) {
            echo "File too large. Can't be more than " . $this->sizeLimit . " bytes";
            return false;
        }
        else if(!$this->isValidType($videoType)) {
            echo "Invalid file type";
            return false;
        }
        else if($this->hasError($videoData)) {
            echo "Error code: " . $videoData["error"];
            return false;
        }
        return true;
    }

    private function isValidSize($data) {
        return $data["size"] <= $this->sizeLimit;
    }

    private function isValidType($type) {
        $lowercased = strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }
    
    private function hasError($data) {
        return $data["error"] != 0;
    }
    
    private function insertVideoData($uploadData, $filePath) {
        // データベースにバリューを代入
        $query = $this->con->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath)
                                        VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");

        $query->bindParam(":title", $uploadData->title);
        $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
        $query->bindParam(":description", $uploadData->description);
        $query->bindParam(":privacy", $uploadData->privacy);
        $query->bindParam(":category", $uploadData->category);
        $query->bindParam(":filePath", $filePath);

        return $query->execute();
    }

    
    public function convertVideoToMp4($tempFilePath, $finalFilePath){
        // ffmpegの使い方。$tempFilePathを$finalFilePathを使ってmp4に変換。
        $cmd = "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1";

        $outputLog = array();
        exec($cmd, $outputLog, $returnCode);
        if($returnCode != 0){
            foreach($outputLog as $line){
                echo $line . "<br>";
            }
            return false;
        }
        return true;
    }

    private function deleteFile($filePath){
        if(!unlink($filePath)){
            echo "Couldnt delete file\n";
            return false;
        }
        return true;
    }


}
?>