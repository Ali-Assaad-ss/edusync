<?php
// Include your database connection file (connect.php)
include "connect.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $teacherId = $_POST['teacherId'];

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, "DELETE FROM `teacher` WHERE id = ?");

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $teacherId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Teacher deleted successfully";
    } else {
        echo "Error updating record: " . mysqli_stmt_error($stmt);
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