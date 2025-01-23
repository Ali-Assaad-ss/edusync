<?php
session_start();
include "connect.php";
$_SESSION["code"] = 0;
$_SESSION["discount"] = 0;
if (isset($_POST['courseId'])) {
  $courseId = $_POST['courseId'];
  $teacherId = $_POST['teacherId'];
  $sql = "select level from course where Id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $courseId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_array($result);
  $level = $row["level"];

$stmt = $conn->prepare("SELECT * FROM teacher WHERE id = ?");
$stmt->bind_param("i", $teacherId);
$stmt->execute();
$result2 = $stmt->get_result();

  $row2 = mysqli_fetch_array($result2);
  $teachername = $row2["name"];
  $teacherDegree = $row2["degree"];
  $d = 0;
  $s=$row2["status"];

  $lowercaseDegree = strtolower($teacherDegree);
  if ($lowercaseDegree == "bachelor") {
    $d = 1;
  } else if ($lowercaseDegree == "master 1") {
    $d = 2;
  } else if ($lowercaseDegree == "master 2") {
    $d = 3;
  } else if ($lowercaseDegree == "phd") {
    $d = 4;
  } else {
    $d = 0;
  }
  $sql2 = "select * from price where id =1";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);

  $base=$row2["basePrice"];
  $degreeAdd=$row2["degreeAdd"];
  $levelAdd=$row2["levelAdd"];

  $level = $row["level"];
  $price = $base + $levelAdd * $level + $degreeAdd * $d;
  $b1 = round($price * 4, 1);
  $b2 = round(($price * 6) * 0.95, 1);
  $b3 = round(($price * 8) * 0.94, 1);
  $b4 = round(($price * 12) * 0.92, 1);
  $_SESSION["b1"] = $b1;
  $_SESSION["b2"] = $b2;
  $_SESSION["b3"] = $b3;
  $_SESSION["b4"] = $b4;
  echo '
<div class="outerb">

<div id="bundle1" class="bundle bundleFront">
<div class="card-3d-wrapper">
  <div class="card-front">
    <div class="pricing-wrap">
      <h4 class="mb-5">Bundle 1</h4>
      <h2 class="mb-2"><sup>$</sup><kl class="priceo '.((($s=="Person")) ? 'hiddenPrice' : '').'">' . $b1 . '</kl> <kl class="pricep '.((($s=="Person")) ? '' : 'hiddenPrice').'">' . ($b1 + 6) . '</kl>/ 4<sup>Sessions</sup></h2>
      <div class="switch switch-blue">
    <input type="radio" class="switch-input" name="view1" value="Online" id="Online1" '.((($s=="Person")) ? 'disabled' : 'checked').'>
    <label for="Online1" class="switch-label switch-label-off">Online</label>
    <input type="radio" class="switch-input" name="view1" value="person" id="person1" '.(($s=="Online") ? 'disabled' :(($s=="All") ? '' :'checked' )).'>
    <label for="person1" class="switch-label switch-label-on">In person</label>
    <span class="switch-selection"></span>
  </div>
      <p class="mb-1"><i class="uil uil-location-pin-alt size-22"></i></p>
      <p class="mb-4">Teacher ' . $teachername . '</p>
      <div style="display:flex;"> <input type="text"  class="coupon" placeholder="Promo Code"> <button class="couponButton" onclick="ApplyCoupon(0)">Add</button></div>
    </div>
  </div>
</div>
</div>


<div id="bundle2"class="bundle bundleBack">
<div class="card-3d-wrapper">
<div class="card-front">
<div class="pricing-wrap">
<h4 class="mb-5">Bundle 2</h4>
<h2 class="mb-2"><sup>$</sup><kl class="priceo '.((($s=="Person")) ? 'hiddenPrice' : '').'">' . $b2 . '</kl> <kl class="pricep '.((($s=="Person")) ? '' : 'hiddenPrice').'">' . ($b2 + 9) . '</kl>/ 6<sup>Sessions</sup></h2>
<div class="switch switch-blue">
<input type="radio" class="switch-input" name="view2" value="Online" id="Online2" '.((($s=="Person")) ? 'disabled' : 'checked').'>
<label for="Online2" class="switch-label switch-label-off">Online</label>
<input type="radio" class="switch-input" name="view2" value="person" id="person2" '.(($s=="Online") ? 'disabled' :(($s=="All") ? '' :'checked' )).'>
<label for="person2" class="switch-label switch-label-on">In person</label>
<span class="switch-selection"></span>
</div>
<p class="mb-1"><i class="uil uil-location-pin-alt size-22"></i></p>
<p class="mb-4">Teacher ' . $teachername . '</p>
<div style="display:flex;"> <input type="text"  class="coupon" placeholder="Promo Code"> <button class="couponButton" onclick="ApplyCoupon(1)">Add</button></div>
</div>
</div>
</div>
</div>

<div id="bundle3"class="bundle">
<div class="card-3d-wrapper">
<div class="card-front">
<div class="pricing-wrap">
<h4 class="mb-5">Bundle 3</h4>
<h2 class="mb-2"><sup>$</sup><kl class="priceo '.((($s=="Person")) ? 'hiddenPrice' : '').'">' . $b3 . '</kl> <kl class="pricep '.((($s=="Person")) ? '' : 'hiddenPrice').'">' . ($b3 + 12) . '</kl>/ 8<sup>Sessions</sup></h2>
<div class="switch switch-blue">
<input type="radio" class="switch-input" name="view3" value="Online" id="Online3" '.((($s=="Person")) ? 'disabled' : 'checked').'>
<label for="Online3" class="switch-label switch-label-off">Online</label>
<input type="radio" class="switch-input" name="view3" value="person" id="person3" '.(($s=="Online") ? 'disabled' :(($s=="All") ? '' :'checked' )).'>
<label for="person3" class="switch-label switch-label-on">In person</label>
<span class="switch-selection"></span>
</div>
<p class="mb-1"><i class="uil uil-location-pin-alt size-22"></i></p>
<p class="mb-4">Teacher ' . $teachername . '</p>
<div style="display:flex;"> <input type="text" class="coupon" placeholder="Promo Code"> <button class="couponButton" onclick="ApplyCoupon(2)">Add</button></div>
</div>
</div>
</div>
</div>

<div id="bundle4"class="bundle">
<div class="card-3d-wrapper">
<div class="card-front">
<div class="pricing-wrap">
<h4 class="mb-5">Bundle 4</h4>
<h2 class="mb-2"><sup>$</sup><kl class="priceo '.((($s=="Person")) ? 'hiddenPrice' : '').'">' . $b4 . '</kl> <kl class="pricep '.((($s=="Person")) ? '' : 'hiddenPrice').'">' . ($b4 + 18) . '</kl>/ 12<sup>Sessions</sup></h2>
<div class="switch switch-blue">
<input type="radio" class="switch-input" name="view4" value="Online" id="Online4" '.((($s=="Person")) ? 'disabled' : 'checked').' >
<label for="Online4" class="switch-label switch-label-off">Online</label>
<input type="radio" class="switch-input" name="view4" value="person" id="person4" '.(($s=="Online") ? 'disabled' :(($s=="All") ? '' :'checked' )).'>
<label for="person4" class="switch-label switch-label-on">In person</label>
<span class="switch-selection"></span>
</div>
<p class="mb-1"><i class="uil uil-location-pin-alt size-22"></i></p>
<p class="mb-4">Teacher ' . $teachername . '</p>
<div style="display:flex;"> <input type="text" class="coupon" placeholder="Promo Code"> <button class="couponButton" onclick="ApplyCoupon(3)">Add</button></div>
</div>
</div>
</div>
</div>

  <span id="arrow1" onclick="nextBundle(1)" class="arrow"></span>
  <span id="arrow2" onclick="nextBundle(2)" class="arrow"></span>
</div>';
}
