<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $filter_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
   $username = mysqli_real_escape_string($conn, $filter_username);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$username' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_admin) > 0){
      $row = mysqli_fetch_assoc($select_admin);

      $_SESSION['admin_name'] = $row['username'];
      $_SESSION['admin_id'] = $row['admin_id'];

      header('location:admin_page.php');
   } else {
      $message[] = 'Incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
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
      <h3>Admin Login</h3>
      <input type="text" name="username" class="box" placeholder="Enter your username" required>
      <input type="password" name="pass" class="box" placeholder="Enter your password" required>
      <input type="submit" class="btn" name="submit" value="Login Now">
      <p>Don't have an account? <a href="admin_register.php">Register now</a></p>
   </form>
</section>

</body>
</html>
