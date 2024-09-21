<?php

$servername = 'localhost'; 
$dbname = 'first_task'; 
$username = 'root'; 
$password = ''; 
    
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(''. $conn->connect_error);
} else {
echo "Connected successfully.";
}
?>