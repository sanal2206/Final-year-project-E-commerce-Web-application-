<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="../home_page/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="margin: 0;"> <!-- Set margin of the body to 0 -->

<?php include '../header_footer/header.php'; ?> <!-- Assuming 'header.php' contains the header code -->

<!-- Banner Section -->
<div class="jumbotron jumbotron-fluid bg-banner text-center" style="margin-bottom: 0;"> <!-- Set margin-bottom of the banner to 0 -->
    <div class="container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="container py-4 custom-form">
                        <h2 class="text-center" style="color:white; margin-left: -340px;">Contact Us</h2>

                        <!-- Bootstrap Form -->
                        <form method="post" action="email.php">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter the subject" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<?php include '../header_footer/footer.php'; ?>
</body>
</html>
