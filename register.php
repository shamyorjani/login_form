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

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get form data
//     $name = $_POST['name'];
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $date_of_birth = $_POST['dob'];
//     $gender = $_POST['gender'];

//     // Display form data for debugging
//     echo "Name: $name<br>";
//     echo "Username: $username<br>";
//     echo "Email: $email<br>";
//     echo "Password: $password<br>";
//     echo "Date of Birth: $date_of_birth<br>";
//     echo "Gender: $gender<br>";

//     // Hash the password
//     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//     // Generate a verification token
//     $token = bin2hex(random_bytes(16)); // Generate a random 32-character token

//     // Create SQL query
//     $sql = "INSERT INTO `users` (`no`, `name`, `username`, `email`, `password`, `dfb`, `gender`, `verified`) VALUES (NULL, 'khan', 'khan', 'programmingwaliid@gmail.com', 'khan123', '2024-07-17', 'male', '23')";

//     // $sql = "INSERT INTO `users` (`no`, `name`, `username`, `email`, `password`, `dfb`, `gender`, `verified`) VALUES (NULL, '$name', '$username', '$email', '$hashed_password', '$date_of_birth', '$gender', '$token')";

//     if ($conn->query($sql) === TRUE) {
//         // Send verification email
//         $to = $email;
//         $subject = 'Email Verification';
//         $message = "
//             Thank you for registering. Please click the link below to verify your email:
//             http://yourdomain.com/verify.php?email=$email&token=$token
//         ";
//         $headers = 'From: ehtishamfarmanmughal@gmail.com';

//         // Send email
//         if (mail($to, $subject, $message, $headers)) {
//             echo "Registration successful. Please verify your email.";
//         } else {
//             echo "Failed to send verification email.";
//         }
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }
$to = "programmingwalid@gamil.com";
$subject = "Test email";
$message = "This is a test email.";
$headers = "From: ehtishamfarmanmugal@gmail.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}
// Close connection
$conn->close();
