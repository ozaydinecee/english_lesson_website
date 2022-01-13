<?php
    session_start();
    ob_start();

    unset($_SESSION["name"]);
    unset($_SESSION["surname"]);
    unset($_SESSION["email"]);
    unset($_SESSION["password"]);
    unset($_SESSION["student"]);
    unset($_SESSION["instructor"]);

    
    session_destroy();
    echo "Logged out. You are being redirected to the home page.";
    header("Refresh: 0.5; url=index.php");
?>
