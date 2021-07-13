<?php
    include('partials/menu.php');
?>

<!-- main Content start -->
    <div class="maincontent">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br> 

            <?php
             if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];// display session message
                    unset($_SESSION['add']);// remove session message
                }
            ?>
            <br><br>

            <form action="" method="POST">
              
                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter full name"></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter user name"></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="passowrd" name="password" placeholder="Enter passowrd"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" 
                            value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

        </div>
    </div>
<!-- end main content -->
<?php
    include('partials/footer.php')
?>

<?php

// if bth click
    if(isset($_POST['submit'])){

        //get data from textboxes
        $full_name = $_POST['full_name']; 
        $username = $_POST['username'];
        $password = md5($_POST['password']);  
        
        // SQL query to save data
        $qry = "INSERT INTO admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        ";

        // save into database
        $result = mysqli_query($conn,$qry);

        // echo $result? "Data Insert Successfully" : "Data Insert Fail!";

        if($result==true){
            //create var to display message
            $_SESSION['add'] = "Add admin Successfully !";
            //Redirect to Manage Admin page
            header("location:".SITEURL.'admin/manage_admin.php');
        }
        else{
            //create var to display message
            $_SESSION['add'] = "Add admin Fail !";
            //Redirect to Add Admin page
            header("location:".SITEURL.'admin/add_admin.php');
        }
        

    }
?>