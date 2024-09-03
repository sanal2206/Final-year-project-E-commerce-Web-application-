<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../login_files/style.css">
    <style>
    body{
    padding: 50px;
    background:url("../login_files/login_bg.jpg");
    background-size: cover;
    width: 100vw;
    height: 100vh;
}
.login-links {
            margin-top: 15px;
        }
        .login-links p {
            margin: 0;
        }
</style>

   
        
</head>
<body>
    <div class="container"  style="width:500px";>
        <?php
        if (isset($_POST["login"])) {
           $email =  $_POST["email"];
           $password1 =  $_POST["password"];
  
            require_once "../database/db_con.php";
            $sql = "SELECT * FROM logistic WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {

            


                if ($password1 == $user["password"]) {
 
                     
                     
                    header("Location:../Delivery/order_details_Dh.php");

                    exit();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                    echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
         

     <form action="login.php" method="post" style="width: 300px; height: 300px;">
        <div class="form-group">
        <h4> Logistic </h4>
            <input type="email" placeholder="Enter Email" name="email" class="form-control">
        </div>
        <br>
        <div class="form-group">
            <input type="password" placeholder="Enter Password" name="password" class="form-control">
        </div>
        <br>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>

        <div class="login-links">
                <p><strong>Admin : </strong><a href="../admin/login.php">Login Here</a></p>
                <p><strong>User     : </strong><a href="../login_files/login.php">Login Here</a></p>
        </div> 
         
     </form>
     

    </div>
            
</body>
</html>