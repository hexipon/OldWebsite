<?php

include('../Include/sessions.php');
$email = filter_var($_POST['emailAddress'], FILTER_VALIDATE_EMAIL);
if($email){
    //sent email
$to = "hexipon@gmail.com";
$subject = "Contact from Website";
$txt = $_POST['message'];
$headers = "From: $email";

mail($to,$subject,$txt,$headers);

//send confirmation
$to = $email;
$subject = "Auto confirmation";
$txt = "Your email has been sent, please wait up to a week for a response. Thank you.";
$headers = "From: hexipon@gmail.com";

mail($to,$subject,$txt,$headers);

$referer = "index.php";
}else{
$referer = "Contact.php";
    
}
header("Location: ../".$referer);
?>