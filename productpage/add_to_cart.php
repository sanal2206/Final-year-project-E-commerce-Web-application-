<?php
@include '../database/db_con.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $product_image = base64_decode($_POST['product_image']);
    $product_quantity = 1;

    // Check if the product is already in the cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Product already added to cart';
    } else {
        // Construct the SQL query to insert the product into the cart
        $query = "INSERT INTO `cart` (product_name, product_price, product_description, quantity, product_image) 
                  VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sdsis', $product_name, $product_price, $product_description, $product_quantity, $product_image);
        
        if (mysqli_stmt_execute($stmt)) {
            $message[] = 'Product added to cart successfully';
        } else {
            $message[] = 'Error adding product to cart: ' . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

    // Close the connection
    mysqli_close($conn);
    header('Location: your_page_with_products.php');
    exit();
}
?>
