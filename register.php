<?php
include('Include/sessions.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register</title>
    <meta name="keywords" content="HTML, JavaScript">
    <meta name="description" content="Sign up">
    <meta name="author" content="Dan Peverley">
    <link rel="icon" href="Images/TitleIcon.ico">
    <link rel="stylesheet" href="CSS/Template.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
  </head>
  <body>
    <header>
      <div class = "logo">
        <img id="logoImg" src="Images/Selfie.jpg" alt="Dan Peverley"></img>
        <h1>Dan Peverley</h1>
        <p>Games programmer</p>
      </div>
    </header>
    <div id="nav"> 
      <a class="active" onclick="navBarfunc()">
        Menu
      </a>
      <div id="myLinks">
        <a href="index.php">Home</a>
        <a href="Contact.php">Contact</a>
        <a href="AboutMe.php">About</a>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="login"><h1>Register</h1>
        <?php
        if(isset($_SESSION['regError'])){
          switch($_SESSION['regError']){
            case 1 :
              echo "<p class=\"error\">Invalid Email Address</p>";
            break;
            case 2 :
              echo "<p class=\"error\">Please confirm your password</p>";
            break;
            case 3 :
              echo "<p class=\"error\">Already Registered</p>";
            break;
          }
          if(isset($_COOKIE[session_name()])){
          // match PHPSESSID settings
          setcookie(session_name(), '', time()-3600, '', 'dan-p.info', 1, 1);
          // clear the Session cookie
          }
          $_SESSION = array();
          // empty the array
          session_destroy();
        }
        ?>
        <form action="process/registration.php" method="post">
        <div>
          <label for="userLogin">Email:</label>
          <input type="text" name="userLogin" id="userLogin">
        </div>
        <div>
          <label for="userName">UserName:</label>
          <input type="text" name="userName" id="userName">
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" name="password" id="password">
        </div>
        <div>
          <label for="passwordConfirm">Confirm Password:</label>
          <input type="password" name="passwordConfirm" id="passwordConfirm">
        </div>
        <div>
          <input type="submit" value="Register">
        </div>
      </form>
      <script src="Javascript/Template.js"></script>
    </body>
</html>




