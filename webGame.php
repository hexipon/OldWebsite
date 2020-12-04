<?php
include("Include/config.php");
Include('Include/sessions.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Web game</title>
    <meta name="keywords" content="HTML, JavaScript">
    <meta name="description" content="Web game">
    <meta name="author" content="Dan Peverley">
    <link rel="icon" href="Images/TitleIcon.ico">
    <link rel="stylesheet" href="CSS/Template.css">
    <link rel="stylesheet" href="CSS/game">
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
        <?php
        if(!isset($_SESSION['role'])){
          echo"<a href='login.php'> Sign in</a>";
        }else{
          echo"<a href='process/logout.php'> Logout</a>";
        }
        ?>
      </div>
    </div>
    <div class="content">

      <!--Put all content here-->

    <canvas tabindex='1'></canvas>
    <script src="Javascript/game.js"></script>
      
    </div>
    <script src="Javascript/Template.js"></script>
  </body>
</html>