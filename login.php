<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "dinewise"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE custName='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Login successful!";
        } else {
            echo "Invalid username or password!";
        }
    }
    elseif (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "INSERT INTO customer (custName, custEmail, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
         
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
