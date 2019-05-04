<?php 

require_once("includes/header.php");
require_once("includes/classes/Video.php");

if(!isset($_GET["id"])) {
    echo "ERROR 404. PAGE NOT FOUND!";
    exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();


?>
                


<?php require_once("includes/footer.php"); ?>
            