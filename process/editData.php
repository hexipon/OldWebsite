<?php
include('../Include/config.php');
include('../Include/sessions.php');
$id = $_POST['id'];
$title = $_POST['title'];
$subtitle = $_POST['subtitle'];
$description = $_POST['description'];
$githubLink= $_POST['gitHubLink'];

$sql = "UPDATE PortfolioContent SET title='$title' WHERE id ='$id'";
$stmt = $con->prepare($sql);
$stmt->execute();
$sql = "UPDATE PortfolioContent SET subtitle='$subtitle' WHERE id ='$id'";
$stmt = $con->prepare($sql);
$stmt->execute();
$sql = "UPDATE PortfolioContent SET description='$description' WHERE id ='$id'";
$stmt = $con->prepare($sql);
$stmt->execute();
$sql = "UPDATE PortfolioContent SET githublink='$githubLink' WHERE id ='$id'";
$stmt = $con->prepare($sql);
$stmt->execute();

if(isset($_POST['upload'])){
    $name = $_FILES['file']['name'];
    $target_dir = "../Videos/";
    $target_file = $target_dir . $_FILES["file"]["name"];
    $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("mp4","avi","3gp","mov","mpeg");
    if( in_array($videoFileType,$extensions_arr) ){
        if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)){
            $sql = "UPDATE PortfolioContent SET videoname='$name' WHERE id = '$id'";
            $stmt = $con->prepare($sql);
            $stmt->execute();
        }
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>