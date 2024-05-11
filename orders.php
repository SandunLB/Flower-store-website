<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Orders</title>
   
   <link rel="stylesheet" href="css/order.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="content">
    <div class="placed-orders">
        <h1 class="title">Placed Orders</h1>

        <div class="order-list">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_orders) > 0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
                    <div class="order">
                        <div class="order-info">
                            <div class="order-detail">Placed On: <?php echo $fetch_orders['placed_on']; ?></div>
                            <div class="order-detail">Name: <?php echo $fetch_orders['name']; ?></div>
                            <div class="order-detail">Number: <?php echo $fetch_orders['number']; ?></div>
                            <div class="order-detail">Email: <?php echo $fetch_orders['email']; ?></div>
                            <div class="order-detail">Address: <?php echo $fetch_orders['address']; ?></div>
                            <div class="order-detail">Payment Method: <?php echo $fetch_orders['method']; ?></div>
                        </div>
                        <div class="order-details">
                            <div class="order-detail">Your Orders: <?php echo $fetch_orders['total_products']; ?></div>
                            <div class="order-detail">Total Price: $<?php echo $fetch_orders['total_price']; ?>/-</div>
                            <div class="order-detail">Payment Status: <span style="color:<?php echo ($fetch_orders['payment_status'] == 'pending') ? 'tomato' : 'green'; ?>"><?php echo $fetch_orders['payment_status']; ?></span></div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="empty">No orders placed yet!</div>';
            }
            ?>
        </div>
    </div>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
