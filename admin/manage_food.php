<?php
    include('partials/menu.php');
?>

    <!-- main content start -->
    <div class="maincontent">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br>
            <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?><br><br><br>
            <a href="add_food.php" class="btn-primary">Add Food</a>

                <br><br><br>
                <table class="tbl-full">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                    //get all food from table
                    $qry = "SELECT * FROM food";

                    //execute query
                    $res = mysqli_query($conn,$qry);

                    //coount row
                    $count = mysqli_num_rows($res);

                    //serial no
                    $sn = 1;

                    //check have data or not
                    if($count>0){
                        //have data
                        //get data and display
                        foreach($res as $item){
                            $id = $item['id'] ;
                            $title = $item['title'];
                            $price = $item['price'];
                            $image_name = $item['image_name'];
                            $featured = $item['featured'];
                            $active = $item['active'];

                            ?>

                                <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                
                                <?php 
                                    if($image_name!="")
                                    {
                                        //display the image
                                ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px">
                                <?php
                                    }
                                    else
                                    {
                                        //Display not have message
                                        echo "<div class='error'>Not have image</div>";
                                    }
                                ?>
                                
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>

                                    <a href="<?php echo SITEURL; ?>admin/update_food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category<a>

                                    <a href="<?php echo SITEURL; ?>admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr> 

                            <?php
                        }

                    }
                    else
                    {
                        //dont have data
                        ?>

                        <tr>
                            <td colspan="6"><div class="error">No Date in the database</div></td>
                        </tr>
                        <?php
                    }

               ?> 
                </table>
            

        </div>
    </div>
    <!-- main content end -->

<?php
    include('partials/footer.php');
?>