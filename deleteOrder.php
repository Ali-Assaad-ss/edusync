<?php
// Include your database connection file (connect.php)
include "connect.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $orderId = $_POST['orderId'];

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, "DELETE FROM `request` WHERE id = ?");
    
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "order deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If the request is not a POST request, return an error
    echo "Invalid request method";
}

// Close the database connection
mysqli_close($conn);
?>