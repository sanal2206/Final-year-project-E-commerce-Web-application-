<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MecahnicalMan</title>
    <!-- Add Bootstrap CSS Link -->

    <!-- Link to home.css -->
    <link rel="stylesheet" type="text/css" href="home.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .item-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 12px;
        }

        .item {
            background: #ffff;

            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 200px;
        }

        .item img {
            max-width: 100%;
            height: auto;

        }

        .item h3 {
            font-size: 1.2em;
            margin: 10px 0;
        }

        .item p {
            font-size: 0.9em;
            color: #555;
            margin: 0 0 15px;
            padding: 0 15px;
        }

        .item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .item {
            animation: fadeIn 0.5s ease-in-out;
        }


        .heading {
            font-size: 2em;
            font-weight: bold;
            position: absolute;
            animation: moveHeading 10s linear infinite;
            left: 50%;
            /* Position the heading at the horizontal center */
            transform: translateX(-50%);
        }

        @keyframes moveHeading {
            0% {
                transform: translateX(-1000px);
            }

            100% {
                transform: translateX(1000px);
            }
        }

        .item-container {
            margin-top: 40px;
            /* Add margin to create space between heading and items */
        }

        .body {
            background-color: #343a40;
            /* Dark background color */
            color: blue;
            /* Text color */
        }
    </style>

</head>

<body>
    <?php include '../header_footer/header.php'; ?>

    <div>
        <!-- Banner Section -->
        <div class="jumbotron jumbotron-fluid bg-banner text-center" style="margin-bottom: 0;">
            <div class="container">
                <h1 style="color:#993399"><strong>Welcome to MechanicalMan.com</strong></h1>
                <h2 style="color: #ddd;">Best Mechanical Product Manufacturer in India</h2>


            </div>

        </div>

        <div class="jumbotron p-3 p-md-5 text-white rounded #d3d3d3;"
            style="margin-bottom: 0;background: rgb(181,180,198);
background: linear-gradient(90deg, rgba(181,180,198,1) 0%, rgba(86,204,228,0.9869135154061625) 49%, rgba(52,142,130,0.9757090336134454) 100%);">

            <!--our goal-->

            <div class="section-header">
                <h2 style="color:black;">Why MechanicalMan ?</h2>
                <h4 style="color:black;"><strong>"Welcome to MechanicalMan.com, your one-stop destination for all things
                        mechanical.<br> Explore our extensive catalog featuring top-notch manufacturers of nuts, bolts,
                        gears, bearings, and more. <br>From industrial fasteners to precision instruments, we offer
                        quality products to meet your mechanical needs. Experience reliability and efficiency with us
                        today!"

                    </strong></h4>
            </div>



            <div class="item-container" style="padding: 25px;">
                <div class="heading" style="color:black;">Our Products</div>
                <br>
                <div class="item-container">
                    <div class="item">
                        <img src="../items/nuts.png" alt="Item 1">
                        <h3>Nuts</h3>
                        <p>Carbon Steel Nut</p>
                    </div>

                    <div class="item">
                        <img src="../items/bolts.png" alt="Item 2">
                        <h3>Bolts</h3>
                        <p>Carbon Steel Bolt</p>
                    </div>

                    <div class="item">
                        <img src="../items/bearings.png" alt="Item 3">
                        <h3>Bearings</h3>
                        <p>Stainless Steel Bearings</p>
                    </div>

                    <div class="item">
                        <img src="../items/Screws.png" alt="Item 4">
                        <h3>Screws</h3>
                        <p>Stainless Steel Screws</p>
                    </div>

                    <div class="item">
                        <img src="../items/gears.png" alt="Item 5">
                        <h3>Gears</h3>
                        <p>Carbon Steel Gears</p>
                    </div>

                    <div class="item">
                        <img src="../items/pulleys.png" alt="Item 6">
                        <h3>Pulleys</h3>
                        <p>Carbon Steel Pulleys</p>
                    </div>

                    <div class="item">
                        <img src="../items/nuts.png" alt="Item 1">
                        <h3>Nuts</h3>
                        <p>Carbon Steel Nut</p>
                    </div>

                    <div class="item">
                        <img src="../items/bolts.png" alt="Item 2">
                        <h3>Bolts</h3>
                        <p>Carbon Steel Bolt</p>
                    </div>

                    <div class="item">
                        <img src="../items/bearings.png" alt="Item 3">
                        <h3>Bearings</h3>
                        <p>Stainless Steel Bearings</p>
                    </div>

                    <div class="item">
                        <img src="../items/Screws.png" alt="Item 4">
                        <h3>Screws</h3>
                        <p>Stainless Steel Screws</p>
                    </div>

                </div>
            </div>
        </div>

        <?php include '../header_footer/footer.php'; ?>



</body>

</html>