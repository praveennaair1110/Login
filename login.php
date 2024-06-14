<?php
session_start();

// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "pP2481375*";
$dbname = "company_dbas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL injection prevention
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Hash the password
$password = hash('sha256', $password);

// SQL query to check if the user exists
$sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// If user exists, redirect to tool_inventory_management.php
if ($result->num_rows > 0) {
    header("Location: tool_inventory_management.php");
} else {
    // If user does not exist, redirect back to login page with error message
    header("Location: login.html?error=1");
}

$conn->close();
?>