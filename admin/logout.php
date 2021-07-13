<?php 
    include('../config/constant.php');

    session_destroy();//unset $_SESSION['user]

    header('location:'.SITEURL.'admin/login.php');
?>