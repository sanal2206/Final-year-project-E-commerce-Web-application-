<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <title>Registerform</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
    body{
    padding: 50px;
    background:url("login_bg.jpg");
    background-size: cover;
    width: 100vw;
    height: 100vh;
}
</style>
    
</head>
<body>
 
     <div class="container">
         

    <?php include('../database/db_con.php');?>
    
 
<?php
$errors = array();

if(isset($_POST["submit"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($fullname) || empty($email) || empty($password) || empty($passwordRepeat)) {
        array_push($errors, "All fields are required");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }

    if(strlen($password) < 5) {
        array_push($errors, "Password must be at least 8 characters long");
    }

    if($password !== $passwordRepeat) {
        array_push($errors, "Password does not match ");
    }
    
    require_once  '../database/db_con.php';
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if($rowCount > 0) {
        array_push($errors, "Email already exists!");
    }
    
    if(count($errors) > 0) {
        foreach($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        } 
    } else {
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);

        if($preparestmt) {
            mysqli_stmt_bind_param($stmt, "sss", $fullname, $email,$passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are Registered Succesfully.</div>";
            
             
        } else {
            die("Something went wrong");
        }
    }
}
?>

        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div>
            <div class="form-btn">
                <input type="submit"   class="btn btn-primary"  value="Register" name="submit">
            </div>
        </form>  
        <div class="text" style="color: black;"><p><strong>Already registered </strong>  <a href="login.php"> Login here</a></p></div>
    </div>  
    </div>    

</body>
</html>