<?php
$host = 'localhost';
$dbname = 'my_diy_improvent_shop1';
$username = 'your_mysql_username';
$password = 'your_mysql_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
