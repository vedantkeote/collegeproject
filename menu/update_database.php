<?php
// Assuming you have a database connection established already
// Replace 'your_database_host', 'your_database_name', 'your_database_user', and 'your_database_password' with your actual database credentials

$cartItems = $_POST['cartItems'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finaldinewise";

$mysqli = new mysqli('localhost', 'root', '', 'finaldinewise');

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['selectedObjects']) && is_array($data['selectedObjects'])) {
        // Assuming you have a table named 'orders' with columns 'id', 'img', 'price', and 'title'
        $stmt = $mysqli->prepare("INSERT INTO orders (img, price, title) VALUES (?, ?, ?)");

        foreach ($data['selectedObjects'] as $item) {
            $img = $item['img'];
            $price = $item['price'];
            $title = $item['title'];

            $stmt->bind_param('sss', $img, $price, $title);
            $stmt->execute();
        }

        $stmt->close();
        $mysqli->close();

        http_response_code(201);
        echo json_encode(array("message" => "Order received and stored successfully."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Invalid data format."));
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method not allowed."));
}
?>
