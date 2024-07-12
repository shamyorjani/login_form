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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    echo "Email: $email<br>";

    // Generate a verification token
    $token = bin2hex(random_bytes(4)); // Generate a random 32-character token

    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($emailCheckResult->num_rows > 0) {
        $row = $emailCheckResult->fetch_assoc();
        if ($row['email'] == $email) {
            // Send verification email
            $to = $email;
            $subject = 'Email Verification';
            $message = "
                    Thank you for registering. Please click the link below to verify your email:
                    http://$servername/login_form/verify.php?email=$email&token=$token
                ";
            $headers = 'From: ehtishamfarmanmughal@gmail.com';

            // Send email
            if (mail($to, $subject, $message, $headers)) {
                $sqlTokenUpdate = "UPDATE `users` SET `token` = '$token' WHERE email = '$email'";
                $conn->query($sqlTokenUpdate);
                echo "Mail sended successfully. Please verify your email.";

            } else {
                echo "Failed to send verification email.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    exit;
}
// else {


// }

// $to = "programmingwalid@gamil.com";
// $subject = "Test email";
// $message = "This is a test email.";
// $headers = "From: ehtishamfarmanmugal@gmail.com";

// if (mail($to, $subject, $message, $headers)) {
//     echo "Email sent successfully.";
// } else {
//     echo "Failed to send email.";
// }

// Close connection
$conn->close();
