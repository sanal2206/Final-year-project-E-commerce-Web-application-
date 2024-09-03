<?php

@include '../database/db_con.php';

if (isset($_POST['update_update_btn'])) {
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if ($update_quantity_query) {
      header('location:cart.php');
   }
}

if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css" href="../home_page/home.css">

   <link rel="stylesheet" href="../css/style.css">

   <style>
      /* Add this custom CSS to center the table */
      .table-container {
         display: flex;
         justify-content: center;
         align-items: center;
         min-height: 80vh; /* Adjust as needed */
         
      }

      table {
         width: 80%; /* Adjust table width as needed */
         margin: auto;
      }
   </style>
</head>

<body>

   <?php include '../header_footer/header.php'; ?>
   <div class="jumbotron p-3 p-md-5 text-white rounded #d3d3d3;"
      style="margin-bottom: 0;background: rgb(181,180,198);
background: linear-gradient(90deg, rgba(181,180,198,1) 0%, rgba(86,204,228,0.9869135154061625) 49%, rgba(52,142,130,0.9757090336134454) 100%);">
      <div class="container">

         <section class="shopping-cart">

            <h1 class="heading">Shopping Cart</h1>
         <div class="table-container">


            <table style="border: 2px solid black; border-collapse: collapse; width: 100%;">

               <thead>
                  <th style="border: 2px solid black;">Image</th>
                  <th style="border: 2px solid black;">Name</th>
                  <th style="border: 2px solid black;">Description</th>

                  <th style="border: 2px solid black;">Price</th>
                  <th style="border: 2px solid black;">Quantity</th>
                  <th style="border: 2px solid black;">Total Price</th>
                  <th style="border: 2px solid black;">Action</th>
               </thead>

               <tbody>
                  <?php
                  // Fetch cart items from the database
                  $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                  $grand_total = 0;

                  // Check if there are any items in the cart
                  if (mysqli_num_rows($select_cart) > 0) {
                     while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        // Convert the image BLOB to a base64-encoded string
                        $image_data = base64_encode($fetch_cart['product_image']);
                        $image_src = 'data:image/png;base64,' . $image_data;

                        // Calculate the subtotal for the current item
                        $sub_total = $fetch_cart['product_price'] * $fetch_cart['quantity'];

                        // Add the subtotal to the grand total
                        $grand_total += $sub_total;
                        ?>
                        <tr>
                           <!-- Display the product image -->
                           <td style="border: 2px solid black;"><img src="<?php echo $image_src; ?>" alt="Product Image"
                                 style="width: 100px; height: auto;"></td>
                           <!-- Display the product name -->
                           <td style="border: 2px solid black;"><?php echo htmlspecialchars($fetch_cart['product_name']); ?>
                           </td>
                           <!-- Display the product price -->
                           <td style="border: 2px solid black;">
                              <?php echo htmlspecialchars($fetch_cart['product_description']); ?></td>

                           <td style="border: 2px solid black;">
                              <?php echo number_format($fetch_cart['product_price'], 2); ?>/-</td>
                           <!-- Form to update the quantity -->
                           <td style="border: 2px solid black;">
                              <form action="" method="post">
                                 <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                                 <input type="number" name="update_quantity" min="1"
                                    value="<?php echo $fetch_cart['quantity']; ?>">
                                 <input type="submit" value="Update" name="update_update_btn">
                              </form>
                           </td style="border: 2px solid black;">
                           <!-- Display the subtotal -->
                           <td style="border: 2px solid black;"><?php echo number_format($sub_total, 2); ?>/-</td>
                           <!-- Link to remove the item -->
                           <td style="border: 2px solid black;"><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>"
                                 onclick="return confirm('remove item from cart?')" class="delete-btn"><i
                                    class="fas fa-trash"></i> Remove</a></td>
                        </tr>
                        <?php
                     }
                  }
                  ?>
                  <!-- Row for the grand total and action buttons -->
                  <tr class="table-bottom">
                     <td><a href="../productpage/products.php" class="option-btn" style="margin-top: 0;">Continue
                           Shopping</a></td>
                     <td colspan="3">Grand Total</td>
                     <td><?php echo number_format($grand_total, 2); ?>/-</td>

                     <td>
                        <div class="d-grid col-10 mx-auto">
                           <a href="../checkout/checkout.php"
                              class="btn btn-primary btn-lg active <?= ($grand_total > 1) ? '' : 'disabled'; ?>"
                              style="width: 200px; height: 100px;font-size: 20px; text-align: center; line-height: 40px;">Proceed
                              to Checkout</a>
                        </div>
                     <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');"
                           class="delete-btn"><i class="fas fa-trash"></i> Delete All</a></td>

                     </td>
                  </tr>
               </tbody>


            </table>

         </div>

         </section>

      </div>
   </div>
   <!-- custom js file link  -->
   <script src="../js/script.js"></script>
   <?php include '../header_footer/footer.php'; ?>

</body>

</html>