<?php
    session_start();

    
    if(!isset($_SESSION['skid'])) 
    {
        header("Location: login.php");
        exit();
    }
?>
