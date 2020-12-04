<?php
include('../Include/config.php');
include('../Include/sessions.php');
$id = $_POST['id'];

$sql = "DELETE FROM PortfolioContent WHERE id ='$id'";
$stmt = $con->prepare($sql);
$stmt->execute();

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>