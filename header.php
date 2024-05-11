<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Website</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>

<header class="header">

    <div class="header-container">

        <a href="home.php" class="header-logo">flowers.</a>

        <nav class="header-nav">
            <ul>
                <li><a href="home.php">home</a></li>
                <li><a href="about.php">about</a></li>
                <li><a href="contact.php">contact</a></li>
                <li><a href="shop.php">shop</a></li>
                <li><a href="orders.php">orders</a></li>              
                <li><a href="login.php">login</a></li>
                <li><a href="register.php">register</a></li>    
            </ul>
        </nav>

        <div class="header-icons">
            <div id="menu-btn" class="header-menu-btn"></div>
            <a href="search_page.php" class="header-search-btn">🔍</a>
            <div id="user-btn" class="header-user-btn"></div>
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="header-heart-icon">💖</i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="header-cart-icon">🛍️</i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="header-account-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="header-logout-btn">logout</a>
        </div>

    </div>

</header>

<!-- Your main content goes here -->

</body>
</html>
