<?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is already logged in, redirect to home page or wherever you want
    header("Location: index.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database
    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $username_db = "root"; // Change this to your database username
    $password_db = ""; // Change this to your database password
    $dbname = "my_diy_improvement_shop1";

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement to insert the user's credentials into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // User registered successfully
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        // Redirect to home page or wherever you want
        header("Location: index.php");
        exit;
    } else {
        // Error occurred while registering user
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="shipping.css">
</head>
<body>
<header>
    <img src="https://cdn11.bigcommerce.com/s-rcvl76lfrq/product_images/uploaded_images/2020-diy.jpg" alt="Logo" style="width: 400px;height: 250px;object-fit:cover;margin:0 auto;display:block;">
    <h1>DIY Home Improvements</h1>
    <style>
        nav{
            background-color: #fff;
        }
    </style>
    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="product_page.php">All products</a>
    </nav>
</header>
<main style="text-align:center;">
    <h1 style="margin-top:50px;">Login to Your Account</h1>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</main>
</body>
</html>
