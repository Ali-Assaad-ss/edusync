<?php

session_start();

include "connect.php";

$teacherId = $_POST['teacherId'];

$courseId = $_POST['courseId'];

$bundleId = $_POST['bundleId'];

$inperson = $_POST['inperson'];

$prices=0;

//get course name

$courseId = mysqli_real_escape_string($conn, $courseId);
$sql = "SELECT * from course WHERE id =$courseId";

$result = mysqli_query($conn, $sql);

$row = $result->fetch_assoc();

$coursename = $row['name'];

//get teacher name

$teacherId = mysqli_real_escape_string($conn, $teacherId);
$sql2 = "SELECT * FROM teacher WHERE id = $teacherId";

$result2 = mysqli_query($conn, $sql2);

$row2 = mysqli_fetch_array($result2);

$teachername = $row2["name"];



$b1 = round($_SESSION["b1"], 1);

$b2 = round($_SESSION["b2"], 1);

$b3 = round($_SESSION["b3"], 1);

$b4 = round($_SESSION["b4"], 1);

$prices = array($b1,$b2,$b3,$b4);





if ($_SESSION["code"]) {

    $code = $_SESSION["code"];

    $sql = "Select * from coupon where code = '$code'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        $discount = $row["discount"];

        $_SESSION['discount'] = $discount;

        $b1 = round($_SESSION["b1"] * (100 - $discount) / 100, 1);

        $b2 = round($_SESSION["b2"] * (100 - $discount) / 100, 1);

        $b3 = round($_SESSION["b3"] * (100 - $discount) / 100, 1);

        $b4 = round($_SESSION["b4"] * (100 - $discount) / 100, 1);

        $prices = array($b1,$b2,$b3,$b4);

    }

}

if ($inperson=="person"){

    $prices = array($b1+6,$b2+9,$b3+12,$b4+18);

}

$price=$prices[($bundleId-1)];







$_SESSION["FT"]=$teachername;

$_SESSION["FTI"]=$teacherId;

$_SESSION["FCI"]=$courseId;

$_SESSION["FC"]=$coursename;

$_SESSION["FL"]=$inperson;

$_SESSION["FB"]=$bundleId;

$_SESSION["FP"]=$price;



echo '

  

<div class="order">

  <div class="order-container">

    <h2>Your Order</h2>

    <div class="order-details">

      <p><strong>Course: </strong>' . $coursename . '</p>

      <p><strong>Teacher: </strong>' . $teachername . '</p>

      <p><strong>Bundle :</strong> Bundle ' . $bundleId . '</p>

      <p><strong>Price :</strong> '.$price.'$</p>

      ';

      if ($_SESSION["code"]) echo '<p><strong>Discount :</strong> '.$discount.'% code: '.$code.' </p>';

      echo'

    </div>

  </div>

  <div class="user-info">

    <label for="name">Enter Your Name</label>

    <input type="text" id="username" placeholder="John Doe" required>



    <label for="phone">Enter Your Phone</label>

    <input type="text" id="phoneNumber" placeholder="123-456-7890" required>

  </div>



  <div class="order-buttons">

    <button onclick="whatsapp()" class="whatsapp-btn">Place Order on WhatsApp</button>

    <span class="or-divider">or</span>

    <button onclick="placeOrder()" class="web-order-btn">Place Order on the Website </button>

  </div>

  </div>

  

';

?>