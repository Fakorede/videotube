<?php require_once("includes/header.php"); ?>
                
<?php 

    if(isset($_SESSION["userLoggedIn"])) {
        echo "Welcome, " . $_SESSION["userLoggedIn"];
    }

    echo '<br>';

    echo $userLoggedInObj->getUsername();
    echo '<br>';
    echo $userLoggedInObj->getName();
?>

<?php require_once("includes/footer.php"); ?>
            