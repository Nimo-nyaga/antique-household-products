<?php
// Start session
session_start();

// Include database connection
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}

// Check if cart_id is provided
if (isset($_GET['cart_id'])) {
    $cart_id = intval($_GET['cart_id']);

    // Prepare delete query
    $query = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cart_id);

    // Execute and check if deletion was successful
    if ($stmt->execute()) {
        echo "Item removed from cart successfully.";
    } else {
        echo "Error removing item: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

// Redirect to cart page
header("Location: cart.php");
exit();
?>
