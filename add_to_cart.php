<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get product ID from the form
$product_id = $_POST['product_id'];
$customer_id = $_SESSION['user_id'];

// Check if the product is already in the cart
$query = "SELECT * FROM cart WHERE customer_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $customer_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update quantity if already in cart
    $query = "UPDATE cart SET quantity = quantity + 1 WHERE customer_id = ? AND product_id = ?";
} else {
    // Add new product to the cart
    $query = "INSERT INTO cart (customer_id, product_id, quantity) VALUES (?, ?, 1)";
}

$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $customer_id, $product_id);
$stmt->execute();
$stmt->close();

// Redirect back to the category page
header("Location: " . $_SERVER['HTTP_REFERER']);
?>
