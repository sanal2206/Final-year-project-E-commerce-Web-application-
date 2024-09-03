<?php



if (isset($_POST['order_btn'])) {

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   @include '../database/db_con.php';
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if (mysqli_num_rows($cart_query) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_query)) {
         $product_name[] = $product_item['product_name'] . ' (' . $product_item['quantity'] . ') ';
         $product_price = number_format($product_item['product_price'] * $product_item['quantity']);
         $price_total += $product_price;
      }
      ;
   }
   ;

   $total_product = implode(', ', $product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

   if ($cart_query && $detail_query) {
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>" . $total_product . "</span>
            <span class='total'> total : $" . $price_total . "/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>" . $name . "</span> </p>
            <p> your number : <span>" . $number . "</span> </p>
            <p> your email : <span>" . $email . "</span> </p>
            <p> your address : <span>" . $flat . ", " . $street . ", " . $city . ", " . $state . ", " . $country . " - " . $pin_code . "</span> </p>
            <p> your payment mode : <span>" . $method . "</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='../productpage/products.php' class='cs'  style='font-size: 28px;'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" type="text/css" href="../home_page/home.css">


</head>

<body>

   <?php include '../header_footer/header.php'; ?>


   <li class="nav-item">
      <div>
         <?php
         @include '../database/db_con.php';
         $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
         $row_count = mysqli_num_rows($select_rows);

         ?>

   <li class="cart-button">
      <a class="nav-link cart" href="../cart_page/cart.php"
         style="background-color: #4CAF50; margin-left:900px; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 16px;">
         cart <span><?php echo "( $row_count)"; ?></span>
      </a>
   </li>

   <div>

      <div class="container">

         <section class="checkout-form">

            <h1 class="heading">complete your order</h1>

            <form action="" method="post">

               <div class="display-order">
                  <?php
                  @include '../database/db_con.php';
                  $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                  $total = 0;
                  $grand_total = 0;
                  if (mysqli_num_rows($select_cart) > 0) {
                     while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        $total_price = number_format($fetch_cart['product_price'] * $fetch_cart['quantity']);
                        $grand_total = $total += $total_price;
                        ?>
                        <span><?= $fetch_cart['product_name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                        <?php
                     }
                  } else {
                     echo "<div class='display-order'><span>your cart is empty!</span></div>";
                  }
                  ?>
                  <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
               </div>

               <div class="flex">
                  <div class="inputBox">
                     <span>your name</span>
                     <input type="text" placeholder="enter your name" name="name" required>
                  </div>
                  <div class="inputBox">
                     <span>your number</span>
                     <input type="number" placeholder="enter your number" name="number" required>
                  </div>
                  <div class="inputBox">
                     <span>your email</span>
                     <input type="email" placeholder="enter your email" name="email" required>
                  </div>
                  <div class="inputBox">
                     <span>payment method</span>
                     <select name="method">
                        <option value="cash on delivery" selected>Cash on devlivery</option>
                        <option value="credit cart">Credit Cart</option>
                        <option value="credit cart">Debit Cart</option>

                        <option value="credit cart">Internet Banking</option>
                        <option value="paypal">Paypal</option>
                     </select>
                  </div>
                  <div class="inputBox">
                     <span>address line 1</span>
                     <input type="text" placeholder="e.g. flat no." name="flat" required>
                  </div>
                  <div class="inputBox">
                     <span>address line 2</span>
                     <input type="text" placeholder="e.g. street name" name="street" required>
                  </div>
                  <div class="inputBox">
                     <span>city</span>
                     <input type="text" placeholder="e.g. Bangalore" name="city" required>
                  </div>
                  <div class="inputBox">
                     <span>state</span>
                     <input type="text" placeholder="e.g. Karnataka" name="state" required>
                  </div>
                  <div class="inputBox">
                     <span>country</span>
                     <input type="text" placeholder="e.g. India" name="country" required>
                  </div>
                  <div class="inputBox">
                     <span>pin code</span>
                     <input type="text" placeholder="e.g. 577431" name="pin_code" required>
                  </div>
               </div>
               <div style="display: flex; justify-content: center; align-items: center; height: 20vh;">
                  <input type="submit" value="Order Now" name="order_btn" class="btn"
                     style="background-color: #4CAF50; font-size: 30px; width: 250px; height: 90px; color: white; padding: 10px 20px; border: none; cursor: pointer;">
               </div>
            </form>

         </section>

      </div>

      <!-- custom js file link  -->
      <script src="js/script.js"></script>


      <?php include '../header_footer/footer.php'; ?>

</body>

</html>