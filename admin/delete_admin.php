<?php
//include databse file
include('../config/constant.php');

//get id of admin to deleted
$id = $_GET['id'];

//create sql qry to delete admin
$qry = "DELETE FROM admin WHERE id=$id;";

//execute qry
$res = mysqli_query($conn,$qry);

//Check the qry is execute or not
if($res==true){
    //create session to show message
    $_SESSION['delete']="<div class='success'>Admin delete successfully</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage_admin.php');
}else{
    $_SESSION['delete']="<div class='error'>Admin delete Fail! Please try again later</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage_admin.php');
}


?>