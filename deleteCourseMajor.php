<?php
include "connect.php";
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
if (isset($_POST["majorId"], $_POST["courseId"])) {
    $majorId = $_POST["majorId"];
    $courseId = $_POST["courseId"];

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM `coursemajor` WHERE `courseId`=? AND `majorId`=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $courseId, $majorId);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "major removed successfully";
    } else {
        echo "Failed to remove major";
    }
}
?>