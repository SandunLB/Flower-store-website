<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'message sent already!';
    }else{
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'message sent successfully!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <link rel="stylesheet" href="css/contact.css">
</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="contact">
    <div class="container">
        <h2 class="title">Get in Touch</h2>
        <form action="" method="POST" class="contact-form">
            <div class="input-group">
                <input type="text" name="name" placeholder="Your Name" class="box" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Your Email" class="box" required>
            </div>
            <div class="input-group">
                <input type="tel" name="number" placeholder="Your Mobile Number" class="box" required>
            </div>
            <div class="input-group">
                <textarea name="message" placeholder="Your Message" class="box" required cols="30" rows="6"></textarea>
            </div>
            <div class="input-group">
                <input type="submit" value="Send Message" name="send" class="btn">
            </div>
        </form>
    </div>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
