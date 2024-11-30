<?php
include('db_connect.php'); // Include the database connection

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row['name'] . "</h2>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Price: " . $row['price'] . "</p>";
        echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "' style='width: 200px;'>";
        echo "</div>";
    }
} else {
    echo "No products found.";
}

$conn->close();
?>
