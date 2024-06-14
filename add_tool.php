<?php
session_start();
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    $toolName = $_POST['toolName'];
    $quantity = $_POST['quantity'];

    // Insert the tool into the database
    $stmt = $conn->prepare("INSERT INTO tools (name, quantity) VALUES (?, ?)");
    $stmt->bind_param("si", $toolName, $quantity);
    $stmt->execute();
    $stmt->close();

    // Redirect to admin page
    header("Location: admin_page.php");
    exit();
} else {
    // Redirect to login page if not logged in as admin
    header("Location: login.html");
    exit();
}
?>