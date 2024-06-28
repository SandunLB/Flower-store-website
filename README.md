# Flower Selling Website

This project is a flower selling website developed using PHP and MySQL.

## Features

- **Product Catalog:** Browse and search for various types of flowers.
- **User Registration and Authentication:** Users can create accounts and log in securely.
- **Shopping Cart:** Add flowers to a shopping cart and proceed to checkout.
- **Order Management:** Users can view their order history and current orders.
- **Admin Panel:** Manage products, orders, and user accounts.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL


## Setup Instructions

1. **Import Database:**
   - Create a MySQL database and import `database.sql` file included in the repository.

2. **Configure Database Connection:**
   - Update `config.php` with your database credentials:
     ```php
     <?php
     define('DB_SERVER', 'localhost');
     define('DB_USERNAME', 'root');
     define('DB_PASSWORD', 'password');
     define('DB_DATABASE', 'flower_db');
     $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
     ?>
     ```

3. **Start the Application:**
   - Navigate to the project directory and start a PHP server:
     ```bash
     php -S localhost:8000
     ```

4. **Access the Application:**
   - Open your web browser and go to `http://localhost:8000`
