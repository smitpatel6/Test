<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
    
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

        .label {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .label h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Shipping Label</h1>
    </header>

    <div class="label">
        <h2>Shipping Details</h2>
        <?php
       
        $from_address = "Your Store Address"; 
        $to_address = $_POST['first_name'] . " " . $_POST['last_name'] . "<br>" . $_POST['street_address'] . "<br>" . $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zip_code'];
        $ship_date = $_POST['ship_date'];
        $order_number = $_POST['order_number'];
        $length = $_POST['length'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $declared_value = $_POST['declared_value'];

        
        $error = "";
        if ($declared_value > 1000) {
            $error .= "Declared value cannot exceed $1,000. ";
        }
        if ($length > 36 || $width > 36 || $height > 36) {
            $error .= "Dimensions cannot exceed 36 inches. ";
        }

       
        if (!empty($error)) {
            echo "<p class='error'>$error</p>";
        } else {
          
            $tracking_number = strtoupper(substr(md5(uniqid(rand(), true)), 0, 10));

            
            echo "<p><strong>From:</strong> $from_address</p>";
            echo "<p><strong>To:</strong><br>$to_address</p>";
            echo "<p><strong>Ship Date:</strong> $ship_date</p>";
            echo "<p><strong>Order Number:</strong> $order_number</p>";
            echo "<p><strong>Dimensions:</strong> $length x $width x $height inches</p>";
            echo "<p><strong>Declared Value:</strong> $$declared_value</p>";
            echo "<p><strong>Shipping Company:</strong> USPS</p>";
            echo "<p><strong>Shipping Class:</strong> Priority Mail</p>";
            echo "<p><strong>Tracking Number:</strong> $tracking_number</p>";
            echo "<img src='barcode.jpg' alt='Barcode Image' style='width: 200px;'>";
        }
        ?>
    </div>
</body>
</html>
