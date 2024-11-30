<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the admin email already exists
    $check_query = "SELECT * FROM admin_panel WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "An account with this email already exists.";
    } else {
        // Insert the new admin into the database
        $insert_query = "INSERT INTO admin_panel (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($conn, $insert_query)) {
            echo "Admin account created successfully. <a href='admin_login.html'>Log in here</a>.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
