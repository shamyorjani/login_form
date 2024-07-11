<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user-registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process verification
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Update user record to mark as verified
    $sql = "UPDATE `users` SET `verified` = '1' WHERE `email` = '$email' AND `verified` = '$token'";

    if ($conn->query($sql) === TRUE) {
        echo "Email verification successful. You can now <a href='login.html'>login</a>.";
    } else {
        echo "Email verification failed.";
    }
} else {
    echo "Invalid verification request.";
}

// Close connection
$conn->close();
?>
