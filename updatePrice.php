<?php
// Include the connection file
include "connect.php";

// Get the base price, degree add, and level add from the POST request
$base = $_POST["basePrice"];
$deg = $_POST["degreeAdd"];
$level = $_POST["levelAdd"];

// Prepare and execute the SQL statement to update the price table
$stmt = $conn->prepare("UPDATE `price` SET `basePrice`=?, `degreeAdd`=?, `levelAdd`=? WHERE id=1");
$stmt->bind_param("sss", $base, $deg, $level);
$stmt->execute();

// Output success message
echo "success";
?>