<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" type="text/css" href="../home_page/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../home_page/home.css">

    <style>
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-title,
        .card-price {
            font-size: 20px;
            font-weight: bold;
        }

        .card-text {
            font-size: 18px;
        }

        .description-popup {
            display: none;
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-width: 300px;
        }
    </style>
</head>

<body>

    <header>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 100%; width: 1860px;">
            <!-- Just an image -->
            <img src="../Logo/logo.png"
                style="width: 50px; height: 50px; margin-left: 10px; margin-right: 10px; padding: 0;" alt="">

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
                        <a class="nav-link" href="product_details_Dh.php"><strong>Products
                                <span><?php echo "($row_count)"; ?></span></strong></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Handles messages -->
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        }
    }
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

    <section class="container mt-4" style="padding: 0px;">
        <h1>Available Products</h1>
        <div id="menuCarousel" class="carousel slide" style="padding: 1px;" data-ride="carousel">
            <div class="carousel-inner">
                <!--  Items 1-3 -->
                <div class="carousel-item active" style="height: auto; text-align: center;">
                    <div class="row h-100" style="padding: 2px;">
                        <?php
                        $query = "SELECT * FROM product";
                        $query_res = mysqli_query($conn, $query);

                        if ($query_res) {
                            if (mysqli_num_rows($query_res) > 0) {
                                while ($row = mysqli_fetch_assoc($query_res)) {
                                    $ID = $row['id'];
                                    $name = $row['product_name'];
                                    $price = $row['product_price'];
                                    $description = $row['product_description'];
                                    $image_data = base64_encode($row['product_image']);
                                    $image = '<img src="data:image/png;base64,' . $image_data . '" class="card-img-top" alt="Product Image"/>';

                                    echo '<div class="col-md-3 mb-4">
                                        <div class="card h-100" onmouseover="showDescription(event, \'' . addslashes($description) . '\')" onmouseout="hideDescription()">
                                            ' . $image . '
                                            <div class="card-body text-center">
                                                <h4 class="card-title">' . $name . '</h4>
                                                <h4 class="card-price"> Rs ' . $price . '/pc</h4>
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
    </section>

    <div id="descriptionPopup" class="description-popup"></div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS for pop-up functionality -->
    <script>
        function showDescription(event, description) {
            var popup = document.getElementById('descriptionPopup');
            popup.innerHTML = '<strong>' + description + '</strong>';
            popup.style.display = 'block';
            popup.style.left = event.pageX + 10 + 'px';
            popup.style.top = event.pageY + 10 + 'px';
        }

        function hideDescription() {
            var popup = document.getElementById('descriptionPopup');
            popup.style.display = 'none';
        }
    </script>

    <?php include '../header_footer/footer.php'; ?>

</body>

</html>