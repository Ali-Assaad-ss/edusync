<?php
// Include your database connection file (connect.php)
include "connect.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code = $_POST['code'];
    // Update the record in the database using prepared statements
    $sql = "DELETE FROM `coupon` WHERE code = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $code);
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "coupon deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
} else {
    // If the request is not a POST request, return an error
    echo "Invalid request method";
}

// Close the database connection
mysqli_close($conn);
?>