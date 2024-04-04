<?php
require_once('database_local.php');

$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My diy improvement</title>
    <link rel="stylesheet" href="product_list.css">
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

<!-- the body section -->
<body>
<body>
<header>
        <img src="https://cdn11.bigcommerce.com/s-rcvl76lfrq/product_images/uploaded_images/2020-diy.jpg" alt="Logo" style="width: 400px;height: 250px;object-fit:cover;margin:0 auto;display:block;">
        <nav>
            <a href="index.php">Home</a>
            <a href="shipping.php">Shipping</a>
            <a href="add_product_form.php">Add</a>
        </nav>
    </header>
    
    <main>
        <h2>Add Product</h2>
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

            <label>Description:</label>
            <input type="text" name="description"><br>
           
            <label>List Price:</label>
            <input type="text" name="price"><br>

            <input type="submit" value="Add Product"><br>
        </form>
        <p><a href="product_list.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> IT202 PROJECT</p>
    </footer>
</body>
</html> 
