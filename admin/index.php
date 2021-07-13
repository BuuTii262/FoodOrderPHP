<?php
    include('partials/menu.php');
?>

    <!-- main content start -->
    <div class="maincontent">
        <div class="wrapper">
            <h1>Dashboard</h1>

            
            <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];// display session message
                unset($_SESSION['login']);// remove session message
            }
        
            ?>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
   <!-- main content end -->

<?php
    include('partials/footer.php');
?>