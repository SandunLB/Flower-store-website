<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
    header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
    header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist</title>
   <link rel="stylesheet" href="css/wishlist.css">
</head>
<body>
   <?php include 'header.php'; ?>
   <main class="wishlist">
      <h1>Added Products !</h1>
      <?php
         $grand_total = 0;
         $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('Query failed');
         if(mysqli_num_rows($select_wishlist) > 0){
            echo '<div class="wishlist-items">';
            while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
               $grand_total += $fetch_wishlist['price'];
               ?>
               <div class="wishlist-item">
                  <img src="uploaded_img/<?php echo $fetch_wishlist['image']; ?>" alt="" class="wishlist-item__image">
                  <div class="wishlist-item__details">
                     <h2 class="wishlist-item__name"><?php echo $fetch_wishlist['name']; ?></h2>
                     <p class="wishlist-item__price">Rs.<?php echo $fetch_wishlist['price']; ?>.00</p>
                     <div class="wishlist-item__actions">
                        <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="wishlist-item__delete" onclick="return confirm('Delete this from wishlist?');">Remove</a>
                     </div>
                  </div>
               </div>
               <?php
            }
            echo '</div>'; // Close wishlist-items
         } else {
            echo '<p>Your wishlist is empty.</p>';
         }
      ?>
      <div class="wishlist-total">
         <p>Total: <span>Rs<?php echo $grand_total; ?>.00</span></p>
         <div class="wishlist-actions">
            <a href="shop.php" class="wishlist-actions__button">Continue Shopping</a>
            <a href="wishlist.php?delete_all" class="wishlist-actions__button <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>" onclick="return confirm('Delete all from wishlist?');">Clear Wishlist</a>
         </div>
      </div>
   </main>
   <?php include 'footer.php'; ?>
   <script src="js/script.js"></script>
</body>
</html>
