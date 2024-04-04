<?php

   $dsn = 'mysql:host=localhost;port=3306;dbname=my_diy_improvement_shop1';
   $username = 'smp48';
   $password = '$miTx2849g';

   try {
    $db = new PDO($dsn, $username, $password);
    echo '<p>Welcome';
   }
    catch (PDOException $ex) {
    $error_message = $ex->getMessage();
    //include("database_error.php");
    exit();
    }
 ?>