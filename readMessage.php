<?php
include "connect.php";
$id = $_POST["messageId"];

// Create a prepared statement
$stmt = mysqli_prepare($conn, "SELECT * FROM message where id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_array($result)) {
    echo '<span id="messagecloseBtn" onclick="closeMessage()">×</span>';
    echo '<h2>Subject: ' . htmlspecialchars($row["subject"]) . '</h2>';
    echo '<p><strong>Message: </strong><br><br>' . htmlspecialchars($row["content"]) . '</p>';

    // Update message status using prepared statement
    $stmt = mysqli_prepare($conn, "UPDATE message SET status=1 WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

// Close the prepared statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>