<?php
    include('partials/menu.php');
?>

    <!-- main content start -->
    <div class="maincontent">
        <div class="wrapper">
            <h1>Manage_Admins</h1>
            <br>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];// display session message
                    unset($_SESSION['add']);// remove session message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];// display session message
                    unset($_SESSION['delete']);// remove session message
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];// display session message
                    unset($_SESSION['update']);// remove session message
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];// display session message
                    unset($_SESSION['user-not-found']);// remove session message
                }
                if(isset($_SESSION['password-not-match'])){
                    echo $_SESSION['password-not-match'];// display session message
                    unset($_SESSION['password-not-match']);// remove session message
                }
                if(isset($_SESSION['change-password'])){
                    echo $_SESSION['change-password'];// display session message
                    unset($_SESSION['change-password']);// remove session message
                }
               
            ?>
            <br><br>

            <a href="add_admin.php" class="btn-primary">Add admin</a>

            <br><br><br>
            <table class="tbl-full">
               <tr>
                   <th>No</th>
                   <th>Full Name</th>
                   <th>Username</th>
                   <th>Action</th>
               </tr> 

<?php
    //Query select all from admin table
    $qry = "SELECT * FROM admin;";
    //Execute the query
    $res = mysqli_query($conn,$qry);

    if($res==true){

        //count row to check we have data in db or not
        $row = mysqli_num_rows($res);

        // check the numbers of rows
        if($row>0){

            $sn=1; //serial no for Admins
            //we have data in databse
            foreach($res as $item){
            $id=$item['id'];
            $fullname=$item['full_name'];
            $username = $item['username'];
                //Display values in our table
                ?>
                
                <tr>
                   <td><?php echo $sn++ ?></td>
                   <td><?php echo $fullname ?></td>
                   <td><?php echo $username ?></td>
                   <td>

                        <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id ?>" class="btn-secondary">Update admin</a>
                        <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id ?>" class="btn-danger">Delete admin</a>
                        <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id ?>" class="btn-primary">Change Password</a>
                    </td>
               </tr> 

                <?php

            }
        }
        else{
            //data empty
            echo "data is empty"; 
        }
    }
?>

               
            </table>
            

        </div>
    </div>
    <!-- main content end -->

<?php
    include('partials/footer.php');
?>