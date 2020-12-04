<?php
require('../Include/config.php');
require('../Include/sessions.php');
$score = $_REQUEST["q"];
$bestScore=$score;
if(isset($_SESSION['userName']))
{
    $name=$_SESSION['userName'];
    $bestScore=$score;
    $sql= "SELECT * FROM highScores WHERE name = '$name'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $numUsers = $stmt->rowCount();
    if($numUsers == 1){
        while($row = $stmt->fetchObject()){
            if($row->score<$score)
            {
                $sql = "UPDATE highScores SET score='$score' WHERE name ='$name'";
                $stmt = $con->prepare($sql);
                $stmt->execute();
            } else
            {
                $bestScore = $row->score;
            }
        }
    }else{
        $sql= "INSERT INTO highScores(name, score)
        VALUES (:name, :score)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':score', $score, PDO::PARAM_STR);
        $stmt->execute();
    }
}
    echo "$bestScore";
?>