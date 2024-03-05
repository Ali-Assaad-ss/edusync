<?php
// Include your database connection file (connect.php)
include "connect.php";
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $majorId = $_POST['majorId'];

    // Prepare and bind the DELETE statement
    $stmt = $conn->prepare("DELETE FROM `major` WHERE id = ?");
    $stmt->bind_param("i", $majorId);

    // Execute the DELETE statement
    if ($stmt->execute()) {
        echo "major deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request is not a POST request, return an error
    echo "Invalid request method";
}

// Close the database connection
$conn->close();
?>