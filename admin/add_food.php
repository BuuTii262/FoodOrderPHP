<?php
    include('partials/menu.php');
?>

<div class="maincontent">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" placeholder="Description of the food" cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //display category from database
                            //create sql to get all active category from database
                            $qry = "SELECT * FROM category WHERE active='Yes'";
                            //execute query
                            $res = mysqli_query($conn,$qry);
                            //count to check categories or not
                            $count = mysqli_num_rows($res);
                            
                            if($count>0){
                                //hav category
                                foreach($res as $item){
                                    //get details of category
                                    $id = $item['id'];
                                    $title = $item['title'];
                                    ?>
                                     <option value="<?php echo $id ?>"><?php echo $title ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //not have
                                ?>
                                <option value="0">No categoty found</option>
                                <?php
                            }

                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featued: </td>
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
                        <input type="submit" name="submit" value="Add Food"
                        class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        //check submit button is click
        if(isset($_POST['submit']))
        {
            // get data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
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
            

            //upload image if selected
            if(isset($_FILES['image']['name']))
            {
                //get detail of selected image
                $imagename = $_FILES['image']['name'];

                //check image is selected or not
                //upload if image is selected
                if($imagename!="")
                {
                    //imageis selected
                    //rename imag
                    //get extension of image
                    $ext = end(explode('.',$imagename));

                    //create new name for image
                    $imagename = "Food-Name".rand(0000,9999).".".$ext;

                    //upload image
                    //get souce path and destination path

                    $src = $_FILES['image']['tmp_name'];//current location of image

                    $des = "../images/food/".$imagename;

                    //upload the image
                    $upload = move_uploaded_file($src,$des,);

                    //check the image is upload or not
                    if($upload==false){
                        //set message
                        $_SESSION['upload'] = "<div class='error'> Fail to upload image</div>";
    
                        header('location:'.SITEURL.'admin/add_food.php');
    
                        die();
                    }

                }
                

            }
            else
            {
                $imagename = "";
            }

            //insert into database
            $qry_insert = "INSERT INTO food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$imagename',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";

            //execute query
            $result = mysqli_query($conn,$qry_insert);

            //rediect with message to manage food page
            if($result==true)
            {
            //execute and category added
            $_SESSION['add'] = "<div class='success'>Add food successfully</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage_food.php');
            }
            else
            {
                //execute and category added
            $_SESSION['add'] = "<div class='error'>Add food fail</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage_food.php');
            }

        }
        ?>

    </div>
</div>

<?php
    include('partials/footer.php');
?>