<?php
include('../database/db_con.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];

    // Fetch the order details
    $query = "SELECT * FROM `order` WHERE id = '$orderId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);

        // Insert the order details into the delivered table
        $insertQuery = "INSERT INTO `delivered` (id, name, number, email, method, flat, street, city, state, country, total_products, total_price)
                        VALUES ('" . $order['id'] . "', '" . $order['name'] . "', '" . $order['number'] . "', '" . $order['email'] . "', '" . $order['method'] . "', '" . $order['flat'] . "', '" . $order['street'] . "', '" . $order['city'] . "', '" . $order['state'] . "', '" . $order['country'] . "', '" . $order['total_products'] . "', '" . $order['total_price'] . "')";

        if (mysqli_query($conn, $insertQuery)) {
            // Delete the order from the original table
            $deleteQuery = "DELETE FROM `order` WHERE id = '$orderId'";
            if (mysqli_query($conn, $deleteQuery)) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}
?>
