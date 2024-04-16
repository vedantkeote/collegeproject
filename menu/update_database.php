<?php
// Retrieve data sent from the form
// Assuming your form sends data in the POST method
$cartItems = $_POST['cartItems'];

// Process and update the database with $cartItems data
// Example code to update the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming your database table structure is like this
// You need to adjust this according to your actual database structure
foreach ($cartItems as $item) {
    $name = $item['name'];
    $price = $item['price'];
    // Insert item into database
    $sql = "INSERT INTO cart_items (name, price) VALUES ('$name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
