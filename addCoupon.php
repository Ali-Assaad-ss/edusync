<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
include "connect.php";

// Check if the code parameter is set
if (isset($_POST['code']) && isset($_POST['discount'])) {
    // Retrieve the code and discount from the AJAX request
    $code = $_POST['code'];
    $discount = $_POST['discount'];

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO coupon (code, discount) VALUES (?, ?)");

    // Bind parameters
    $stmt->bind_param("si", $code, $discount);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Coupon added successfully" . $discount;

    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid parameters";
}
?>
