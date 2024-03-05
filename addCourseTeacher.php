<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
include "connect.php";

if (isset($_POST["teacherId"], $_POST["courseId"])) {
    $teacherId = $_POST["teacherId"];
    $courseId = $_POST["courseId"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `courseteacher` (`courseId`, `teacherId`) VALUES (?, ?)");
    $stmt->bind_param("ss", $courseId, $teacherId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Teacher added successfully";
    } else {
        echo "Failed to add teacher";
    }

    $stmt->close();
}
?>