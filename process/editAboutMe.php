<?php
include('../Include/config.php');
include('../Include/sessions.php');
$text = $_POST['text'];
$location = $_POST['location'];

$sql = "UPDATE aboutMe SET text='{$text}' WHERE title ='About Me'";
$stmt = $con->prepare($sql);
$stmt->execute();
$sql = "UPDATE aboutMe SET location='$location' WHERE title ='About Me'";
$stmt = $con->prepare($sql);
$stmt->execute();

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>