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

    
    $sql = 'SELECT username, verified, password FROM users';
    // $sql = 'SELECT username , password FROM users';
    $result = $conn->query($sql);

    $matched = false;

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] == $username && password_verify($password, $row['password'])) {
                
                // echo isset($row['verified']) ? 'Key exists' : 'Key does not exist';


                if (isset($row['verified']) && $row['verified'] == "yes") {
                    // echo "Username: " . $row["username"]. " - Password: " . $row["password"]. "<br>";
                    echo 'Login Successfully';
                    $matched = true;
                    break;
                }
                else {
                    echo 'Please Verify your email';
                    echo '<button onclick="location.href=\'verifyEmail.html\'">Verify Email</button>';
                    $matched = true;
                    break;
                }
            }
        }
        if (!$matched) {
            echo 'Username and Email is not found';
        }
    } else {
        echo '0 results';
    }
}
// Close connection
$conn->close();
