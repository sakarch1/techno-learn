<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
       
        $_SESSION['loggedin'] = true;
        $_SESSION['user_email'] = $email;
        header("Location: home.html");
    } else {
        
        echo "Invalid email or password.";
    }
}
?>
