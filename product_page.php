<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('database_local.php');
require_once('image_source.php');

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in
    $isLoggedIn = true;
} else {
    // User is not logged in
    $isLoggedIn = false;
}

// Query products from the database
$query = 'SELECT categories.categoryName, products.productID, products.productCode, products.productName, products.listPrice 
          FROM products 
          INNER JOIN categories ON products.categoryID = categories.categoryID
          ORDER BY categories.categoryName, products.productName';
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll(); 
$statement->closeCursor();

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product List</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f9f9f9;
            }

            header {
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 20px 0;
            }
            nav {
                text-align: center;
                margin-top: 20px;
            }
            nav a {
                color: #fff;
                text-decoration: none;
                margin: 0 10px;
            }
            main {
                width: 80%;
                margin: 0 auto;
                padding: 20px 0;
            }
            ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }
            li {
                margin-bottom: 20px;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            a {
                color: #333;
                text-decoration: none;
            }
            a:hover {
                color: #555;
            }
            footer {
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 10px 0;
                position: fixed;
                bottom: 0;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <header>
        <h1>Product List</h1>
        <img src="<?php echo $imageSource; ?>" alt="Logo" style="width: 400px;height: 250px;object-fit:cover;margin:0 auto;display:block;">
                <nav>
                <a href="index.php">Home</a>
                <?php if ($isLoggedIn): ?>
                    <a href="shipping.php">Shipping</a>
                    <a href="add.php">Add</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
                </nav>
        </header>
        <main>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li>
                        <a href="product_details.php?product_id=<?php echo $product['productID']; ?>">
                        <?php echo $product['productName']; ?> - $<?php echo $product['listPrice']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </main>
    </body>
</html>
