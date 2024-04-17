<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "finaldinewise";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data using $_POST superglobal
    $name = $_POST["name"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $people = $_POST["people"];

    // Display the extracted data
    echo "<h2>Form Data:</h2>";
    echo "<p>Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Date: $date</p>";
    echo "<p>Time: $time</p>";
    echo "<p>Number of People: $people</p>";
} else {
    // Display a message if the form is not submitted
    echo "<h2>No data submitted</h2>";
}
?>
