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

// Fetch products for the "vases" category
$query = "SELECT * FROM products WHERE category = 'vases'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vases - Antique Household Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .header {
            padding: 20px;
            background-color: plum;
            color: white;
            text-align: center;
        }
        .product {
            border: 1px solid #ccc;
            margin: 15px;
            padding: 15px;
            text-align: center;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product h3 {
            color: plum;
        }
        .product button {
            background-color: plum;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .product button:hover {
            background-color: #b57c9b;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Vases</h1>
        <p>Explore our exclusive collection of antique portraits.</p>
    </div>
    <div class="container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product">
                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Vase">
                <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <p><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
