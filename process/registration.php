<?php
require('../Include/config.php');
require('../Include/sessions.php');
$regLogin = filter_var($_POST['userLogin'], FILTER_VALIDATE_EMAIL);
$regName = $_POST['userName'];
$regPassword = $_POST['password'];
$regPasswordConfirm = $_POST['passwordConfirm'];
if(!$regLogin){
    $_SESSION['regError'] = 1;
    $referer = "register.php";
    header("Location: ../".$referer);
    exit;
}
if($regPassword != $regPasswordConfirm || $regPassword == ""){
    $_SESSION['regError'] = 2;
    $referer = "register.php";
    header("Location: ../".$referer);
    exit;
}else{
    $sql= "SELECT * FROM users WHERE name = :userLogin";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':userLogin', $regLogin, PDO::PARAM_STR);
    $stmt->execute();
    $numUsers = $stmt->rowCount();
    if($numUsers == 1){
        $_SESSION['regError'] = 3;
        $referer = "register.php";
    }else{
        $sql= "INSERT INTO users(name, password, username)
        VALUES (:userLogin, :userPassword, :userName)";
        $stmt = $con->prepare($sql);
        $hashedPw = password_hash($regPassword, PASSWORD_BCRYPT);
        $stmt->bindParam(':userLogin', $regLogin, PDO::PARAM_STR);
        $stmt->bindParam(':userPassword', $hashedPw, PDO::PARAM_STR);
        $stmt->bindParam(':userName', $regName, PDO::PARAM_STR);
        $stmt->execute();
        if(isset($_SESSION['regError'])){
            unset($_SESSION['regError']);
        }
        $to = $regLogin;
        $subject = "Auto confirmation";
        $txt = "You have successfully signed up to Dan-p.info";
        $headers = "From: hexipon@gmail.com";
        mail($to,$subject,$txt,$headers);

        $referer = "login.php";
    }
}
header("Location: ../".$referer);
exit;  
?>