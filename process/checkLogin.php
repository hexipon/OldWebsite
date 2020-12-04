<?php
include('../Include/config.php');
include('../Include/sessions.php');
$userLogin = filter_var($_POST['userLogin'], FILTER_VALIDATE_EMAIL);
if($userLogin){
    // email good
    // check if in database next
    $sql= "SELECT * FROM users WHERE name = :userLogin";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':userLogin', $userLogin, PDO::PARAM_STR);
    $stmt->execute();
    $numUsers = $stmt->rowCount();
    if($numUsers == 0){
        $_SESSION['loginError'] = 1;
        $referer = "login.php";
        }else{
            $row =$stmt->fetchObject();
            $dbPasswordHash = $row->password;
            if(password_verify($_POST['password'], $dbPasswordHash)) {
                unset($_SESSION['loginError']);
                $referer = "index.php";
                if($row->rights==1){
                    $_SESSION['role'] = "admin";
                }else{
                    $_SESSION['role'] = "normal";
                }
                $_SESSION['email'] = $row->name;
                $_SESSION['userName'] = $row->username;
                $date=date('Y-m-d');
                $time=date('h:i:s');
                $sql = "UPDATE users SET lastLoginTime= '$time' WHERE name = '$userLogin'";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $sql = "UPDATE users SET lastLoginDate= '$date' WHERE name = '$userLogin'";
                $stmt = $con->prepare($sql);
                $stmt->execute();


            }else{
                $_SESSION['loginError'] = 1;
                $referer = "login.php";
            }
            
        }
        

    }else{
    // not valid email error
    $_SESSION['loginError'] = 1;
    $referer = "login.php";
    }
    header("Location: ../".$referer);
    
?>