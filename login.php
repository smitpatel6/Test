<?php
// Start the session
session_start();

// Include image source file
$imageSource = include "image_source.php";

// Check if the user is already logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is already logged in, redirect to home page
    header("Location: index.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

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

    // Prepare and bind the SQL statement to retrieve user's hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if($stmt->num_rows > 0) {
        // Bind the result
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify password
        if(password_verify($password, $hashed_password)) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            // Redirect to home page
            header("Location: index.php");
            exit;
        } else {
            // Incorrect password
            $error = "Incorrect username or password.";
        }
    } else {
        // User does not exist, create the user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert_stmt->bind_param("ss", $username, $hashed_password);
        if ($insert_stmt->execute()) {
            // User created successfully, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            // Redirect to home page
            header("Location: index.php");
            exit;
        } else {
            // Failed to create user
            $error = "Failed to create user.";
        }
    }

    // Close the statements and database connection
    $stmt->close();
    $insert_stmt->close();
    $conn->close();
}

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="shipping.css">
</head>
<body>
<header>
    <img src="<?php echo $imageSource; ?>" alt="Logo" style="width: 400px;height: 250px;object-fit:cover;margin:0 auto;display:block;">
    <h1>DIY Home Improvements</h1>
    <style>
        nav{
            background-color: #fff;
        }
    </style>
    <nav>
    <a href="index.php">Home</a>
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
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</main>
</body>
</html>
