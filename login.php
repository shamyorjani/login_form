<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user-registration';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// echo "Connection created<br>";

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = 'SELECT userna`me, password FROM users';
    $result = $conn->query($sql);

    $matched = false;

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] == $username && password_verify($password, $row['password'])) {
                // echo "Username: " . $row["username"]. " - Password: " . $row["password"]. "<br>";
                echo 'Login Successfully';
                $matched = true;
                break;
            }

        }
        if(!$matched){
            $matched = false;
            echo 'nothing matched';
        }
    } else {
        echo '0 results';
    }
}
// Close connection
$conn->close();
