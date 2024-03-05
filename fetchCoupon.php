<?php
session_start();
include "connect.php";

// Check if the code is set in the POST request
if (isset($_POST["code"])) {
    // Set the code in the session
    $_SESSION["code"] = $_POST["code"];
    $code = $_POST["code"];
    // Prepare and execute a SQL statement to select data from the coupon table based on the code
    $stmt = $conn->prepare("SELECT * FROM coupon WHERE code = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // If there are rows in the result, calculate and apply the discount
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $discount = $row["discount"];
        // Apply the discount to session variables b1, b2, b3, and b4
        $b1 = round($_SESSION["b1"] * (100 - $discount) / 100, 1);
        $b2 = round($_SESSION["b2"] * (100 - $discount) / 100, 1);
        $b3 = round($_SESSION["b3"] * (100 - $discount) / 100, 1);
        $b4 = round($_SESSION["b4"] * (100 - $discount) / 100, 1);
        // Create a result array with the updated values and encode it to JSON
        $result = array('b1' => $b1, 'b2' => $b2, 'b3' => $b3, 'b4' => $b4);
        echo json_encode($result);
    }
}
?>