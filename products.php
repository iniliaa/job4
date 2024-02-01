<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

$product_nama = $_POST['product_nama'];
$product_harga = $_POST['product_harga'];
$product_image = $_POST['product_image'];
$product_jumlah = 0;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE nama = '$product_nama'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'produk siap di tambahkan';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart` (nama, harga, image, jumlah) VALUES ('$product_nama', '$product_harga', '$product_image', '$product_jumlah')");

      $message[] = 'penambahan produk sukses';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>produk</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="produk">

   <h1 class="heading">daftar produk</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
         <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" height="100" alt="">
            <h3><?php echo $fetch_product['nama']; ?></h3>
            <div class="harga">$<?php echo $fetch_product['harga']; ?>/-</div>
            <input type="hidden" name="product_nama" value="<?php echo $fetch_product['nama']; ?>">
            <input type="hidden" name="product_harga" value="<?php echo $fetch_product['harga']; ?>">
            <!-- <input type="file" name="product_image" value="<?php echo $fetch_product['image']; ?>"> -->
            <input type="submit" class="btn" value="tambahkan keranjanng" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>


</body>
</html>