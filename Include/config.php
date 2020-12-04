<?php

$host = "mysql:host=localhost;dbname=dan"; /* Host name */
$user = "----"; /* User */
$password = "----"; /* Password */


try{
    $con = new PDO($host, $user, $password);
    $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con ->exec("SET CHARACTER SET utf8");
}
catch (PDOException $e){
    echo 'Connection failed again: ' .$e->getMessage();
}
?>
