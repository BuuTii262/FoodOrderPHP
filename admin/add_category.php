<?php
    include('partials/menu.php');
?>

    <!-- main content start -->
    <div class="maincontent">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <!-- Add category form start  -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes">&nbsp;Yes 
                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="featured" value="No">&nbsp;No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes">&nbsp;Yes
                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="active" value="No">&nbsp;No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category"
                            class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Add category form end -->

    <?php 
    
    //check wherethere submit button is clicked or not
    if(isset($_POST['submit'])){
        // echo "btn clicked";

        //get data from form
        $title = $_POST['title'];

        //for radio, check whether the button is select or not
        if(isset($_POST['featured'])){
            //get value from form
            $featured = $_POST['featured'];
        }else{
            //set the value default
            $featured = "No";
        }

        if(isset($_POST['active'])){
            //get value from form
            $active = $_POST['active'];
        }else{
            //set the value default
            $active = "No";
        }

        //image
        if(isset($_FILES['image']['name']))
        {
            //Upload the image
            //To upload image we need image name,source path, destination path
            $image_name = $_FILES['image']['name'];

            //upload image only if image is selected
            if($image_name!="")
            {

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

                    header('location:'.SITEURL.'admin/add_category.php');

                    die();
                }
            }
        }
        else
        {
            //didnt upload image and set image name as blank
            $image_name="";
        }

        //create query to insert into database
        $qry = "INSERT INTO category SET
        title = '$title',
        image_name='$image_name',
        features = '$featured',
        active = '$active'      
        ";

        //execut query and save into the database
        $res = mysqli_query($conn,$qry);

        //check wherther the query execute or not
        if($res==true)
        {
            //execute and category added
            $_SESSION['add'] = "<div class='success'>Add category successfully</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage_category.php');

        } 
        else
        {
            //fail to add category
            $_SESSION['add'] = "<div class='error'>Add category fail</div>";
            //rediect to manage categoty page
            header('location:'.SITEURL.'admin/add_category.php');

        }

    }

    ?>

        </div>
    </div>
    <!-- main content end -->

<?php
    include('partials/footer.php');
?>