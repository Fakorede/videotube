<?php

require_once("../includes/config.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])) {
    echo "commented";
   
} else {
    echo "One or more parameters not passed!";
}

?>