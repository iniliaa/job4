
<?php

@include 'config.php';

if(isset($_POST['add_product'])){  // Perbaikan nama formulir
   $p_nama = $_POST['p_nama'];
   $p_harga = $_POST['p_harga'];
   $p_image = $_FILES['p_image']['name'];  // Perbaikan nama variabel file
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(nama, harga, image) VALUES('$p_nama', '$p_harga', '$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);  // Perbaikan nama variabel file
      $message[] = 'product add successfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_GET['delete'])){  // Perbaikan nama atribut pada tombol hapus
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:admin.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){  // Perbaikan nama formulir
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_nama'];  // Perbaikan nama kolom
   $update_p_harga = $_POST['update_p_harga'];
   $update_p_image = $_FILES['update_p_image']['name'];  // Perbaikan nama variabel file
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET nama = '$update_p_name', harga = '$update_p_harga', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);  // Perbaikan nama variabel file
      $message[] = 'produk sukses ditambahkan';
      header('location:admin.php');
   }else{
      $message[] = 'produk gagal ditambahkan';
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
   <title>halaman admin</title>

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

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>tambahkan produk baru</h3>
   <input type="text" name="p_nama" placeholder="isi nama produk" class="box" required>
   <input type="number" name="p_harga" min="0" placeholder="isi harga produk" class="box" required>
   <input type="file" name="p_image" accept="image/jpeg" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>foto produk</th>
         <th>nama produk</th>
         <th>harga produk</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['harga']; ?>/-</td>
            <td>
               <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('yakin mau di hapus?');"> <i class="fas fa-trash"></i> hapus </a>
                  <!-- admin.php -->

<a href="edit.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> edit </a>

            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>tidak ada produk yang di tambahkan</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_p_nama" value="<?php echo $fetch_edit['nama']; ?>">
      <input type="number" min="0" class="box" required name="update_p_harga" value="<?php echo $fetch_edit['harga']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
      };
   ?>

</section>

</div>















<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>