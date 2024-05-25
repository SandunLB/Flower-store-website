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

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Dashboard</a>
         <a href="admin_products.php">Flowers</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Accounts</a>
         <a href="admin_contacts.php">Messages</a>

         <a href="admin_logout.php" >Logout!</a>

      </nav>

   </div>

</header>