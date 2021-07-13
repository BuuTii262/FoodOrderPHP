<?php
    include('../config/constant.php');

//check id or image name is set or not 

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get value and delete
        $id = $_GET['id'];
        $imagename = $_GET['image_name'];

        //remove image in file
        if($imagename != ""){
            //image is avaliable and remove
            $path = "../images/category/".$imagename;

            //remove the image
            $remove = unlink($path);

            //if fail remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Fail to remove Category image</div>";
                //redirct to manage category 
                header('location:'.SITEURL.'admin/manage_category.php');
                //stop the process
                die();
            }
        }
        //delet date from database
        $qry = "DELETE FROM category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn,$qry);

        //check data is delete form database
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category delet successfully</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage_category.php');

        }
        else
        {
            //set error message and redirect
            $_SESSION['delete'] = "<div class='success'>Fail to delet Category</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage_category.php');
        }
    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage_category.php');
    }

?>