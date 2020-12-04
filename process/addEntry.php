<?php
include('../Include/config.php');
include('../Include/sessions.php');

$sql= "INSERT INTO PortfolioContent(title, subtitle, description, videoname, githublink) 
VALUES ('New Entry', 'New subtitle', 'New description', 'snake.mp4', 'Not a link')";
$stmt = $con->prepare($sql);
$stmt->execute();

header('Location: ../index.php');
?>