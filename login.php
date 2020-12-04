<?php
include('Include/sessions.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <meta name="keywords" content="HTML, JavaScript">
    <meta name="description" content="Login">
    <meta name="author" content="Dan Peverley">
    <link rel="icon" href="Images/TitleIcon.ico">
    <link rel="stylesheet" href="CSS/Template.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
  </head>
  <body>
      <header>
          <div class = "logo">
              <img id="logoImg" src="Images/Selfie.jpg" alt="Dan Peverley">
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
      <div id="login">
        <a href="register.php"> Register</a>
      </div>
    </div>
    <div class="content">
        <!--Put all content here-->
        <div class="container">
            <div class="login"><h1>Login</h1>
            <?php
            if(isset($_SESSION['loginError'])){
                echo "<p class=\"error\">Incorrect Details</p>";
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
            <form action="process/checkLogin.php" method="post">
            <div>
                <label for="userLogin">Email:</label>
                <input type="text" name="userLogin" id="userLogin">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
    <script src="Javascript/Template.js"></script>
  </body>
</html>




