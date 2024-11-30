<?php
// Include database connection file
require_once 'db_connect.php';

// Start a session to manage user login state
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists in the customers table
    $query = "SELECT * FROM users WHERE email = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['email'];

            // Redirect to the customer dashboard
            header("Location: customer dashboard.html");
            exit;
        } else {
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        $error_message = "No account found with that email.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Antique Household Products</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="link">
            <a href="signup.html">Don't have an account? Sign Up</a>
        </div>
    </div>
</body>
</html>
