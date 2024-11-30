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

// Fetch customer cart (assuming a `cart` table exists)
$customer_id = $_SESSION['user_id'];
$query = "SELECT c.*, p.name AS product_name, p.price AS product_price 
          FROM cart c 
          JOIN products p ON c.product_id = p.product_id 
          WHERE c.customer_id = '$customer_id'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
</head>
<body>
    <h2>My Cart</h2>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php while ($cart = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $cart['product_name']; ?></td>
                <td><?php echo $cart['product_price']; ?></td>
                <td><?php echo $cart['quantity']; ?></td>
                <td><?php echo $cart['quantity'] * $cart['product_price']; ?></td>
                <td>
                    <a href="remove_from_cart.php?cart_id=<?php echo $cart['cart_id']; ?>">Remove</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="checkout.php">Proceed to Checkout</a>
</body>
</html>
