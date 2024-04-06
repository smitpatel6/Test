<?php
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$description = filter_input(INPUT_POST, 'description');

$min_price = 0; // Minimum price allowed
$max_price = 1000000; // Maximum price allowed

if ($category_id == NULL || $category_id == FALSE || $code == NULL || 
    $name == NULL || $price == NULL || $price == FALSE || $price < $min_price || $price > $max_price || $price < 0) {
    $error = "Invalid product data. Check all fields and try again.";
    echo "$error <br>";
} else {
    require_once('database_local.php');

    // Add the description column to the products table
    $alter_query = 'ALTER TABLE products ADD COLUMN description TEXT';
    $alter_statement = $db->prepare($alter_query);
    $alter_success = $alter_statement->execute();
    $alter_statement->closeCursor();

    if (!$alter_success) {
        echo "<p>Failed to add description column to the products table.</p>";
    }

    // Proceed with inserting the product data
    $query = 'INSERT INTO products
                 (categoryID, productCode, productName, listPrice, description)
              VALUES
                 (:category_id, :code, :name, :price, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $success = $statement->execute();
    $statement->closeCursor();
    
    if ($success) {
        echo "<p>Product added successfully to the category.</p>";
    } else {
        echo "<p>Failed to add product to the category.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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

        h1 {
            text-align: center;
        }
        

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add Product</h1>
    </header>

    <main>
        <form action="add_product.php" method="post" id="add_product_form">
            <label>Category:</label>
            <select name="category_id">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['categoryID']; ?>">
                        <?php echo $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <label>Code:</label>
            <input type="text" name="code"><br>

            <label>Name:</label>
            <input type="text" name="name"><br>

            <label>List Price:</label>
            <input type="text" name="price"><br>

            <label>Description:</label>
            <input type="text" name="description"><br>

            <input type="submit" value="Add Product"><br>
        </form>
        <p><a href="product_list.php">View Product List</a></p>
    </main>
</body>
</html>
