<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
include "connect.php";
// Check if the major parameter is set
if (isset($_POST['major'])) {
    // Retrieve the major from the AJAX request
    $major = $_POST['major'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `major` (`name`) VALUES (?)");
    $stmt->bind_param("s", $major);

    if ($stmt->execute()) {
        echo "major added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
    
}
?>