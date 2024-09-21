<?php
session_start();
require_once("config.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: contact.html");
        exit();
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: contact.html");
        exit();
    }

    
    $stmt = $conn->prepare("INSERT INTO inquiries (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");

   
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Your inquiry has been submitted successfully.";
        header("Location: contact.html");
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: contact.html");
        exit();
    }

    
    $stmt->close();
}
?>
