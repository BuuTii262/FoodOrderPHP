<?php
    include('partials/menu.php');
?>

<div class="maincontent">
        <div class="wrapper">
            <h1>Change Password</h1>

            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>

            <br><br>
            <form action="" method="POST">
              
                <table class="tbl-30">
                    <tr>
                        <td>Current Passowrd: </td>
                        <td><input type="password" name="current_pass" 
                        placeholder="Enter Old Password"></td>
                    </tr>
                    <tr>
                        <td>New Password: </td>
                        <td><input type="password" name="new_pass" 
                        placeholder="Enter new Password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password: </td>
                        <td><input type="password" name="confirm_pass" 
                        placeholder="Confrim new Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="submit" 
                            value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

        </div>
 </div> 

 <?php 
    if(isset($_POST['submit'])){
        //get data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_pass']);
        $new_password = md5($_POST['new_pass']);
        $confrim_password = md5($_POST['confirm_pass']);

        //check wherether the user with the current id and current pass is exit or not
        $qry = "SELECT * FROM admin WHERE id=$id AND password = '$current_password'";

        //execute query
        $res = mysqli_query($conn,$qry);
         
        if($res==true){
            $count = mysqli_num_rows($res);
            if($count==1){
                //user exist
                echo "user found";

                //check new passowrd and confirm password match
                if($new_password==$confrim_password){
                    //update passwrd
                    $qry2= "UPDATE admin SET
                    password = '$new_password'
                    WHERE id=$id
                    ";

                    //execute query
                    $res2 = mysqli_query($conn,$qry2);
                    if($res2==true){
                        //Display success message
                        $_SESSION['change-password']="<div class='success'>New passowrd change successful</div>";
                        header('location:'.SITEURL.'admin/manage_admin.php');

                    }else{
                        //Display Error message
                        $_SESSION['change-password']="<div class='error'>New passowrd change fail!</div>";
                        header('location:'.SITEURL.'admin/manage_admin.php');
                    }

                }else{
                    //Redirect to this page
                    $_SESSION['password-not-match']="<div class='error'>New passowrd and Confirm Password did not match</div>";
                header('location:'.SITEURL.'admin/manage_admin.php');
                }
            }else{
                //user dose not exist set message and redirect
                $_SESSION['user-not-found']="<div class='error'>user not found</div>";
                header('location:'.SITEURL.'admin/manage_admin.php');
            }
        }
    }
 ?>      

<?php
    include('partials/footer.php');
?>