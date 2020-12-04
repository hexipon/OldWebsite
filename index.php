<?php
include("Include/config.php");
Include('Include/sessions.php');
$output='';
if(isset($_SESSION['role']))
{
  if($_SESSION['role']=="admin")
  {
    $output = " 
    <form class='portfolioEntry', style='background-color: #101010;' action='process/addEntry.php' method='post'>
    <input type='submit' value='Add Entry'>
    </form>";
  }
}
$stmt = $con->query("SELECT id, title, subtitle, description, videoname, githublink FROM PortfolioContent ORDER BY id ASC");
$num=1;
while($row = $stmt->fetchObject()){
  $id=$row->id;
  $title=$row->title;
  $subtitle=$row->subtitle;
  $videoname = $row->videoname;
  $description = $row->description;
  $githublink = $row->githublink;
  $colour = $num % 2 == 0 ? '#101010' : '#1e1e1e';
  if(!isset($_SESSION['role']))
  { 
    $output .= "<div class='portfolioEntry', style='background-color: ".$colour.";'>
    <h1> ".$title." </h1>
    <h2> ".$subtitle." </h2>
    <video src='Videos/".$videoname."' controls type='video/mp4'>Your browser does not support this video</video>
    <p> ".$description." </p>
    <a style='margin-top:10px;' href='https://".$githublink."' title='Go to link for ".$title."'> You can find this project here.</a>
    </div>";
  }else{
    if($_SESSION['role'] != "admin")
    {
      $output .= "<div class='portfolioEntry', style='background-color: ".$colour.";'>
      <h1> ".$title." </h1>
      <h2> ".$subtitle." </h2>
      <video src='Videos/".$videoname."' controls type='video/mp4'>Your browser does not support this video</video>
      <p> ".$description." </p>
      <a style='margin-top:10px;' href='https://".$githublink."' title='Go to link for ".$title."'> You can find this project here.</a>
      </div>";
    }else{
      $output .="
      <form class='portfolioEntry', style='background-color: ".$colour.";' action='process/editData.php' method='post' enctype='multipart/form-data'>
        <textarea style='display: none' name='id'>".$id."</textarea> 
        <div class='editArea1'>
          <h2> Title </h2>
          <textarea type='text' name='title'>".$title."</textarea>
          <h2> Subtitle </h2>
          <textarea type='text' name='subtitle'>".$subtitle."</textarea>
          <h2> Github Link </h2>
          <textarea type='text' name='gitHubLink'>".$githublink."</textarea>
        </div>
        <div class='editArea2'>
          <h2> Video </h2>
          <video src='Videos/".$videoname."' controls type='video/mp4'>Your browser does not support this video</video>
          <h2> Upload new video below </h2>
          <input type='file' name='file'/>
        </div>
        <div class='editArea3'>
          <h2> Description </h2>
          <textarea type='text' style='height:180px' name='description'>".$description."</textarea>
          </div>
          <div class='editArea4'>
            <input type='submit' value='Make changes' name='upload'>
        </div>
      </form>
      <form style='text-align: center; margin: 0;' action='process/deleteData.php' method='post'>
                <textarea style='display: none' name='id'>".$id."</textarea> 
                <input type='submit' value='Delete above entry'>
      </form>";
    }
  }
  $num++;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Portfolio</title>
    <meta name="keywords" content="HTML, JavaScript">
    <meta name="description" content="Portfolio">
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
      <a class="active" onclick="navBarfunc()">Menu</a>
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
    <div class="searchbar">
    <form action="search.php" method="post">
        <label for="search">Search Portfolio</label>
        <input id = "search"type="text" name="search" placeholder="Search portfolio...">
        <input type="submit" value=">>"/>
        </form>
      </div>
      <!--Put all content here-->
      <?php print("$output") ?>
    </div>
    <script src="Javascript/Template.js"></script>
  </body>
</html>
