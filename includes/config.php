<?php
ob_start(); //Turns on output buffering 

// これで$_SESSIONを使うことができる
session_start();

// date_default_timezone_set("Asia/Tokyo");

// $servername = "us-cdbr-east-02.cleardb.com";
// $username = "bafba681bcdc9f";
// $password = "b78e28cb";

// try {
//     $con = new PDO("mysql:dbname=dentechno;port=3032;host=$servername", $username, $password);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    // $con->query("SET time_zone = '+09:00'");
    // $con->query("SET @@session.time_zone = '+09:00'");
// }
// catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }

// function dbConnect(){
//     $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
//     $db['dbname'] = ltrim($db['path'], '/');
//     $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
//     $user = $db['user'];
//     $password = $db['pass'];
//     $options = array(
//       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//       PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
//     );
//     $dbh = new PDO($dsn,$user,$password,$options);
//     return $dbh;
//   }


$user = "bafba681bcdc9f";

$pass = "b78e28cb";       

$dsn = "mysql:dbname=db1;port=8889;host=localhost;    charset=utf8";        

try{ 

     $dbh = new PDO($dsn, $user, $pass);           

     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);           

     $sql="SELECT * FROM recipes";          

     $stmt = $dbh->query($sql);           

     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);           

     print_r($result);       

     $dbh = null;       

}      

catch(PDOException $e){           

      echo 'Connection failed: ' . $e->getMessage();       

} 
?>
