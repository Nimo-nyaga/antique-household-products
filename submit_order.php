<?php
// db_connect.php should handle your database connection.
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deliveryAddress = $_POST['deliveryAddress'];
    $paymentMethod = $_POST['paymentMethod'];
    $cartData = $_POST['cartData']; // This is JSON-encoded cart data
    $orderDate = date('Y-m-d H:i:s');

    // Insert the order into the database
    $query = "INSERT INTO orders (delivery_address, payment_method, cart_items, order_date) 
              VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $deliveryAddress, $paymentMethod, $cartData, $orderDate);

    if ($stmt->execute()) {
        // Redirect to orders.html or show success message
        header("Location: thank_you.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
