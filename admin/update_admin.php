<?php
    include('partials/menu.php');
?>


<!-- main content start -->
<div class="maincontent">
        <div class="wrapper">
            <h1>Update Admin</h1>
          
            <br><br>
            <?php
            //get id of selected admin
            $id = $_GET['id'];

            //create sql query to get detail
            $qry = "SELECT * FROM admin WHERE id=$id;";

            //execute the query
            $res = mysqli_query($conn,$qry);

            if($res==true){
                $count = mysqli_num_rows($res);
                if($count==1){
                    //get detail
                    //admin available
                    $row = mysqli_fetch_assoc($res);
                    $fullname = $row['full_name'];
                    $username = $row['username'];
                }else{
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }

            }
            ?>

            <form action="" method="POST">
              
                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" 
                        value="<?php echo $fullname ?>"></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" 
                        value="<?php echo $username ?>"></td>
                        <td><input type="hidden" name="id" 
                        value="<?php echo $id ?>"></td>

                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" 
                            value="Update" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

        </div>
    </div>

<?php 
    if(isset($_POST['submit'])){
        //Get all the value from form to Update
         $id = $_POST['id'];
         $fullname = $_POST['full_name'];
         $username = $_POST['username'];
        
        //create sql query to update admin
        $qry = "UPDATE admin SET
        full_name = '$fullname',
        username = '$username'
        WHERE id=$id
        ";

        $res=mysqli_query($conn,$qry);

        if($res==true){
            //create session to show message
            $_SESSION['update']="<div class='success'>Admin update successfully</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage_admin.php');
        }else{
            //create session to show message
            $_SESSION['update']="<div class='success'>Admin update Fail!</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
    }
?>

<!-- end main content -->
<?php
    include('partials/footer.php')
?>
