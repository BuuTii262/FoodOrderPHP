<?php
    //Auturization access control\
    //Check whether the user is loggin or not
    if(!isset($_SESSION['user']))// if user session is not set
    {
        //user is not login
        //redirect to login page with message
        $_SESSION['no-login-message']="<div class='error'>Please Login to access Admin Panel</div>";

        header('location:'.SITEURL.'admin/login.php');
    }
?>