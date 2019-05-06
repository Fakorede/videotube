<?php

require_once("../includes/config.php");

if(isset($_POST['userTo']) && isset($_POST['userFrom'])) {

    $userTo = $_POST['userTo'];
    $userFrom = $_POST['userFrom'];

    // check if user is subbed
    $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo = :userTo AND userFrom = :userFrom");
    $query->bindParam(":userTo", $userTo);
    $query->bindParam(":userFrom", $userFrom);
    $query->execute();

    if($query->rowCount() == 0) {
        // not subbed
        $query = $this->con->prepare("INSERT INTO subscribers(userTo, userFrom) VALUES(:userTo, :userFrom)");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();

    } else {
        // delete sub
        $query = $this->con->prepare("DELETE FROM subscribers WHERE userTo = :userTo AND userFrom = :userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();

    }

    // return new no of subs
    $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo = :userTo");
    $query->bindParam(":userTo", $userTo);
    $query->execute();

    echo $query->rowCount();

} else {
    echo "One or more parameters not passed!";
}

?>