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

// Fetch product categories
$query = "SELECT * FROM categories"; // Assuming a `categories` table
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>
    <h2>Product Categories</h2>
    <ul>
        <?php while ($category = $result->fetch_assoc()): ?>
            <li>
                <a href="products.php?category_id=<?php echo $category['id']; ?>">
                    <?php echo htmlspecialchars($category['name']); ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
