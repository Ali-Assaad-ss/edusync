<?php
// Include your database connection file (connect.php)
include "connect.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code = $_POST['code'];
    $discount = $_POST['discount'];
    $oldcode = $_POST['ocode'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "UPDATE coupon SET code = ?, discount = ? WHERE code = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sds", $code, $discount, $oldcode);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Coupon updated successfully";
    } else {
        echo "Error updating record: " . mysqli_stmt_error($stmt);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // If the request is not a POST request, return an error
    echo "Invalid request method";
}

// Close the database connection
mysqli_close($conn);
?>