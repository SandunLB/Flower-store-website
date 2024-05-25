<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $filter_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
   $username = mysqli_real_escape_string($conn, $filter_username);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$username'") or die('query failed');

   if(mysqli_num_rows($select_admin) > 0){
      $message[] = 'Username already exists!';
   } else {
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      } else {
         mysqli_query($conn, "INSERT INTO `admin`(username, password) VALUES('$username', '$pass')") or die('query failed');
         $message[] = 'Registered successfully!';
         header('location:admin_login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Register</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/login.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<section class="form-container">
   <form action="" method="post">
      <h3>Admin Register</h3>
      <input type="text" name="username" class="box" placeholder="Enter your username" required>
      <input type="password" name="pass" class="box" placeholder="Enter your password" required>
      <input type="password" name="cpass" class="box" placeholder="Confirm your password" required>
      <input type="submit" class="btn" name="submit" value="Register Now">
      <p>Already have an account? <a href="admin_login.php">Login now</a></p>
   </form>
</section>

</body>
</html>
