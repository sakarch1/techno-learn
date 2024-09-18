<?php
session_start();
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $course_id = $_GET['course_id'];  

    if (!$course_id) {
        $_SESSION['error'] = "Invalid course selection.";
        header("Location: enroll.html");
        exit();
    }

    $conn->autocommit(false);

    try {
        
        $stmt = $conn->prepare("INSERT INTO premium (user_id, course_id, membership_status, created_at) VALUES (?, ?, 'active', NOW())");
        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();

        
        $stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id, enrollment_status, created_at) VALUES (?, ?, 'enrolled', NOW())");
        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();

        
        $conn->commit();
        $_SESSION['success'] = "You have successfully enrolled in the premium course.";
        header("Location: success.html");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = "Enrollment failed. Please try again.";
        header("Location: enroll.html");
        exit();
    } finally {
        $conn->autocommit(true); 
    }
}
?>
