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
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>
   <link rel="stylesheet" href="css/about.css">
</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="about">
    <div class="container">
        <h2>Welcome to Our Enchanted Garden</h2>
        <div class="content">
            <div class="image">
                <img src="images/about-img-2.jpg" alt="Image 1">
            </div>
            <div class="text">
                <p>In the heart of the mystical forest lies our enchanted garden, where the most exquisite flowers bloom under the moonlight. Here, we create magic with petals, weaving dreams into every arrangement.</p>
            </div>
        </div>
        <div class="content">
            <div class="text">
                <p>Our journey began with a single seed and a vision to bring the beauty of nature to the world. With each blossom that unfolds, we are reminded of the power of creation and the wonder of life.</p>
            </div>
            <div class="image">
                <img src="images/about-img-2.jpg" alt="Image 2">
            </div>
        </div>
        <div class="content">
            <div class="image">
                <img src="images/about-img-3.jpg" alt="Image 3">
            </div>
            <div class="text">
                <p>From delicate roses to vibrant tulips, our garden is home to a kaleidoscope of colors and scents. Every flower tells a story, and we are honored to be part of yours.</p>
            </div>
        </div>
    </div>
</section>

<?php @include 'footer.php'; ?>

</body>
</html>
