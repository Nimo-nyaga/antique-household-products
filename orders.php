<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: yellow;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .no-orders {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Your Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Delivery Address</th>
                <th>Payment Method</th>
                <th>Cart Items</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include the database connection
            include 'db_connect.php';

            // SQL query to fetch all orders
            $query = "SELECT * FROM orders ORDER BY order_date DESC";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                // Loop through each order and display it in the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['delivery_address']) . "</td>";
                    echo "<td>" . $row['payment_method'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['cart_items']) . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='no-orders'>No orders found.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
