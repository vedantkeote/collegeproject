<?php
// Retrieve data sent from the form
// Assuming your form sends data in the POST method
$cartItems = $_POST['cartItems'];

// Connect to your database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "your_database_name"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start a new order
$sql = "INSERT INTO customerorder (order_date, total_price) VALUES (NOW(), 0)";
if ($conn->query($sql) === TRUE) {
    // Get the order ID of the newly inserted order
    $order_id = $conn->insert_id;
    
    // Loop through cart items and insert them into orderitem table
    foreach ($cartItems as $item) {
        $item_description = $item['name'];
        $price = $item['price'];
        
        // Insert item into orderitem table
        $sql = "INSERT INTO orderitem (order_id, item_description, price) VALUES ('$order_id', '$item_description', '$price')";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    echo "Order placed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
