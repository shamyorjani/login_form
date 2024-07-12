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
    // Get form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date_of_birth = $_POST['dob'];
    $gender = $_POST['gender'];

    // Display form data for debugging
    echo "Name: $name<br>";
    echo "Username: $username<br>";
    echo "Email: $email<br>";
    echo "Password: $password<br>";
    echo "Date of Birth: $date_of_birth<br>";
    echo "Gender: $gender<br>";

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Generate a verification token
    $token = bin2hex(random_bytes(4)); // Generate a random 32-character token
    echo $token;
    // Create SQL query
    // $sql = "INSERT INTO `users` (`no`, `name`, `username`, `email`, `password`, `dob`, `gender`, `verified`) VALUES (NULL, 'khan', 'khan', 'programmingwaliid@gmail.com', 'khan123', '2024-07-17', 'male', '23')";
    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($emailCheckResult->num_rows > 0) {
        $row = $emailCheckResult->fetch_assoc();
        if($row['username'] == $username && $row['email'] !== $email){
            echo "Username is use before use '", $username, "'";
        }
        else if($row['username'] !== $username && $row['email'] == $email){
            echo "Email is use before '", $email, "'";
        }
        else{
            echo "Username and email is use before";
        }
        exit;
    }
    else{
        
    $sql = "INSERT INTO `users` (`no`, `name`, `username`, `email`, `password`, `dob`, `gender`,`token`, `verified`) VALUES (NULL, '$name', '$username', '$email', '$hashed_password', '$date_of_birth', '$gender', '$token', 'no')";

    $result = $conn->query($sql);
    // Check if email or username already exist in the database
        if ($result === TRUE) {
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
                echo "Registration successful. Please verify your email.";
            } else {
                echo "Failed to send verification email.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    }
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
