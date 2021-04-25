<?php
error_reporting(0);
ini_set('display_errors', 0); 

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    session_start();
    ob_start();
    
    $headtitle = 'Lịch Sử Nạp Thẻ - ThueAcc.Net - Cho Thuê Tài Khoản PUBG Giá Rẻ';
    
    require('config.php');
    require('template/head.php');
    require('template/navbar.php');
    require('template/lichsunap.php');
    require('template/foot.php');

?>
