<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
include "connect.php";

if (isset($_POST["majorId"], $_POST["courseId"])) {
    $majorId = $_POST["majorId"];
    $courseId = $_POST["courseId"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `coursemajor` (`courseId`, `majorId`) VALUES (?, ?)");
    $stmt->bind_param("ss", $courseId, $majorId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "major added successfully";
    } else {
        echo "Failed to add major";
    }

    $stmt->close();
}
?>