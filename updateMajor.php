<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
// Include your database connection file (connect.php)
include "connect.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Create a prepared statement
    $stmt = mysqli_prepare($conn, "UPDATE major SET name = ? WHERE id = ?");
    
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "si", $_POST['name'], $_POST['majorId']);
    
    // Execute the prepared statement
    mysqli_stmt_execute($stmt);
    
    // Check if the query was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "teacher info updated successfully";
    } else {
        echo "Error updating record";
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