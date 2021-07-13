<?php
    include('partials/menu.php');
?>
<?php
    //check the id is set or not
    if(isset($_GET['id']))
    {
        //Getting id
        $id = $_GET['id'];
        //query to get all data
        $query = "SELECT * FROM category WHERE id=$id";

        //execute query
        $res = mysqli_query($conn,$query);

        //check category exist or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //category is exist
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['features'];
            $active = $row['active'];
        }
        else
        {
            //redirect to manage category page with seession messag
            $_SESSION['no_category_found'] = "<div class='error'>Category not found</div>";
            header('location:'.SITEURL.'/admin/manage_category.php');
        }
    }
    else
    {
        //redirect to update category page
        header('location:'.SITEURL.'admin/manage_category.php');
    }
?>

<div class="maincontent">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br> 
            <!-- Update category form start  -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" 
                            value="<?php echo $title ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php 
                                if($current_image!="")
                                    {
                                        //display the image
                            ?>
                             <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                            <?php
                                    }
                                    else
                                    {
                                        //Display not have message
                            echo "<div class='error'>Not have image</div>";
                                    }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked"; }?> type="radio" name="featured" value="Yes">&nbsp;Yes 
                            &nbsp;&nbsp;&nbsp;
                            <input <?php if($featured=="No"){echo "checked"; }?> type="radio" name="featured" value="No">&nbsp;No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked"; }?> type="radio" name="active" value="Yes">&nbsp;Yes
                            &nbsp;&nbsp;&nbsp;
                            <input <?php if($active=="No"){echo "checked"; }?> type="radio" name="active" value="No">&nbsp;No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="current_image" 
                        value="<?php echo $current_image ?>">
                            <input type="submit" name="submit" value="Update Category"
                            class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    //get all value from form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //updating new image if selected
                    if(isset($_FILES['image']['name'])){
                        //get the image details
                        $image_name = $_FILES['image']['name'];

                        //check the image is available or not
                        if($image_name != "")
                        {
                            //image availabe
                            //upload image

                            //Rename our image
                            //get the extension
                            $ext = end(explode('.',$image_name));

                            //r"ename the image
                            $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            //Upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);

                            //check the image is upload or not
                            //if not stop the process and redirect with error message\
                            if($upload==false){
                                //set message
                                $_SESSION['upload'] = "<div class='error'> Fail to upload image</div>";

                                header('location:'.SITEURL.'admin/manage_category.php');

                                die();
                            }

                            //remove current image
                            if($current_image != "")
                            {
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);
    
                                //check the image is remove or not
                                //if fail to remove display message and stop the process
                                if($remove==false)
                                {
                                    //fail to remove image
                                    $_SESSION['failed_remove']="<div class='error'>
                                    Fail to remove current image</div>";
                                    header('location:'.SITEURL.'admin/manage_category.php');
                                    die();//stop the process
                                }  
                            }
                            
                        }
                        else
                        {
                            $image_name = $current_image;
                        }

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                    
                    //Update database
                    $qry = "UPDATE category SET
                    title = '$title',
                    image_name = '$image_name',
                    features = '$featured',
                    active = '$active'
                    WHERE id=$id
                    ";

                    //execute query
                    $res = mysqli_query($conn,$qry);
                    if($res==true)
                    {
                        //category updated
                        $_SESSION['update']="<div class='success'>Category Update successfully</div>";
                        header('location:'.SITEURL.'/admin/manage_category.php');
                    }
                    else
                    {
                        //Update fail
                        $_SESSION['update']="<div class='success'>Category Update  fail !</div>";
                        header('location:'.SITEURL.'/admin/manage_category.php');
                    }
                    
                }
            ?>

        </div>

</div>
<?php
    include('partials/footer.php');
?>