<?php
session_start();
ob_start();
$conn = new mysqli("localhost", "root", "", "english");
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

// if (!isset($_SESSION['email']))
//     header("Location: login.php");

?>
