<?php include('../database/db_con.php');?>


<?php 
 // to add a new product
 if(isset($_POST['add_product']))
{
$product_image=addslashes(file_get_contents($_FILES["product_image"]["tmp_name"]));
$product_name=$_POST['product_name'];
$product_description=$_POST['product_description'];
$product_price=$_POST['product_price'];

$query="INSERT INTO `product` (`product_name`,`product_price`,`product_description`,`product_image`)VALUES('$product_name',$product_price,'$product_description','$product_image')";
$query_run=mysqli_query($conn,$query);

if($query_run)
{
   
   $message[] = 'New Product Added';
}else
{
   $message[] = 'Query Failed';
}
 }

?>
 

 <?php

 //to delete the product 
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `product` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:add_new_product.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:add_new_product.php');
      $message[] = 'product could not be deleted';
   };
};

?>
<?php
//to update the product details
 
// Check if the update product form is submitted
if(isset($_POST['update_product'])){
   // Get form data
   $update_p_id = $_POST['update_product_id'];
   $update_p_name = $_POST['update_product_name'];
   $update_p_price = $_POST['update_product_price'];
   $update_p_description = $_POST['update_product_description'];
   
   // Get image file details
   $update_p_image_name = $_FILES['update_product_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_product_image']['tmp_name'];
   
   // Define the folder where the image will be stored
   $update_p_image_folder = '../uploaded_img/'.$update_p_image_name;

   // Move the uploaded image to the specified folder
   if(move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder)){
      // Read the image data
      $product_image = addslashes(file_get_contents($update_p_image_folder));

      // Include database connection
      include '../database/db_con.php';
      
      // Prepare and execute the SQL query to update product details with the image data
      $update_query = mysqli_query($conn, "UPDATE `product` SET product_name = '$update_p_name', product_price = '$update_p_price', product_description = '$update_p_description', product_image = '$product_image' WHERE id = '$update_p_id'");
      
      // Check if the query was successful
      if($update_query){
         // Redirect to admin page with success message
         $message[] = 'Product updated successfully';
         header('location:add_new_product.php');
       } else {
         // Redirect to admin page with error message
         $message[] = 'Product could not be updated';
         header('location:add_new_product.php');
      }
   } else {
      // Redirect to admin page with error message if file move failed
      $message[] = 'Failed to move uploaded file';
      header('location:admin.php');
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css"  href="../productpage/style.css">
   <link rel="stylesheet" type="text/css"  href="../home_page/home.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 

   
   

</head>
<body>
  <!-- Include the header -->
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

                 
                
                < 
            </ul>
        </div>
    </nav>
</header>


 
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

 

<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <input type="text" name="product_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="product_price" min="0" placeholder="enter the product price" class="box" required>
   <input type="text" name="product_description" placeholder="enter the product description" class="box" required>

   <input type="file" name="product_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>
<!-- display the product in admin page -->
<section class="display-product-table">

   <table>

      <thead>
         <th style="border: 2px solid black;">product image</th>
         <th style="border: 2px solid black;">product name</th>
         <th style="border: 2px solid black;">product Description</th>
         <th style="border: 2px solid black;">product price</th>
         <th style="border: 2px solid black;">action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `product`");

            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
                  // Encode the product image for display
                   
         ?>

         <tr>
          <!-- display the product image ,name and price -->  
         <td style="border: 2px solid black;"><?php echo'<img src="data:image;base64,'.base64_encode($row['product_image']).'" alt="image" style=" height: 100px; width:100px;"/>'; ?></td>
         <td style="border: 2px solid black;"><?php echo $row['product_name']; ?></td>
         <td style="border: 2px solid black;"><?php echo $row['product_description']; ?></td>

         <td style="border: 2px solid black;">$<?php echo $row['product_price']; ?>/-</td>
            
         <!-- delete and update buttons-->
            <td style="border: 2px solid black;">
               <a href="add_new_product.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="add_new_product.php?update=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>



<section class="edit-form-container">

   <?php
   
   if(isset($_GET['update'])){
      $edit_id = $_GET['update'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `product` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>
 

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <input type="hidden" name="update_product_id" value="<?php echo $fetch_edit['id']; ?>">

   <input type="text" name="update_product_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="update_product_price" min="0" placeholder="enter the product price" class="box" required>
   <input type="text" name="update_product_description" placeholder="enter the product description" class="box" required>

   <input type="file" name="update_product_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <button type="submit" value="update the product" name="update_product" class="btn btn-primary btn-lg">Update</button>
   <button type="button" class="btn btn-secondary btn-lg" id="cancel-button">Cancel</button>
   <script>
    document.getElementById('cancel-button').addEventListener('click', function() {
        window.location.href = 'add_new_product.php';
    });
</script>



</form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>















<!-- custom js file link  -->
<script src="../js/script.js"></script>


</body>
</html>