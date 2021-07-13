<?php include('../config/constant.php'); ?>
<html>
    <head>
        <title>Login - Food Order</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">

            <h1 class="text-center">Login</h1><br>

            <!-- login form start here -->
                <form action="" method="POST" class="text-center">

                <?php 
                        if(isset($_SESSION['login'])){
                            echo $_SESSION['login'];// display session message
                            unset($_SESSION['login']);// remove session message
                        }
                        if(isset($_SESSION['no-login-message'])){
                            echo $_SESSION['no-login-message'];// display session message
                            unset($_SESSION['no-login-message']);// remove session message
                        }
                    ?>
                    
                    Username:<br>
                    <input type="text" name="username" placeholder="Enter Your username"><br><br>

                    Password:<br>
                    <input type="password" name="password" placeholder="Enter Your Password"><br><br>

                    <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

                    

                </form>
            <!-- login form end here -->

            <p class="text-center">created by Sai Thiha Aung</p>

        </div>
    </body>
</html>

<?php
    //Checked whether the submit button is click or not
    if(isset($_POST['submit'])){
        //Process for login
        //get data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //Query to check user exist or not
        $qry = "SELECT * FROM admin WHERE username='$username' AND 
        password='$password';";

        //Execute query
        $res = mysqli_query($conn,$qry);
        print_r($res);

        // count row to check whether the user exist or not
        $count = mysqli_num_rows($res);

        if($count==1){
            // echo "login success";
            //uesr exist
            $_SESSION['login']="<div class='success'>Login successfully</div>";
            $_SESSION['user'] = $username;//to check the user is login or not and log out will unset it

            //direct page to the Home page
            header('location:http://localhost/food-order/admin/');
        }else{
            // echo "login fail";
            //user not exist
            $_SESSION['login']="<div class='error'>Login Fail ! Please Try again </div>";
            //direct page to the Home page
            header('location:http://localhost/food-order/admin/login.php');
        }



    }
?>