<?php
include "connect.php";

if (isset($_POST["teacherId"], $_POST["courseId"])) {
    $teacherId = mysqli_real_escape_string($conn, $_POST["teacherId"]);
    $courseId = mysqli_real_escape_string($conn, $_POST["courseId"]);

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM `courseteacher` WHERE `courseId`=? AND `teacherId`=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $courseId, $teacherId);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Teacher removed successfully";
    } else {
        echo "Failed to remove teacher";
    }
}
?>