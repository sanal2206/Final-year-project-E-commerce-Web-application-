<?php
include('../database/db_con.php');

if(isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // SQL query to delete the order with the specified ID
    $deleteQuery = "DELETE FROM `order` WHERE id = $orderId";

    if(mysqli_query($conn, $deleteQuery)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
