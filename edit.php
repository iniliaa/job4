<!-- edit.php -->

<?php
@include 'config.php';

if(isset($_GET['edit'])){
   $edit_id = $_GET['edit'];
   $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
   if(mysqli_num_rows($edit_query) > 0){
      while($fetch_edit = mysqli_fetch_assoc($edit_query)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
</body>
<form action="update.php" method="post" enctype="multipart/form-data">
    <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
    <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
    <input type="text" class="box" required name="update_p_nama" value="<?php echo $fetch_edit['nama']; ?>">
    <input type="number" min="0" class="box" required name="update_p_harga" value="<?php echo $fetch_edit['harga']; ?>">
    <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
    <input type="submit" value="update the prodcut" name="update_product" class="btn">
    <input type="reset" value="cancel" id="close-edit" class="option-btn">
</form>
</html>

<?php
      }
   }
}
?>

