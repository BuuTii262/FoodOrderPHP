<?php

//session start
    session_start();

    define("SITEURL",'http://localhost/food-order/');

    define("DB_HOST",'localhost');
    define("DB_NAME",'food-order');
    define("DB_USERNAME",'root');
    define("DB_PASSWORD",'');
    $conn = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
    $db_select = mysqli_select_db($conn,DB_NAME);

?>