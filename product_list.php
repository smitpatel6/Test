<?php
require_once('database_local.php');


$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
  $category_id = 1;
}


$queryCategory = 'SELECT * FROM categories WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();


$queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();


$queryProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
  <title>My DIY Improvement</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    header {
      background-color: #333;
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }
    nav ul {
      list-style-type: none;
      padding: 0;
    }
    nav ul li {
      display: inline;
      margin-right: 10px;
    }
    nav ul li a {
      color: red;
      text-decoration: none;
    }
    aside {
      width: 20%;
      float: left;
      background-color: #fff;
      padding: 20px;
    }
    section {
      width: 75%;
      float: left;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    table th {
      background-color: #f2f2f2;
    }
    table tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    table tr:hover {
      background-color: #ddd;
    }
    footer {
      clear: both;
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px 0;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
    footer p {
      margin: 0;
    }
  </style>
</head>

<body>
<header>
  <h1>My DIY Improvement</h1>
</header>

<main>
  <aside>
    
    <h2>Categories</h2>
    <nav>
      <ul>
        <?php foreach ($categories as $category) : ?>
          <li>
            <a href="?category_id=<?php echo $category['categoryID']; ?>">
              <?php echo $category['categoryName']; ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </aside>

  <section>
  
    <h2><?php echo $category_name; ?></h2>
    <table>
      <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Price</th>
      </tr>

      <?php foreach ($products as $product) : ?>
        <tr>
          <td><?php echo $product['productCode']; ?></td>
          <td><?php echo $product['productName']; ?></td>
          <td><?php echo $product['listPrice']; ?></td>
          <td>
            <form action="delete_product.php" method="post">
              <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
              <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
              <input type="submit" value="Delete">
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="add_product_form.php">Add Product</a></p>
    <p><a href="product_page.php">Go back to Home Page</a></p>
  </section>
</main>
<footer>
        <p>&copy; <?php echo date('Y'); ?> IT202 PROJECT</p>
    </footer>
</body>
</html>
