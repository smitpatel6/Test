<?php
require_once('database_local.php');

$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
if ($product_id == NULL || $product_id == FALSE) {
    echo "Invalid product ID";
    exit();
}

$query = 'SELECT categories.categoryName, products.productCode, products.productName, products.listPrice 
          FROM products 
          INNER JOIN categories ON products.categoryID = categories.categoryID
          WHERE products.productID = :product_id';
$statement = $db->prepare($query);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$product = $statement->fetch();
$statement->closeCursor();

if (!$product) {
    echo "Product not found";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['productName']; ?> Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        main {
            width: 80%;
            margin: 0 auto;
            padding: 20px 0;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1><?php echo $product['productName']; ?> Details</h1>
    </header>
    
    <main>
        <p>Category: <?php echo $product['categoryName']; ?></p>
        <p>Product Code: <?php echo $product['productCode']; ?></p>
        <p>List Price: $<?php echo number_format($product['listPrice'], 2); ?></p>
        <p>Description: <?php echo $product['description'];?></p>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> IT202 PROJECT</p>
    </footer>
</body>
</html>
