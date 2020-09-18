<?php
ob_start(); //Turns on output buffering 

// これで$_SESSIONを使うことができる
session_start();

date_default_timezone_set("Asia/Tokyo");

$servername = "us-cdbr-east-02.cleardb.com";
$username = "bafba681bcdc9f";
$password = "b78e28cb";

try {
    $con = new PDO("mysql:dbname=dentechno;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $con->query("SET time_zone = '+09:00'");
    $con->query("SET @@session.time_zone = '+09:00'");
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



?>
