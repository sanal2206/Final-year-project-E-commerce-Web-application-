<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../home_page/home.css">

    <title>Order Details</title>
    
    <style>

        
        .container {
            margin-top: 10px;
            margin-left: 145px;
            margin-right: 10px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .table-wrapper {
            padding-left: 0;
            padding-right: 0;
            overflow-x: auto;
            overflow-y: auto;
            max-height: 400px; 
             
        }
        .custom-table {
            border: 2px solid #ddd;
            width: 100%; /* Ensure the table takes the full width of its container */
        }
        .custom-table th, .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            white-space: nowrap; /* Ensure single-line content */
        }
        .custom-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<header>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 100%; width: 1860px;">
        <!-- Just an image -->
        <img src="../Logo/logo.png" style="width: 50px; height: 50px; margin-left: 10px; margin-right: 10px; padding: 0;" alt="">

        <span class="company-name" style="margin-right: 200px; color: white;">MechanicalMan.com</span>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                 
                <li class="nav-item active">
                    <a class="nav-link" href="order_details_Dh.php"><strong>Orders</strong></a>
                </li>
                <li class="nav-item active">
                    <?php
                        @include '../database/db_con.php';
                        $select_rows = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
                        $row_count = mysqli_num_rows($select_rows);
                    ?>
                    <a class="nav-link" href="product_details_Dh.php"><strong>Product <span><?php echo "($row_count)"; ?></span></strong></a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<?php include('../database/db_con.php');?>

<?php 
$query = "SELECT * FROM `order`";
$query_res = mysqli_query($conn, $query);
?>

<div class="container">
<h2 style="color:orange;">Order Details</h2>
    <div class="table-wrapper">
        <table class="table table-striped custom-table">
            <thead>
                <tr>
                    <th style="width: 8%;">Order ID</th>
                    <th style="width: 12%;">Customer Name</th>
                    <th style="width: 10%;">Phone Number</th>
                    <th style="width: 15%;">Email</th>
                    <th style="width: 15%;">Payment Method</th>
                    <th style="width: 5%;">Flat</th>
                    <th style="width: 10%;">Street</th>
                    <th style="width: 10%;">City</th>
                    <th style="width: 5%;">State</th>
                    <th style="width: 10%;">Country</th>
                    <th style="width: 10%;">Total Products</th>
                    <th style="width: 10%;">Total Price</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if ($query_res && mysqli_num_rows($query_res) > 0) {
                        while($row = mysqli_fetch_assoc($query_res)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['number'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['method'] . "</td>";
                            echo "<td>" . $row['flat'] . "</td>";
                            echo "<td>" . $row['street'] . "</td>";
                            echo "<td>" . $row['city'] . "</td>";
                            echo "<td>" . $row['state'] . "</td>";
                            echo "<td>" . $row['country'] . "</td>";
                            echo "<td>" . $row['total_products'] . "</td>";
                            echo "<td>" . $row['total_price'] . "</td>";
                            echo '<td>
                                     <button class="btn btn-success btn-sm" onclick="deliverOrder(' . $row['id'] . ')">Delivered</button>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='13'>No orders found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function cancelOrder(orderId) {
        if (confirm('Are you sure you want to cancel this order?')) {
            // Implement cancel order functionality if needed
        }
    }

    function deliverOrder(orderId) {
        if (confirm('Are you sure this order is delivered?')) {
            $.ajax({
                url: 'deliver_order.php',
                type: 'POST',
                data: { orderId: orderId },
                success: function(response) {
                    if (response === 'success') {
                        alert('Order marked as delivered.');
                        $('#deliverBtn_' + orderId).removeClass('btn-success').addClass('btn-secondary').text('Delivered').prop('disabled', true);

                        location.reload();
                    } else {
                        alert('Failed to mark order as delivered.');
                    }
                }
            });
        }
    }
</script>

</body>
</html>
