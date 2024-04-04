<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Page</title>
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

        form {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        select {
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

        .error {
            color: red;
            margin-bottom: 10px;
        }
        footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 2px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <img src="https://cdn11.bigcommerce.com/s-rcvl76lfrq/product_images/uploaded_images/2020-diy.jpg" alt="Logo" style="width: 400px;height: 250px;object-fit:cover;margin:0 auto;display:block;">
        <nav>
            <a href="index.php">Home</a>
            <a href="shipping.php">Shipping</a>
            <a href="add_product_form.php">Add</a>
        </nav>
    </header>
    
    <form action="shipping_process.php" method="post">
        <label for="from_address">From Address:</label>
        <!-- Assuming fixed "From" address for the store -->
        <input type="text" id="from_address" name="from_address" value="Your Store Address" readonly>
        
        <h2>To Address:</h2>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="street_address">Street Address:</label>
        <input type="text" id="street_address" name="street_address" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="state">State:</label>
        <input type="text" id="state" name="state" required>

        <label for="zip_code">Zip Code:</label>
        <input type="text" id="zip_code" name="zip_code" required>

        <label for="ship_date">Ship Date:</label>
        <input type="date" id="ship_date" name="ship_date" required>

        <label for="order_number">Order Number:</label>
        <input type="text" id="order_number" name="order_number" required>

        <label for="length">Length (in inches):</label>
        <input type="text" id="length" name="length" required>

        <label for="width">Width (in inches):</label>
        <input type="text" id="width" name="width" required>

        <label for="height">Height (in inches):</label>
        <input type="text" id="height" name="height" required>

        <label for="declared_value">Declared Value ($):</label>
        <input type="text" id="declared_value" name="declared_value" required>

        <input type="submit" value="Submit">
    </form>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> IT202 PROJECT</p>
    </footer>
</body>
</html>
