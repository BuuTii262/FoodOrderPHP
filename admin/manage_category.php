<?php
    include('partials/menu.php');
?>

    <!-- main content start -->
    <div class="maincontent">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no_category_found'])){
                echo $_SESSION['no_category_found'];
                unset($_SESSION['no_category_found']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed_remove'])){
                echo $_SESSION['failed_remove'];
                unset($_SESSION['failed_remove']);
            }
            ?>
            <br><br>

            <a href="add_category.php" class="btn-primary">Add Category</a>

            <br><br><br>
            <table class="tbl-full">
               <tr>
                   <th>No</th>
                   <th>Title</th>
                   <th>Image</th>
                   <th>Featued</th>
                   <th>Active</th>
                   <th>Action</th>
               </tr> 
               <?php
                    //get all category from table
                    $qry = "SELECT * FROM category";

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
                            $image_name = $item['image_name'];
                            $featured = $item['features'];
                            $active = $item['active'];

                            ?>

                                <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                
                                <?php 
                                    if($image_name!="")
                                    {
                                        //display the image
                                ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">
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

                                    <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category<a>

                                    <a href="<?php echo SITEURL; ?>admin/delete_categoty.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
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