<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

 </head>
 <body> 
 
 <header>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 90px;">
        <!-- Just an image -->
        <img src="..\Logo\logo.png" style="width: 50px; height: 50px;margin-left: 0px; margin-right: 5px;  padding: 0;" alt="">
         
        <span class="company-name" style="margin-right :200px">MechanicalMan.com</span>

        <div class="collapse navbar-collapse"   id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../home_page/home.php"><strong> Home </strong> </a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="../aboutus/aboutus.php"><strong> About Us </strong></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../productpage/products.php"><strong> Products </strong></a>
                </li>
                
                
                
                <li class="nav-item active">
                    <a class="nav-link" href="../contactus/contactus.php"><strong> Contact Us </strong></a>
                </li>

                <li class="nav-item active">
                    
                    <?php
                        @include '../database/db_con.php';
                        $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                        $row_count = mysqli_num_rows($select_rows);

                        ?>

                         <li class="nav-item active" >
                         <a class="nav-link"  href= "../cart_page/cart.php" class="cart"> <strong>Cart  <span><?php echo"( $row_count)"; ?></strong></span>  </a>
                        </li>

                   
 
                </li>
                
                
                <li class="nav-item active">
                    <a class="nav-link" href="../login_files/login.php"><strong> Login </strong></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

</body>
</html>