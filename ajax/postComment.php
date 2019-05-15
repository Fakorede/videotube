<?php

require_once("../includes/config.php");
require_once("../includes/classes/User.php");
require_once("../includes/classes/Comment.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])) {
    $query = $con->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body) VALUES(:postedBy, :videoId, :responseTo, :body)");
    $query->bindParam(":postedBy", $postedBy);
    $query->bindParam(":videoId", $videoId);
    $query->bindParam(":responseTo", $responseTo);
    $query->bindParam(":body", $commentText);

    $postedBy = $_POST['postedBy'];
    $videoId = $_POST['videoId'];
    $responseTo = $_POST['responseTo'];
    $commentText = $_POST['commentText'];

    $query->execute();

    $userLoggedInObj = new User($con, $_SESSION["userLoggedIn"]);
    $newComment = new Comment($con, $con->lastInsertId(), $userLoggedInObj, $videoId);
    echo $newComment->create();

   
} else {
    echo "One or more parameters not passed!";
}

?>