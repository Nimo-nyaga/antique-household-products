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

// Fetch customer details
$customer_id = $_SESSION['user_id'];
$query = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $customer = $result->fetch_assoc();
} else {
    echo "Error fetching customer details.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard - Antique Household Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(https://images.pexels.com/photos/2332913/pexels-photo-2332913.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            margin: 0;
            padding: 0;
            color: #333;
        }
        /* Header */
        .header {
            padding: 20px;
            background-color: plum;
            border-bottom: 1px solid plum;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img {
            max-width: 150px;
        }
        /* Navbar */
        .nav {
            background-color: plum;
            padding: 10px 0;
            display: flex;
            justify-content: center;
            border-bottom: 2px solid plum;
        }
        .nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        /* Main Dashboard */
        .dashboard {
            text-align: center;
            padding: 40px 0;
        }
        .dashboard h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: plum;
        }
        .dashboard .section {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 20px;
        }
        .section div {
            background-color: white;
            border: 2px solid plum;
            padding: 20px;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .section div h3 {
            margin-bottom: 15px;
            font-size: 20px;
            color: plum;
        }
        .section div a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <span>Welcome, <?php echo htmlspecialchars($customer['name']); ?>!</span>
        <div>
            <a href="my_account.php">My Account</a>
            <a href="cart.php">Cart</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Navbar -->
    <div class="nav">
        <a href="potraits.php">Portraits</a>
        <a href="vases.php">Vases</a>
        <a href="clocks.php">Clocks</a>
        <a href="antique_furniture.php">Antique Furniture</a>
    </div>

    <!-- Main Dashboard Content -->
    <div class="dashboard">
        <h2>Welcome to Your Dashboard!</h2>
        <p>Manage your account, view orders, and browse products here.</p>
        
        <!-- Dashboard Sections -->
        <div class="section">
            <div>
                <h3>Browse Categories</h3>
                <a href="categories.php">Explore All</a>
            </div>
            <div>
                <h3>My Orders</h3>
                <a href="orders.php">View Orders</a>
            </div>
            <div>
                <h3>Account Settings</h3>
                <a href="account_settings.php">Edit Profile</a>
            </div>
            <div>
                <h3>Cart</h3>
                <a href="cart.php">View Cart</a>
            </div>
        </div>
    </div>

</body>
</html>
