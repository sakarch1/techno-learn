<?php
session_start();

include("config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: login.html");
        exit();
    }

    
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id; 
            header("Location: home.html"); 
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: login.html");
            exit();
        }
    } else {
        $_SESSION['error'] = "No account found with that email.";
        header("Location: login.html");
        exit();
    }
}
?>
