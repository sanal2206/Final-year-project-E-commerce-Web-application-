<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" type="text/css" href="../home_page/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       .container {
    margin-top: 10px;
    margin-left: 100px;
    margin-right: 10px;
    max-height: 300px;
    overflow-x: auto; /* Add horizontal scrollbar when needed */
    overflow-y: auto; /* Add vertical scrollbar when needed */
}
        h2 {
            margin-bottom: 20px;
        }
        .custom-table {
            border: 2px solid #ddd;
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 100%; width: 1850px;">
        <!-- Just an image -->
        <img src="..\Logo\logo.png" style="width: 50px; height: 50px; margin-left: 10px; margin-right: 10px; padding: 0;" alt="">

        <span class="company-name" style="margin-right: 200px; color: white;">MechanicalMan.com</span>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                    <?php
                        @include '../database/db_con.php';
                        $select_rows = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
                        $row_count = mysqli_num_rows($select_rows);
                    ?>
                    <a class="nav-link" href="add_new_product.php"><strong>Products <span><?php echo "($row_count)"; ?></span></strong></a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="order_details.php"><strong>Orders</strong></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="delivered.php"><strong>Delivered</strong></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="users_details.php"><strong>Users</strong></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="user_login_data.php"><strong>Login-Data</strong></a>
                </li>

                 
                
                
            </ul>
        </div>
    </nav>
</header>



<!--users data -->
<?php include('../database/db_con.php'); ?>

<?php 
// Handle delete request
if (isset($_POST['delete'])) {
    $userIdToDelete = $_POST['user_id'];
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $userIdToDelete);
    $stmt->execute();
    $stmt->close();
}

// Fetch users
$query = "SELECT * FROM `users`";
$query_res = mysqli_query($conn, $query);
?>
<br>
<h2 style="color:orange;   margin-left: 120px;">Order Details</h2>
<div class="container">
     
    <div class="table-wrapper">
        <table class="table table-striped custom-table">
            <thead>
                <tr>
                    <th style="width: 8%;">ID</th>
                    <th style="width: 12%;">Customer Name</th>
                    <th style="width: 15%;">Email</th>
                    <th style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if ($query_res && mysqli_num_rows($query_res) > 0) {
                        while($row = mysqli_fetch_assoc($query_res)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['full_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>";
                            echo "<form method='POST' style='display:inline;'>";
                            echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' name='delete' class='btn btn-danger'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No orders found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 
</body>
</html>
