<?php

@include 'config.php';

if(isset($_POST['order_btn'])){

   $nama = $_POST['nama'];
   $nomer = $_POST['nomer'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $jalan = $_POST['jalan'];
   $kota = $_POST['kota'];
   $tempat = $_POST['tempat'];
   $negara = $_POST['negara'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['nama'] .' ('. $product_item['jumlah'] .') ';
         $product_price = number_format($product_item['harga'] * $product_item['jumlah']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(nama, nomer, email, method, flat, jalan, kota, tempat, negara, pin_code, total_products, total_price) VALUES('$nama','$nomer','$email','$method','$flat','$'jalan','$'kota','$tempat','$kota','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> nama : <span>".$nama."</span> </p>
            <p> nomer: <span>".$nomer."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> alamat anda : <span>".$flat.", ".$jalan.", ".$kota.", ".$tempat.", ".$kota." - ".$pin_code."</span> </p>
            <p> pembayaran metode : <span>".$method."</span> </p>
            <p>(*baya ketika produk tiba*)</p>
         </div>
            <a href='products.php' class='btn'>lanjutkan belanja</a>
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

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $sub_total = number_format($fetch_cart['harga'] * $fetch_cart['jumlah']);
            $total_harga = $total += $sub_total;
      ?>
      <span><?= $fetch_cart['nama']; ?>(<?= $fetch_cart['harga']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> jumlah  : $<?= $total_harga; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>nama anda</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>nomer telepon</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>email anda</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>metode pembayaran</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on devlivery</option>
               <option value="credit cart">m-banking</option>
               <option value="paypal">pay later</option>
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
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. maharashtra" name="state" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. india" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>