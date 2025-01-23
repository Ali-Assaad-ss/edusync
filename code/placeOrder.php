<?php
session_start();
include "connect.php";

// Sanitize input data
$username = mysqli_real_escape_string($conn, $_POST['username']);
$phonenumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
$course = $_SESSION["FCI"];
$teacher = $_SESSION["FTI"];
$location = $_SESSION['FL'];
$bundle = $_SESSION['FB'];
$price = $_SESSION['FP'];
$promo = "";
if ($_SESSION['code']) {
    $promo = $_SESSION['code'] . ': ' . $_SESSION['discount'] . '%';
}

$stmt = $conn->prepare("INSERT INTO `request` (`username`, `PhoneNumber`, `teacherId`, `courseId`, `Bundle`, `Price`,`promo`) VALUES (?, ?, ?, ?, ?, ?,?)");

// Bind parameters
$stmt->bind_param("ssiiids", $username, $phonenumber, $teacher, $course, $bundle, $price, $promo);

// Execute the statement
if ($stmt->execute()) {
    echo '  </style>
  <div class="orderConfimation">
  <img style="height:100px;width:100px" src="../design/order.png" alt="Thank You Image" class="thank-you-image">
  <h1>Thank You for Your Order!</h1>
  <p>Your order has been successfully placed. We appreciate your business.</p>
  <!-- You can display order details dynamically based on your application -->

  <p>Feel free to contact us if you have any questions or concerns.</p>
</div>';
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>