<?php
include("Include/config.php");
Include('Include/sessions.php');


$output='';
$fetchPData = $con->query("SELECT title, text, location FROM aboutMe");
while($row = $fetchPData->fetchObject()){
  $title=$row->title;
  $description=$row->text;
  $location=$row->location;
  if(!isset($_SESSION['role'])){
    $output .= "<div class='portfolioEntry', style='background-color: #101010;'>
    <h1> ".$title." </h1>
    <p> ".$description." </p>
    <p> Location: ".$location." </p>
    </div>";
    }else{
      if($_SESSION['role'] != "admin")
      {
        $output .= "<div class='portfolioEntry', style='background-color: #101010;'>
        <h1> ".$title." </h1>
        <p> ".$description." </p>
        <p> Location: ".$location." </p>
        </div>";
        }else{
          $output .= "
          <form class='portfolioEntry', style='background-color: #101010;' action='process/editAboutMe.php' method='post'>
          <h1> ".$title." </h1>
          <h2> Description </h2>
          <textarea type='text' style='height:180px' name='text'>".$description."</textarea>
          <h2> Location </h2>
          <textarea type='text' name='location'>".$location."</textarea>
          <input type='submit' value='Make changes' name='upload'>
          </form>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>About me</title>
    <meta name="keywords" content="HTML, JavaScript">
    <meta name="description" content="Infomation about me">
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
      <?php print("$output") ?>
    </div>
    <script src="Javascript/Template.js"></script>
  </body>
</html>