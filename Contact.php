<?php
include("Include/config.php");
Include('Include/sessions.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Contact</title>
    <meta name="keywords" content="HTML, JavaScript">
    <meta name="description" content="Contact me">
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
        <?php
        if(!isset($_SESSION['role'])){
          echo"<a href='login.php'> Sign in</a>";
        }else{
          echo"<a href='webGame.php'> Play game</a>";
          echo"<a href='process/logout.php'> Logout</a>";
        }
        ?>
      </div>
    </div>
    <div class="content">

      <!--Put all content here-->

      <div class="container">
            <form action="process/email.php" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Your first name.." id="name">
                <label for="emailAddress">Email address</label>
                <?php
                if(!isset($_SESSION['email'])){
                  echo"<input type='text' name='emailAddress' placeholder='Your email address..' id='emailAddress'>";
                }else{
                  echo"<input type='text' name='emailAddress' value='".$_SESSION['email']."' id='emailAddress'>";
                }
                ?>
                <label for="message">Subject</label>
                <textarea name="message" placeholder="Reason for contacting me.." style="height:180px" id="message"></textarea>

                <input type="submit" value="Submit">
            </form>
        </div>
      
    </div>
    <script src="Javascript/Template.js"></script>
  </body>
</html>