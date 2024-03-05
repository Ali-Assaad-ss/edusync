<?php
//code to receive data from login form and check it with database then create session and redirect to admin page
include "connect.php";
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) == 1){
        $_SESSION['Admin'] = $username;
        header("location:admin.php");
    } else {
        header("location:loginPage.php");
    }
    }
?>