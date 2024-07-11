<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user-registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// echo "Connection created<br>";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT username, password FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["username"] == $username && password_verify($password, $row['password'])){
                // echo "Username: " . $row["username"]. " - Password: " . $row["password"]. "<br>";
                echo "Login Successfully";
                break;

            }
        }
        echo "Invalid User name or password";
    } else {
        echo "0 results";
    }
}
// Close connection
$conn->close();
?>
