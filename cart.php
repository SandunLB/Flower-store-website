<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}


if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>

   <link rel="stylesheet" href="css/cart.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="shopping-cart">

    <h1 class="title">Shopping Cart</h1>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub-total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $grand_total = 0;
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                ?>
                <tr>
                    <td>
                        <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" class="product-image">
                        <span class="product-name"><?php echo $fetch_cart['name']; ?></span>
                    </td>
                    <td>Rs<?php echo $fetch_cart['price']; ?>.00</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                            <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="quantity-input">
                            <input type="submit" value="Update" class="update-btn" name="update_quantity">
                        </form>
                    </td>
                    <td>Rs<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>.00</td>
                    <td>
                        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('Delete this item from cart?');">Delete</a>
                    </td>
                </tr>
                <?php
                    $grand_total += $sub_total;
                        }
                    } else {
                        echo '<tr><td colspan="5" class="empty">Your cart is empty</td></tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div class="cart-total">
        <p>Full Total: <span>Rs<?php echo $grand_total; ?>.00</span></p>
        <a href="shop.php" class="continue-btn option-btn">Continue Browsing</a>
        <a href="checkout.php" class="checkout-btn btn <?php echo ($grand_total > 1) ? '' : 'disabled' ?>">Proceed to Payment</a>
    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
