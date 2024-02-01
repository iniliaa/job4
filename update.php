<!-- update.php -->

<?php
@include 'config.php';

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_nama'];
   $update_p_harga = $_POST['update_p_harga'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET nama = '$update_p_name', harga = '$update_p_harga', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'produk sukses ditambahkan';
      header('location:admin.php');
   } else {
      $message[] = 'produk gagal ditambahkan';
      header('location:admin.php');
   }
}
?>
