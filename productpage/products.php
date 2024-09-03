<?php
@include '../database/db_con.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $decoded_image = base64_decode($product_image);

    // Check if the product is already in the cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Product already added to cart';
    } else {
        // Prepare an SQL statement to insert the product into the cart
        $stmt = $conn->prepare("INSERT INTO `cart` (product_name, product_price, product_description, quantity, product_image) VALUES (?, ?, ?, ?, ?)");

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("sssis", $product_name, $product_price, $product_description, $product_quantity, $decoded_image);

            // Execute the statement
            if ($stmt->execute()) {
                $message[] = 'Product added to cart successfully';
            } else {
                $message[] = 'Error adding product to cart: ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            $message[] = 'Error preparing statement: ' . $conn->error;
        }
    }

    // Close the connection
    $conn->close();
}
?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <link rel="stylesheet" type="text/css" href="../home_page/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">


</head>

<body>


    <?php include '../header_footer/header.php'; ?>

    <!-- handles messages -->

    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        }
        ;
    }
    ;

    ?>






    <?php include ('../database/db_con.php'); ?>
    <?php

    $query = "SELECT * FROM product";
    $query_res = mysqli_query($conn, $query);

    if ($query_res) {
        if (mysqli_num_rows($query_res) > 0) {
            while ($row = mysqli_fetch_assoc($query_res)) {
                $imageData = base64_encode($row['product_image']); // Corrected this line
                $imageFormat = 'png';
            }
        }
    }
    ?>

    <div class="jumbotron p-3 p-md-5 text-white rounded #d3d3d3;"
        style="margin-bottom: 0;background: rgb(181,180,198);
background: linear-gradient(90deg, rgba(181,180,198,1) 0%, rgba(86,204,228,0.9869135154061625) 49%, rgba(52,142,130,0.9757090336134454) 100%);">
        <section class="container mt-4" style="padding: 0px;">
            <h1>Available Products</h1>
            <div id="menuCarousel" class="carousel slide" style="padding: 1px;" data-ride="carousel">
                <div class="carousel-inner">
                    <!--  Items 1-3 -->
                    <div class="carousel-item active" style="height: auto;  text-allign:centre;">
                        <div class="row h-100" style="padding: 2px;">
                            <?php
                            $query = "SELECT * FROM product ";
                            $query_res = mysqli_query($conn, $query);

                            if ($query_res) {
                                if (mysqli_num_rows($query_res) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_res)) {
                                        $ID = $row['id'];
                                        $name = $row['product_name'];
                                        $price = $row['product_price'];
                                        $description = $row['product_description'];
                                        $image_data = base64_encode($row['product_image']);
                                        $image = '<img src="data:image/png;base64,' . $image_data . '" />';

                                        echo '<div class="col-md-3">
                
              <div class="card h-100 ">
             ' . $image . '
              <div class="card-body text-center" style="color:black;">
                <h4 class="card-title">' . $name . '</h4>
                <h4 class="card-title"> Rs ' . $price . '/pc</h4>
                <p class="card-text"><strong>' . $description . '</strong></p>
                


                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="' . $ID . '">
                    <input type="hidden" name="product_name" value="' . $name . '">
                    <input type="hidden" name="product_price" value="' . $price . '">
                    <input type="hidden" name="product_description" value="' . $description . '">
                    <input type="hidden" name="product_image" value="' . $image_data . '">
                    <div class="d-grid gap-2 col-8 mx-auto">
                    
                    <button type="submit" value="add to cart" name="add_to_cart" class="btn btn-primary btn-lg active">Add to Cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';




                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>




    <!-- custom js file link  -->
    <script src="../js/script.js"></script>



    <?php include '../header_footer/footer.php'; ?>

</body>

</html>