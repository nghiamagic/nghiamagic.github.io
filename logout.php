<?php 
session_start();
session_unset();
 
    if (isset($_SESSION['username'])){
        unset($_SESSION['username']);
    }
    header("Location: /index.php"); 
?>